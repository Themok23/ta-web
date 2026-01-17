<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductQuery;
use App\Models\Category;
use App\Utility\CategoryUtility;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ProductQueryReplyNotification;
use App\Enums\InquiryStatus;

class ProductQueryController extends Controller
{
    public function __construct()
    {
        // Staff Permission Check
        $this->middleware(['permission:view_all_product_queries'])->only(['index', 'show']);
        $this->middleware(['permission:reply_to_product_queries'])->only(['reply']);
    }

    /**
     * Admin: Retrieve all inquiries with filtering
     */
    public function index(Request $request)
    {
        $query = ProductQuery::with(['product', 'user', 'category']);

        // Filter by status
        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        // Filter by category (main category should include all descendants)
        if ($request->filled('category_id')) {
            $category = Category::find($request->category_id);
            if ($category) {
                $ids = array_merge([$category->id], CategoryUtility::children_ids($category->id, true));
                $query->whereIn('category_id', $ids);
            }
        }

        // Filter by product
        if ($request->filled('product_id')) {
            $query->byProduct($request->product_id);
        }

        $queries = $query->latest()->paginate(20);

        // Get categories and products for filter dropdowns
        $categories = Category::where('parent_id', 0)->get();
        $productIds = ProductQuery::query()->select('product_id')->distinct()->pluck('product_id');
        $products = Product::whereIn('id', $productIds)->get();

        return view('backend.support.product_query.index', compact('queries', 'categories', 'products'));
    }

    /**
     * Retrieve specific query using query id.
     */
    public function show($id)
    {
        $query = ProductQuery::with(['product', 'user', 'category'])->findOrFail(decrypt($id));
        return view('backend.support.product_query.show', compact('query'));
    }

    /**
     * store products queries through the ProductQuery model
     * data comes from product details page
     * authenticated user can leave queries about the product
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'question' => 'required|string',
        ]);
        $product = Product::find($request->product);

        $query = new ProductQuery();
        $query->customer_id = Auth::id();
        $query->seller_id = $product->user_id;
        $query->product_id = $product->id;
        $query->category_id = $product->category_id; // Set category for filtering
        $query->question = $request->question;
        $query->save();
        flash(translate('Your query has been submittes successfully'))->success();
        return redirect()->back();
    }

    /**
     * Store reply against the question from Admin panel
     */

    public function reply(Request $request, $id)
    {
        $this->validate($request, [
            'reply' => 'required',
        ]);
        $query = ProductQuery::find($id);
        $query->reply = $request->reply;
        // Auto-update status to Responded if it was New or Pending
        if (in_array($query->status, [InquiryStatus::New, InquiryStatus::Pending])) {
            $query->status = InquiryStatus::Responded;
        }
        $query->save();

        // Notify customer about reply
        $query->loadMissing('product', 'user');
        $notificationType = get_notification_type('product_query_replied_customer', 'type');
        if ($notificationType && $notificationType->status == 1 && $query->user) {
            $product = $query->product;
            $link = $product ? (route('product', $product->slug) . '#product_query') : null;
            $statusLabel = $query->status instanceof InquiryStatus ? $query->status->label() : (string) $query->status;
            $data = [
                'notification_type_id' => $notificationType->id,
                'product_query_id' => $query->id,
                'product_id' => $product?->id,
                'product_slug' => $product?->slug,
                'product_name' => $product ? $product->getTranslation('name') : null,
                'status' => $query->status instanceof InquiryStatus ? $query->status->value : (string) $query->status,
                'status_label' => $statusLabel,
                'link' => $link,
            ];
            Notification::send($query->user, new ProductQueryReplyNotification($data));
        }
        flash(translate('Replied successfully!'))->success();
        return redirect()->route('product_query.index');
    }
}

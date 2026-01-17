<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\ProductQuery;
use App\Models\Category;
use App\Models\Product;
use App\Enums\InquiryStatus;
use App\Utility\CategoryUtility;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ProductQueryReplyNotification;
use App\Notifications\ProductQueryStatusNotification;

class ProductQueryController extends Controller
{
    /**
     * Retrieve queries that belongs to current seller with filtering
     */
    public function index(Request $request)
    {
        $query = ProductQuery::where('seller_id', Auth::id())
            ->with(['product', 'user', 'category']);

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->byStatus($request->status);
        }

        // Filter by category
        if ($request->has('category_id') && $request->category_id) {
            $category = Category::find($request->category_id);
            if ($category) {
                $ids = array_merge([$category->id], CategoryUtility::children_ids($category->id, true));
                $query->whereIn('category_id', $ids);
            }
        }

        // Filter by product
        if ($request->has('product_id') && $request->product_id) {
            $query->byProduct($request->product_id);
        }

        $queries = $query->latest()->paginate(20);

        // Get categories and products for filter dropdowns
        $categories = Category::where('parent_id', 0)->get();
        $products = Product::where('user_id', Auth::id())->get();

        return view('seller.product_query.index', compact('queries', 'categories', 'products'));
    }

    /**
     * Retrieve specific query using query id.
     */
    public function show($id)
    {
        $query = ProductQuery::with(['product', 'user', 'category'])
            ->where('seller_id', Auth::id())
            ->findOrFail(decrypt($id));
        
        return view('seller.product_query.show', compact('query'));
    }

    /**
     * Store reply against the question from seller panel
     */
    public function reply(Request $request, $id)
    {
        $this->validate($request, [
            'reply' => 'required',
        ]);
        
        $query = ProductQuery::where('seller_id', Auth::id())->findOrFail($id);
        $query->reply = $request->reply;
        
        // Auto-update status to Responded if it was New or Pending
        if (in_array($query->status, [InquiryStatus::New, InquiryStatus::Pending])) {
            $query->status = InquiryStatus::Responded;
        }
        
        $query->loadMissing('product', 'user');
        $query->save();

        // Notify customer about reply
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
        return redirect()->route('seller.product_query.index');
    }

    /**
     * Update inquiry status
     */
    public function updateStatus(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required|string',
        ]);

        $query = ProductQuery::where('seller_id', Auth::id())->findOrFail($id);
        
        try {
            $status = InquiryStatus::from($request->status);
            $query->status = $status;
            $query->save();

            // Notify customer about status change
            $query->loadMissing('product', 'user');
            $notificationType = get_notification_type('product_query_status_changed_customer', 'type');
            if ($notificationType && $notificationType->status == 1 && $query->user) {
                $product = $query->product;
                $link = $product ? (route('product', $product->slug) . '#product_query') : null;
                $data = [
                    'notification_type_id' => $notificationType->id,
                    'product_query_id' => $query->id,
                    'product_id' => $product?->id,
                    'product_slug' => $product?->slug,
                    'product_name' => $product ? $product->getTranslation('name') : null,
                    'status' => $status->value,
                    'status_label' => $status->label(),
                    'link' => $link,
                ];
                Notification::send($query->user, new ProductQueryStatusNotification($data));
            }
            
            flash(translate('Status updated successfully!'))->success();
        } catch (\ValueError $e) {
            flash(translate('Invalid status!'))->error();
        }
        
        return redirect()->back();
    }
}

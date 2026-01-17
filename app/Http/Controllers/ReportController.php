<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CommissionHistory;
use App\Models\Wallet;
use App\Models\User;
use App\Models\Search;
use App\Models\Shop;
use App\Models\ProductQuery;
use App\Models\Category;
use App\Enums\InquiryStatus;
use App\Utility\CategoryUtility;
use Carbon\Carbon;
use DB;
use Auth;

class ReportController extends Controller
{
    public function __construct()
    {
        // Staff Permission Check
        $this->middleware(['permission:in_house_product_sale_report'])->only('in_house_sale_report');
        $this->middleware(['permission:seller_products_sale_report'])->only('seller_sale_report');
        $this->middleware(['permission:products_stock_report'])->only('stock_report');
        $this->middleware(['permission:product_wishlist_report'])->only('wish_report');
        $this->middleware(['permission:user_search_report'])->only('user_search_report');
        $this->middleware(['permission:commission_history_report'])->only('commission_history');
        $this->middleware(['permission:wallet_transaction_report'])->only('wallet_transaction_history');
        $this->middleware(['permission:inquiries_report'])->only('inquiries_report');
    }

    public function stock_report(Request $request)
    {
        $sort_by = null;
        $products = Product::orderBy('created_at', 'desc');
        if ($request->has('category_id')) {
            $sort_by = $request->category_id;
            $products = $products->where('category_id', $sort_by);
        }
        $products = $products->paginate(15);
        return view('backend.reports.stock_report', compact('products', 'sort_by'));
    }

    public function in_house_sale_report(Request $request)
    {
        $sort_by = null;
        $products = Product::orderBy('num_of_sale', 'desc')->where('added_by', 'admin');
        if ($request->has('category_id')) {
            $sort_by = $request->category_id;
            $products = $products->where('category_id', $sort_by);
        }
        $products = $products->paginate(15);
        return view('backend.reports.in_house_sale_report', compact('products', 'sort_by'));
    }

    public function seller_sale_report(Request $request)
    {
        $sort_by = null;
        // $sellers = User::where('user_type', 'seller')->orderBy('created_at', 'desc');
        $sellers = Shop::with('user')->orderBy('created_at', 'desc');
        if ($request->has('verification_status')) {
            $sort_by = $request->verification_status;
            $sellers = $sellers->where('verification_status', $sort_by);
        }
        $sellers = $sellers->paginate(10);
        return view('backend.reports.seller_sale_report', compact('sellers', 'sort_by'));
    }

    public function wish_report(Request $request)
    {
        $sort_by = null;
        $products = Product::orderBy('created_at', 'desc');
        if ($request->has('category_id')) {
            $sort_by = $request->category_id;
            $products = $products->where('category_id', $sort_by);
        }
        $products = $products->paginate(10);
        return view('backend.reports.wish_report', compact('products', 'sort_by'));
    }

    public function user_search_report(Request $request)
    {
        $searches = Search::orderBy('count', 'desc')->paginate(10);
        return view('backend.reports.user_search_report', compact('searches'));
    }

    public function commission_history(Request $request)
    {
        $seller_id = null;
        $date_range = null;

        if (Auth::user()->user_type == 'seller') {
            $seller_id = Auth::user()->id;
        }
        if ($request->seller_id) {
            $seller_id = $request->seller_id;
        }

        $commission_history = CommissionHistory::orderBy('created_at', 'desc');

        if ($request->date_range) {
            $date_range = $request->date_range;
            $date_range1 = explode(" / ", $request->date_range);
            $commission_history = $commission_history->where('created_at', '>=', $date_range1[0]);
            $commission_history = $commission_history->where('created_at', '<=', $date_range1[1]);
        }
        if ($seller_id) {

            $commission_history = $commission_history->where('seller_id', '=', $seller_id);
        }

        $commission_history = $commission_history->paginate(10);
        if (Auth::user()->user_type == 'seller') {
            return view('seller.reports.commission_history_report', compact('commission_history', 'seller_id', 'date_range'));
        }
        return view('backend.reports.commission_history_report', compact('commission_history', 'seller_id', 'date_range'));
    }

    public function wallet_transaction_history(Request $request)
    {
        $user_id = null;
        $date_range = null;

        if ($request->user_id) {
            $user_id = $request->user_id;
        }

        $users_with_wallet = User::whereIn('id', function ($query) {
            $query->select('user_id')->from(with(new Wallet)->getTable());
        })->get();

        $wallet_history = Wallet::orderBy('created_at', 'desc');

        if ($request->date_range) {
            $date_range = $request->date_range;
            $date_range1 = explode(" / ", $request->date_range);
            $wallet_history = $wallet_history->where('created_at', '>=', $date_range1[0]);
            $wallet_history = $wallet_history->where('created_at', '<=', $date_range1[1]);
        }
        if ($user_id) {
            $wallet_history = $wallet_history->where('user_id', '=', $user_id);
        }

        $wallets = $wallet_history->paginate(10);

        return view('backend.reports.wallet_history_report', compact('wallets', 'users_with_wallet', 'user_id', 'date_range'));
    }

    public function inquiries_report(Request $request)
    {
        $query = ProductQuery::with(['product', 'user', 'category']);

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Filter by category
        if ($request->has('category_id') && $request->category_id) {
            $category = Category::find($request->category_id);
            if ($category) {
                $ids = array_merge([$category->id], CategoryUtility::children_ids($category->id, true));
                $query->whereIn('category_id', $ids);
            }
        }

        // Filter by date range
        if ($request->has('date_range') && $request->date_range) {
            $date_range = explode(" / ", $request->date_range);
            if (count($date_range) == 2) {
                $query->whereDate('created_at', '>=', $date_range[0])
                      ->whereDate('created_at', '<=', $date_range[1]);
            }
        }

        // Filter by search term
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('question', 'like', "%{$search}%")
                  ->orWhere('reply', 'like', "%{$search}%")
                  ->orWhereHas('product', function($productQuery) use ($search) {
                      $productQuery->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        $inquiries = $query->orderBy('created_at', 'desc')->paginate(20);

        // Analytics data
        $total_inquiries = ProductQuery::count();
        // Important: ProductQuery casts `status` to InquiryStatus enum, which breaks using it as an array key.
        // Use query builder to keep status as a plain string.
        $inquiries_by_status = DB::table('product_queries')
            ->select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Monthly trend (last 12 months)
        $monthly_trend = ProductQuery::select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                DB::raw('count(*) as count')
            )
            ->where('created_at', '>=', Carbon::now()->subMonths(12))
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        // Top categories by inquiries
        $top_categories = ProductQuery::select('categories.name', 'categories.id', DB::raw('count(*) as count'))
            ->join('categories', 'product_queries.category_id', '=', 'categories.id')
            ->groupBy('categories.id', 'categories.name')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get();

        // Top products by inquiries
        $top_products = ProductQuery::select('products.name', 'products.id', DB::raw('count(*) as count'))
            ->join('products', 'product_queries.product_id', '=', 'products.id')
            ->groupBy('products.id', 'products.name')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get();

        // Response rate (inquiries with replies)
        $responded_count = ProductQuery::whereNotNull('reply')->count();
        $response_rate = $total_inquiries > 0 ? ($responded_count / $total_inquiries) * 100 : 0;

        // Conversion rate (accepted + deal_closed)
        $converted_count = ProductQuery::whereIn('status', [InquiryStatus::Accepted->value, InquiryStatus::DealClosed->value])->count();
        $conversion_rate = $total_inquiries > 0 ? ($converted_count / $total_inquiries) * 100 : 0;

        // Get categories for filter dropdown
        $categories = Category::where('parent_id', 0)->get();

        return view('backend.reports.inquiries_report', compact(
            'inquiries',
            'total_inquiries',
            'inquiries_by_status',
            'monthly_trend',
            'top_categories',
            'top_products',
            'response_rate',
            'conversion_rate',
            'categories'
        ));
    }

    public function search_reports(Request $request)
    {
        $search_term = $request->get('q', '');
        $results = [
            'inquiries' => collect(),
            'products' => collect(),
            'users' => collect(),
        ];

        if ($search_term) {
            // Search across different report types
            $results['inquiries'] = ProductQuery::where(function($q) use ($search_term) {
                    $q->where('question', 'like', "%{$search_term}%")
                      ->orWhere('reply', 'like', "%{$search_term}%");
                })
                ->with(['product', 'user'])
                ->limit(5)
                ->get();

            $results['products'] = Product::where('name', 'like', "%{$search_term}%")
                ->limit(5)
                ->get();

            $results['users'] = User::where(function($q) use ($search_term) {
                    $q->where('name', 'like', "%{$search_term}%")
                      ->orWhere('email', 'like', "%{$search_term}%");
                })
                ->limit(5)
                ->get();
        }

        return view('backend.reports.search', compact('search_term', 'results'));
    }

}

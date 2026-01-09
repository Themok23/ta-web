@php
    use App\Models\Category;

    $topHeaderTextColor = get_setting('top_header_text_color');
    $middleHeaderTextColor = get_setting('middle_header_text_color');
    $bottomHeaderTextColor = get_setting('bottom_header_text_color');

    $categories = Category::where('level', 0)->with('childrenCategories')->get();
@endphp

<style>
    body {
        margin: 0;
        padding: 0;
    }

    .header {
        background: transparent;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        padding: 20px 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .header-container {
        max-width: 1200px;
        width: 90%;
        padding: 0 40px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #1a1a1a;
        border-radius: 100px;
        height: 56px;
        transition: all 0.3s ease;
    }

    .header-container.search-active {
        border-radius: 16px;
        height: auto;
        flex-wrap: wrap;
        padding: 12px 40px;
    }

    /* Logo */
    .logo1 {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        color: white;
        padding-right: 20px;
    }

    .logo1-icon {
        width: 24px;
        height: 24px;
    }

    .logo1-text {
        font-size: 18px;
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .logo1-text span {
        font-weight: 400;
    }

    /* Navigation */
    .nav {
        display: flex;
        align-items: center;
        gap: 40px;
        flex: 1;
        justify-content: center;
    }

    .nav-link {
        color: #fff;
        text-decoration: none;
        font-size: 15px;
        font-weight: 500;
        transition: color 0.2s;
        white-space: nowrap;
    }

    .nav-link:hover {
        color: #3b82f6;
    }

    .nav-dropdown {
        position: relative;
    }

    .dropdown-btn {
        background: none;
        border: none;
        color: #fff;
        font-size: 15px;
        font-weight: 500;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: color 0.2s;
        padding: 0;
    }

    .dropdown-btn:hover {
        color: #3b82f6;
    }

    .dropdown-arrow {
        width: 14px;
        height: 14px;
        transition: transform 0.2s;
    }

    .dropdown-btn.active .dropdown-arrow {
        transform: rotate(180deg);
    }

    /* Actions */
    .header-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        padding-left: 20px;
    }

    .icon-btn {
        background: none;
        border: none;
        color: #999;
        cursor: pointer;
        padding: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.2s;
        position: relative;
    }

    .icon-btn:hover {
        color: #fff;
        background: #2a2a2a;
    }

    .icon-btn svg {
        width: 20px;
        height: 20px;
    }

    .badge-count {
        position: absolute;
        top: 2px;
        right: 2px;
        background: #3b82f6;
        color: white;
        font-size: 10px;
        font-weight: 700;
        padding: 2px 5px;
        border-radius: 10px;
        min-width: 16px;
        text-align: center;
    }

    .mobile-menu-btn {
        display: none;
        background: none;
        border: none;
        color: #fff;
        cursor: pointer;
        padding: 8px;
    }

    /* Search Bar */
    .search-container {
        width: 100%;
        margin-top: 12px;
        display: none;
        opacity: 0;
        transform: translateY(-10px);
        transition: all 0.3s ease;
    }

    .search-container.active {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }

    .search-input-wrapper {
        position: relative;
        width: 100%;
    }

    .search-input {
        width: 100%;
        padding: 12px 50px 12px 20px;
        background: #2a2a2a;
        border: 1px solid #3a3a3a;
        border-radius: 100px;
        color: #fff;
        font-size: 15px;
        outline: none;
        transition: all 0.2s;
    }

    .search-input:focus {
        border-color: #3b82f6;
        background: #333;
    }

    .search-input::placeholder {
        color: #666;
    }

    .search-close-btn {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #999;
        cursor: pointer;
        padding: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.2s;
    }

    .search-close-btn:hover {
        color: #fff;
        background: #3a3a3a;
    }

    /* Dropdown Menu Styles */
    .header-dropdown {
        position: absolute;
        top: calc(100% + 10px);
        left: 50%;
        transform: translateX(-50%);
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        min-width: 200px;
        opacity: 0;
        visibility: hidden;
        transform: translateX(-50%) translateY(-10px);
        transition: all 0.3s;
        z-index: 1000;
    }

    .nav-dropdown:hover .header-dropdown {
        opacity: 1;
        visibility: visible;
        transform: translateX(-50%) translateY(0);
    }

    .icon-dropdown {
        right: 0;
        left: auto;
        transform: none;
    }

    .icon-btn:hover .icon-dropdown {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .dropdown-header {
        padding: 12px 16px;
        background: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
        border-radius: 8px 8px 0 0;
        font-weight: 600;
        color: #333;
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        color: #333;
        text-decoration: none;
        transition: background 0.2s;
        border-bottom: 1px solid #f0f0f0;
    }

    .dropdown-item:last-child {
        border-bottom: none;
    }

    .dropdown-item:hover {
        background: #000000;
    }

    .dropdown-footer {
        padding: 10px;
        text-align: center;
        border-top: 1px solid #e9ecef;
    }

    .dropdown-footer a {
        color: #3b82f6;
        text-decoration: none;
        font-size: 13px;
        font-weight: 500;
    }

    /* === Sub Categories Dropdown (Mega Menu Style) === */
    .category-item-wrapper {
        position: relative;
    }

    .sub-dropdown {
        position: absolute;
        top: 0;
        left: 100%;
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        min-width: 200px;
        opacity: 0;
        visibility: hidden;
        transform: translateX(-10px);
        transition: all 0.3s ease;
        z-index: 1000;
        margin-left: 10px;
        padding: 8px 0;
    }

    .category-item-wrapper:hover>.sub-dropdown {
        opacity: 1;
        visibility: visible;
        transform: translateX(0);
    }

    .category-item-wrapper:hover>.dropdown-item {
        background: #000000;
    }

    .sub-arrow {
        margin-left: auto;
        width: 16px;
        height: 16px;
        transition: transform 0.2s ease;
    }

    .category-item-wrapper:hover .sub-arrow {
        transform: translateX(4px);
    }

    /* Mobile Styles */
    @media (max-width: 968px) {
        .header {
            padding: 12px 0;
        }

        .header-container {
            border-radius: 16px;
            padding: 0 20px;
            width: 95%;
        }

        .nav {
            display: none;
            position: absolute;
            top: 68px;
            left: 50%;
            transform: translateX(-50%);
            width: 95%;
            max-width: 1200px;
            background: #1a1a1a;
            flex-direction: column;
            gap: 0;
            padding: 16px 0;
            border-radius: 16px;
        }

        .nav.active {
            display: flex;
        }

        .nav-link,
        .dropdown-btn {
            padding: 12px 24px;
            width: 100%;
            text-align: right;
        }

        .mobile-menu-btn {
            display: block;
        }

        .header-actions {
            gap: 4px;
            padding-left: 0;
        }

        .search-input {
            font-size: 14px;
            padding: 10px 40px 10px 16px;
        }

        .sub-dropdown {
            display: none;
        }
    }
</style>

<header class="header">
    <div class="header-container" id="headerContainer">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="logo1">
            @php
                $header_logo = get_setting('header_logo');
            @endphp
            @if ($header_logo != null)
                <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}" class="logo-icon">
            @else
                <svg class="logo1-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="#3B82F6" stroke="#3B82F6" stroke-width="2"
                        stroke-linejoin="round" />
                    <path d="M2 17L12 22L22 17" stroke="#3B82F6" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M2 12L12 17L22 12" stroke="#3B82F6" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            @endif
            <span class="logo-text">TRADES<span>AXIS</span></span>
        </a>

        <!-- Navigation -->
        <nav class="nav" id="mainNav">
            @if (get_setting('header_menu_labels') != null)
                @foreach (json_decode(get_setting('header_menu_labels'), true) as $key => $value)
                    @if ($value == 'All Categories')
                        {{-- عرض الـ Categories مع الـ dropdown --}}
                        @if (isset($categories) && $categories->count() > 0)
                            <div class="nav-dropdown">
                                <button class="dropdown-btn">
                                    {{ translate('categories') }}
                                    <svg class="dropdown-arrow" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <div class="header-dropdown">
                                    <div class="dropdown-header">{{ translate('Categories') }}</div>

                                    @foreach ($categories->take(10) as $category)
                                        <div class="category-item-wrapper">
                                            <a href="{{ route('products.category', $category->slug) }}"
                                                class="dropdown-item">
                                                @if ($category->icon)
                                                    <img src="{{ uploaded_asset($category->icon) }}" width="20"
                                                        height="20">
                                                @endif
                                                <span>{{ $category->getTranslation('name') }}</span>

                                                @if ($category->childrenCategories->count() > 0)
                                                    <svg class="sub-arrow" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M9 5l7 7-7 7" />
                                                    </svg>
                                                @endif
                                            </a>

                                            @if ($category->childrenCategories->count() > 0)
                                                <div class="sub-dropdown">
                                                    @foreach ($category->childrenCategories as $subCategory)
                                                        <a href="{{ route('products.category', $subCategory->slug) }}"
                                                            class="dropdown-item">
                                                            <span>{{ $subCategory->getTranslation('name') }}</span>
                                                        </a>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach

                                    <div class="dropdown-footer">
                                        <a href="{{ route('categories.all') }}">
                                            {{ translate('View All Categories') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @else
                            {{-- Link عادي لو مفيش categories --}}
                            <a href="{{ route('categories.all') }}" class="nav-link">
                                {{ translate('All categories') }}
                            </a>
                        @endif
                    @elseif ($value == 'Partners' || $value == 'Our Partners')
                        {{-- عرض الـ Partners مع الـ dropdown --}}
                        <div class="nav-dropdown">
                            <button class="dropdown-btn">
                                {{ translate('Partners') }}
                                <svg class="dropdown-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="header-dropdown">
                                <a href="{{ route('ourpartners') }}" class="dropdown-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                    <span>{{ translate('Our Partners') }}</span>
                                </a>
                                <a href="{{ route('join_us') }}" class="dropdown-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <line x1="19" y1="8" x2="19" y2="14"></line>
                                        <line x1="22" y1="11" x2="16" y2="11"></line>
                                    </svg>
                                    <span>{{ translate('Join Us') }}</span>
                                </a>
                            </div>
                        </div>
                    @else
                        @if (!in_array($value, ['Partners', 'Our Partners', 'Join Us']))
                            <a href="{{ json_decode(get_setting('header_menu_links'), true)[$key] }}" class="nav-link">
                                {{ translate($value) }}
                            </a>
                        @endif
                    @endif
                @endforeach
            @endif
        </nav>

        <!-- Actions (Search, Compare, Wishlist, Notifications, Cart, User) -->
        <div class="header-actions">
            <!-- Search Icon -->
            <button class="icon-btn" onclick="toggleSearch()">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>

            @if (Auth::check() && auth()->user()->user_type == 'customer')
                <!-- Compare -->
                <div class="icon-btn" style="position: relative;">
                    <a href="{{ route('compare') }}" style="color: inherit; display: flex;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </a>
                    @if (Session::has('compare'))
                        <span class="badge-count">{{ count(Session::get('compare')) }}</span>
                    @endif
                </div>

                <!-- Wishlist -->
                <div class="icon-btn" style="position: relative;">
                    <a href="{{ route('wishlists.index') }}" style="color: inherit; display: flex;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </a>
                    @if (Auth::check())
                        <span class="badge-count">{{ count(Auth::user()->wishlists) }}</span>
                    @endif
                </div>

                <!-- Notifications -->
                <div class="icon-btn" style="position: relative;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    @if (count($user->unreadNotifications) > 0)
                        <span class="badge-count">{{ count($user->unreadNotifications) }}</span>
                    @endif

                    <div class="header-dropdown icon-dropdown" style="max-width: 320px;">
                        <div class="dropdown-header">{{ translate('Notifications') }}</div>
                        <div style="max-height: 300px; overflow-y: auto;">
                            @forelse($user->unreadNotifications->take(5) as $notification)
                                <a href="{{ route('notification.read-and-redirect', encrypt($notification->id)) }}"
                                    class="dropdown-item">
                                    <div style="flex: 1;">
                                        <p style="margin: 0; font-size: 13px; color: #333;">
                                            {{ Str::limit($notification->data['message'] ?? 'New notification', 50) }}
                                        </p>
                                        <small
                                            style="color: #999;">{{ $notification->created_at->diffForHumans() }}</small>
                                    </div>
                                </a>
                            @empty
                                <div style="padding: 20px; text-align: center; color: #999;">
                                    {{ translate('No notifications') }}
                                </div>
                            @endforelse
                        </div>
                        <div class="dropdown-footer">
                            <a href="{{ route('customer.all-notifications') }}">{{ translate('View All') }}</a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Cart -->
            <div class="icon-btn" style="position: relative;">
                <a href="{{ route('cart') }}" style="color: inherit; display: flex;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </a>
                @if (Session::has('cart'))
                    <span class="badge-count">{{ count(Session::get('cart')) }}</span>
                @endif
            </div>

            <!-- User Icon -->
            <div class="icon-btn" style="position: relative;">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>

                @auth
                    <div class="header-dropdown icon-dropdown">
                        <div class="dropdown-header">{{ Auth::user()->name }}</div>
                        @if (isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M15.3,5.4,9.561.481A2,2,0,0,0,8.26,0H7.74a2,2,0,0,0-1.3.481L.7,5.4A2,2,0,0,0,0,6.92V14a2,2,0,0,0,2,2H14a2,2,0,0,0,2-2V6.92A2,2,0,0,0,15.3,5.4M10,15H6V9A1,1,0,0,1,7,8H9a1,1,0,0,1,1,1Zm5-1a1,1,0,0,1-1,1H11V9A2,2,0,0,0,9,7H7A2,2,0,0,0,5,9v6H2a1,1,0,0,1-1-1V6.92a1,1,0,0,1,.349-.76l5.74-4.92A1,1,0,0,1,7.74,1h.52a1,1,0,0,1,.651.24l5.74,4.92A1,1,0,0,1,15,6.92Z"
                                        fill="#666" />
                                </svg>
                                <span>{{ translate('Dashboard') }}</span>
                            </a>
                        @elseif(isCustomer())
                            <a href="{{ route('dashboard') }}" class="dropdown-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M15.3,5.4,9.561.481A2,2,0,0,0,8.26,0H7.74a2,2,0,0,0-1.3.481L.7,5.4A2,2,0,0,0,0,6.92V14a2,2,0,0,0,2,2H14a2,2,0,0,0,2-2V6.92A2,2,0,0,0,15.3,5.4M10,15H6V9A1,1,0,0,1,7,8H9a1,1,0,0,1,1,1Zm5-1a1,1,0,0,1-1,1H11V9A2,2,0,0,0,9,7H7A2,2,0,0,0,5,9v6H2a1,1,0,0,1-1-1V6.92a1,1,0,0,1,.349-.76l5.74-4.92A1,1,0,0,1,7.74,1h.52a1,1,0,0,1,.651.24l5.74,4.92A1,1,0,0,1,15,6.92Z"
                                        fill="#666" />
                                </svg>
                                <span>{{ translate('Dashboard') }}</span>
                            </a>
                            <a href="{{ route('purchase_history.index') }}" class="dropdown-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M14.5,5.963h-4a1.5,1.5,0,0,0,0,3h4a1.5,1.5,0,0,0,0-3m0,2h-4a.5.5,0,0,1,0-1h4a.5.5,0,0,1,0,1"
                                        transform="translate(0 -0.963)" fill="#666" />
                                </svg>
                                <span>{{ translate('Orders') }}</span>
                            </a>
                            @if (get_setting('wallet_system') == 1)
                                <a href="{{ route('wallet.index') }}" class="dropdown-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M13.5,4H13V2.5A2.5,2.5,0,0,0,10.5,0h-8A2.5,2.5,0,0,0,0,2.5v11A2.5,2.5,0,0,0,2.5,16h11A2.5,2.5,0,0,0,16,13.5v-7A2.5,2.5,0,0,0,13.5,4"
                                            fill="#666" />
                                    </svg>
                                    <span>{{ translate('Wallet') }}</span>
                                </a>
                            @endif
                        @endif
                        <a href="{{ route('logout') }}" class="dropdown-item" style="color: #d43533;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                <path d="M8,0a8,8,0,1,0,8,8A8,8,0,0,0,8,0ZM8,1a7,7,0,1,1-7,7A7,7,0,0,1,8,1Z"
                                    fill="#d43533" />
                                <rect width="1" height="8" rx="0.5" transform="translate(7.5 0)"
                                    fill="#d43533" />
                            </svg>
                            <span>{{ translate('Logout') }}</span>
                        </a>
                    </div>
                @else
                    <div class="header-dropdown icon-dropdown">
                        <a href="{{ route('user.login') }}" class="dropdown-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                                <polyline points="10 17 15 12 10 7"></polyline>
                                <line x1="15" y1="12" x2="3" y2="12"></line>
                            </svg>
                            <span>{{ translate('Login') }}</span>
                        </a>
                        <a href="{{ route('user.registration') }}" class="dropdown-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <line x1="19" y1="8" x2="19" y2="14"></line>
                                <line x1="22" y1="11" x2="16" y2="11"></line>
                            </svg>
                            <span>{{ translate('Register') }}</span>
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <button class="mobile-menu-btn" onclick="toggleMobileMenu()">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Search Container -->
        <div class="search-container" id="searchContainer">
            <form action="{{ route('search') }}" method="GET" class="search-input-wrapper">
                <input type="text" name="keyword" class="search-input"
                    placeholder="{{ translate('I\'m Looking for...') }}" autocomplete="off">
                <button type="button" class="search-close-btn" onclick="toggleSearch()">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</header>

<script>
    function toggleSearch() {
        const container = document.getElementById('headerContainer');
        const searchContainer = document.getElementById('searchContainer');
        const searchInput = searchContainer.querySelector('.search-input');

        container.classList.toggle('search-active');
        searchContainer.classList.toggle('active');

        if (searchContainer.classList.contains('active')) {
            setTimeout(() => {
                searchInput.focus();
            }, 300);
        }
    }

    function toggleMobileMenu() {
        const nav = document.getElementById('mainNav');
        nav.classList.toggle('active');
    }

    // Close menus when clicking outside
    document.addEventListener('click', function(event) {
        const nav = document.getElementById('mainNav');
        const menuBtn = document.querySelector('.mobile-menu-btn');
        const searchContainer = document.getElementById('searchContainer');
        const headerContainer = document.getElementById('headerContainer');

        if (nav && menuBtn && !nav.contains(event.target) && !menuBtn.contains(event.target)) {
            nav.classList.remove('active');
        }

        if (searchContainer.classList.contains('active') &&
            !searchContainer.contains(event.target) &&
            !event.target.closest('.icon-btn')) {
            headerContainer.classList.remove('search-active');
            searchContainer.classList.remove('active');
        }
    });

    // Submit search on Enter
    document.querySelector('.search-input')?.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            this.closest('form').submit();
        }
    });
</script>

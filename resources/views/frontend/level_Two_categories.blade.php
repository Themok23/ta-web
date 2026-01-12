@extends('frontend.layouts.app')

@php
    $mainCategories = App\Models\Category::where('level', 0)
        ->with([
            'childrenCategories' => function ($query) {
                $query
                    ->with([
                        'childrenCategories' => function ($q) {
                            $q->withCount('products');
                        },
                    ])
                    ->withCount('products');
            },
        ])
        ->withCount('products')
        ->orderBy('order_level', 'desc')
        ->get();

    $currentCategoryId = request()->segment(2);
@endphp

<style>
    .category-page {
        background: #f8f9fa;
        min-height: 100vh;
    }

    /* ========================
       BACK ARROW - RESPONSIVE
    ======================== */
    .back-arrow {
        position: absolute;
        top: -60px;
        left: 20px;
        width: 52px;
        height: 52px;
        background: rgba(0, 0, 0, 0.5);
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        z-index: 3;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .back-arrow:hover {
        background: rgba(0, 0, 0, 0.7);
        transform: translateX(-3px);
        color: #fff;
    }

    .back-arrow i {
        font-size: 16px;
    }

    /* ========================
       HERO BANNER - RESPONSIVE
    ======================== */
    .category-hero {
        position: relative;
        height: 450px;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        display: flex;
        align-items: flex-end;
        margin-bottom: 0;
        padding: 20px;
        padding-bottom: 50px;
        overflow: hidden;
    }

    .category-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #000;
        opacity: 0.7;
        z-index: 1;
    }

    .category-hero .container {
        position: relative;
        z-index: 2;
        width: 100%;
    }

    .category-hero h1 {
        color: #fff;
        font-size: 52px;
        font-weight: 700;
        margin: 0;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.9);
        line-height: 1.2;
    }

    .category-hero h1 .explore {
        color: #5fb3f6;
        display: block;
        font-size: 46px;
        margin-bottom: 5px;
    }

    /* ========================
       CONTENT SECTION
    ======================== */
    .category-content {
        background: #fff;
        padding: 40px 0 80px;
    }

    /* ========================
       SIDEBAR - RESPONSIVE (NEW DESIGN)
    ======================== */
    .category-sidebar {
        background: #fff;
        padding: 30px 20px;
        border-radius: 16px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, .08);
        position: sticky;
        top: 20px;
        margin-bottom: 30px;
        max-height: calc(100vh - 40px);
        overflow-y: auto;
    }

    .category-sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .category-sidebar::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .category-sidebar::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 10px;
    }

    .category-sidebar::-webkit-scrollbar-thumb:hover {
        background: #999;
    }

    .category-sidebar h6 {
        font-weight: 600;
        margin-bottom: 15px;
        margin-top: 30px;
        font-size: 10px;
        color: #999;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        padding: 0 12px;
    }

    .category-sidebar h6:first-of-type {
        margin-top: 0;
    }

    .category-sidebar ul {
        list-style: none;
        padding: 0;
        margin: 0 0 20px 0;
    }

    .category-sidebar ul li {
        padding: 0;
        border-radius: 12px;
        font-size: 14px;
        cursor: pointer;
        transition: all .3s ease;
        margin-bottom: 6px;
        color: #555;
        font-weight: 500;
        background: transparent;
        position: relative;
    }

    .category-sidebar ul li a.category-link {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 16px;
        color: inherit;
        text-decoration: none;
        width: 100%;
        border-radius: 12px;
        transition: all .3s ease;
    }

    .category-sidebar .category-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 16px;
        border-radius: 12px;
        cursor: pointer;
        transition: all .3s ease;
    }

    .category-sidebar .category-header .category-name {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: space-between;
        text-decoration: none;
        color: inherit;
    }

    .category-sidebar .toggle-icon {
        font-size: 10px;
        opacity: 0.5;
        transition: all .3s ease;
        cursor: pointer;
        padding: 4px 8px;
        margin-left: 8px;
        flex-shrink: 0;
    }

    .category-sidebar ul li:hover:not(.active) {
        background: #f8f9fa;
    }

    .category-sidebar ul li:hover:not(.active) a.category-link,
    .category-sidebar ul li:hover:not(.active) .category-header {
        color: #333;
    }

    .category-sidebar ul li.active {
        background: linear-gradient(135deg, #4a90e2 0%, #357abd 100%);
        color: #fff;
        box-shadow: 0 3px 10px rgba(74, 144, 226, 0.25);
    }

    .category-sidebar ul li.active a.category-link {
        color: #fff;
    }

    .category-sidebar ul li.active .category-header {
        color: #fff;
    }

    .category-sidebar ul li.active .category-name {
        color: #fff;
    }

    .category-sidebar ul li i.fa-chevron-right {
        font-size: 9px;
        opacity: 0.5;
        transition: .3s;
        flex-shrink: 0;
    }

    .category-sidebar ul li:hover i.fa-chevron-right {
        opacity: 0.8;
    }

    .category-sidebar ul li.active i {
        opacity: 1;
    }

    /* Sub Categories Styling - Level 2 */
    .sub-categories {
        margin: 8px 0 0 0 !important;
        padding-left: 16px !important;
        list-style: none;
        display: none;
    }

    .sub-categories.show {
        display: block;
        padding-top: 6px;
    }

    .sub-categories li {
        font-size: 13px;
        margin-bottom: 5px;
    }

    .sub-categories li a.category-link {
        padding: 10px 14px;
        border-radius: 10px;
    }

    .sub-categories li .category-header {
        padding: 10px 14px;
        font-size: 13px;
        border-radius: 10px;
    }

    .sub-categories li i.fa-chevron-right,
    .sub-categories li i.fa-chevron-down {
        font-size: 8px;
    }

    /* Sub Sub Categories Styling - Level 3 */
    .sub-sub-categories {
        margin: 8px 0 0 0 !important;
        padding-left: 16px !important;
        list-style: none;
        display: none;
    }

    .sub-sub-categories.show {
        display: block;
        padding-top: 6px;
    }

    .sub-sub-categories li {
        font-size: 12px;
        margin-bottom: 4px;
    }

    .sub-sub-categories li a.category-link {
        padding: 8px 12px;
        border-radius: 8px;
    }

    .sub-sub-categories li i {
        font-size: 7px;
    }

    /* Product Count */
    .product-count {
        font-size: 11px;
        opacity: 0.65;
        margin-left: 6px;
        font-weight: 400;
        flex-shrink: 0;
    }

    .sub-categories .product-count {
        font-size: 10px;
    }

    .sub-sub-categories .product-count {
        font-size: 9px;
    }

    /* Parent category with children */
    .parent-category-list {
        margin-bottom: 0 !important;
    }

    /* Spacing between category items */
    .parent-category-list>li {
        margin-bottom: 8px;
    }

    .parent-category-list>li:last-child {
        margin-bottom: 0;
    }

    /* ========================
       CATEGORY CARD - NEW DESIGN
    ======================== */
    .category-card {
        position: relative;
        height: 280px;
        border-radius: 16px;
        overflow: hidden;
        cursor: pointer;
        transition: .4s;
        box-shadow: 0 4px 20px rgba(0, 0, 0, .1);
        background: #fff;
    }

    .category-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: .4s;
    }

    .category-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 35px rgba(0, 0, 0, .18);
    }

    .category-card:hover img {
        transform: scale(1.08);
    }

    /* Cart Icon - Top Left with Dark Circle */
    .category-card .cart-icon {
        position: absolute;
        top: 15px;
        left: 15px;
        width: 35px;
        height: 35px;
        background: rgba(0, 0, 0, 0.7);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 3;
        cursor: pointer;
        transition: .3s;
    }

    .category-card .cart-icon:hover {
        background: rgba(0, 0, 0, 0.85);
        transform: scale(1.1);
    }

    .category-card .cart-icon i {
        color: #fff;
        font-size: 14px;
    }

    /* Category Title - Bottom Left */
    .category-card .category-title {
        position: absolute;
        bottom: 60px;
        left: 20px;
        z-index: 2;
        text-align: left;
    }

    .category-card .category-title h5 {
        margin: 0;
        font-weight: 700;
        font-size: 24px;
        color: #fff;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.6);
        letter-spacing: 0;
    }

    /* Sub Categories - Bottom Left (Below Title) */
    .category-card .sub-categories-bottom {
        position: absolute;
        bottom: 20px;
        left: 20px;
        right: 20px;
        z-index: 2;
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        align-items: center;
    }

    .category-card .sub-cat-item {
        font-size: 11px;
        color: #fff;
        background: transparent;
        padding: 0;
        border-radius: 0;
        font-weight: 400;
        transition: .3s;
        border: none;
        white-space: nowrap;
        opacity: 0.85;
        line-height: 1.4;
    }

    .category-card:hover .sub-cat-item {
        opacity: 1;
    }

    /* Dark overlay gradient for better text visibility */
    .category-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom,
                rgba(0, 0, 0, 0) 0%,
                rgba(0, 0, 0, 0.1) 40%,
                rgba(0, 0, 0, 0.5) 70%,
                rgba(0, 0, 0, 0.7) 100%);
        z-index: 1;
        transition: .4s;
    }

    .category-card:hover::before {
        background: linear-gradient(to bottom,
                rgba(0, 0, 0, 0.1) 0%,
                rgba(0, 0, 0, 0.2) 40%,
                rgba(0, 0, 0, 0.6) 70%,
                rgba(0, 0, 0, 0.75) 100%);
    }

    /* ========================
       RESPONSIVE BREAKPOINTS
    ======================== */

    /* Large Desktop */
    @media (min-width: 1400px) {
        .category-hero {
            height: 500px;
        }

        .category-hero h1 {
            font-size: 60px;
        }

        .category-hero h1 .explore {
            font-size: 52px;
        }

        .category-card {
            height: 320px;
        }
    }

    /* Tablet Landscape */
    @media (max-width: 1024px) {
        .category-hero {
            height: 380px;
            padding-bottom: 40px;
        }

        .category-hero h1 {
            font-size: 44px;
        }

        .category-hero h1 .explore {
            font-size: 38px;
        }

        .category-card {
            height: 300px;
        }

        .category-sidebar {
            position: relative;
            top: 0;
        }
    }

    /* Tablet Portrait & Mobile Landscape */
    @media (max-width: 768px) {
        .back-arrow {
            width: 40px;
            height: 40px;
            top: 15px;
            left: 15px;
        }

        .back-arrow i {
            font-size: 14px;
        }

        .category-hero {
            height: 320px;
            padding: 15px;
            padding-bottom: 35px;
        }

        .category-hero h1 {
            font-size: 36px;
        }

        .category-hero h1 .explore {
            font-size: 32px;
        }

        .category-content {
            padding: 30px 0 60px;
        }

        .category-sidebar {
            margin-bottom: 25px;
            padding: 25px 18px;
            border-radius: 14px;
        }

        .category-sidebar ul li a.category-link {
            padding: 11px 14px;
            font-size: 13px;
        }

        .category-sidebar .category-header {
            padding: 11px 14px;
            font-size: 13px;
        }

        .sub-categories li a.category-link {
            padding: 9px 12px;
            font-size: 12px;
        }

        .sub-categories li .category-header {
            padding: 9px 12px;
            font-size: 12px;
        }

        .category-card {
            height: 280px;
        }

        .category-card .category-title h5 {
            font-size: 22px;
        }
    }

    /* Mobile Portrait */
    @media (max-width: 576px) {
        .back-arrow {
            width: 38px;
            height: 38px;
            top: 12px;
            left: 12px;
        }

        .back-arrow i {
            font-size: 13px;
        }

        .category-hero {
            height: 280px;
            padding: 12px;
            padding-bottom: 30px;
        }

        .category-hero h1 {
            font-size: 30px;
        }

        .category-hero h1 .explore {
            font-size: 26px;
            margin-bottom: 3px;
        }

        .category-content {
            padding: 25px 0 50px;
        }

        .category-sidebar {
            padding: 22px 16px;
            margin-bottom: 20px;
            border-radius: 12px;
        }

        .category-sidebar ul li a.category-link {
            padding: 10px 12px;
            font-size: 12px;
            border-radius: 10px;
        }

        .category-sidebar .category-header {
            padding: 10px 12px;
            font-size: 12px;
        }

        .sub-categories li a.category-link {
            padding: 8px 10px;
            font-size: 11px;
        }

        .sub-categories li .category-header {
            padding: 8px 10px;
            font-size: 11px;
        }

        .category-card {
            height: 260px;
        }

        .category-card .category-title h5 {
            font-size: 20px;
        }

        .row.g-4 {
            --bs-gutter-x: 1rem;
            --bs-gutter-y: 1rem;
        }
    }

    /* Extra Small Mobile */
    @media (max-width: 400px) {
        .category-hero {
            height: 250px;
            padding-bottom: 25px;
        }

        .category-hero h1 {
            font-size: 26px;
        }

        .category-hero h1 .explore {
            font-size: 23px;
        }

        .category-card {
            height: 240px;
        }

        .category-card .category-title h5 {
            font-size: 18px;
        }
    }

    /* Landscape orientation fixes */
    @media (max-height: 500px) and (orientation: landscape) {
        .category-hero {
            height: 250px;
            padding-bottom: 20px;
        }

        .category-hero h1 {
            font-size: 28px;
        }

        .category-hero h1 .explore {
            font-size: 24px;
        }
    }

    /* Touch device optimizations */
    @media (hover: none) and (pointer: coarse) {
        .category-card:hover {
            transform: none;
        }

        .category-card:active {
            transform: translateY(-4px);
            transition: transform 0.1s;
        }
    }
</style>

@section('content')
    <div class="category-page">
        {{-- Hero Banner with Category Image --}}
        <div class="category-hero"
            style="background-image: url('{{ uploaded_asset($levelTwoCategories->first()->banner ?? '') }}');">
            <div class="container">
                <a href="javascript:history.back()" class="back-arrow">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1>
                    <span class="explore">Explore</span>
                    {{ $levelTwoCategories->first()->name ?? 'Categories' }}
                </h1>
            </div>
        </div>

        {{-- Content Section --}}
        <div class="category-content">
            <div class="container">
                <div class="row">

                    {{-- Sidebar --}}
                    <div class="col-lg-3 mb-4">
                        <div class="category-sidebar">
                            <h6>CATEGORIES</h6>

                            {{-- All Categories Link --}}
                            <ul>
                                <li class="{{ !request()->segment(2) ? 'active' : '' }}">
                                    <a href="{{ route('categories.all') }}" class="category-link">
                                        <span>All Categories</span>
                                    </a>
                                </li>
                            </ul>

                            {{-- Loop through Main Categories (Level 0) --}}
                            @foreach ($mainCategories as $mainCategory)
                                <h6>{{ $mainCategory->getTranslation('name') }}</h6>

                                <ul class="parent-category-list">
                                    @if ($mainCategory->childrenCategories && $mainCategory->childrenCategories->count() > 0)
                                        {{-- Main Category with Sub-categories (Level 1) --}}
                                        @foreach ($mainCategory->childrenCategories as $level1Category)
                                            <li class="parent-category {{ $currentCategoryId == $level1Category->id ? 'active' : '' }}"
                                                data-category-id="{{ $level1Category->id }}">

                                                @if ($level1Category->childrenCategories && $level1Category->childrenCategories->count() > 0)
                                                    {{-- Level 1 has children (Level 2) --}}
                                                    <div class="category-header">
                                                        <a href="{{ route('categories.level2', $level1Category->id) }}"
                                                            class="category-name">
                                                            <span>{{ $level1Category->getTranslation('name') }}</span>
                                                            <span
                                                                class="product-count">({{ $level1Category->products_count ?? 0 }})</span>
                                                        </a>
                                                        <i class="fas fa-chevron-down toggle-icon"></i>
                                                    </div>

                                                    {{-- Sub Categories (Level 2) --}}
                                                    <ul class="sub-categories" data-parent-id="{{ $level1Category->id }}">
                                                        @foreach ($level1Category->childrenCategories as $level2Category)
                                                            <li class="{{ $currentCategoryId == $level2Category->id ? 'active' : '' }}"
                                                                data-category-id="{{ $level2Category->id }}">

                                                                @if ($level2Category->childrenCategories && $level2Category->childrenCategories->count() > 0)
                                                                    {{-- Level 2 has children (Level 3) --}}
                                                                    <div class="category-header">
                                                                        <a href="{{ route('products.level2', $level2Category->id) }}"
                                                                            class="category-name">
                                                                            <span>{{ $level2Category->getTranslation('name') }}</span>
                                                                            <span
                                                                                class="product-count">({{ $level2Category->products_count ?? 0 }})</span>
                                                                        </a>
                                                                        <i class="fas fa-chevron-down toggle-icon"></i>
                                                                    </div>

                                                                    {{-- Sub Sub Categories (Level 3) --}}
                                                                    <ul class="sub-sub-categories"
                                                                        data-parent-id="{{ $level2Category->id }}">
                                                                        @foreach ($level2Category->childrenCategories as $level3Category)
                                                                            <li
                                                                                class="{{ $currentCategoryId == $level3Category->id ? 'active' : '' }}">
                                                                                <a href="{{ route('products.level2', $level3Category->id) }}"
                                                                                    class="category-link">
                                                                                    <span>{{ $level3Category->getTranslation('name') }}</span>
                                                                                    <span
                                                                                        class="product-count">({{ $level3Category->products_count ?? 0 }})</span>
                                                                                    <i class="fas fa-chevron-right"></i>
                                                                                </a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @else
                                                                    {{-- Level 2 without children --}}
                                                                    <a href="{{ route('products.level2', $level2Category->id) }}"
                                                                        class="category-link">
                                                                        <span>{{ $level2Category->getTranslation('name') }}</span>
                                                                        <span
                                                                            class="product-count">({{ $level2Category->products_count ?? 0 }})</span>
                                                                        <i class="fas fa-chevron-right"></i>
                                                                    </a>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    {{-- Level 1 without children --}}
                                                    <a href="{{ route('products.level2', $level1Category->id) }}"
                                                        class="category-link">
                                                        <span>{{ $level1Category->getTranslation('name') }}</span>
                                                        <span
                                                            class="product-count">({{ $level1Category->products_count ?? 0 }})</span>
                                                        <i class="fas fa-chevron-right"></i>
                                                    </a>
                                                @endif
                                            </li>
                                        @endforeach
                                    @else
                                        {{-- Main Category without children --}}
                                        <li class="{{ $currentCategoryId == $mainCategory->id ? 'active' : '' }}">
                                            <a href="{{ route('products.category', $mainCategory->slug) }}"
                                                class="category-link">
                                                <span>{{ $mainCategory->getTranslation('name') }}</span>
                                                <span
                                                    class="product-count">({{ $mainCategory->products_count ?? 0 }})</span>
                                                <i class="fas fa-chevron-right"></i>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            @endforeach
                        </div>
                    </div>

                    {{-- Cards Section --}}
                    <div class="col-lg-9">
                        <div class="row g-4">
                            @foreach ($levelTwoCategories as $category)
                                <div class="col-lg-6 col-md-6">
                                    <a href="{{ route('products.level2', $category->id) }}" style="text-decoration: none;">
                                        <div class="category-card">
                                            <img src="{{ uploaded_asset($category->banner) }}"
                                                alt="{{ $category->getTranslation('name') }}">

                                            {{-- Cart Icon - Top Left --}}
                                            <div class="cart-icon">
                                                <i class="fas fa-shopping-basket"></i>
                                            </div>

                                            {{-- Category Title - Bottom Left --}}
                                            <div class="category-title">
                                                <h5>{{ $category->getTranslation('name') }}</h5>
                                            </div>

                                            {{-- Subcategories List - Bottom Left (Below Title) --}}
                                            @if ($category->childrenCategories && $category->childrenCategories->count() > 0)
                                                <div class="sub-categories-bottom">
                                                    @foreach ($category->childrenCategories->take(6) as $index => $subCat)
                                                        <span
                                                            class="sub-cat-item">{{ $subCat->getTranslation('name') }}</span>
                                                        @if ($index < 5 && $index < $category->childrenCategories->count() - 1)
                                                            <span class="sub-cat-item">•</span>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript for Toggle Functionality --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle all toggle icons
            const allToggleIcons = document.querySelectorAll('.toggle-icon');

            allToggleIcons.forEach(function(toggleIcon) {
                toggleIcon.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    const categoryHeader = this.closest('.category-header');
                    const parentLi = categoryHeader.closest('li');
                    const categoryId = parentLi.getAttribute('data-category-id');

                    // Find the sub-categories ul
                    let subCategoriesUl = parentLi.querySelector(
                        `.sub-categories[data-parent-id="${categoryId}"]`);
                    if (!subCategoriesUl) {
                        subCategoriesUl = parentLi.querySelector(
                            `.sub-sub-categories[data-parent-id="${categoryId}"]`);
                    }

                    if (subCategoriesUl) {
                        const isVisible = subCategoriesUl.classList.contains('show');

                        if (isVisible) {
                            subCategoriesUl.classList.remove('show');
                            this.style.transform = 'rotate(0deg)';
                        } else {
                            subCategoriesUl.classList.add('show');
                            this.style.transform = 'rotate(180deg)';
                        }
                    }
                });
            });

            // Auto-expand active category's parents
            const activeCategories = document.querySelectorAll('.category-sidebar li.active');
            activeCategories.forEach(function(activeLi) {
                // Find parent ul and show it
                let parentUl = activeLi.closest('.sub-categories, .sub-sub-categories');
                while (parentUl) {
                    parentUl.classList.add('show');

                    // Rotate the toggle icon
                    const parentLi = parentUl.previousElementSibling?.querySelector('.toggle-icon') ||
                        parentUl.closest('li')?.querySelector('.toggle-icon');
                    if (parentLi) {
                        parentLi.style.transform = 'rotate(180deg)';
                    }

                    // Move up to next parent
                    parentUl = parentUl.closest('li')?.closest('.sub-categories, .sub-sub-categories');
                }
            });
        });
    </script>
@endsection

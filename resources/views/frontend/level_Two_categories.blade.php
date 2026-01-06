@extends('frontend.layouts.app')
<style>
    /* ========================
   CATEGORY PAGE STYLE
======================== */

    .category-sidebar {
        background: #fff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, .06);
    }

    .category-sidebar h6 {
        font-weight: 700;
        margin-bottom: 15px;
    }

    .category-sidebar ul {
        list-style: none;
        padding: 0;
    }

    .category-sidebar ul li {
        padding: 10px 12px;
        border-radius: 8px;
        font-size: 14px;
        cursor: pointer;
        transition: .3s;
    }

    .category-sidebar ul li:hover,
    .category-sidebar ul li.active {
        background: #1f73ff;
        color: #fff;
    }

    /* ========================
   CATEGORY CARD
======================== */

    .category-card {
        position: relative;
        height: 230px;
        border-radius: 16px;
        overflow: hidden;
        cursor: pointer;
        transition: .4s;
    }

    .category-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: .4s;
    }

    .category-card:hover img {
        transform: scale(1.1);
    }

    .category-card::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, .7), rgba(0, 0, 0, .1));
    }

    .category-card .overlay {
        position: absolute;
        bottom: 20px;
        left: 20px;
        color: #fff;
        z-index: 2;
    }

    .category-card h5 {
        margin: 0;
        font-weight: 700;
        font-size: 18px;
    }

    .category-card p {
        margin: 0;
        font-size: 13px;
        opacity: .9;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .category-card {
            height: 190px;
        }
    }
</style>

@section('content')


    <div class="container my-5">

        <h2 class="mb-4 fw-bold">Explore <span class="text-primary">Food & Beverages</span></h2>

        <div class="row">

            {{-- Sidebar --}}
            <div class="col-lg-3 mb-4">
                <div class="category-sidebar">
                    <a href="/categories" class="mb-3">Categories</a>

                </div>
            </div>

            {{-- Cards --}}
            <div class="col-lg-9">
                <div class="row g-4">

                    @foreach ($levelTwoCategories as $category)
                        <div class="col-xl-4 col-lg-6 col-md-6">
                            <a href="{{ route('products.level2', $category->id) }}" class="category-link">
                                <div class="category-card">
                                    <img src="{{ uploaded_asset($category->banner) }}" alt="">

                                    <div class="overlay">
                                        <h5>{{ $category->getTranslation('name') }}</h5>
                                        <p>{{ $category->products_count ?? 0 }} Products</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                    @endforeach

                </div>
            </div>

        </div>
    </div>
@endsection
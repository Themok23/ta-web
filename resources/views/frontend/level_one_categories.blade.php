@extends('frontend.layouts.app')

<style>
    /* ========================
   CATEGORY PAGE STYLE
======================== */
    .category-page {
        background: #f8f9fa;
        min-height: 100vh;
    }



    .back-arrow {
        position: absolute;
        top: 30px;
        left: 30px;
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, .95);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #333;
        cursor: pointer;
        transition: .3s;
        z-index: 3;
        box-shadow: 0 4px 15px rgba(0, 0, 0, .2);
    }

    .back-arrow:hover {
        background: #fff;
        transform: scale(1.05);
    }

    /* Content Section */
    .category-content {
        background: #fff;
        padding: 40px 0 80px;
    }

    .category-sidebar {
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .05);
        position: sticky;
        top: 20px;
    }

    .category-sidebar h6 {
        font-weight: 600;
        margin-bottom: 15px;
        font-size: 12px;
        color: #999;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .category-sidebar ul {
        list-style: none;
        padding: 0;
        margin: 0 0 30px 0;
    }

    .category-sidebar ul li {
        padding: 12px 15px;
        border-radius: 8px;
        font-size: 14px;
        cursor: pointer;
        transition: .3s;
        margin-bottom: 5px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: #666;
    }

    .category-sidebar ul li:hover {
        background: #f5f7fa;
        color: #333;
    }

    .category-sidebar ul li.active {
        background: #1f73ff;
        color: #fff;
    }

    .category-sidebar ul li i {
        font-size: 10px;
        opacity: 0.5;
    }

    /* ========================
   CATEGORY CARD
======================== */
    .category-card {
        position: relative;
        height: 300px;
        border-radius: 16px;
        overflow: hidden;
        cursor: pointer;
        transition: .4s;
        box-shadow: 0 4px 20px rgba(0, 0, 0, .1);
    }

    .category-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: .4s;
        filter: brightness(0.85);
    }

    .category-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 35px rgba(0, 0, 0, .18);
    }

    .category-card:hover img {
        transform: scale(1.08);
        filter: brightness(0.75);
    }

    .category-card .cart-icon {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 32px;
        height: 32px;
        background: rgba(0, 0, 0, .75);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 3;
        cursor: pointer;
        transition: .3s;
        box-shadow: 0 4px 12px rgba(0, 0, 0, .3);
    }

    .category-card .cart-icon:hover {
        background: #1f73ff;
        transform: scale(1.12);
    }

    .category-card .cart-icon i {
        color: #fff;
        font-size: 20px;
    }

    .category-card .overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 28px;
        color: #fff;
        z-index: 2;
        background: linear-gradient(to top, rgba(0, 0, 0, .9) 0%, rgba(0, 0, 0, .6) 60%, transparent 100%);
    }

    .category-card h5 {
        margin: 0 0 12px 0;
        font-weight: 700;
        font-size: 24px;
        text-shadow: 0 3px 10px rgba(0, 0, 0, .7);
        letter-spacing: -0.5px;
    }

    .category-card .sub-categories {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 12px;
    }

    .category-card .sub-cat-item {
        font-size: 13px;
        color: #fff;
        background: rgba(255, 255, 255, .25);
        padding: 6px 12px;
        border-radius: 6px;
        backdrop-filter: blur(8px);
        font-weight: 500;
        transition: .3s;
        border: 1px solid rgba(255, 255, 255, .2);
    }

    .category-card:hover .sub-cat-item {
        background: rgba(255, 255, 255, .3);
        border-color: rgba(255, 255, 255, .3);
    }

/* Hero Banner */
.category-hero {
    position: relative;
    height: 450px;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    display: flex;
    align-items: flex-end;
    margin-bottom: 0;
    padding-bottom: 50px;
    overflow: hidden;
}

.category-hero::before {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 60%;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0.4) 50%, transparent 100%);
    z-index: 1;
}

.category-hero .container {
    position: relative;
    z-index: 2;
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

.back-arrow {
    position: absolute;
    top: 30px;
    left: 30px;
    width: 50px;
    height: 50px;
    background: rgba(255, 255, 255, 0.95);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #333;
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 3;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    text-decoration: none;
}

.back-arrow:hover {
    background: #fff;
    transform: scale(1.08);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
    color: #1f73ff;
}

.back-arrow i {
    font-size: 18px;
}

/* Responsive */
@media (max-width: 768px) {
    .category-hero {
        height: 320px;
        padding-bottom: 35px;
    }
    
    .category-hero h1 {
        font-size: 34px;
    }
    
    .category-hero h1 .explore {
        font-size: 30px;
    }
    
    .category-card {
        height: 260px;
    }

    .back-arrow {
        width: 45px;
        height: 45px;
        top: 20px;
        left: 20px;
    }

    .back-arrow i {
        font-size: 16px;
    }
}

@media (max-width: 480px) {
    .category-hero {
        height: 280px;
        padding-bottom: 30px;
    }
    
    .category-hero h1 {
        font-size: 28px;
    }
    
    .category-hero h1 .explore {
        font-size: 26px;
    }
}
</style>

@section('content')
    <div class="category-page">
        
        {{-- Hero Banner with Main Category Image --}}
{{-- Hero Banner with Main Category Image --}}
<div class="category-hero" style="background-image: url('{{ uploaded_asset($mainCategory->banner ?? $levelOneCategories->first()->banner) }}');">
    
    <div class="container">
        <h1>
            <span class="explore">Explore</span>
            {{ $mainCategory->getTranslation('name') ?? 'Food & Beverages' }}
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
                            <h6>Categories</h6>
                            <ul>
                                <li class="{{ !request('category') ? 'active' : '' }}">
                                    All Categories
                                    <i class="fas fa-chevron-right"></i>
                                </li>
                                <li class="active">
                                    Food & Beverages
                                    <i class="fas fa-chevron-right"></i>
                                </li>
                            </ul>

                            <h6>Fresh Food</h6>
                            <ul>
                                @foreach ($levelOneCategories as $cat)
                                    <li>
                                        {{ $cat->getTranslation('name') }}
                                        <i class="fas fa-chevron-right"></i>
                                    </li>
                                @endforeach
                            </ul>

                            <h6>Beverages</h6>
                            <ul>
                                <li>Coffee <i class="fas fa-chevron-right"></i></li>
                                <li>Beverages <i class="fas fa-chevron-right"></i></li>
                            </ul>

                            <h6>Fresh Fruits / Juices & Smoothies</h6>
                            <ul>
                                <li>Frozen Food <i class="fas fa-chevron-right"></i></li>
                            </ul>
                        </div>
                    </div>

                    {{-- Cards Grid --}}
                    <div class="col-lg-9">
                        <div class="row g-4">

                            @foreach ($levelOneCategories as $category)
                                <div class="col-lg-6 col-md-6">
                                    <a href="{{ route('categories.level2', $category->id) }}" class="text-decoration-none">
                                        <div class="category-card">
                                            <img src="{{ uploaded_asset($category->banner) }}" 
                                                 alt="{{ $category->getTranslation('name') }}"
                                                 onerror="this.src='{{ static_asset('assets/img/placeholder.jpg') }}'">

                                            {{-- Cart Icon --}}
                                            <div class="cart-icon">
                                                <i class="fas fa-shopping-basket"></i>
                                            </div>

                                            <div class="overlay">
                                                <h5>{{ $category->getTranslation('name') }}</h5>
                                                
                                                {{-- Sub Categories --}}
                                                @if($category->childrenCategories && $category->childrenCategories->count() > 0)
                                                    <div class="sub-categories">
                                                        @foreach($category->childrenCategories->take(4) as $subCat)
                                                            <span class="sub-cat-item">{{ $subCat->getTranslation('name') }}</span>
                                                        @endforeach
                                                        @if($category->childrenCategories->count() > 4)
                                                            <span class="sub-cat-item">+{{ $category->childrenCategories->count() - 4 }}</span>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
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
@endsection
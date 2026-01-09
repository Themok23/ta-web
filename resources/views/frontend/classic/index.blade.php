@extends('frontend.layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        overflow-x: hidden;
    }

    .hero-carousel {
        position: relative;
        height: 100vh;
        overflow: hidden;
        background-color: #000;
    }

    .hero-carousel .carousel-item {
        height: 100vh;
        position: relative;
        background-color: #000;
    }

    .hero-carousel .carousel-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.4);
        z-index: 1;
    }

    .hero-carousel img {
        object-fit: cover;
        height: 100%;
        width: 100%;
        background-color: #000;
    }

    .carousel-item {
        transition: transform 0.6s ease-in-out;
        background-color: #000;
    }

    .carousel-item.active,
    .carousel-item-next,
    .carousel-item-prev {
        display: block;
        background-color: #000;
    }

    .carousel-fade .carousel-item {
        opacity: 0;
        transition-property: opacity;
        transform: none;
    }

    .carousel-fade .carousel-item.active,
    .carousel-fade .carousel-item-next.carousel-item-start,
    .carousel-fade .carousel-item-prev.carousel-item-end {
        opacity: 1;
        z-index: 1;
    }

    .carousel-fade .active.carousel-item-start,
    .carousel-fade .active.carousel-item-end {
        opacity: 0;
        z-index: 0;
        transition: opacity 0s 0.6s;
    }

    .hero-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 2;
        text-align: center;
        color: white;
        width: 90%;
        max-width: 1200px;
    }

    .hero-content h1 {
        font-size: 4rem;
        font-weight: 700;
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .hero-content p {
        font-size: 1.1rem;
        opacity: 0.95;
        max-width: 800px;
        margin: 0 auto;
    }

    .carousel-indicators {
        bottom: 40px;
        z-index: 3;
        margin-bottom: 0;
    }

    .carousel-indicators [data-bs-target] {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        border: 2px solid white;
        background-color: transparent;
        opacity: 0.7;
        margin: 0 6px;
        padding: 0;
    }

    .carousel-indicators .active {
        background-color: white;
        opacity: 1;
    }

    .carousel-control-prev,
    .carousel-control-next {
        width: 60px;
        height: 60px;
        background-color: rgba(255, 255, 255, 0.15);
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
        opacity: 0;
        transition: all 0.3s ease;
        z-index: 3;
        border: none;
    }

    .carousel-control-prev {
        left: 40px;
    }

    .carousel-control-next {
        right: 40px;
    }

    .hero-carousel:hover .carousel-control-prev,
    .hero-carousel:hover .carousel-control-next {
        opacity: 1;
    }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        background-color: rgba(255, 255, 255, 0.3);
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        width: 24px;
        height: 24px;
        background-size: 100% 100%;
    }

    /* Second Section Styles */
    .customers-section {
        padding: 100px 0 0 0;
        background-color: #ffffff;
        position: relative;
    }

    .customers-section .container {
        max-width: 1200px;
    }

    .customers-section .row {
        align-items: center;
    }

    .customers-section .image-wrapper {
        position: relative;
    }

    .customers-section .image-wrapper img {
        width: 100%;
        max-width: 450px;
        height: auto;
    }

    .customers-section .content-wrapper h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 20px;
        line-height: 1.3;
    }

    .customers-section .content-wrapper p {
        font-size: 1rem;
        color: #6c757d;
        margin-bottom: 30px;
        line-height: 1.6;
    }

    .customers-section .about-link {
        display: inline-flex;
        align-items: center;
        color: #007bff;
        font-size: 1rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .customers-section .about-link:hover {
        color: #0056b3;
    }

    .customers-section .about-link svg {
        margin-left: 8px;
        transition: transform 0.3s ease;
    }

    .customers-section .about-link:hover svg {
        transform: translateX(5px);
    }

    .triangle-wrapper {
        width: 100%;
        margin: 0;
        padding: 0;
        display: block;
    }

    .triangle-wrapper img {
        width: 100%;
        height: auto;
        display: block;
        margin: 0;
        padding: 0;
    }

    /* Categories Section */
    .categories-section {
        padding: 80px 0;
        background-color: #ffffff;
        position: relative;
    }

    .categories-section .section-header {
        text-align: center;
        margin-bottom: 50px;
        position: relative;
    }

    .categories-section .section-header h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1a1a1a;
        display: inline-block;
        position: relative;
    }

    .categories-section .nav-arrows {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        display: flex;
        gap: 15px;
    }

    .categories-section .nav-arrows.left {
        left: 0;
    }

    .categories-section .nav-arrows.right {
        right: 0;
    }

    .categories-section .arrow-btn {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        border: none;
        background-color: #f8f9fa;
        color: #007bff;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .categories-section .arrow-btn:hover {
        background-color: #007bff;
        color: white;
    }

    .categories-slider {
        position: relative;
        overflow: hidden;
    }

    .categories-wrapper {
        display: flex;
        gap: 25px;
        transition: transform 0.5s ease;
        padding: 10px 0;
    }

    .category-card {
        flex: 0 0 calc(33.333% - 17px);
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        height: 300px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: block;
    }

    .category-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    }

    .category-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .category-card:hover img {
        transform: scale(1.1);
    }

    .category-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.6));
        z-index: 1;
    }

    .category-card .content {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 25px;
        z-index: 2;
        color: white;
    }

    .category-card .content h3 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0;
    }

    .category-card .cart-icon {
        position: absolute;
        top: 20px;
        left: 20px;
        width: 40px;
        height: 40px;
        background-color: rgba(0, 0, 0, 0.7);
        border-radius: 8px;
        display: flex;
        color: white;
        align-items: center;
        justify-content: center;
        z-index: 2;
        transition: all 0.3s ease;
    }

    .category-card:hover .cart-icon {
        background-color: white;
        color: #000;
        transform: scale(1.1);
    }

    .category-card .cart-icon svg {
        width: 20px;
        height: 20px;
    }

    /* Gather Quality Section */
    .gather-section {
        position: relative;
        padding: 0;
        margin: 0;
    }

    .gather-section .top-bar {
        background: linear-gradient(135deg, #1e4d7b 0%, #2d5f8d 100%);
        padding: 30px 0;
    }

    .gather-section .top-bar .container {
        max-width: 1200px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .gather-section .top-bar .left-content {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .gather-section .top-bar .icon-grid {
        display: grid;
        grid-template-columns: repeat(2, 30px);
        grid-template-rows: repeat(2, 30px);
        gap: 8px;
    }

    .gather-section .top-bar .icon-box {
        width: 30px;
        height: 30px;
        border: 3px solid white;
        border-radius: 8px;
    }

    .gather-section .top-bar .icon-box:nth-child(1),
    .gather-section .top-bar .icon-box:nth-child(4) {
        border-radius: 50%;
    }

    .gather-section .top-bar .text-content h3 {
        color: white;
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .gather-section .top-bar .text-content p {
        color: rgba(255, 255, 255, 0.85);
        font-size: 0.95rem;
        margin: 0;
        max-width: 450px;
    }

    .gather-section .top-bar .explore-btn {
        background-color: transparent;
        color: white;
        border: 2px solid white;
        padding: 12px 30px;
        border-radius: 25px;
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .gather-section .top-bar .explore-btn:hover {
        background-color: white;
        color: #1e4d7b;
    }

    .gather-section .image-section {
        position: relative;
        width: 100%;
        height: 600px;
        overflow: hidden;
    }

    .gather-section .image-section img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .gather-section .image-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5));
        z-index: 1;
    }

    .gather-section .image-section .overlay-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 2;
        text-align: center;
        color: white;
        width: 90%;
        max-width: 900px;
    }

    .gather-section .image-section .overlay-text h2 {
        font-size: 4.5rem;
        font-weight: 700;
        line-height: 1.2;
        margin: 0;
    }

    @media (max-width: 992px) {
        .category-card {
            flex: 0 0 calc(50% - 13px);
        }

        .gather-section .top-bar .container {
            flex-direction: column;
            gap: 20px;
            text-align: center;
        }

        .gather-section .top-bar .left-content {
            flex-direction: column;
        }

        .gather-section .image-section .overlay-text h2 {
            font-size: 2.5rem;
        }
    }

    @media (max-width: 768px) {
        .hero-content h1 {
            font-size: 2.5rem;
        }

        .hero-content p {
            font-size: 1rem;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 45px;
            height: 45px;
            opacity: 0.8;
        }

        .carousel-control-prev {
            left: 15px;
        }

        .carousel-control-next {
            right: 15px;
        }

        .carousel-indicators {
            bottom: 20px;
        }

        .carousel-indicators [data-bs-target] {
            width: 10px;
            height: 10px;
            margin: 0 4px;
        }

        .customers-section {
            padding: 60px 0 0 0;
        }

        .customers-section .content-wrapper h2 {
            font-size: 2rem;
        }

        .customers-section .content-wrapper p {
            font-size: 0.95rem;
        }

        .customers-section .image-wrapper {
            margin-bottom: 30px;
            text-align: center;
        }

        .categories-section .section-header h2 {
            font-size: 2rem;
        }

        .categories-section .nav-arrows {
            display: none;
        }

        .category-card {
            flex: 0 0 100%;
        }

        .categories-section {
            padding: 50px 0;
        }

        .gather-section .top-bar {
            padding: 20px 15px;
        }

        .gather-section .top-bar .text-content h3 {
            font-size: 1.2rem;
        }

        .gather-section .top-bar .text-content p {
            font-size: 0.85rem;
        }

        .gather-section .image-section {
            height: 300px;
        }

        .gather-section .image-section .overlay-text h2 {
            font-size: 2rem;
        }
    }
</style>

<!-- Carousel Section -->
<div id="heroCarousel" class="carousel slide carousel-fade hero-carousel" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>

    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="5000">
            <img src="{{ static_asset('assets/img/firstCarousal.jpg') }}" class="d-block w-100" alt="Slide 1">
            <div class="hero-content">
                <h1>Connecting Markets, Delivering Value.</h1>
                <p>From food and beverages to raw materials and recycled goods – Trades Axis bridges global demand and supply with precision, trust, and expertise.</p>
            </div>
        </div>

        <div class="carousel-item" data-bs-interval="5000">
            <img src="{{ static_asset('assets/img/firstCarousal.jpg') }}" class="d-block w-100" alt="Slide 2">
            <div class="hero-content">
                <h1>Connecting Markets, Delivering Value.</h1>
                <p>From food and beverages to raw materials and recycled goods – Trades Axis bridges global demand and supply with precision, trust, and expertise.</p>
            </div>
        </div>

        <div class="carousel-item" data-bs-interval="5000">
            <img src="{{ static_asset('assets/img/firstCarousal.jpg') }}" class="d-block w-100" alt="Slide 3">
            <div class="hero-content">
                <h1>Connecting Markets, Delivering Value.</h1>
                <p>From food and beverages to raw materials and recycled goods – Trades Axis bridges global demand and supply with precision, trust, and expertise.</p>
            </div>
        </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- Customers Section -->
<section class="customers-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="image-wrapper">
                    <img src="{{ static_asset('assets/img/secondSection.png') }}" alt="Make customers happy">
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="content-wrapper">
                    <h2>Make your customers happy by giving the best products.</h2>
                    <p>We trade common products and food for improving your business and making sure you keep providing the highest quality.</p>
                    <a href="#" class="about-link">
                        About us
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    {{-- <div class="triangle-wrapper">
        <img src="{{ static_asset('assets/img/triangle.png') }}" alt="Triangle Design">
    </div> --}}
</section>

<!-- Categories Section -->
@if($categories && count($categories) > 0)
<section class="categories-section">
    <div class="container">
        <div class="section-header">
            @if(count($categories) > 3)
            <div class="nav-arrows left">
                <button class="arrow-btn" id="prevBtn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M15 18l-6-6 6-6"/>
                    </svg>
                </button>
            </div>
            @endif
            <h2>Our Categories</h2>
            @if(count($categories) > 3)
            <div class="nav-arrows right">
                <button class="arrow-btn" id="nextBtn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 18l6-6-6-6"/>
                    </svg>
                </button>
            </div>
            @endif
        </div>

        <div class="categories-slider">
            <div class="categories-wrapper" id="categoriesWrapper">
                @foreach($categories as $category)
                    @php
                        $categoryName = $category->getTranslation('name', $lang);
                        $categoryImage = null;
                        if($category->banner) {
                            $categoryImage = uploaded_asset($category->banner);
                        } elseif($category->cover_image) {
                            $categoryImage = uploaded_asset($category->cover_image);
                        }
                        
                        if(!$categoryImage) {
                            $lowerName = strtolower($categoryName);
                            if(str_contains($lowerName, 'food') || str_contains($lowerName, 'beverage')) {
                                $categoryImage = 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=800';
                            } elseif(str_contains($lowerName, 'vegetable') || str_contains($lowerName, 'vegtable')) {
                                $categoryImage = 'https://images.unsplash.com/photo-1540420773420-3366772f4999?w=800';
                            } elseif(str_contains($lowerName, 'fruit')) {
                                $categoryImage = 'https://images.unsplash.com/photo-1619566636858-adf3ef46400b?w=800';
                            } elseif(str_contains($lowerName, 'meat') || str_contains($lowerName, 'fish')) {
                                $categoryImage = 'https://images.unsplash.com/photo-1607623814075-e51df1bdc82f?w=800';
                            } elseif(str_contains($lowerName, 'dairy')) {
                                $categoryImage = 'https://images.unsplash.com/photo-1563636619-e9143da7973b?w=800';
                            } elseif(str_contains($lowerName, 'bakery') || str_contains($lowerName, 'bread')) {
                                $categoryImage = 'https://images.unsplash.com/photo-1509440159596-0249088772ff?w=800';
                            } else {
                                $categoryImage = 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=800';
                            }
                        }
                        
                        $categoryUrl = route('products.category', $category->slug);
                    @endphp
                    
                    <a href="{{ $categoryUrl }}" class="category-card">
                        <div class="cart-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                            </svg>
                        </div>
                        <img src="{{ $categoryImage }}" alt="{{ $categoryName }}" onerror="this.src='https://images.unsplash.com/photo-1542838132-92c53300491e?w=800'">
                        <div class="content">
                            <h3>{{ $categoryName }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

<!-- Gather Quality Section -->
<section class="gather-section">
    <div class="top-bar">
        <div class="container">
            <div class="left-content">
                <div class="icon-grid">
                    <div class="icon-box"></div>
                    <div class="icon-box"></div>
                    <div class="icon-box"></div>
                    <div class="icon-box"></div>
                </div>
                <div class="text-content">
                    <h3>Enjoy Most Completed Trading platform</h3>
                    <p>Explore through our large set of Categories. Find the products you need and inquire about them.</p>
                </div>
            </div>
            <a href="{{ route('categories.all') }}" class="explore-btn">Explore Categories</a>
        </div>
    </div>
    
    <div class="image-section">
        <img src="{{ static_asset('assets/img/gather.png') }}" alt="Quality Products">
        <div class="overlay-text">
            <h2>We Gather the highest Quality Products</h2>
        </div>
    </div>
</section>

@if(count($categories) > 3)
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const wrapper = document.getElementById('categoriesWrapper');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        
        if(wrapper && prevBtn && nextBtn) {
            let currentIndex = 0;
            
            setTimeout(() => {
                const firstCard = wrapper.querySelector('.category-card');
                if(firstCard) {
                    const cardWidth = firstCard.offsetWidth + 25;
                    
                    nextBtn.addEventListener('click', () => {
                        const maxScroll = wrapper.scrollWidth - wrapper.parentElement.offsetWidth;
                        if (currentIndex < maxScroll) {
                            currentIndex += cardWidth;
                            if (currentIndex > maxScroll) currentIndex = maxScroll;
                            wrapper.style.transform = `translateX(-${currentIndex}px)`;
                        }
                    });

                    prevBtn.addEventListener('click', () => {
                        if (currentIndex > 0) {
                            currentIndex -= cardWidth;
                            if (currentIndex < 0) currentIndex = 0;
                            wrapper.style.transform = `translateX(-${currentIndex}px)`;
                        }
                    });
                }
            }, 100);
        }
    });
</script>
@endif

@endsection
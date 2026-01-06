@extends('frontend.layouts.app')

@section('content')
    <style>
        .categories-hero {
            position: relative;
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #6366f1 100%);
            padding: 80px 20px;
            text-align: center;
            overflow: hidden;
            margin-bottom: 60px;
        }

        .categories-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('https://images.unsplash.com/photo-1553413077-190dd305871c?w=1200');
            background-size: cover;
            background-position: center;
            opacity: 0.15;
        }

        .categories-hero-content {
            position: relative;
            z-index: 2;
        }

        .categories-hero h1 {
            color: white;
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .categories-hero .subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.3rem;
            font-weight: 300;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 60px;
        }

        .category-card {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            height: 280px;
            cursor: pointer;
            transition: all 0.4s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            display: block;
        }

        .category-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(180deg, transparent 0%, rgba(0, 0, 0, 0.7) 100%);
            z-index: 1;
            transition: all 0.4s ease;
        }

        .category-card:hover::before {
            background: linear-gradient(180deg, transparent 0%, rgba(0, 0, 0, 0.5) 100%);
        }

        .category-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .category-card:hover .category-image {
            transform: scale(1.1);
        }

        .category-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 25px;
            z-index: 2;
        }

        .category-name {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 5px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            color: white;
        }

        .icon-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 45px;
            height: 45px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        .category-card:hover .icon-badge {
            transform: rotate(360deg) scale(1.1);
        }

        .icon-badge i {
            font-size: 24px;
            color: #3b82f6;
        }

        .subcategories-section {
            background: white;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .subcategory-title {
            color: #1e293b;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 3px solid #3b82f6;
        }

        .subcategories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 25px;
        }

        .subcategory-item h6 {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .subcategory-item h6 a {
            color: #1e293b;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .subcategory-item h6 a:hover {
            color: #3b82f6;
        }

        .sub-subcategory-list {
            list-style: none;
            padding: 0;
            margin: 0;
            transition: max-height 0.3s ease;
        }

        .sub-subcategory-list.less {
            max-height: 150px;
            overflow: hidden;
            position: relative;
        }

        .sub-subcategory-list.less::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 50px;
            background: linear-gradient(transparent, white);
        }

        .sub-subcategory-list li {
            margin-bottom: 8px;
        }

        .sub-subcategory-list a {
            color: #64748b;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .sub-subcategory-list a:hover {
            color: #3b82f6;
            padding-left: 5px;
        }

        .show-hide-cetegoty {
            color: #3b82f6;
            font-size: 0.85rem;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            margin-top: 5px;
        }

        .show-hide-cetegoty:hover {
            color: #1e40af;
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .categories-hero h1 {
                font-size: 2rem;
            }

            .categories-hero .subtitle {
                font-size: 1rem;
            }

            .categories-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            }

            .category-card {
                height: 240px;
            }

            .subcategories-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <!-- Hero Section -->
    <section class="categories-hero">
        <div class="categories-hero-content">
            <h1>{{ translate('Explore') }}</h1>
            <p class="subtitle">{{ translate('Our Categories') }}</p>
        </div>
    </section>

    <!-- Categories Grid -->
    <section class="pb-5">
        <div class="container">
            <div class="categories-grid">
                @foreach ($categories as $key => $category)
                    <a href="{{ route('products.category', $category->slug) }}" class="category-card">
                        <img src="{{ $category->banner ? uploaded_asset($category->banner) : asset('assets/img/placeholder.jpg') }}"
                            class="card-img-top" style="object-fit:cover;" alt="{{ $category->name }}">

                        <div class="icon-badge">
                            <i class="las la-tag"></i>
                        </div>

                        <div class="category-content">
                            <h3 class="category-name">{{ $category->getTranslation('name') }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Subcategories Section -->
            @foreach ($categories as $key => $category)
                @if($category->childrenCategories->count() > 0)
                    <div class="subcategories-section">
                        <h2 class="subcategory-title">
                            {{ $category->getTranslation('name') }}
                        </h2>

                        <div class="subcategories-grid">
                            @foreach ($category->childrenCategories as $key => $child_category)
                                <div class="subcategory-item">
                                    <h6>
                                        <a href="{{ route('products.category', $child_category->slug) }}">
                                            {{ $child_category->getTranslation('name') }}
                                        </a>
                                    </h6>

                                    @if($child_category->childrenCategories->count() > 0)
                                        <ul class="sub-subcategory-list @if ($child_category->childrenCategories->count() > 5) less @endif">
                                            @foreach ($child_category->childrenCategories as $key => $second_level_category)
                                                <li>
                                                    <a href="{{ route('products.category', $second_level_category->slug) }}">
                                                        {{ $second_level_category->getTranslation('name') }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>

                                        @if($child_category->childrenCategories->count() > 5)
                                            <a href="javascript:void(0)" class="show-hide-cetegoty">
                                                {{ translate('More') }} <i class="las la-angle-down"></i>
                                            </a>
                                        @endif
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>

@endsection

@section('script')
    <script>
        $('.show-hide-cetegoty').on('click', function () {
            var el = $(this).siblings('ul');
            if (el.hasClass('less')) {
                el.removeClass('less');
                $(this).html('{{ translate('Less') }} <i class="las la-angle-up"></i>');
            } else {
                el.addClass('less');
                $(this).html('{{ translate('More') }} <i class="las la-angle-down"></i>');
            }
        });
    </script>
@endsection
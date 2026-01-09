@extends('frontend.layouts.app')

@php
    use App\Models\OurPartners;

    $hero = OurPartners::where('key', 'hero')->first();
    $trust = OurPartners::where('key', 'trust')->first();
    $brands = OurPartners::where('key', 'brands')->first();
    $count = OurPartners::where('key', 'count')->first();
@endphp

<style>

    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

    .our-partners-page {
        background: #ffffff;
        min-height: 100vh;
        padding: 100px 0;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    .partners-hero {
        text-align: center;
        margin-bottom: 60px;
        position: relative;
    }

    .partners-hero h1 {
        font-size: 56px;
        font-weight: 800;
        color: #0a0a0a;
        margin-bottom: 60px;
        letter-spacing: -1px;
        line-height: 1.2;
    }

    /* Trapezoid Container for Hero */
    .hero-trapezoid-container {
        position: relative;
        max-width: 900px;
        margin: 0 auto 40px;
        padding: 60px 80px;
    }

    .hero-trapezoid-border {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(100, 181, 246, 0.08) 0%, rgba(66, 165, 245, 0.05) 100%);
        clip-path: polygon(8% 0%, 92% 0%, 100% 100%, 0% 100%);
        z-index: 1;
        border-radius: 16px;
    }

    .hero-trapezoid-border::before {
        content: '';
        position: absolute;
        inset: 2px;
        background: rgba(255, 255, 255, 0.95);
        clip-path: polygon(8% 0%, 92% 0%, 100% 100%, 0% 100%);
        backdrop-filter: blur(10px);
    }

    .hero-trapezoid-border::after {
        content: '';
        position: absolute;
        inset: 0;
        border: 4px solid rgba(100, 181, 246, 0.3);
        clip-path: polygon(8% 0%, 92% 0%, 100% 100%, 0% 100%);
        box-shadow: 0 8px 32px rgba(100, 181, 246, 0.12);
        border-radius: 16px;
    }

    .hero-trapezoid-content {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: fadeInUp 0.8s ease-out;
        padding: 20px;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .hero-illustration {
        max-width: 100%;
        max-height: 350px;
        height: auto;
        object-fit: contain;
    }

    /* Subtitle Below Hero */
    .hero-subtitle {
        font-size: 15px;
        line-height: 1.7;
        color: #64748b;
        max-width: 850px;
        margin: 0 auto 80px;
        padding: 0 20px;
        font-weight: 400;
        text-align: center;
    }

    /* Trust Statement Section */
    .trust-section {
        text-align: center;
        margin-bottom: 60px;
    }

    .trust-section h2 {
        font-size: 28px;
        font-weight: 600;
        color: #0a0a0a;
        margin-bottom: 0;
        letter-spacing: -0.3px;
    }

    /* Partners Logos Slider */
    .partners-slider-wrapper {
        overflow: hidden;
        margin-bottom: 50px;
        position: relative;
    }

    .partners-slider-wrapper::before,
    .partners-slider-wrapper::after {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        width: 100px;
        z-index: 2;
        pointer-events: none;
    }

    .partners-slider-wrapper::before {
        left: 0;
        background: linear-gradient(to right, #ffffff, transparent);
    }

    .partners-slider-wrapper::after {
        right: 0;
        background: linear-gradient(to left, #ffffff, transparent);
    }

    .partners-slider {
        display: flex;
        animation: scroll 30s linear infinite;
        width: fit-content;
    }

    @keyframes scroll {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }
    }

    .partners-slider:hover {
        animation-play-state: paused;
    }

    .partner-logo-item {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 60px;
        flex-shrink: 0;
    }

    .partner-logo-item img {
        height: 40px;
        width: auto;
        max-width: 150px;
        filter: grayscale(100%) opacity(0.5);
        transition: all 0.3s ease;
        object-fit: contain;
    }

    .partner-logo-item:hover img {
        filter: grayscale(0%) opacity(1);
        transform: scale(1.1);
    }

    /* Partner Count Statement */
    .partner-count {
        text-align: center;
        font-size: 15px;
        color: #64748b;
        font-weight: 400;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .our-partners-page {
            padding: 80px 0;
        }

        .partners-hero h1 {
            font-size: 44px;
            margin-bottom: 50px;
        }

        .hero-trapezoid-container {
            padding: 50px 60px;
        }
    }

    @media (max-width: 768px) {
        .our-partners-page {
            padding: 60px 0;
        }

        .partners-hero h1 {
            font-size: 38px;
            margin-bottom: 40px;
        }

        .hero-trapezoid-container {
            padding: 40px 40px;
            max-width: 90%;
        }

        .hero-illustration {
            max-height: 280px;
        }

        .hero-subtitle {
            font-size: 14px;
            margin-bottom: 60px;
        }

        .trust-section h2 {
            font-size: 24px;
        }

        .partner-logo-item {
            padding: 0 40px;
        }

        .partner-logo-item img {
            height: 35px;
        }
    }

    @media (max-width: 480px) {
        .partners-hero h1 {
            font-size: 32px;
        }

        .hero-trapezoid-container {
            padding: 30px 20px;
        }

        .hero-illustration {
            max-height: 240px;
        }

        .hero-subtitle {
            font-size: 13px;
        }

        .trust-section h2 {
            font-size: 20px;
        }

        .partner-logo-item {
            padding: 0 30px;
        }

        .partner-logo-item img {
            height: 30px;
        }

        .partner-count {
            font-size: 14px;
        }
    }


    /* Brand Name beside Logo */
    .partner-logo-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
    }

    .brand-name {
        font-size: 13px;
        font-weight: 600;
        color: #495057;
        text-align: center;
        white-space: nowrap;
        letter-spacing: 0.3px;
    }

    .partner-logo-item:hover .brand-name {
        color: #0a0a0a;
    }
</style>

@section('content')
    <div class="our-partners-page">
        <div class="container">

            {{-- Hero Section --}}
            <div class="partners-hero">
                <h1>{{ $hero && isset($hero->value['title']) ? $hero->value['title'] : 'Our Partners' }}</h1>

                {{-- Trapezoid Container with Illustration --}}
                <div class="hero-trapezoid-container">
                    <div class="hero-trapezoid-border"></div>
                    <div class="hero-trapezoid-content">
                        @if ($hero && isset($hero->value['image']) && $hero->value['image'])
                            <img src="{{ asset($hero->value['image']) }}" alt="Our Partners" class="hero-illustration"
                                onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 800 400%27%3E%3Ctext x=%27400%27 y=%27200%27 font-size=%2724%27 text-anchor=%27middle%27 fill=%27%23999%27%3EPartnership Illustration%3C/text%3E%3C/svg%3E'">
                        @else
                        <img src="{{ asset('assets/img/partners/f539e3f31e94302e4e1f745004803908c4aa2e1d.png') }}" alt="Our Partners" class="hero-illustration">
                        @endif
                    </div>
                </div>

                {{-- Subtitle --}}
                <p class="hero-subtitle">
                    {{ $hero && isset($hero->value['subtitle']) ? $hero->value['subtitle'] : 'Trades Axis was founded as an extension of our sister distribution business, which has been thriving in the regional market since 20XX. Our evolution into the import-export field reflects our ongoing commitment to expand our value chain and deliver excellence in every market we serve.' }}
                </p>
            </div>

            {{-- Trust Statement --}}
            <div class="trust-section">
                <h2>{{ $trust && isset($trust->value['text']) ? $trust->value['text'] : "The world's best companies trust Trades Axis." }}
                </h2>
            </div>

            {{-- Partners Logos Slider --}}
            <div class="partners-slider-wrapper">
                <div class="partners-slider">
                    @if (
                        $brands &&
                            isset($brands->value['items']) &&
                            is_array($brands->value['items']) &&
                            count($brands->value['items']) > 0)
                        {{-- First Set of Logos from Database --}}
                        @foreach ($brands->value['items'] as $brand)
                            <div class="partner-logo-item">
                                <div class="partner-logo-wrapper">
                                    @if (isset($brand['logo']) && $brand['logo'])
                                        <img src="{{ asset($brand['logo']) }}" alt="{{ $brand['name'] ?? 'Partner' }}"
                                            onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 150 50%22%3E%3Crect width=%22150%22 height=%2250%22 fill=%22%23f8f9fa%22/%3E%3Ctext x=%2275%22 y=%2225%22 text-anchor=%22middle%22 dominant-baseline=%22middle%22 font-family=%22Arial%22 font-size=%2216%22 font-weight=%22600%22 fill=%22%23495057%22%3ELogo%3C/text%3E%3C/svg%3E';">
                                    @else
                                        <div
                                            style="display: flex; align-items: center; justify-content: center; min-width: 150px; height: 50px; background: #f8f9fa; border-radius: 4px; font-weight: 600; color: #495057; font-size: 16px;">
                                            Logo
                                        </div>
                                    @endif

                                    @if (isset($brand['name']) && $brand['name'])
                                        <span class="brand-name">{{ $brand['name'] }}</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                        {{-- Duplicate Set for Seamless Loop --}}
                        @foreach ($brands->value['items'] as $brand)
                            <div class="partner-logo-item">
                                <div class="partner-logo-wrapper">
                                    @if (isset($brand['logo']) && $brand['logo'])
                                        <img src="{{ asset($brand['logo']) }}" alt="{{ $brand['name'] ?? 'Partner' }}"
                                            onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 150 50%22%3E%3Crect width=%22150%22 height=%2250%22 fill=%22%23f8f9fa%22/%3E%3Ctext x=%2275%22 y=%2225%22 text-anchor=%22middle%22 dominant-baseline=%22middle%22 font-family=%22Arial%22 font-size=%2216%22 font-weight=%22600%22 fill=%22%23495057%22%3ELogo%3C/text%3E%3C/svg%3E';">
                                    @else
                                        <div
                                            style="display: flex; align-items: center; justify-content: center; min-width: 150px; height: 50px; background: #f8f9fa; border-radius: 4px; font-weight: 600; color: #495057; font-size: 16px;">
                                            Logo
                                        </div>
                                    @endif

                                    @if (isset($brand['name']) && $brand['name'])
                                        <span class="brand-name">{{ $brand['name'] }}</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        {{-- Default Logos if no data --}}
                        <div class="partner-logo-item">
                            <div class="partner-logo-wrapper">
                                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 50'%3E%3Cg fill='%23000'%3E%3Ccircle cx='20' cy='25' r='10'/%3E%3Ctext x='40' y='32' font-family='Arial' font-size='20' font-weight='bold'%3EAmplitude%3C/text%3E%3C/g%3E%3C/svg%3E"
                                    alt="Amplitude">
                                <span class="brand-name">Amplitude</span>
                            </div>
                        </div>
                        <div class="partner-logo-item">
                            <div class="partner-logo-wrapper">
                                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 50'%3E%3Ctext x='10' y='35' font-family='Arial' font-size='24' font-weight='bold' fill='%23000'%3Everox%3C/text%3E%3Ctext x='80' y='35' font-family='Arial' font-size='20' font-weight='300' fill='%23666'%3Edoor%3C/text%3E%3C/svg%3E"
                                    alt="Verox Door">
                                <span class="brand-name">Verox Door</span>
                            </div>
                        </div>
                        <div class="partner-logo-item">
                            <div class="partner-logo-wrapper">
                                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 50'%3E%3Ctext x='10' y='32' font-family='Arial' font-size='20' font-weight='bold' letter-spacing='2' fill='%23000'%3ERPUBLICA%3C/text%3E%3C/svg%3E"
                                    alt="RPUBLICA">
                                <span class="brand-name">RPUBLICA</span>
                            </div>
                        </div>
                        <div class="partner-logo-item">
                            <div class="partner-logo-wrapper">
                                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 50'%3E%3Cg fill='%23000'%3E%3Ccircle cx='20' cy='25' r='10'/%3E%3Ctext x='40' y='32' font-family='Arial' font-size='20' font-weight='bold'%3EAmplitude%3C/text%3E%3C/g%3E%3C/svg%3E"
                                    alt="Amplitude">
                                <span class="brand-name">Amplitude</span>
                            </div>
                        </div>
                        <div class="partner-logo-item">
                            <div class="partner-logo-wrapper">
                                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 50'%3E%3Cpath d='M20 15 L35 25 L20 35 Z' fill='%23000'/%3E%3Ctext x='45' y='32' font-family='Arial' font-size='22' font-weight='bold' fill='%23000'%3Einvoice%3C/text%3E%3C/svg%3E"
                                    alt="Invoice">
                                <span class="brand-name">Invoice</span>
                            </div>
                        </div>

                        {{-- Duplicate for seamless loop --}}
                        <div class="partner-logo-item">
                            <div class="partner-logo-wrapper">
                                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 50'%3E%3Cg fill='%23000'%3E%3Ccircle cx='20' cy='25' r='10'/%3E%3Ctext x='40' y='32' font-family='Arial' font-size='20' font-weight='bold'%3EAmplitude%3C/text%3E%3C/g%3E%3C/svg%3E"
                                    alt="Amplitude">
                                <span class="brand-name">Amplitude</span>
                            </div>
                        </div>
                        <div class="partner-logo-item">
                            <div class="partner-logo-wrapper">
                                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 50'%3E%3Ctext x='10' y='35' font-family='Arial' font-size='24' font-weight='bold' fill='%23000'%3Everox%3C/text%3E%3Ctext x='80' y='35' font-family='Arial' font-size='20' font-weight='300' fill='%23666'%3Edoor%3C/text%3E%3C/svg%3E"
                                    alt="Verox Door">
                                <span class="brand-name">Verox Door</span>
                            </div>
                        </div>
                        <div class="partner-logo-item">
                            <div class="partner-logo-wrapper">
                                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 50'%3E%3Ctext x='10' y='32' font-family='Arial' font-size='20' font-weight='bold' letter-spacing='2' fill='%23000'%3ERPUBLICA%3C/text%3E%3C/svg%3E"
                                    alt="RPUBLICA">
                                <span class="brand-name">RPUBLICA</span>
                            </div>
                        </div>
                        <div class="partner-logo-item">
                            <div class="partner-logo-wrapper">
                                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 50'%3E%3Cg fill='%23000'%3E%3Ccircle cx='20' cy='25' r='10'/%3E%3Ctext x='40' y='32' font-family='Arial' font-size='20' font-weight='bold'%3EAmplitude%3C/text%3E%3C/g%3E%3C/svg%3E"
                                    alt="Amplitude">
                                <span class="brand-name">Amplitude</span>
                            </div>
                        </div>
                        <div class="partner-logo-item">
                            <div class="partner-logo-wrapper">
                                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 50'%3E%3Cpath d='M20 15 L35 25 L20 35 Z' fill='%23000'/%3E%3Ctext x='45' y='32' font-family='Arial' font-size='22' font-weight='bold' fill='%23000'%3Einvoice%3C/text%3E%3C/svg%3E"
                                    alt="Invoice">
                                <span class="brand-name">Invoice</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>


            {{-- Partner Count --}}
            <div class="partner-count">
                {{ $count && isset($count->value['text']) ? $count->value['text'] : 'Trades Axis is partner with over 100+ companies across the world' }}
            </div>

        </div>
    </div>
@endsection

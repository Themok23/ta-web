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
        border: 2px solid rgba(100, 181, 246, 0.3);
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
                    <img src="{{ asset($hero->value['image']) }}" alt="Our Partners" class="hero-illustration" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 800 400%27%3E%3Ctext x=%27400%27 y=%27200%27 font-size=%2724%27 text-anchor=%27middle%27 fill=%27%23999%27%3EPartnership Illustration%3C/text%3E%3C/svg%3E'">
                    @else
                    <svg class="hero-illustration" viewBox="0 0 800 400" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Background Elements -->
                        <circle cx="150" cy="200" r="120" fill="#FFF5E6" opacity="0.6" />
                        <circle cx="650" cy="200" r="120" fill="#E3F2FD" opacity="0.6" />

                        <!-- Left Person -->
                        <ellipse cx="150" cy="350" rx="60" ry="15" fill="#E0E0E0" opacity="0.3" />
                        <rect x="135" y="260" width="30" height="90" rx="15" fill="#2C3E85" />
                        <circle cx="150" cy="240" r="25" fill="#FFD4A3" />
                        <path d="M135 240 Q130 250 135 260 L165 260 Q170 250 165 240" fill="#2C3E85" />
                        <rect x="120" y="270" width="20" height="50" rx="10" fill="#2C3E85" />
                        <rect x="110" y="310" width="15" height="35" rx="7" fill="#FFB366" />
                        <path d="M135 350 L125 380 Q125 385 130 385 L140 385 Q145 385 145 380 Z" fill="#2C3E85" />
                        <path d="M165 350 L175 380 Q175 385 170 385 L160 385 Q155 385 155 380 Z" fill="#2C3E85" />
                        <rect x="125" y="300" width="50" height="8" rx="4" fill="#4A5C99" />

                        <!-- Right Person -->
                        <ellipse cx="650" cy="350" rx="60" ry="15" fill="#E0E0E0" opacity="0.3" />
                        <rect x="635" y="260" width="30" height="90" rx="15" fill="#FF8C42" />
                        <circle cx="650" cy="240" r="25" fill="#FFD4A3" />
                        <path d="M635 240 Q630 250 635 260 L665 260 Q670 250 665 240" fill="#FF8C42" />
                        <rect x="660" y="270" width="20" height="50" rx="10" fill="#FF8C42" />
                        <rect x="675" y="310" width="15" height="35" rx="7" fill="#4ECDC4" />
                        <path d="M635 350 L625 380 Q625 385 630 385 L640 385 Q645 385 645 380 Z" fill="#4ECDC4" />
                        <path d="M665 350 L675 380 Q675 385 670 385 L660 385 Q655 385 655 380 Z" fill="#4ECDC4" />

                        <!-- Laptop -->
                        <rect x="580" y="280" width="80" height="50" rx="5" fill="#455A64" />
                        <rect x="585" y="285" width="70" height="40" rx="3" fill="#90CAF9" />
                        <line x1="590" y1="290" x2="640" y2="290" stroke="#64B5F6" stroke-width="2" />
                        <line x1="590" y1="295" x2="630" y2="295" stroke="#64B5F6" stroke-width="2" />
                        <rect x="575" y="330" width="90" height="3" rx="1.5" fill="#455A64" />

                        <!-- Briefcase -->
                        <rect x="100" y="300" width="40" height="30" rx="5" fill="#2C3E85" />
                        <rect x="100" y="305" width="40" height="3" fill="#4A5C99" />
                        <rect x="117" y="295" width="6" height="10" rx="3" fill="#2C3E85" />

                        <!-- Central Handshake & Document -->
                        <!-- Left Arm -->
                        <path d="M180 290 L320 240" stroke="#2C3E85" stroke-width="25" stroke-linecap="round" />
                        <ellipse cx="320" cy="240" rx="20" ry="18" fill="#FFD4A3" />

                        <!-- Right Arm -->
                        <path d="M620 290 L480 240" stroke="#FF8C42" stroke-width="25" stroke-linecap="round" />
                        <ellipse cx="480" cy="240" rx="20" ry="18" fill="#FFD4A3" />

                        <!-- Handshake -->
                        <path d="M320 240 L350 235 L380 240 L410 235 L440 240 L470 235 L480 240" stroke="none" fill="#2C3E85" opacity="0.3" />
                        <path d="M340 225 L380 220 L420 225 L460 220" stroke="#FFD4A3" stroke-width="30" stroke-linecap="round" stroke-linejoin="round" />

                        <!-- Document/Contract -->
                        <rect x="320" y="80" width="160" height="120" rx="8" fill="white" stroke="#E0E0E0" stroke-width="2" />
                        <rect x="340" y="100" width="120" height="8" rx="4" fill="#90CAF9" />
                        <rect x="340" y="120" width="100" height="6" rx="3" fill="#E0E0E0" />
                        <rect x="340" y="133" width="110" height="6" rx="3" fill="#E0E0E0" />
                        <rect x="340" y="146" width="95" height="6" rx="3" fill="#E0E0E0" />
                        <rect x="340" y="159" width="105" height="6" rx="3" fill="#E0E0E0" />
                        <rect x="340" y="172" width="90" height="6" rx="3" fill="#E0E0E0" />

                        <!-- Coins/Money -->
                        <circle cx="420" cy="300" r="25" fill="#FFD54F" />
                        <circle cx="410" cy="305" r="25" fill="#FFEB3B" />
                        <circle cx="430" cy="305" r="25" fill="#FFC107" />
                        <text x="410" y="312" font-size="20" fill="#F57C00" font-weight="bold">$</text>
                        <text x="420" y="312" font-size="20" fill="#F57C00" font-weight="bold">$</text>

                        <!-- Plant Decoration -->
                        <ellipse cx="220" cy="370" rx="30" ry="10" fill="#8D6E63" opacity="0.6" />
                        <path d="M220 345 Q215 350 218 360 L222 360 Q225 350 220 345" fill="#8D6E63" />
                        <path d="M210 355 Q205 350 200 355 Q205 365 210 360" fill="#66BB6A" />
                        <path d="M220 350 Q218 345 213 348 Q215 358 220 355" fill="#4CAF50" />
                        <path d="M230 355 Q235 350 240 355 Q235 365 230 360" fill="#81C784" />
                        <path d="M220 348 Q222 343 227 346 Q225 356 220 353" fill="#66BB6A" />
                    </svg>
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
                        <img src="{{ asset($brand['logo']) }}" alt="{{ $brand['name'] ?? 'Partner' }}" onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 150 50%22%3E%3Crect width=%22150%22 height=%2250%22 fill=%22%23f8f9fa%22/%3E%3Ctext x=%2275%22 y=%2225%22 text-anchor=%22middle%22 dominant-baseline=%22middle%22 font-family=%22Arial%22 font-size=%2216%22 font-weight=%22600%22 fill=%22%23495057%22%3ELogo%3C/text%3E%3C/svg%3E';">
                        @else
                        <div style="display: flex; align-items: center; justify-content: center; min-width: 150px; height: 50px; background: #f8f9fa; border-radius: 4px; font-weight: 600; color: #495057; font-size: 16px;">
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
                        <img src="{{ asset($brand['logo']) }}" alt="{{ $brand['name'] ?? 'Partner' }}" onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 150 50%22%3E%3Crect width=%22150%22 height=%2250%22 fill=%22%23f8f9fa%22/%3E%3Ctext x=%2275%22 y=%2225%22 text-anchor=%22middle%22 dominant-baseline=%22middle%22 font-family=%22Arial%22 font-size=%2216%22 font-weight=%22600%22 fill=%22%23495057%22%3ELogo%3C/text%3E%3C/svg%3E';">
                        @else
                        <div style="display: flex; align-items: center; justify-content: center; min-width: 150px; height: 50px; background: #f8f9fa; border-radius: 4px; font-weight: 600; color: #495057; font-size: 16px;">
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
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 50'%3E%3Cg fill='%23000'%3E%3Ccircle cx='20' cy='25' r='10'/%3E%3Ctext x='40' y='32' font-family='Arial' font-size='20' font-weight='bold'%3EAmplitude%3C/text%3E%3C/g%3E%3C/svg%3E" alt="Amplitude">
                        <span class="brand-name">Amplitude</span>
                    </div>
                </div>
                <div class="partner-logo-item">
                    <div class="partner-logo-wrapper">
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 50'%3E%3Ctext x='10' y='35' font-family='Arial' font-size='24' font-weight='bold' fill='%23000'%3Everox%3C/text%3E%3Ctext x='80' y='35' font-family='Arial' font-size='20' font-weight='300' fill='%23666'%3Edoor%3C/text%3E%3C/svg%3E" alt="Verox Door">
                        <span class="brand-name">Verox Door</span>
                    </div>
                </div>
                <div class="partner-logo-item">
                    <div class="partner-logo-wrapper">
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 50'%3E%3Ctext x='10' y='32' font-family='Arial' font-size='20' font-weight='bold' letter-spacing='2' fill='%23000'%3ERPUBLICA%3C/text%3E%3C/svg%3E" alt="RPUBLICA">
                        <span class="brand-name">RPUBLICA</span>
                    </div>
                </div>
                <div class="partner-logo-item">
                    <div class="partner-logo-wrapper">
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 50'%3E%3Cg fill='%23000'%3E%3Ccircle cx='20' cy='25' r='10'/%3E%3Ctext x='40' y='32' font-family='Arial' font-size='20' font-weight='bold'%3EAmplitude%3C/text%3E%3C/g%3E%3C/svg%3E" alt="Amplitude">
                        <span class="brand-name">Amplitude</span>
                    </div>
                </div>
                <div class="partner-logo-item">
                    <div class="partner-logo-wrapper">
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 50'%3E%3Cpath d='M20 15 L35 25 L20 35 Z' fill='%23000'/%3E%3Ctext x='45' y='32' font-family='Arial' font-size='22' font-weight='bold' fill='%23000'%3Einvoice%3C/text%3E%3C/svg%3E" alt="Invoice">
                        <span class="brand-name">Invoice</span>
                    </div>
                </div>

                {{-- Duplicate for seamless loop --}}
                <div class="partner-logo-item">
                    <div class="partner-logo-wrapper">
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 50'%3E%3Cg fill='%23000'%3E%3Ccircle cx='20' cy='25' r='10'/%3E%3Ctext x='40' y='32' font-family='Arial' font-size='20' font-weight='bold'%3EAmplitude%3C/text%3E%3C/g%3E%3C/svg%3E" alt="Amplitude">
                        <span class="brand-name">Amplitude</span>
                    </div>
                </div>
                <div class="partner-logo-item">
                    <div class="partner-logo-wrapper">
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 50'%3E%3Ctext x='10' y='35' font-family='Arial' font-size='24' font-weight='bold' fill='%23000'%3Everox%3C/text%3E%3Ctext x='80' y='35' font-family='Arial' font-size='20' font-weight='300' fill='%23666'%3Edoor%3C/text%3E%3C/svg%3E" alt="Verox Door">
                        <span class="brand-name">Verox Door</span>
                    </div>
                </div>
                <div class="partner-logo-item">
                    <div class="partner-logo-wrapper">
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 50'%3E%3Ctext x='10' y='32' font-family='Arial' font-size='20' font-weight='bold' letter-spacing='2' fill='%23000'%3ERPUBLICA%3C/text%3E%3C/svg%3E" alt="RPUBLICA">
                        <span class="brand-name">RPUBLICA</span>
                    </div>
                </div>
                <div class="partner-logo-item">
                    <div class="partner-logo-wrapper">
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 50'%3E%3Cg fill='%23000'%3E%3Ccircle cx='20' cy='25' r='10'/%3E%3Ctext x='40' y='32' font-family='Arial' font-size='20' font-weight='bold'%3EAmplitude%3C/text%3E%3C/g%3E%3C/svg%3E" alt="Amplitude">
                        <span class="brand-name">Amplitude</span>
                    </div>
                </div>
                <div class="partner-logo-item">
                    <div class="partner-logo-wrapper">
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 50'%3E%3Cpath d='M20 15 L35 25 L20 35 Z' fill='%23000'/%3E%3Ctext x='45' y='32' font-family='Arial' font-size='22' font-weight='bold' fill='%23000'%3Einvoice%3C/text%3E%3C/svg%3E" alt="Invoice">
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

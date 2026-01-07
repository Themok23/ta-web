@extends('frontend.layouts.app')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .join-partner-page {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        background: #ffffff;
        min-height: 100vh;
    }

    /* =====================================
       HERO SECTION
    ===================================== */
    .partner-hero {
        position: relative;
        height: 500px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        overflow: hidden;
    }

    .partner-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0.5) 100%);
        z-index: 1;
    }

    .partner-hero-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 0;
    }

    .partner-hero-content {
        position: relative;
        z-index: 2;
        color: white;
        padding: 0 20px;
    }

    .partner-hero h1 {
        font-size: 64px;
        font-weight: 300;
        color: #ffffff;
        margin-bottom: 10px;
        letter-spacing: 1px;
        line-height: 1.2;
    }

    .partner-hero h2 {
        font-size: 72px;
        font-weight: 800;
        color: #f54242;
        letter-spacing: 0;
        line-height: 1;
        text-transform: none;
    }

    /* =====================================
       FORM SECTION
    ===================================== */
    .partner-form-section {
        padding: 80px 0;
        background: #ffffff;
    }

    .form-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 80px;
        align-items: start;
    }

    /* Left Side - Info */
    .form-info {
        padding-right: 20px;
    }

    .form-info h3 {
        font-size: 36px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 20px;
        line-height: 1.3;
    }

    .form-info-description {
        font-size: 16px;
        line-height: 1.8;
        color: #5f6368;
        margin-bottom: 40px;
    }

    .contact-info-item {
        display: flex;
        align-items: flex-start;
        gap: 20px;
        margin-bottom: 30px;
    }

    .contact-icon {
        width: 48px;
        height: 48px;
        min-width: 48px;
        background: #f5f5f5;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #f54242;
        font-size: 20px;
    }

    .contact-details h4 {
        font-size: 16px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 5px;
    }

    .contact-details p {
        font-size: 14px;
        color: #5f6368;
        line-height: 1.6;
    }

    /* Right Side - Form */
    .partner-form {
        background: #ffffff;
        padding: 0;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 8px;
    }

    .form-input,
    .form-textarea {
        width: 100%;
        padding: 14px 18px;
        font-size: 15px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        font-family: 'Inter', sans-serif;
        color: #1a1a1a;
        transition: all 0.3s ease;
        background: #fafafa;
    }

    .form-input:focus,
    .form-textarea:focus {
        outline: none;
        border-color: #42a5f5;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(66, 165, 245, 0.1);
    }

    .form-input::placeholder,
    .form-textarea::placeholder {
        color: #9e9e9e;
    }

    .form-textarea {
        min-height: 120px;
        resize: vertical;
    }

    .submit-btn {
        width: 100%;
        padding: 16px 32px;
        font-size: 16px;
        font-weight: 600;
        color: #ffffff;
        background: #d10202;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: 'Inter', sans-serif;
        text-transform: none;
        letter-spacing: 0.5px;
    }

    .submit-btn:hover {
        background: #bd0202;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(2, 136, 209, 0.3);
    }

    .submit-btn:active {
        transform: translateY(0);
    }

    /* =====================================
       RESPONSIVE
    ===================================== */
    @media (max-width: 992px) {
        .form-container {
            grid-template-columns: 1fr;
            gap: 50px;
        }

        .form-info {
            padding-right: 0;
        }

        .partner-hero h1 {
            font-size: 48px;
        }

        .partner-hero h2 {
            font-size: 56px;
        }
    }

    @media (max-width: 768px) {
        .partner-hero {
            height: 400px;
        }

        .partner-hero h1 {
            font-size: 36px;
        }

        .partner-hero h2 {
            font-size: 44px;
        }

        .form-info h3 {
            font-size: 28px;
        }

        .partner-form-section {
            padding: 60px 0;
        }
    }

    @media (max-width: 480px) {
        .partner-hero {
            height: 350px;
        }

        .partner-hero h1 {
            font-size: 28px;
        }

        .partner-hero h2 {
            font-size: 36px;
        }

        .form-info h3 {
            font-size: 24px;
        }

        .form-container {
            padding: 0 15px;
        }

        .contact-info-item {
            gap: 15px;
        }

        .contact-icon {
            width: 40px;
            height: 40px;
            min-width: 40px;
        }
    }
</style>

@section('content')
    <div class="join-partner-page">

        {{-- Hero Section --}}
        <section class="partner-hero">
            <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?w=1920&h=500&fit=crop" 
                 alt="Join Us as Partner" 
                 class="partner-hero-bg">
            <div class="partner-hero-content">
                <h1>Join Us</h1>
                <h2>a Partner</h2>
            </div>
        </section>

        {{-- Form Section --}}
        <section class="partner-form-section">
            <div class="form-container">
                
                {{-- Left Side - Info --}}
                <div class="form-info">
                    <h3>Join us as Partner</h3>
                    <p class="form-info-description">
                        We're here to help! Whether you have a question about your order, 
                        need assistance with a product, or just want to share feedback, 
                        our team is ready to assist you.
                    </p>

                    <div class="contact-info-item">
                        <div class="contact-icon">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 0C6.134 0 3 3.134 3 7c0 5.25 7 13 7 13s7-7.75 7-13c0-3.866-3.134-7-7-7zm0 9.5a2.5 2.5 0 110-5 2.5 2.5 0 010 5z"/>
                            </svg>
                        </div>
                        <div class="contact-details">
                            <h4>Address</h4>
                            <p>13th Street, 47 W 13th St, New York, NY 10011, USA</p>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="contact-icon">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                        </div>
                        <div class="contact-details">
                            <h4>Phone</h4>
                            <p>124-251-524</p>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="contact-icon">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                        </div>
                        <div class="contact-details">
                            <h4>Email Address</h4>
                            <p>mokhtari@gmail.com</p>
                        </div>
                    </div>
                </div>

                {{-- Right Side - Form --}}
                <div class="partner-form">
                    <form action="#" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label class="form-label">Name</label>
                            <input type="text" 
                                   class="form-input" 
                                   name="name" 
                                   placeholder="Enter Name" 
                                   required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" 
                                   class="form-input" 
                                   name="email" 
                                   placeholder="Enter Email" 
                                   required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Phone no. (optional)</label>
                            <input type="tel" 
                                   class="form-input" 
                                   name="phone" 
                                   placeholder="Enter Phone">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Tell us about your Business</label>
                            <textarea class="form-textarea" 
                                      name="business" 
                                      placeholder="Type here..." 
                                      required></textarea>
                        </div>

                        <button type="submit" class="submit-btn">Submit</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
@endsection
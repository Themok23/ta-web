@extends('frontend.layouts.app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .contact-page {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        background: #f8f9fa;
        min-height: 100vh;
        padding: 80px 20px;
    }

    .contact-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        overflow: hidden;
    }

    /* Left side */
    .contact-left {
        padding: 60px 50px;
        background: #ffffff;
    }

    .contact-left-title {
        font-size: 36px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 16px;
        letter-spacing: -0.5px;
    }

    .contact-left-desc {
        font-size: 15px;
        color: #6b7280;
        line-height: 1.7;
        margin-bottom: 50px;
    }

    .contact-info-item {
        display: flex;
        align-items: flex-start;
        gap: 20px;
        margin-bottom: 32px;
    }

    .contact-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .contact-icon svg {
        width: 22px;
        height: 22px;
    }

    .contact-info-content {
        flex: 1;
    }

    .contact-info-label {
        font-size: 16px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 6px;
    }

    .contact-info-value {
        font-size: 14px;
        color: #6b7280;
        line-height: 1.6;
    }

    /* Right side – form */
    .contact-right {
        padding: 60px 50px;
        background: #fafbfc;
    }

    .contact-form-title {
        font-size: 18px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 8px;
    }

    .contact-form-desc {
        font-size: 14px;
        color: #6b7280;
        margin-bottom: 32px;
    }

    .contact-form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-group-full {
        grid-column: 1 / -1;
    }

    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 500;
        color: #1a1a1a;
        margin-bottom: 8px;
    }

    .form-input,
    .form-select,
    .form-textarea {
        width: 100%;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
        padding: 14px 16px;
        font-size: 14px;
        color: #1a1a1a;
        background: #ffffff;
        outline: none;
        transition: all 0.2s ease;
        font-family: 'Inter', sans-serif;
    }

    .form-select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg width='14' height='14' viewBox='0 0 20 20' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5 7L10 12L15 7' stroke='%236B7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        background-size: 16px;
        padding-right: 40px;
    }

    .form-textarea {
        min-height: 130px;
        resize: vertical;
        line-height: 1.6;
    }

    .form-input::placeholder,
    .form-select::placeholder,
    .form-textarea::placeholder {
        color: #9ca3af;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        border-color: #0ea5e9;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
    }

    .submit-btn {
        margin-top: 12px;
        width: 100%;
        max-width: 180px;
        border-radius: 10px;
        padding: 14px 32px;
        background: #e90e0e;
        border: none;
        color: #ffffff;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        font-family: 'Inter', sans-serif;
    }

    .submit-btn:hover {
        background: #c70202;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(14, 165, 233, 0.3);
    }

    .submit-btn:active {
        transform: translateY(0);
    }

    /* Responsive */
    @media (max-width: 992px) {
        .contact-wrapper {
            grid-template-columns: 1fr;
        }

        .contact-left,
        .contact-right {
            padding: 40px 30px;
        }

        .contact-left-title {
            font-size: 30px;
        }
    }

    @media (max-width: 640px) {
        .contact-page {
            padding: 40px 16px;
        }

        .contact-wrapper {
            border-radius: 16px;
        }

        .contact-left,
        .contact-right {
            padding: 32px 24px;
        }

        .contact-left-title {
            font-size: 28px;
        }

        .contact-form-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .submit-btn {
            max-width: 100%;
        }
    }
</style>

<div class="contact-page">
    <div class="contact-wrapper">

        {{-- Left side --}}
        <div class="contact-left">
            <h2 class="contact-left-title">Contact us</h2>
            <p class="contact-left-desc">
                We're here to help! Whether you have a question about your order, need assistance with a product,
                or just want to share feedback, our team is ready to assist you.
            </p>

            <div class="contact-info-item">
                <div class="contact-icon">
                    <svg viewBox="0 0 20 20" fill="none">
                        <path d="M10 1.667C6.778 1.667 4.167 4.278 4.167 7.5c0 4.167 5.833 10.833 5.833 10.833s5.833-6.666 5.833-10.833c0-3.222-2.611-5.833-5.833-5.833z" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M10 9.167a1.667 1.667 0 1 0 0-3.334 1.667 1.667 0 0 0 0 3.334z" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="contact-info-content">
                    <div class="contact-info-label">Address</div>
                    <div class="contact-info-value">13th Street, 47 W 13th St, New York, NY 10011, USA</div>
                </div>
            </div>

            <div class="contact-info-item">
                <div class="contact-icon">
                    <svg viewBox="0 0 20 20" fill="none">
                        <path d="M4.167 3.333h1.5a1.5 1.5 0 0 1 1.46 1.143l.52 2.253a1.5 1.5 0 0 1-.77 1.68l-1.02.51a8.75 8.75 0 0 0 4.754 4.754l.51-1.02a1.5 1.5 0 0 1 1.68-.77l2.253.52A1.5 1.5 0 0 1 16.667 13.5v1.5A1.667 1.667 0 0 1 15 16.667C8.556 16.667 3.333 11.444 3.333 5A1.667 1.667 0 0 1 4.167 3.333z" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="contact-info-content">
                    <div class="contact-info-label">Phone</div>
                    <div class="contact-info-value">124-251-524</div>
                </div>
            </div>

            <div class="contact-info-item">
                <div class="contact-icon">
                    <svg viewBox="0 0 20 20" fill="none">
                        <path d="M3.333 5.417A1.75 1.75 0 0 1 5.083 3.667h9.834a1.75 1.75 0 0 1 1.75 1.75v8.166a1.75 1.75 0 0 1-1.75 1.75H5.083a1.75 1.75 0 0 1-1.75-1.75V5.417z" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4 6l6 3.75L16 6" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="contact-info-content">
                    <div class="contact-info-label">Email Address</div>
                    <div class="contact-info-value">sales@tradesaxis.me</div>
                </div>
            </div>
        </div>

        {{-- Right side – form --}}
        <div class="contact-right">
            <div class="contact-form-title">Get in touch</div>
            <div class="contact-form-desc">Fill out the form and our team will get back to you shortly.</div>

            <form action="#" method="POST">
                @csrf

                <div class="contact-form-grid">
                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-input" placeholder="Enter Name" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-input" placeholder="Enter Email" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Phone no. (optional)</label>
                        <input type="tel" name="phone" class="form-input" placeholder="Enter Phone">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Interested in (optional)</label>
                        <select name="category_id" class="form-select">
                            <option value="">Select Category</option>
                            @foreach($Category as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group form-group-full">
                        <label class="form-label">Tell us about your query</label>
                        <textarea name="message" class="form-textarea" placeholder="Type here..." required></textarea>
                    </div>
                </div>

                <button type="submit" class="submit-btn">Submit</button>
            </form>
        </div>

    </div>
</div>
@endsection
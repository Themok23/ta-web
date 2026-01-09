<!-- Last Viewed Products  -->
@if (get_setting('last_viewed_product_activation') == 1 && Auth::check() && auth()->user()->user_type == 'customer')
    <div class="border-top" id="section_last_viewed_products" style="background-color: #fcfcfc;">
        @php
            $lastViewedProducts = getLastViewedProducts();
        @endphp
        @if (count($lastViewedProducts) > 0)
            <section class="my-2 my-md-3">
                <div class="container">
                    <!-- Top Section -->
                    <div class="d-flex mb-2 mb-md-3 align-items-baseline justify-content-between">
                        <!-- Title -->
                        <h3 class="fs-16 fw-700 mb-2 mb-sm-0">
                            <span class="">{{ translate('Last Viewed Products') }}</span>
                        </h3>
                        <!-- Links -->
                        <div class="d-flex">
                            <a type="button" class="arrow-prev slide-arrow link-disable text-secondary mr-2"
                                onclick="clickToSlide('slick-prev','section_last_viewed_products')"><i
                                    class="las la-angle-left fs-20 fw-600"></i></a>
                            <a type="button" class="arrow-next slide-arrow text-secondary ml-2"
                                onclick="clickToSlide('slick-next','section_last_viewed_products')"><i
                                    class="las la-angle-right fs-20 fw-600"></i></a>
                        </div>
                    </div>
                    <!-- Product Section -->
                    <div class="px-sm-3">
                        <div class="aiz-carousel slick-left sm-gutters-16 arrow-none" data-items="6" data-xl-items="5"
                            data-lg-items="4" data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true'
                            data-infinite='false'>
                            @foreach ($lastViewedProducts as $key => $lastViewedProduct)
                                <div
                                    class="carousel-box px-3 position-relative has-transition hov-animate-outline border-right border-top border-bottom @if ($key == 0) border-left @endif">
                                    @include(
                                        'frontend.' .
                                            get_setting('homepage_select') .
                                            '.partials.last_view_product_box_1',
                                        ['product' => $lastViewedProduct->product]
                                    )
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </div>
@endif

<!-- footer Description -->
@if (get_setting('footer_title') != null || get_setting('footer_description') != null)
    <section class="bg-light border-top border-bottom mt-auto">
        <div class="container py-32px">
            <h1 class="fs-18 fw-700 text-gray-dark mb-3">{{ get_setting('footer_title', null, $system_language->code) }}
            </h1>
            @php
                $fullDescription = nl2br(get_setting('footer_description', null, $system_language->code));
            @endphp

            <div class="footer-desc-container">
                <p class="footer-text-control fs-13 text-gray-dark text-justify mb-0">
                    {!! $fullDescription !!}
                </p>
                <div class="text-control-btn mt-2 d-xl-none">

                    <a class="text-primary cursor-pointer toggle-btn" id="toggle-btn">
                        Read More
                    </a>
                </div>
            </div>
        </div>
    </section>
@endif

<!-- footer top Bar -->
<section class="bg-light border-top mt-auto">
    <div class="container px-xs-0">
        <div class="row no-gutters border-left border-soft-light">
            <!-- Terms & conditions -->
            <div class="col-lg-3 col-6 policy-file">
                <a class="text-reset h-100  border-right border-bottom border-soft-light text-center p-2 p-md-4 d-block hov-ls-1"
                    href="{{ route('terms') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26.004" height="32" viewBox="0 0 26.004 32">
                        <path id="Union_8" data-name="Union 8"
                            d="M-14508,18932v-.01a6.01,6.01,0,0,1-5.975-5.492h-.021v-14h1v13.5h0a4.961,4.961,0,0,0,4.908,4.994h.091v0h14v1Zm17-4v-1a2,2,0,0,0,2-2h1a3,3,0,0,1-2.927,3Zm-16,0a3,3,0,0,1-3-3h1a2,2,0,0,0,2,2h16v1Zm18-3v-16.994h-4v-1h3.6l-5.6-5.6v3.6h-.01a2.01,2.01,0,0,0,2,2v1a3.009,3.009,0,0,1-3-3h.01v-4h.6l0,0H-14507a2,2,0,0,0-2,2v22h-1v-22a3,3,0,0,1,3-3v0h12l0,0,7,7-.01.01V18925Zm-16-4.992v-1h12v1Zm0-4.006v-1h12v1Zm0-4v-1h12v1Z"
                            transform="translate(14513.998 -18900.002)" fill="rgba(255, 255, 255, 1)" />
                    </svg>

                    <h4 class="text-dark fs-14 fw-700 mt-3">{{ translate('Terms & conditions') }}</h4>
                </a>
            </div>

            <!-- Return Policy -->
            <div class="col-lg-3 col-6 policy-file">
                <a class="text-reset h-100  border-right border-bottom border-soft-light text-center p-2 p-md-4 d-block hov-ls-1"
                    href="{{ route('returnpolicy') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32.001" height="23.971" viewBox="0 0 32.001 23.971">
                        <path id="Union_7" data-name="Union 7"
                            d="M-14490,18922.967a6.972,6.972,0,0,0,4.949-2.051,6.944,6.944,0,0,0,2.052-4.943,7.008,7.008,0,0,0-7-7v0h-22.1l7.295,7.295-.707.707-7.779-7.779-.708-.707.708-.7,7.774-7.779.712.707-7.261,7.258H-14490v0a8.01,8.01,0,0,1,8,8,8.008,8.008,0,0,1-8,8Z"
                            transform="translate(14514.001 -18900)" fill="rgba(255, 255, 255, 1)" />
                    </svg>

                    <h4 class="text-dark fs-14 fw-700 mt-3">{{ translate('Return Policy') }}</h4>
                </a>
            </div>

            <!-- Support Policy -->
            <div class="col-lg-3 col-6 policy-file">
                <a class="text-reset h-100  border-right border-bottom border-soft-light text-center p-2 p-md-4 d-block hov-ls-1"
                    href="{{ route('supportpolicy') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32.002" height="32.002" viewBox="0 0 32.002 32.002">
                        <g id="Group_24198" data-name="Group 24198" transform="translate(-1113.999 -2398)">
                            <path id="Subtraction_14" data-name="Subtraction 14"
                                d="M-14508,18916h0l-1,0a12.911,12.911,0,0,1,3.806-9.187A12.916,12.916,0,0,1-14496,18903a12.912,12.912,0,0,1,9.193,3.811A12.9,12.9,0,0,1-14483,18916l-1,0a11.918,11.918,0,0,0-3.516-8.484A11.919,11.919,0,0,0-14496,18904a11.921,11.921,0,0,0-8.486,3.516A11.913,11.913,0,0,0-14508,18916Z"
                                transform="translate(15626 -16505)" fill="rgba(255, 255, 255, 1)" />
                            <path id="Subtraction_15" data-name="Subtraction 15"
                                d="M-14510,18912h-1a3,3,0,0,1-3-3v-6a3,3,0,0,1,3-3h1a2,2,0,0,1,2,2v8A2,2,0,0,1-14510,18912Zm-1-11a2,2,0,0,0-2,2v6a2,2,0,0,0,2,2h1a1,1,0,0,0,1-1v-8a1,1,0,0,0-1-1Z"
                                transform="translate(15628 -16489)" fill="rgba(255, 255, 255, 1)" />
                            <path id="Subtraction_19" data-name="Subtraction 19"
                                d="M4,12H3A3,3,0,0,1,0,9V3A3,3,0,0,1,3,0H4A2,2,0,0,1,6,2v8A2,2,0,0,1,4,12ZM3,1A2,2,0,0,0,1,3V9a2,2,0,0,0,2,2H4a1,1,0,0,0,1-1V2A1,1,0,0,0,4,1Z"
                                transform="translate(1146.002 2423) rotate(180)" fill="rgba(255, 255, 255, 1)" />
                            <path id="Subtraction_17" data-name="Subtraction 17"
                                d="M-14512,18908a2,2,0,0,1-2-2v-4a2,2,0,0,1,2-2,2,2,0,0,1,2,2v4A2,2,0,0,1-14512,18908Zm0-7a1,1,0,0,0-1,1v4a1,1,0,0,0,1,1,1,1,0,0,0,1-1v-4A1,1,0,0,0-14512,18901Z"
                                transform="translate(20034 16940.002) rotate(90)" fill="rgba(255, 255, 255, 1)" />
                            <rect id="Rectangle_18418" data-name="Rectangle 18418" width="1" height="4.001"
                                transform="translate(1137.502 2427.502) rotate(90)" fill="rgba(255, 255, 255, 1)" />
                            <path id="Intersection_1" data-name="Intersection 1"
                                d="M-14508.5,18910a4.508,4.508,0,0,0,4.5-4.5h1a5.508,5.508,0,0,1-5.5,5.5Z"
                                transform="translate(15646.004 -16482.5)" fill="rgba(255, 255, 255, 1)" />
                        </g>
                    </svg>

                    <h4 class="text-dark fs-14 fw-700 mt-3">{{ translate('Support Policy') }}</h4>
                </a>
            </div>

            <!-- Privacy Policy -->
            <div class="col-lg-3 col-6 policy-file">
                <a class="text-reset h-100 border-right border-bottom border-soft-light text-center p-2 p-md-4 d-block hov-ls-1"
                    href="{{ route('privacypolicy') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                        <g id="Group_24236" data-name="Group 24236" transform="translate(-1454.002 -2430.002)">
                            <path id="Subtraction_11" data-name="Subtraction 11"
                                d="M-14498,18932a15.894,15.894,0,0,1-11.312-4.687A15.909,15.909,0,0,1-14514,18916a15.884,15.884,0,0,1,4.685-11.309A15.9,15.9,0,0,1-14498,18900a15.909,15.909,0,0,1,11.316,4.688A15.885,15.885,0,0,1-14482,18916a15.9,15.9,0,0,1-4.687,11.316A15.909,15.909,0,0,1-14498,18932Zm0-31a14.9,14.9,0,0,0-10.605,4.393A14.9,14.9,0,0,0-14513,18916a14.9,14.9,0,0,0,4.395,10.607A14.9,14.9,0,0,0-14498,18931a14.9,14.9,0,0,0,10.607-4.393A14.9,14.9,0,0,0-14483,18916a14.9,14.9,0,0,0-4.393-10.607A14.9,14.9,0,0,0-14498,18901Z"
                                transform="translate(15968 -16470)" fill="rgba(255, 255, 255, 1)" />
                            <g id="Group_24196" data-name="Group 24196" transform="translate(0 -1)">
                                <rect id="Rectangle_18406" data-name="Rectangle 18406" width="2" height="10"
                                    transform="translate(1469 2440)" fill="rgba(255, 255, 255, 1)" />
                                <rect id="Rectangle_18407" data-name="Rectangle 18407" width="2" height="2"
                                    transform="translate(1469 2452)" fill="rgba(255, 255, 255, 1)" />
                            </g>
                        </g>
                    </svg>

                    <h4 class="text-dark fs-14 fw-700 mt-3">{{ translate('Privacy Policy') }}</h4>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="footer-section">
    <div class="footer-container">
        <div class="footer-top">
            <div class="footer-left">
                <div class="logo">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="#3b9df8" />
                        <path d="M2 17L12 22L22 17V12L12 17L2 12V17Z" fill="#3b9df8" />
                    </svg>
                    <span class="logo-text"><span class="trades">TRADES</span><span class="axis">AXIS</span></span>
                </div>
                <p class="tagline">Complete system for your eCommerce business</p>
                <p class="newsletter-text">Subscribe to our newsletter for regular updates about Offers, Coupons & more
                </p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Your Email Address" required>
                    <button type="submit">Subscribe</button>
                </form>
            </div>

            <div class="footer-right">
                <div class="social-section">
                    <h3>FOLLOW US</h3>
                    <div class="social-icons">
                        <a href="#" class="social-icon facebook">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="18"
                                height="18" fill="currentColor">
                                <path
                                    d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z" />
                            </svg>
                        </a>
                        <a href="#" class="social-icon twitter">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="18"
                                height="18" fill="currentColor">
                                <path
                                    d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z" />
                            </svg>
                        </a>
                        <a href="#" class="social-icon instagram">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="18"
                                height="18" fill="currentColor">
                                <path
                                    d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                            </svg>
                        </a>
                        <a href="#" class="social-icon youtube">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="20"
                                height="20" fill="currentColor">
                                <path
                                    d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z" />
                            </svg>
                        </a>
                        <a href="#" class="social-icon linkedin">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="18"
                                height="18" fill="currentColor">
                                <path
                                    d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z" />
                            </svg>
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-links">
                <div class="footer-column">
                    <h3>QUICK LINKS</h3>
                    <ul>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Term & Conditions</a></li>
                    </ul>
                    @if (get_setting('vendor_system_activation') == 1)
                        <a href="{{ route(get_setting('seller_registration_verify') === '1' ? 'shop-reg.verification' : 'shops.create') }}"
                            class="partner-btn">
                            {{ translate('Become a Partner') }}
                        </a>
                    @endif
                </div>

                <div class="footer-column">
                    <h3>CONTACTS</h3>
                    <div class="contact-info">
                        <p class="contact-label">Address</p>
                        <p class="contact-value">Demo Address</p>
                        <p class="contact-label">Phone</p>
                        <p class="contact-value">123456789</p>
                        <p class="contact-label">Email</p>
                        <p class="contact-value">demo.example@gmail.com</p>
                    </div>
                </div>

                <div class="footer-column">
                    <h3>{{ translate('MY ACCOUNT') }}</h3>
                    <ul>
                        @if (Auth::check())
                            <li><a href="{{ route('logout') }}">{{ translate('Logout') }}</a></li>
                        @else
                            <li><a href="{{ route('user.login') }}">{{ translate('Login') }}</a></li>
                        @endif
                        <li><a href="{{ route('purchase_history.index') }}">{{ translate('Inquiry History') }}</a>
                        </li>
                        <li><a href="{{ route('wishlists.index') }}">{{ translate('My Wishlist') }}</a></li>
                        <li><a href="{{ route('orders.track') }}">{{ translate('Track Inquiry') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .footer-section {
        background-color: #2c2c3e;
        color: #fff;
        padding: 60px 20px 40px;
    }

    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .social-icon svg {
        width: 18px;
        height: 18px;
        fill: currentColor;
    }

    .social-icon.youtube svg {
        width: 20px;
        height: 20px;
    }

    .footer-top {
        display: flex;
        justify-content: space-between;
        margin-bottom: 60px;
        gap: 40px;
        flex-wrap: wrap;
    }

    .footer-left {
        flex: 1;
        max-width: 500px;
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .logo svg {
        width: 30px;
        height: 30px;
    }

    .logo-text {
        font-size: 24px;
        font-weight: 600;
        letter-spacing: 1px;
    }

    .logo-text .trades,
    .logo-text .axis {
        color: #fff;
    }

    .logo-text .axis {
        font-weight: 400;
    }

    .tagline {
        color: #b8b8c7;
        margin-bottom: 25px;
        font-size: 14px;
    }

    .newsletter-text {
        color: #fff;
        margin-bottom: 20px;
        font-size: 14px;
        line-height: 1.6;
    }

    .newsletter-form {
        display: flex;
        gap: 0;
    }

    .newsletter-form input {
        flex: 1;
        padding: 12px 20px;
        border: 1px solid #404052;
        background-color: transparent;
        color: #fff;
        outline: none;
        font-size: 14px;
    }

    .newsletter-form input::placeholder {
        color: #777788;
    }

    .newsletter-form button {
        padding: 12px 35px;
        background-color: #3b9df8;
        color: #fff;
        border: none;
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
        transition: background-color 0.3s;
    }

    .newsletter-form button:hover {
        background-color: #2a8be6;
    }

    .footer-right {
        display: flex;
        align-items: flex-start;
    }

    .social-section h3 {
        color: #b8b8c7;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 1px;
        margin-bottom: 20px;
    }

    .social-icons {
        display: flex;
        gap: 15px;
    }

    .social-icon {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        text-decoration: none;
        transition: transform 0.3s;
        font-size: 18px;
    }

    .social-icon:hover {
        transform: translateY(-3px);
    }

    .social-icon.facebook {
        background-color: #3b5998;
    }

    .social-icon.twitter {
        background-color: #1da1f2;
    }

    .social-icon.instagram {
        background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
    }

    .social-icon.youtube {
        background-color: #ff0000;
    }

    .social-icon.linkedin {
        background-color: #0077b5;
    }

    .footer-bottom {
        border-top: 1px solid #404052;
        padding-top: 40px;
    }

    .footer-links {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 40px;
    }

    .footer-column h3 {
        color: #b8b8c7;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 1px;
        margin-bottom: 20px;
    }

    .footer-column ul {
        list-style: none;
    }

    .footer-column ul li {
        margin-bottom: 12px;
    }

    .footer-column ul li a {
        color: #fff;
        text-decoration: none;
        font-size: 14px;
        transition: color 0.3s;
    }

    .footer-column ul li a:hover {
        color: #3b9df8;
    }

    .partner-btn {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 25px;
        background-color: #3b9df8;
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
        transition: background-color 0.3s;
    }

    .partner-btn:hover {
        background-color: #2a8be6;
    }

    .contact-info {
        font-size: 14px;
    }

    .contact-label {
        color: #b8b8c7;
        margin-top: 15px;
        margin-bottom: 5px;
        font-size: 13px;
    }

    .contact-label:first-child {
        margin-top: 0;
    }

    .contact-value {
        color: #fff;
    }

    @media (max-width: 768px) {
        .footer-top {
            flex-direction: column;
        }

        .footer-left {
            max-width: 100%;
        }

        .newsletter-form {
            flex-direction: column;
        }

        .newsletter-form button {
            padding: 12px;
        }

        .social-icons {
            justify-content: flex-start;
        }

        .footer-links {
            grid-template-columns: 1fr;
        }
    }
</style>

<script>
    document.querySelector('.newsletter-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const email = this.querySelector('input').value;
        if (email) {
            alert('Thank you for subscribing! We will send updates to: ' + email);
            this.querySelector('input').value = '';
        }
    });
</script>

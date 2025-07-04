<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mars Communications Ltd | Pay in Installments</title>

    <!-- SEO Meta Tags -->
    <meta name="description"
        content="Mars Communications Ltd offers flexible product payments in easy installments. Pay gradually and receive your product once it's fully paid. Enjoy more with our hassle-free payment plan.">
    <meta name="keywords"
        content="Mars Communications, Pay in Installments, Flexible Payment, Product Financing, Payment Plan, Tanzania, Buy Now Pay Later">
    <meta name="author" content="Mars Communications Ltd">
    <meta name="robots" content="index, follow">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/iconW.png') }}" type="image/png">

    <!-- Open Graph for social media preview -->
    <meta property="og:title" content="Mars Communications Ltd">
    <meta property="og:description"
        content="Buy now, pay later. Choose a product and pay in small, easy installments. Once fully paid, it’s yours.">
    <meta property="og:image" content="{{ asset('images/logo.png') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link href="{{ asset('front-end/assets/vendors/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front-end/assets/vendors/bootstrap-icons/font/bootstrap-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front-end/assets/vendors/glightbox/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front-end/assets/vendors/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front-end/assets/vendors/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('front-end/assets/css/style.css') }}" rel="stylesheet">

    <!-- Theme Setup -->
    <script>
        (function() {
            const storedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-bs-theme', storedTheme);
        })();
    </script>
</head>


<body>

    <div class="site-wrap">

        @include('layouts.front-nav')

        <main>

            <!-- ======= Hero =======-->
            <section class="hero__v6 section" id="home">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 mb-4 mb-lg-0">
                            <div class="row">
                                <div class="col-lg-11"><span class="hero-subtitle text-uppercase alert-danger"
                                        data-aos="fade-up" data-aos-delay="0">Innovative Fintech Solutions</span>

                                    <h1 class="hero-title mb-3" data-aos="fade-up" data-aos-delay="100">
                                        @lang('messages.advance_payment_installment_scheme')</h1>
                                    <p class="hero-description mb-4 mb-lg-5" data-aos="fade-up" data-aos-delay="200">
                                        Experience the future of finance with our secure, efficient, and user-friendly
                                        electronics purchase services.</p>
                                    <div class="cta d-flex gap-2 mb-4 mb-lg-5" data-aos="fade-up" data-aos-delay="300">

                                        @if (Route::has('login'))
                                            @auth

                                                <a class="btn" href="{{ route('dashboard') }}">Dashboard</a>
                                            @else
                                                <a class="btn" href="{{ route('login') }}">Get Started Now</a>
                                            @endauth
                                        @endif


                                        <a class="btn btn-white-outline" href="#">Learn More
                                            <svg class="lucide lucide-arrow-up-right" xmlns="http://www.w3.org/2000/svg"
                                                width="18" height="18" viewbox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M7 7h10v10"></path>
                                                <path d="M7 17 17 7"></path>
                                            </svg></a>
                                    </div>
                                    <div class="logos mb-4" data-aos="fade-up" data-aos-delay="400"><span
                                            class="logos-title text-uppercase mb-4 d-block">Partner with</span>
                                        <div class="logos-images d-flex gap-4 align-items-center">
                                            <img class="img-fluid" src="{{ asset('images/hisense.png') }}"
                                                alt="Company 1" style="width: 80px;">
                                            <img class="img-fluid" src="{{ asset('images/samsung.png') }}"
                                                alt="Company 1" style="width: 80px;">
                                            <img class="img-fluid" src="{{ asset('images/lg.png') }}" alt="Company 1"
                                                style="width: 80px;">
                                            <img class="img-fluid" src="{{ asset('images/toshiba.png') }}"
                                                alt="Company 1" style="width: 80px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="hero-img"><img class="img-card img-fluid"
                                    src="{{ asset('images/sittingroom.jpeg') }}" alt="Image card"
                                    data-aos="fade-down" data-aos-delay="600"><img
                                    class="img-main img-fluid rounded-4" src="{{ asset('images/tv1.webp') }}"
                                    alt="Hero Image" data-aos="fade-in" data-aos-delay="500"></div>
                        </div>
                    </div>
                </div>
            </section>


            <section class="about__v4 section" id="about">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 order-md-2">
                            <div class="row justify-content-end">
                                <div class="col-md-11 mb-4 mb-md-0"><span class="subtitle text-uppercase mb-3"
                                        data-aos="fade-up" data-aos-delay="0">@lang('messages.about_service')</span>
                                    <h2 class="mb-4" data-aos="fade-up" data-aos-delay="100">@lang('messages.easily_manage_advance_payments')</h2>
                                    <div data-aos="fade-up" data-aos-delay="200">
                                        <p>@lang('messages.about_payment')</p>
                                        {{-- <p>Our cutting-edge platform ensures your transactions are safe, streamlined,
                                            and easy to manage, empowering you to take control of your financial journey
                                            with confidence and convenience.</p> --}}
                                    </div>
                                    <h4 class="small fw-bold mt-4 mb-3" data-aos="fade-up" data-aos-delay="300">Key
                                        Features</h4>
                                    <ul class="d-flex flex-row flex-wrap list-unstyled gap-3 features"
                                        data-aos="fade-up" data-aos-delay="400">
                                        <li class="d-flex align-items-center gap-2"><span
                                                class="icon rounded-circle text-center"><i
                                                    class="bi bi-check"></i></span><span
                                                class="text">@lang('messages.flexible_plans')</span></li>
                                        <li class="d-flex align-items-center gap-2"><span
                                                class="icon rounded-circle text-center"><i
                                                    class="bi bi-check"></i></span><span
                                                class="text">@lang('messages.secure_transactions')</span></li>
                                        <li class="d-flex align-items-center gap-2"><span
                                                class="icon rounded-circle text-center"><i
                                                    class="bi bi-check"></i></span><span
                                                class="text">@lang('messages.instant_approvals') </span></li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="img-wrap position-relative"><img class="img-fluid rounded-4"
                                    src="{{ asset('images/vaccmbg.jpeg') }}"
                                    alt="FreeBootstrap.net image placeholder" data-aos="fade-up" data-aos-delay="0">
                                <div class="mission-statement p-4 rounded-4 d-flex gap-4" data-aos="fade-up"
                                    data-aos-delay="100">
                                    <div class="mission-icon text-center rounded-circle"><i
                                            class="bi bi-lightbulb fs-4"></i></div>
                                    <div>
                                        <h3 class="text-uppercase fw-bold">Solution</h3>
                                        <p class="fs-5 mb-0">@lang('messages.choose_advance_payment_plan')</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End About-->

            <!-- ======= Features =======-->
            <section class="section features__v2" id="features">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-lg-flex p-5 rounded-4 content" data-aos="fade-in" data-aos-delay="0">
                                <div class="row">
                                    <div class="col-lg-5 mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="0">
                                        <div class="row">
                                            <div class="col-lg-11">
                                                <div class="h-100 flex-column justify-content-between d-flex">
                                                    <div>
                                                        <h2 class="mb-4">@lang('messages.why_choose_us')</h2>
                                                        <p class="mb-5">Step into the future of smart spending with
                                                            our secure, seamless, and user-focused advance purchase
                                                            platform. Whether you're planning ahead or spreading out
                                                            payments, our system makes every transaction safe,
                                                            efficient, and hassle-free—giving you full control over your
                                                            financial commitments with confidence and ease.</p>
                                                    </div>
                                                    {{-- <div class="align-self-start"><a
                                                            class="glightbox btn btn-play d-inline-flex align-items-center gap-2"
                                                            href="https://www.youtube.com/watch?v=DQx96G4yHd8"
                                                            data-gallery="video"><i class="bi bi-play-fill"></i> Watch
                                                            the Video</a></div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="row justify-content-end">
                                            <div class="col-lg-11">
                                                <div class="row">
                                                    <div class="col-sm-6" data-aos="fade-up" data-aos-delay="0">
                                                        <div class="icon text-center mb-4 bg-secondary"><i
                                                                class="bi bi-wallet fs-4 text-white"></i></div>
                                                        <h3 class="fs-6 fw-bold mb-3">@lang('messages.flexible_payments')</h3>
                                                        <p>@lang('messages.pay_at_your_own_pace')
                                                        </p>
                                                    </div>
                                                    <div class="col-sm-6" data-aos="fade-up" data-aos-delay="100">
                                                        <div class="icon text-center mb-4 bg-secondary"><i
                                                                class="bi bi-eye fs-4 text-white"></i></div>
                                                        <h3 class="fs-6 fw-bold mb-3">@lang('messages.transparent_tracking')</h3>
                                                        <p>@lang('messages.get_real_time_updates')</p>
                                                    </div>
                                                    <div class="col-sm-6" data-aos="fade-up" data-aos-delay="200">
                                                        <div class="icon text-center mb-4 bg-secondary"><i
                                                                class="bi bi-shield-lock fs-4 text-white"></i></div>
                                                        <h3 class="fs-6 fw-bold mb-3">@lang('messages.secure_transactions')</h3>
                                                        <p>@lang('messages.transactions_encrypted_safeguarded')</p>
                                                    </div>
                                                    <div class="col-sm-6" data-aos="fade-up" data-aos-delay="300">
                                                        <div class="icon text-center mb-4 bg-secondary"><i
                                                                class="bi bi-check-circle fs-4 text-white"></i></div>
                                                        <h3 class="fs-6 fw-bold mb-3">@lang('messages.quick_approvals')</h3>
                                                        <p>@lang('messages.get_approvals_faster')
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Features-->

            <section class="section pricing__v2" id="products">
                <div class="container">
                    <div class="row mb-5">
                        <div class="col-md-6 mx-auto text-center">
                            <span class="subtitle text-uppercase mb-3" data-aos="fade-up">Products</span>
                            <h2 class="mb-3" data-aos="fade-up" data-aos-delay="100">Explore Our Top Electronics
                            </h2>
                            <p data-aos="fade-up" data-aos-delay="200">Discover our best-selling devices – premium
                                quality, cutting-edge features, and unbeatable prices.</p>
                        </div>
                    </div>

                    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel" data-aos="fade-up"
                        data-aos-delay="300">
                        <div class="carousel-inner">

                            <div class="carousel-item active">
                                <div class="row justify-content-center">
                                    <div class="col-md-4">
                                        <div class="p-5 rounded-4 price-table h-100 text-center">
                                            <img src="https://via.placeholder.com/200x150?text=Smartphone"
                                                class="mb-3 img-fluid" alt="Smartphone">
                                            <h3>Smartphone X1</h3>
                                            <p>Experience lightning speed with our new 5G smartphone, stunning OLED
                                                display, and pro-grade camera.</p>
                                            <div class="price mb-3"><strong>TZS 69800000</strong></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="p-5 rounded-4 price-table h-100 text-center">
                                            <img src="https://via.placeholder.com/200x150?text=Smartwatch"
                                                class="mb-3 img-fluid" alt="Smartwatch">
                                            <h3>Smartwatch Pro</h3>
                                            <p>Track your health, stay connected, and look sharp with our
                                                water-resistant Smartwatch Pro.</p>
                                            <div class="price mb-3"><strong>TZS 1990000</strong></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-none d-md-block">
                                        <div class="p-5 rounded-4 price-table h-100 text-center">
                                            <img src="https://via.placeholder.com/200x150?text=Laptop"
                                                class="mb-3 img-fluid" alt="Laptop">
                                            <h3>Laptop ZBook</h3>
                                            <p>Powerful performance with Intel i7, 16GB RAM, and a stunning 4K display –
                                                built for professionals.</p>
                                            <div class="price mb-3"><strong>TZS 1,190,000</strong></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Second Slide -->
                            <div class="carousel-item">
                                <div class="row justify-content-center">
                                    <div class="col-md-4">
                                        <div class="p-5 rounded-4 price-table h-100 text-center">
                                            <img src="https://via.placeholder.com/200x150?text=Bluetooth+Speaker"
                                                class="mb-3 img-fluid" alt="Speaker">
                                            <h3>Bluetooth Boom</h3>
                                            <p>Portable wireless speaker with deep bass, 10-hour battery life, and
                                                splash-proof design.</p>
                                            <div class="price mb-3"><strong>TZS 900000</strong></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="p-5 rounded-4 price-table h-100 text-center">
                                            <img src="https://via.placeholder.com/200x150?text=Drone"
                                                class="mb-3 img-fluid" alt="Drone">
                                            <h3>SkyCam Drone</h3>
                                            <p>4K camera drone with GPS, follow-me mode, and 30-minute flight time –
                                                ready for adventure.</p>
                                            <div class="price mb-3"><strong>TZS 800000</strong></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-none d-md-block">
                                        <div class="p-5 rounded-4 price-table h-100 text-center">
                                            <img src="https://via.placeholder.com/200x150?text=Headphones"
                                                class="mb-3 img-fluid" alt="Headphones">
                                            <h3>Noise Cancelling Headphones</h3>
                                            <p>Immerse in music with active noise canceling, wireless comfort, and
                                                25-hour playtime.</p>
                                            <div class="price mb-3"><strong>TZS 1490000</strong></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Carousel controls -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </section>



            <!-- ======= How it works =======-->
            <section class="section howitworks__v1" id="how-it-works">
                <div class="container">
                    <div class="row mb-5">
                        <div class="col-md-6 text-center mx-auto"><span class="subtitle text-uppercase mb-3"
                                data-aos="fade-up" data-aos-delay="0">@lang('messages.advance_purchase_made_simple')</span>
                            <h2 data-aos="fade-up" data-aos-delay="100">How It Works</h2>
                            <p data-aos="fade-up" data-aos-delay="200">@lang('messages.platform_allows_purchase')</p>
                        </div>
                    </div>
                    <div class="row g-md-5">
                        <div class="col-md-6 col-lg-3">
                            <div class="step-card text-center h-100 d-flex flex-column justify-content-start position-relative"
                                data-aos="fade-up" data-aos-delay="0">
                                <div data-aos="fade-right" data-aos-delay="500"><img class="arch-line"
                                        src="front-end/assets/images/arch-line.svg"
                                        alt="FreeBootstrap.net image placeholder">
                                </div><span
                                    class="step-number rounded-circle text-center fw-bold mb-5 mx-auto">1</span>
                                <div>
                                    <h3 class="fs-5 mb-4">@lang('messages.register_create_account')</h3>
                                    <p>@lang('messages.sign_up_verify_account')</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="600">
                            <div
                                class="step-card reverse text-center h-100 d-flex flex-column justify-content-start position-relative">
                                <div data-aos="fade-right" data-aos-delay="1100"><img class="arch-line reverse"
                                        src="front-end/assets/images/arch-line-reverse.svg"
                                        alt="FreeBootstrap.net image placeholder"></div><span
                                    class="step-number rounded-circle text-center fw-bold mb-5 mx-auto">2</span>
                                <h3 class="fs-5 mb-4">@lang('messages.choose_your_product')</h3>
                                <p>@lang('messages.browse_select_appliance').
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="1200">
                            <div
                                class="step-card text-center h-100 d-flex flex-column justify-content-start position-relative">
                                <div data-aos="fade-right" data-aos-delay="1700"><img class="arch-line"
                                        src="front-end/assets/images/arch-line.svg"
                                        alt="FreeBootstrap.net image placeholder">
                                </div><span
                                    class="step-number rounded-circle text-center fw-bold mb-5 mx-auto">3</span>
                                <h3 class="fs-5 mb-4">@lang('messages.track_your_progress')</h3>
                                <p>@lang('messages.monitor_payments_loan_status')</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="1800">
                            <div
                                class="step-card last text-center h-100 d-flex flex-column justify-content-start position-relative">
                                <span class="step-number rounded-circle text-center fw-bold mb-5 mx-auto">4</span>
                                <div>
                                    <h3 class="fs-5 mb-4">@lang('messages.complete_payment_receive_product')</h3>
                                    <p>@lang('messages.once_fully_paid_delivered')
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End How it works-->

            <!-- ======= Stats =======-->
            <section class="stats__v3 section">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex flex-wrap content rounded-4" data-aos="fade-up" data-aos-delay="0">
                                <div class="rounded-borders">
                                    <div class="rounded-border-1"></div>
                                    <div class="rounded-border-2"></div>
                                    <div class="rounded-border-3"></div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0 text-center" data-aos="fade-up"
                                    data-aos-delay="100">
                                    <div class="stat-item">
                                        <h3 class="fs-1 fw-bold"><span class="purecounter" data-purecounter-start="0"
                                                data-purecounter-end="320"
                                                data-purecounter-duration="2">0</span><span>+</span></h3>
                                        <p class="mb-0">@lang('messages.experts')</p>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0 text-center" data-aos="fade-up"
                                    data-aos-delay="200">
                                    <div class="stat-item">
                                        <h3 class="fs-1 fw-bold"> <span class="purecounter"
                                                data-purecounter-start="0" data-purecounter-end="18"
                                                data-purecounter-duration="2">0</span><span>+</span></h3>
                                        <p class="mb-0">@lang('messages.partnership')</p>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0 text-center" data-aos="fade-up"
                                    data-aos-delay="300">
                                    <div class="stat-item">
                                        <h3 class="fs-1 fw-bold"><span class="purecounter" data-purecounter-start="0"
                                                data-purecounter-end="500"
                                                data-purecounter-duration="2">0</span><span>+</span></h3>
                                        <p class="mb-0">@lang('messages.products')</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Stats-->

            <!-- ======= Services =======-->
            {{-- <section class="section services__v3" id="services">
                <div class="container">
                    <div class="row mb-5">
                        <div class="col-md-8 mx-auto text-center"><span class="subtitle text-uppercase mb-3"
                                data-aos="fade-up" data-aos-delay="0">Our Services</span>
                            <h2 class="mb-3" data-aos="fade-up" data-aos-delay="100">Empowering Financial
                                Innovation Through Cutting-Edge Services</h2>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
                            <div
                                class="service-card p-4 rounded-4 h-100 d-flex flex-column justify-content-between gap-5">
                                <div><span class="icon mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0" y="0" viewbox="0 0 64 64"
                                            style="enable-background:new 0 0 512 512" xml:space="preserve">
                                            <g>
                                                <path
                                                    d="M50.327 4H25.168a6.007 6.007 0 0 0-6 6v5.11h-8.375a3.154 3.154 0 0 0-3.12 3.18v5.47a1 1 0 0 0 .724.961 3.204 3.204 0 0 1 0 6.097 1 1 0 0 0-.724.962v5.49a3.154 3.154 0 0 0 3.12 3.18H34.5c-2.147 8.057 9.408 12.135 12.77 4.441a1 1 0 0 0-1.841-.779 4.778 4.778 0 1 1-4.403-6.636c1.039-.159 2.453 1.082 3.063-.225.449-1.37-1.383-1.598-2.336-1.734V31.8a1 1 0 0 0-.72-.96 3.21 3.21 0 0 1 0-6.11 1 1 0 0 0 .72-.96v-5.48a3.154 3.154 0 0 0-3.12-3.18H21.168V10a4.004 4.004 0 0 1 4-4h3.21l1.24 3.066a3.982 3.982 0 0 0 3.708 2.503h8.826a3.984 3.984 0 0 0 3.71-2.503L47.1 6h3.228a4.004 4.004 0 0 1 4 4v1.6a1 1 0 0 0 2 0V10a6.007 6.007 0 0 0-6-6ZM38.633 17.11a1.153 1.153 0 0 1 1.12 1.18v4.792a5.234 5.234 0 0 0 0 9.405V35.6a6.789 6.789 0 0 0-4.333 2.85H10.793a1.153 1.153 0 0 1-1.12-1.18v-4.8a5.232 5.232 0 0 0 0-9.401V18.29a1.153 1.153 0 0 1 1.12-1.18Zm5.375-8.793a1.994 1.994 0 0 1-1.856 1.252h-8.826a1.991 1.991 0 0 1-1.854-1.252l-.934-2.312H44.94Z"
                                                    fill="currentColor" opacity="1" data-original="#000000">
                                                </path>
                                                <path
                                                    d="M55.327 14.6a1 1 0 0 0-1 1V54a4.004 4.004 0 0 1-4 4H25.168a4.004 4.004 0 0 1-4-4V43.45a1 1 0 0 0-2 0V54a6.007 6.007 0 0 0 6 6h25.16a6.007 6.007 0 0 0 6-6V15.6a1 1 0 0 0-1-1Z"
                                                    fill="currentColor" opacity="1" data-original="#000000">
                                                </path>
                                                <path
                                                    d="M41.185 54.52a1 1 0 0 0 0-2h-6.891a1 1 0 0 0 0 2ZM24.713 28.383a.853.853 0 1 1-.835 1.028.998.998 0 0 0-1.184-.775c-1.765.61-.18 2.94 1.017 3.265-.271 1.919 2.27 1.926 2-.003a2.852 2.852 0 0 0-.998-5.515.851.851 0 1 1 .821-1.084 1 1 0 0 0 1.926-.54 2.857 2.857 0 0 0-1.749-1.893v-.518a1 1 0 0 0-2 0v.521a2.852 2.852 0 0 0 1.002 5.514Z"
                                                    fill="currentColor" opacity="1" data-original="#000000">
                                                </path>
                                                <path
                                                    d="M24.713 36.43a9.092 9.092 0 0 0 9.082-9.082c-.499-12.047-17.666-12.045-18.163 0a9.092 9.092 0 0 0 9.08 9.082Zm0-16.163a7.09 7.09 0 0 1 7.082 7.081c-.371 9.388-13.793 9.387-14.163 0a7.09 7.09 0 0 1 7.08-7.081ZM46.413 37.53l-4.757 4.757-1.68-1.68a1 1 0 0 0-1.413 1.415l2.386 2.386a1 1 0 0 0 1.414 0l5.464-5.464a1 1 0 0 0-1.414-1.414Z"
                                                    fill="currentColor" opacity="1" data-original="#000000">
                                                </path>
                                            </g>
                                        </svg></span>
                                    <h3 class="fs-5 mb-3">Digital Payments</h3>
                                    <p class="mb-4">Seamless and secure transactions through various digital
                                        platforms, enabling quick and convenient payments for businesses and consumers
                                        alike.</p>
                                </div><a
                                    class="special-link d-inline-flex gap-2 align-items-center text-decoration-none"
                                    href="#"><span class="icons"><i
                                            class="icon-1 bi bi-arrow-right-short"></i><i
                                            class="icon-2 bi bi-arrow-right-short"> </i></span><span>Read
                                        more</span></a>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                            <div
                                class="service-card p-4 rounded-4 h-100 d-flex flex-column justify-content-between gap-5">
                                <div><span class="icon mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0" y="0" viewbox="0 0 64 64"
                                            style="enable-background:new 0 0 512 512" xml:space="preserve">
                                            <g>
                                                <path
                                                    d="m57.936 58.647-4.47-11.871a9.542 9.542 0 0 0-5.914-5.693l-7.659-2.609-1.944-2.116v-2.62a13.043 13.043 0 0 0 4.739-5.175 14.256 14.256 0 0 0 3.237.14 2.909 2.909 0 0 0 2.905-2.906v-5.382a2.895 2.895 0 0 0-1.495-2.523 13.84 13.84 0 0 0-2.807-7.777 1 1 0 0 0-1.597 1.205 11.879 11.879 0 0 1 2.386 6.19c-.012-.01-2.017.036-1.987-.023-4.064-11.113-18.668-11.126-22.702.024h-1.875c.73-9.938 13.556-14.987 21.539-8.81a1 1 0 0 0 1.196-1.605c-9.394-7.24-24.311-1.02-24.754 10.758a2.895 2.895 0 0 0-1.566 2.561v5.382a2.909 2.909 0 0 0 2.905 2.906c.4-.042 2.932.115 3.213-.122a12.843 12.843 0 0 0 4.542 5.038v2.757l-1.825 2.184-7.553 2.521a9.547 9.547 0 0 0-5.917 5.695l-4.47 11.871a1.008 1.008 0 0 0 .935 1.352H49.97a1 1 0 0 0 0-2H36.123l-2.985-7.876 2.014-2.491 2.009 1.746a1.007 1.007 0 0 0 1.643-.594l1.322-8.118 6.785 2.312a7.549 7.549 0 0 1 4.682 4.504L55.555 58H53.97a1 1 0 0 0 0 2H57a1.007 1.007 0 0 0 .936-1.353zm-13.77-39.136h1.759a.906.906 0 0 1 .905.904v5.382a.906.906 0 0 1-.905.906h-1.759zm-24.334 7.192h-1.759a.906.906 0 0 1-.905-.906v-5.382a.906.906 0 0 1 .905-.904h1.76s.038 5.959 0 7.192zm12.146-15.6a10.16 10.16 0 0 1 9.15 6.288L38.85 18.43a4.677 4.677 0 0 1-4.986-.747 6.633 6.633 0 0 0-7.78-.736l-3.91 2.325c1.2-4.704 5.135-8.169 9.803-8.169zM21.832 23.168V21.8l5.273-3.133a4.632 4.632 0 0 1 5.433.51 6.72 6.72 0 0 0 7.15 1.07l2.098-.957a12.113 12.113 0 0 1 .38 2.98c-.464 14.245-18.826 15.065-20.334.9zM35.95 34.706v1.718l-3.968 5.464-4.153-5.473v-1.78a11.242 11.242 0 0 0 8.12.071zm-9.164 3.643 3.852 5.075-3.771 3.28-1.206-7.008zM8.444 58l3.96-10.516a7.551 7.551 0 0 1 4.681-4.505l6.724-2.245 1.387 8.06a1.007 1.007 0 0 0 1.641.585l2.01-1.746 2.013 2.491L27.875 58zm25.54 0h-3.97L32 52.763zm-1.985-9.65-1.642-2.03 1.642-1.428 1.642 1.427zm5.12-1.658-3.772-3.28 3.693-5.085 1.224 1.332z"
                                                    fill="currentColor" opacity="1" data-original="currentColor">
                                                </path>
                                            </g>
                                        </svg></span>
                                    <h3 class="fs-5 mb-3">Personal Finance Management</h3>
                                    <p class="mb-4">Seamless and secure transactions through various digital
                                        platforms, enabling quick and convenient payments for businesses and consumers
                                        alike.</p>
                                </div><a
                                    class="special-link d-inline-flex gap-2 align-items-center text-decoration-none"
                                    href="#"><span class="icons"><i
                                            class="icon-1 bi bi-arrow-right-short"></i><i
                                            class="icon-2 bi bi-arrow-right-short"> </i></span><span>Read
                                        more</span></a>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                            <div
                                class="service-card p-4 rounded-4 h-100 d-flex flex-column justify-content-between gap-5">
                                <div><span class="icon mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0" y="0" viewbox="0 0 64 64"
                                            style="enable-background:new 0 0 512 512" xml:space="preserve">
                                            <g>
                                                <path
                                                    d="M35.719 21.413a1 1 0 0 0-1.586 1.218 15.554 15.554 0 0 1 1.806 3.012h-6.1a19.93 19.93 0 0 0-3.417-8.42 15.637 15.637 0 0 1 5.012 2.652 1 1 0 0 0 1.245-1.565 17.676 17.676 0 1 0-11.002 31.51c14.511.067 22.936-16.94 14.042-28.407zm.966 6.23a15.507 15.507 0 0 1 .001 8.994h-6.533a35.942 35.942 0 0 0-.001-8.995zM29.84 38.635h6.102a15.688 15.688 0 0 1-9.534 8.447 19.91 19.91 0 0 0 3.432-8.447zm-1.402-6.491a34.461 34.461 0 0 1-.292 4.492h-12.94a34.731 34.731 0 0 1 .001-8.995h12.938a34.461 34.461 0 0 1 .293 4.503zm-6.812-15.67c2.533-.006 5.021 3.488 6.193 9.168H15.535c1.138-5.63 3.672-9.12 6.092-9.168zm-4.683.734a19.903 19.903 0 0 0-3.429 8.434H7.417a15.707 15.707 0 0 1 9.527-8.434zM6 32.149a15.682 15.682 0 0 1 .671-4.507h6.53a35.936 35.936 0 0 0 0 8.995H6.67A15.558 15.558 0 0 1 6 32.15zm1.413 6.487h6.1a19.912 19.912 0 0 0 3.43 8.446 15.69 15.69 0 0 1-9.53-8.446zm8.118 0h12.29c-2.589 12.171-9.703 12.166-12.29 0zM16.844 8.31H38.91a8.42 8.42 0 0 1 8.4 8.106l-2.018-2.018a1 1 0 0 0-1.414 1.414l3.74 3.74a1 1 0 0 0 1.414 0l3.74-3.74a1 1 0 0 0-1.413-1.414l-2.048 2.047A10.421 10.421 0 0 0 38.911 6.31H16.844a1 1 0 0 0 0 2zM50.105 44.448a1 1 0 0 0-1.413 0l-3.74 3.74a1 1 0 1 0 1.413 1.414l2.018-2.018a8.419 8.419 0 0 1-8.4 8.107H17.916a1 1 0 0 0 0 2h22.067a10.42 10.42 0 0 0 10.401-10.136l2.048 2.047a1 1 0 0 0 1.413-1.414zM58.589 27.13a1 1 0 0 0-1.694 1.062 7.174 7.174 0 1 1-2.549-2.453 1 1 0 1 0 .992-1.736 9.2 9.2 0 1 0-4.545 17.195c7.082.128 11.668-8.14 7.796-14.068z"
                                                    fill="currentColor" opacity="1" data-original="#000000">
                                                </path>
                                                <path
                                                    d="M49.754 34.379a1.001 1.001 0 0 0-1.238-.682c-1.769.767.123 2.972 1.275 3.302a1 1 0 1 0 2-.024 3.075 3.075 0 0 0-1-5.975 1.078 1.078 0 1 1 1.053-1.306 1 1 0 0 0 1.187.77c1.894-.7-.034-3.134-1.24-3.463a1 1 0 1 0-2 .024 3.075 3.075 0 0 0 1 5.975 1.079 1.079 0 1 1-1.037 1.379z"
                                                    fill="currentColor" opacity="1" data-original="#000000">
                                                </path>
                                            </g>
                                        </svg></span>
                                    <h3 class="fs-5 mb-3">Online Lending</h3>
                                    <p class="mb-4">Fast and accessible lending services that provide personal and
                                        business loans through online platforms, simplifying the borrowing process.</p>
                                </div><a
                                    class="special-link d-inline-flex gap-2 align-items-center text-decoration-none"
                                    href="#"><span class="icons"><i
                                            class="icon-1 bi bi-arrow-right-short"></i><i
                                            class="icon-2 bi bi-arrow-right-short"> </i></span><span>Read
                                        more</span></a>
                            </div>
                        </div>

                    </div>
                </div>
            </section> --}}


            <section class="section faq__v2" id="faq">
                <div class="container">
                    <div class="row mb-4">
                        <div class="col-md-6 col-lg-7 mx-auto text-center">
                            <span class="subtitle text-uppercase mb-3" data-aos="fade-up"
                                data-aos-delay="0">FAQ</span>
                            <h2 class="h2 fw-bold mb-3" data-aos="fade-up" data-aos-delay="0">Advance Purchase –
                                Frequently Asked Questions</h2>
                            <p data-aos="fade-up" data-aos-delay="100">
                                Everything you need to know about our advance purchase and installment payment service.
                                Get clarity before you commit.
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 mx-auto" data-aos="fade-up" data-aos-delay="200">
                            <div class="faq-content">
                                <div class="accordion custom-accordion" id="accordionPanelsStayOpenExample">

                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#faq1" aria-expanded="true" aria-controls="faq1">
                                                What is an advance purchase?
                                            </button>
                                        </h2>
                                        <div id="faq1" class="accordion-collapse collapse show">
                                            <div class="accordion-body">
                                                An advance purchase allows you to choose a product and pay for it in
                                                small installments over time. Once full payment is completed, the
                                                product is delivered to you. It’s a flexible way to shop without the
                                                burden of paying everything upfront.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#faq2"
                                                aria-expanded="false" aria-controls="faq2">
                                                How do I get approved for advance payment?
                                            </button>
                                        </h2>
                                        <div id="faq2" class="accordion-collapse collapse">
                                            <div class="accordion-body">
                                                Approval is instant for most users. Simply register, complete your
                                                profile, and submit your request. Our team may review certain
                                                applications for verification before activation.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#faq3"
                                                aria-expanded="false" aria-controls="faq3">
                                                When will I receive my product?
                                            </button>
                                        </h2>
                                        <div id="faq3" class="accordion-collapse collapse">
                                            <div class="accordion-body">
                                                Once your total installment payments are completed, your product will be
                                                processed for delivery. You can track your payment progress in your
                                                dashboard at any time.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#faq4"
                                                aria-expanded="false" aria-controls="faq4">
                                                Is there any interest or hidden charge?
                                            </button>
                                        </h2>
                                        <div id="faq4" class="accordion-collapse collapse">
                                            <div class="accordion-body">
                                                No, our advance purchase plans are completely interest-free. What you
                                                see is what you pay. We believe in transparent pricing and flexible
                                                financial options.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#faq5"
                                                aria-expanded="false" aria-controls="faq5">
                                                Can I apply for more than one product?
                                            </button>
                                        </h2>
                                        <div id="faq5" class="accordion-collapse collapse">
                                            <div class="accordion-body">
                                                Yes, after successfully completing payment for a product, you become
                                                eligible to apply for additional products using the same installment
                                                plan system. You must, however, be in good standing with your previous
                                                payments.
                                            </div>
                                        </div>
                                    </div>

                                </div> <!-- end accordion -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <!-- ======= Contact =======-->
            <section class="section contact__v2" id="contact">
                <div class="container">
                    <div class="row mb-5">
                        <div class="col-md-6 col-lg-7 mx-auto text-center"><span class="subtitle text-uppercase mb-3"
                                data-aos="fade-up" data-aos-delay="0">Contact</span>
                            <h2 class="h2 fw-bold mb-3" data-aos="fade-up" data-aos-delay="0">Contact Us</h2>
                            <p data-aos="fade-up" data-aos-delay="100">Contact For Any Query.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="d-flex gap-5 flex-column">
                                <div class="d-flex align-items-start gap-3" data-aos="fade-up" data-aos-delay="0">
                                    <div class="icon d-block"><i class="bi bi-telephone"></i></div><span> <span
                                            class="d-block">Phone</span><strong>+255 74140-0900</strong></span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex gap-5 flex-column">

                                <div class="d-flex align-items-start gap-3" data-aos="fade-up" data-aos-delay="200">
                                    <div class="icon d-block"><i class="bi bi-envelope"></i></div><span> <span
                                            class="d-block">Email</span>
                                        <address class="fw-bold">marscommunicationltd@gmail.com</address>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="d-flex gap-5 flex-column">

                                <div class="d-flex align-items-start gap-3" data-aos="fade-up" data-aos-delay="200">
                                    <div class="icon d-block"><i class="bi bi-geo-alt"></i></div><span> <span
                                            class="d-block">Address</span>
                                        <address class="fw-bold">Samora JM Mall,Posta <br> Dar es salaam</address>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.5951619290745!2d39.28414437499556!3d-6.818992593178741!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x185c4b05a1a7c36d%3A0x879448c8362f87fd!2sSamora%20Ave%2C%20Dar%20es%20Salaam!5e0!3m2!1sen!2stz!4v1733818825960!5m2!1sen!2stz"
                                width="100%" height="450" style="border: 0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>

                    </div>
                </div>
            </section>
            <!-- End Contact-->
            @include('elements.footer')

        </main>
    </div>

    <!-- ======= Back to Top =======-->
    <button id="back-to-top"><i class="bi bi-arrow-up-short"></i></button>

    <script src="{{ asset('front-end/assets/vendors/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('front-end/assets/vendors/gsap/gsap.min.js') }}"></script>
    <script src="{{ asset('front-end/assets/vendors/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('front-end/assets/vendors/isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('front-end/assets/vendors/glightbox/glightbox.min.js') }}"></script>
    <script src="{{ asset('front-end/assets/vendors/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('front-end/assets/vendors/aos/aos.js') }}"></script>
    <script src="{{ asset('front-end/assets/vendors/purecounter/purecounter.js') }}"></script>
    <script src="{{ asset('front-end/assets/js/custom.js') }}"></script>
    <script src="{{ asset('front-end/assets/js/send_email.js') }}"></script>


</body>

</html>

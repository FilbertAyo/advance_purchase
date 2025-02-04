<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Mars communications ltd</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="front-end/front-end/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@600;700&family=Ubuntu:wght@400;500&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="front-end/lib/animate/animate.min.css" rel="stylesheet">
    <link href="front-end/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="front-end/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="front-end/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="front-end/css/style.css" rel="stylesheet">

    <style>
        .carousel-item {
            height: 60vh;
        }
    </style>
</head>

<body>

@include('layouts.front-nav')


    <div class="container-fluid p-0 mb-5">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="front-end/img/carousel-bg-1.jpg" alt="Image">
                    <div class="carousel-caption d-flex align-items-center">
                        <div class="container">
                            <div class="row align-items-center justify-content-center justify-content-lg-start">
                                <div class="col-10 col-lg-7 text-center text-lg-start">
                                    <h6 class="text-white text-uppercase mb-3 animated slideInDown">// Air Conditioners
                                        //</h6>
                                    <h1 class="display-3 text-white mb-4 pb-3 animated slideInDown">@lang('messages.advance_payment_installment_scheme')</h1>
                                    <a href="{{ url('/register') }}"
                                        class="btn bg-white text-primary py-3 px-5 animated slideInDown fw-bold">@lang('messages.application')<i class="fa fa-arrow-right ms-3"></i></a>
                                </div>
                                <div class="col-lg-5 d-none d-lg-flex animated zoomIn">
                                    <img class="img-fluid" src="front-end/img/carousel-1.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="front-end/img/wmbac.png" alt="Image">
                    <div class="carousel-caption d-flex align-items-center">
                        <div class="container">
                            <div class="row align-items-center justify-content-center justify-content-lg-start">
                                <div class="col-10 col-lg-7 text-center text-lg-start">
                                    <h6 class="text-white text-uppercase mb-3 animated slideInDown">// Washing Machine
                                        //</h6>
                                    <h1 class="display-3 text-white mb-4 pb-3 animated slideInDown">@lang('messages.advance_payment_installment_scheme')</h1>
                                    <a href="{{ url('/register') }}"
                                        class="btn bg-white text-primary py-3 px-5 animated slideInDown fw-bold">@lang('messages.application')<i class="fa fa-arrow-right ms-3"></i></a>
                                </div>
                                <div class="col-lg-5 d-none d-lg-flex animated zoomIn">
                                    <img class="img-fluid" src="front-end/img/wm.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="front-end/img/carousel-bg-2.jpg" alt="Image">
                    <div class="carousel-caption d-flex align-items-center">
                        <div class="container">
                            <div class="row align-items-center justify-content-center justify-content-lg-start">
                                <div class="col-10 col-lg-7 text-center text-lg-start">
                                    <h6 class="text-white text-uppercase mb-3 animated slideInDown">// TELEVISION //
                                    </h6>
                                    <h1 class="display-3 text-white mb-4 pb-3 animated slideInDown">@lang('messages.advance_payment_installment_scheme')</h1>
                                    <a href="{{ url('/register') }}"
                                        class="btn bg-white text-primary py-3 px-5 animated slideInDown fw-bold">@lang('messages.application')<i class="fa fa-arrow-right ms-3"></i></a>
                                </div>
                                <div class="col-lg-5 d-none d-lg-flex animated zoomIn">
                                    <img class="img-fluid" src="front-end/img/tv.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="front-end/img/vaccmbg.jpeg" alt="Image">
                    <div class="carousel-caption d-flex align-items-center">
                        <div class="container">
                            <div class="row align-items-center justify-content-center justify-content-lg-start">
                                <div class="col-10 col-lg-7 text-center text-lg-start">
                                    <h6 class="text-white text-uppercase mb-3 animated slideInDown">// VACUUM CLEANER
                                        //</h6>
                                    <h1 class="display-3 text-white mb-4 pb-3 animated slideInDown">@lang('messages.advance_payment_installment_scheme')</h1>
                                    <a href="{{ url('/register') }}"
                                        class="btn bg-white text-primary py-3 px-5 animated slideInDown fw-bold">@lang('messages.application')<i class="fa fa-arrow-right ms-3"></i></a>
                                </div>
                                <div class="col-lg-5 d-none d-lg-flex animated zoomIn">
                                    <img class="img-fluid" src="front-end/img/VC.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="front-end/img/airbg.jpeg" alt="Image">
                    <div class="carousel-caption d-flex align-items-center">
                        <div class="container">
                            <div class="row align-items-center justify-content-center justify-content-lg-start">
                                <div class="col-10 col-lg-7 text-center text-lg-start">
                                    <h6 class="text-white text-uppercase mb-3 animated slideInDown">// AIR FLYER //
                                    </h6>
                                    <h1 class="display-3 text-white mb-4 pb-3 animated slideInDown">@lang('messages.advance_payment_installment_scheme')</h1>
                                    <a href="{{ url('/register') }}"
                                        class="btn bg-white text-primary py-3 px-5 animated slideInDown fw-bold">@lang('messages.application')<i class="fa fa-arrow-right ms-3"></i></a>
                                </div>
                                <div class="col-lg-5 d-none d-lg-flex animated zoomIn">
                                    <img class="img-fluid" src="front-end/img/airfly.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->

    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center">
                <h6 class="text-danger text-uppercase">@lang('messages.easily_manage_advance_payments')</h6>
                <h1>@lang('messages.about_service') </h1>
                <p style="text-align: justify;" class="my-4">@lang('messages.about_payment') </p>
            </div>
            <div class="row g-4">
                <!-- Card 1 -->
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex bg-light py-5 px-4">
                        <i class="fa fa-wallet fa-3x text-primary flex-shrink-0"></i>
                        <div class="ps-4">
                            <h5 class="mb-3"> @lang('messages.flexible_plans')</h5>
                            <p> @lang('messages.choose_advance_payment_plan')</p>
                            <a class="text-secondary border-bottom" href=""> @lang('messages.learn_more')</a>
                        </div>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex bg-light py-5 px-4">
                        <i class="fa fa-shield-alt fa-3x text-primary flex-shrink-0"></i>
                        <div class="ps-4">
                            <h5 class="mb-3">@lang('messages.secure_transactions')</h5>
                            <p>@lang('messages.your_advance_payments_protected').</p>
                            <a class="text-secondary border-bottom" href=""> @lang('messages.learn_more')</a>
                        </div>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex bg-light py-5 px-4">
                        <i class="fa fa-check-circle fa-3x text-primary flex-shrink-0"></i>
                        <div class="ps-4">
                            <h5 class="mb-3"> @lang('messages.instant_approvals')</h5>
                            <p> @lang('messages.receive_quick_approvals')</p>
                            <a class="text-secondary border-bottom" href=""> @lang('messages.learn_more')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container-xxl py-5" id="about">
        <div class="container">
            <div class="row g-5">
                <!-- Image Section -->
                <div class="col-lg-6 pt-4">
                    <div class="position-relative" style="height: 600px;">
                        <img class="position-absolute img-fluid w-100 h-100" src="images/W3.png"
                             alt="Advance Payment" style="object-fit: contain;">
                    </div>
                </div>
                <!-- Content Section -->
                <div class="col-lg-6">
                    <h1 class="mb-4"><span class="text-primary"> @lang('messages.advance_purchase_made_simple')</h1>
                    <p class="mb-4"> @lang('messages.platform_allows_purchase')</p>

                    <div class="row g-4 mb-3 pb-3">
                        <!-- Step 1 -->
                        <div class="col-12 ">
                            <div class="d-flex">
                                <div class="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1" style="width: 45px; height: 45px;">
                                    <span class="fw-bold text-secondary">01</span>
                                </div>
                                <div class="ps-3">
                                    <h6>@lang('messages.register_create_account')</h6>
                                    <span>@lang('messages.sign_up_verify_account').</span>
                                </div>
                            </div>
                        </div>
                        <!-- Step 2 -->
                        <div class="col-12">
                            <div class="d-flex">
                                <div class="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1" style="width: 45px; height: 45px;">
                                    <span class="fw-bold text-secondary">02</span>
                                </div>
                                <div class="ps-3">
                                    <h6>@lang('messages.choose_your_product')</h6>
                                    <span>@lang('messages.browse_select_appliance').</span>
                                </div>
                            </div>
                        </div>
                        <!-- Step 3 -->
                        <div class="col-12">
                            <div class="d-flex">
                                <div class="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1" style="width: 45px; height: 45px;">
                                    <span class="fw-bold text-secondary">03</span>
                                </div>
                                <div class="ps-3">
                                    <h6>@lang('messages.start_making_payments')</h6>
                                    <span>@lang('messages.deposit_any_amount').</span>
                                </div>
                            </div>
                        </div>
                        <!-- Step 4 -->
                        <div class="col-12">
                            <div class="d-flex">
                                <div class="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1" style="width: 45px; height: 45px;">
                                    <span class="fw-bold text-secondary">04</span>
                                </div>
                                <div class="ps-3">
                                    <h6>@lang('messages.track_your_progress')</h6>
                                    <span>@lang('messages.monitor_payments_loan_status').</span>
                                </div>
                            </div>
                        </div>
                        <!-- Step 5 -->
                        <div class="col-12">
                            <div class="d-flex">
                                <div class="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1" style="width: 45px; height: 45px;">
                                    <span class="fw-bold text-secondary">05</span>
                                </div>
                                <div class="ps-3">
                                    <h6>@lang('messages.complete_payment_receive_product')</h6>
                                    <span>@lang('messages.nce_fully_paid_delivered').</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ url('/register') }}" class="btn btn-primary py-3 px-5">@lang('messages.get_started')<i class="fa fa-arrow-right ms-3"></i></a>
                </div>
            </div>
        </div>
    </div>



    <div class="container-fluid fact bg-dark  py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6 col-lg-3 text-center">
                    <i class="fa fa-check fa-2x text-white mb-3"></i>
                    <h2 class="text-white mb-2" data-toggle="counter-up">20</h2>
                    <p class="text-white mb-0">@lang('messages.years_experience')</p>
                </div>
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.3s">
                    <i class="fa fa-users-cog fa-2x text-white mb-3"></i>
                    <h2 class="text-white mb-2" data-toggle="counter-up">320</h2>
                    <p class="text-white mb-0">@lang('messages.experts')</p>
                </div>
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.5s">
                    <i class="fa fa-users fa-2x text-white mb-3"></i>
                    <h2 class="text-white mb-2" data-toggle="counter-up">8</h2>
                    <p class="text-white mb-0">@lang('messages.partnership')</p>
                </div>
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.7s">
                    <i class="fa fa-product fa-2x text-white mb-3"></i>
                    <h2 class="text-white mb-2" data-toggle="counter-up">500</h2>
                    <p class="text-white mb-0">@lang('messages.products')</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-xxl service py-5">
        <div class="container">
            <div class="text-center">
                <h1 class="mb-5">@lang('messages.why_choose_us')?</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="nav w-100 nav-pills me-4">
                        <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4 active" data-bs-toggle="pill" data-bs-target="#tab-pane-1" type="button">
                            <i class="fa fa-wallet fa-2x me-3"></i>
                            <h4 class="m-0">@lang('messages.flexible_payments')</h4>
                        </button>
                        <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4" data-bs-toggle="pill" data-bs-target="#tab-pane-2" type="button">
                            <i class="fa fa-eye fa-2x me-3"></i>
                            <h4 class="m-0">@lang('messages.transparent_tracking')</h4>
                        </button>
                        <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4" data-bs-toggle="pill" data-bs-target="#tab-pane-3" type="button">
                            <i class="fa fa-lock fa-2x me-3"></i>
                            <h4 class="m-0">@lang('messages.secure_transactions')</h4>
                        </button>
                        <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-0" data-bs-toggle="pill" data-bs-target="#tab-pane-4" type="button">
                            <i class="fa fa-bolt fa-2x me-3"></i>
                            <h4 class="m-0">@lang('messages.quick_approvals')</h4>
                        </button>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="tab-content w-100">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <div class="row g-4">
                                <div class="col-md-6" style="min-height: 350px;">
                                    <div class="position-relative h-100">
                                        <img class="position-absolute img-fluid w-100 h-100" src="front-end/img/wm.png" style="object-fit: cover;" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="mb-3">@lang('messages.flexible_payments')</h3>
                                    <p class="mb-4">@lang('messages.pay_at_your_own_pace')</p>
                                    <p><i class="fa fa-check text-success me-3"></i>@lang('messages.multiple_installment_plans')</p>
                                    <p><i class="fa fa-check text-success me-3"></i>@lang('messages.no_hidden_fees')</p>
                                    <p><i class="fa fa-check text-success me-3"></i>@lang('messages.easy_online_payments')</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-2">
                            <div class="row g-4">
                                <div class="col-md-6" style="min-height: 350px;">
                                    <div class="position-relative h-100">
                                        <img class="position-absolute img-fluid w-100 h-100" src="front-end/img/carousel-2.png" style="object-fit: cover;" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="mb-3">@lang('messages.transparent_tracking')</h3>
                                    <p class="mb-4">@lang('messages.get_real_time_updates')</p>
                                    <p><i class="fa fa-check text-success me-3"></i>@lang('messages.live_transaction_tracking')</p>
                                    <p><i class="fa fa-check text-success me-3"></i>@lang('messages.instant_notifications')</p>
                                    <p><i class="fa fa-check text-success me-3"></i>@lang('messages.detailed_reports')</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row g-4">
                                <div class="col-md-6" style="min-height: 350px;">
                                    <div class="position-relative h-100">
                                        <img class="position-absolute img-fluid w-100 h-100" src="front-end/img/airfly.png" style="object-fit: cover;" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="mb-3">@lang('messages.secure_transactions')</h3>
                                    <p class="mb-4">@lang('messages.transactions_encrypted_safeguarded')</p>
                                    <p><i class="fa fa-check text-success me-3"></i>@lang('messages.advanced_encryption')</p>
                                    <p><i class="fa fa-check text-success me-3"></i>@lang('messages.fraud_detection_system')</p>
                                    <p><i class="fa fa-check text-success me-3"></i>@lang('messages.safe_secure_payments')</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-4">
                            <div class="row g-4">
                                <div class="col-md-6" style="min-height: 350px;">
                                    <div class="position-relative h-100">
                                        <img class="position-absolute img-fluid w-100 h-100" src="front-end/img/carousel-1.png" style="object-fit: cover;" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="mb-3">@lang('messages.quick_approvals')</h3>
                                    <p class="mb-4">@lang('messages.get_approvals_faster')</p>
                                    <p><i class="fa fa-check text-success me-3"></i>@lang('messages.instant_verification')</p>
                                    <p><i class="fa fa-check text-success me-3"></i>@lang('messages.minimal_documentation')</p>
                                    <p><i class="fa fa-check text-success me-3"></i>@lang('messages.fast_processing_time')</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="p-1">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.5951619290745!2d39.28414437499556!3d-6.818992593178741!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x185c4b05a1a7c36d%3A0x879448c8362f87fd!2sSamora%20Ave%2C%20Dar%20es%20Salaam!5e0!3m2!1sen!2stz!4v1733818825960!5m2!1sen!2stz"
            width="100%" height="450" style="border: 0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </section>

    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center">
                {{-- <h6 class="text-danger text-uppercase"> Highlights </h6> --}}
                <h1 class="mb-5">@lang('messages.products_showcase')</h1>
            </div>
            @foreach ($products as $product)
            <div class="owl-carousel testimonial-carousel position-relative">
                <div class="testimonial-item text-center bg-light p-3">
                    <img src="{{ $product->productImages->isEmpty() ? 'default.jpg' : $product->productImages->first()->image_url }}" alt="{{ $product->name }}" class="mb-3">
                    <h5 class="mb-0">TZS {{ number_format($product->sales, 0, '.', ',') }}/=</h5>
                    <p>{{ $product->item_name }}</p>
                </div>
            </div>
        @endforeach


        </div>
    </div>

    @include('elements.footer')


    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="front-end/lib/wow/wow.min.js"></script>
    <script src="front-end/lib/easing/easing.min.js"></script>
    <script src="front-end/lib/waypoints/waypoints.min.js"></script>
    <script src="front-end/lib/counterup/counterup.min.js"></script>
    <script src="front-end/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="front-end/lib/tempusdominus/js/moment.min.js"></script>
    <script src="front-end/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="front-end/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="front-end/js/main.js"></script>
</body>

</html>

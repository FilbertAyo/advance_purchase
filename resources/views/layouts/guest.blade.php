<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Mars - Application Form</title>

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

                {{ $slot }}

            @include('elements.footer')

          </main>
    </div>




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

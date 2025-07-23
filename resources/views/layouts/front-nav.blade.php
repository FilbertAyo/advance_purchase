


<header class="fbs__net-navbar navbar navbar-expand-lg dark" aria-label="freebootstrap.net navbar">

    <div class="container d-flex align-items-center justify-content-between">


        <!-- Start Logo-->
        <a class="navbar-brand w-auto" href="{{ url('/') }}">
            <!-- If you use a text logo, uncomment this if it is commented-->
            <!-- Vertex-->

            <!-- If you plan to use an image logo, uncomment this if it is commented-->

            <!-- logo dark--><img class="logo dark img-fluid" src="{{ asset('images/shortblogo.png') }}"
                style="height: 50px;" alt="mars">

            <!-- logo light--><img class="logo light img-fluid" src="{{ asset('images/shortblogo.png') }}"
                style="height: 50px;" alt="mars">

        </a>
        <!-- End Logo-->

        <!-- Start offcanvas-->
        <div class="offcanvas offcanvas-start w-75" id="fbs__net-navbars" tabindex="-1"
            aria-labelledby="fbs__net-navbarsLabel">


            <div class="offcanvas-header">
                <div class="offcanvas-header-logo">
                    <!-- If you use a text logo, uncomment this if it is commented-->

                    <!-- h5#fbs__net-navbarsLabel.offcanvas-title Vertex-->

                    <!-- If you plan to use an image logo, uncomment this if it is commented-->
                    <a class="logo-link" id="fbs__net-navbarsLabel" href="{{ url('/') }}">


                        <!-- logo dark--><img class="logo dark img-fluid" src="{{ asset('images/shortblogo.png') }}"
                            style="height: 50px;" alt="mars">

                        <!-- logo light--><img class="logo light img-fluid" src="{{ asset('images/shortblogo.png') }}"
                            style="height: 50px;" alt="mars">

                </div>
                <button class="btn-close btn-close-black" type="button" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>

            <div class="offcanvas-body align-items-lg-center">

                <ul class="navbar-nav nav me-auto ps-lg-5 mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link scroll-link active" aria-current="page"
                            href="{{ url('/') }}">@lang('messages.home')</a></li>
                    <li class="nav-item"><a class="nav-link scroll-link"
                            href="{{ url('/') }}#about">@lang('messages.about')</a></li>
                    <li class="nav-item"><a class="nav-link scroll-link" href="#how-it-works">How It Works</a>
                    </li>
                    <li class="nav-item"><a class="nav-link scroll-link" href="#services">Services</a></li>

                    <li class="nav-item"><a class="nav-link scroll-link"
                            href="{{ url('/') }}#contact">@lang('messages.contact')</a></li>
                    <li class="nav-item"><a class="nav-link scroll-link" href="{{ route('register') }}">Registration
                            form</a></li>

                </ul>

            </div>
        </div>


        <div class="ms-auto w-auto">
    <div class="header-social d-flex align-items-center gap-1">
        @if (Route::has('login'))
            @auth
                <a class="btn btn-primary py-2" href="{{ route('dashboard') }}">Dashboard</a>
            @else
                <a class="btn btn-primary py-2" href="{{ route('login') }}">@lang('messages.login')</a>
            @endauth
        @endif

        <!-- Language Switcher -->
        <div class="dropdown">
            <button class="btn btn-sm dropdown-toggle bg-transparent border-0 shadow-none" type="button"
                id="languageDropdownLg" data-bs-toggle="dropdown" aria-expanded="false">
                <img id="selectedFlagLg" src="https://flagcdn.com/w40/us.png" alt="English" width="25" class="me-1">
            </button>
            <ul class="dropdown-menu" aria-labelledby="languageDropdownLg">
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="locale/en" onclick="changeLanguage('en')">
                        <img src="https://flagcdn.com/w40/us.png" alt="English" width="20" class="me-2">
                        Eng
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="locale/sw" onclick="changeLanguage('sw')">
                        <img src="https://flagcdn.com/w40/tz.png" alt="Swahili" width="20" class="me-2">
                        Swa
                    </a>
                </li>
            </ul>
        </div>

        <!-- Offcanvas Toggle -->
        <button class="fbs__net-navbar-toggler d-flex justify-content-center align-items-center ms-auto bg-transparent border-0 shadow-none"
            data-bs-toggle="offcanvas" data-bs-target="#fbs__net-navbars" aria-controls="fbs__net-navbars"
            aria-label="Toggle navigation" aria-expanded="false">
            <svg class="fbs__net-icon-menu" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <line x1="21" x2="3" y1="6" y2="6"></line>
                <line x1="15" x2="3" y1="12" y2="12"></line>
                <line x1="17" x2="3" y1="18" y2="18"></line>
            </svg>
            <svg class="fbs__net-icon-close d-none" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 6L6 18"></path>
                <path d="M6 6l12 12"></path>
            </svg>
        </button>
    </div>
</div>



    </div>
</header>


<script>
    // Function to get the current language from the URL
    function getLanguageFromUrl() {
        if (window.location.href.includes('/locale/sw')) {
            return 'sw';
        } else if (window.location.href.includes('/locale/en')) {
            return 'en';
        }
        return 'en'; // Default to English
    }

    function setLanguageFlag() {
        let lang = getLanguageFromUrl();
        let flagUrl = lang === 'sw' ? 'https://flagcdn.com/w40/tz.png' : 'https://flagcdn.com/w40/us.png';

        // Update both flags in navbar
        document.getElementById('selectedFlag').src = flagUrl;
        document.getElementById('selectedFlagLg').src = flagUrl;
    }

    // Run when the page loads to ensure correct flag is displayed
    document.addEventListener('DOMContentLoaded', setLanguageFlag);
</script>

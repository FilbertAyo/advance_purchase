
<div class="container-fluid bg-dark p-0" style="z-index: 10003;">
    <div class="row gx-0 d-none d-lg-flex">
        <div class="col-lg-7 px-5 text-start">
            <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                <small class="fa fa-map-marker-alt text-danger me-2"></small>
                <small class="text-white">Samora J.M Mall , Posta</small>
            </div>
            <div class="h-100 d-inline-flex align-items-center py-3">
                <small class="far fa-clock text-danger me-2"></small>
                <small class="text-white">Mon - Sat : 08.30 AM - 5.00 PM</small>
            </div>
        </div>
        <div class="col-lg-5 px-5 text-end">
            <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                <small class="fa fa-phone-alt text-danger me-2"></small>
                <small class="text-white">0743400900</small>
            </div>
            <div class="h-100 d-inline-flex align-items-center">
                <a class="btn btn-sm-square bg-danger text-white me-1" href="#"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-sm-square bg-danger text-white me-0" href="https://www.instagram.com/marscomtz?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg bg-white navbar-light  sticky-top p-0">
    <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <img src="{{ asset('front-end/img/shortblogo.png') }}" alt="" style="height: 50px;">
    </a>

    <!-- Language Switcher (Visible on Small Screens, Left of Toggle Button) -->
    <div class="d-flex d-lg-none">
        <div class="dropdown">
            <button class="btn btn-sm bg-transparent dropdown-toggle d-flex align-items-center" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <img id="selectedFlag" src="https://flagcdn.com/w40/us.png" alt="English" width="25" class="me-1">
            </button>
            <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="locale/en" onclick="changeLanguage('en')">
                        <img src="https://flagcdn.com/w40/us.png" alt="English" width="25" class="me-2"> Eng
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="locale/sw" onclick="changeLanguage('sw')">
                        <img src="https://flagcdn.com/w40/tz.png" alt="Swahili" width="25" class="me-2"> Swa
                    </a>
                </li>
            </ul>

        </div>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>



    <div class="collapse navbar-collapse mx-5" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{ url('/') }}" class="nav-item nav-link active">@lang('messages.home')</a>
            <a href="{{ url('/') }}#about" class="nav-item nav-link">@lang('messages.about')</a>
            <a href="{{ url('/') }}#contact" class="nav-item nav-link">@lang('messages.contact')</a>
            <a href="{{ url('/register') }}" class="nav-item nav-link">@lang('messages.application_form')</a>
        </div>

        @if (Route::has('login'))
            @auth
                <a href="{{ route('dashboard') }}" class="nav-item nav-link bg-primary text-white py-3 px-4">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="nav-item nav-link bg-primary text-white py-3 px-4">
                    <i class="fas fa-sign-in-alt me-2"></i>@lang('messages.login')
                </a>
            @endauth
        @endif

        <!-- Language Switcher (Visible on Large Screens, Right of Login Button) -->
        <div class="dropdown ms-3 d-none d-lg-flex">
            <button class="btn btn-sm bg-white dropdown-toggle d-flex align-items-center" type="button" id="languageDropdownLg" data-bs-toggle="dropdown" aria-expanded="false">
                <img id="selectedFlagLg" src="https://flagcdn.com/w40/us.png" alt="English" width="25" class="me-1">
            </button>
            <ul class="dropdown-menu" aria-labelledby="languageDropdownLg">
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="locale/en" onclick="changeLanguage('en')">
                        <img src="https://flagcdn.com/w40/us.png" alt="English" width="20" class="me-2"> Eng
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="locale/sw" onclick="changeLanguage('sw')">
                        <img src="https://flagcdn.com/w40/tz.png" alt="Swahili" width="20" class="me-2"> Swa
                    </a>
                </li>
            </ul>
        </div>

    </div>
</nav>

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

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Mars Communication - Advanced Payment</title>

    <link rel="shortcut icon" type="{{ asset('images/iconW.png') }}" href="{{ asset('images/iconW.png') }}">

    <link rel="stylesheet" href="{{ asset('css/simplebar.css') }}">
    <!-- Fonts CSS -->
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ asset('css/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('css/uppy.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.steps.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/quill.snow.css') }}">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{ asset('css/daterangepicker.css') }}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('css/app-light.css') }}" id="lightTheme">
    <link rel="stylesheet" href="{{ asset('css/app-dark.css') }}" id="darkTheme" disabled>
    
</head>

<body class="horizontal light">

    @if (Auth::user()->userType == 0)

        @if (Auth::user()->status == 'active')
            <div class="wrapper">

                <nav class="navbar navbar-expand-lg navbar-light bg-white flex-row border-bottom shadow">
                    <div class="container-fluid">
                        <a class="navbar-brand mx-lg-1 mr-0" href="{{ route('dashboard') }}">
                            <div class="w-100 d-flex">
                                <img src="{{ asset('images/marslogo.png') }}" class="navbar-brand-img" alt=""
                                    style="height: 40px">
                            </div>
                        </a>
                        <!-- Navbar Toggle Button -->
                        <button class="navbar-toggler mt-2 mr-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fe fe-menu navbar-toggler-icon"></i>
                        </button>

                        <!-- Navbar Content -->
                        <div class="collapse navbar-collapse navbar-slide bg-white ml-lg-4" id="navbarSupportedContent">
                            <!-- Close button for mobile -->
                            <a href="#" class="btn d-lg-none text-muted ml-2 mt-3" data-toggle="collapse" data-target="#navbarSupportedContent">
                                <i class="fe fe-x"></i>
                            </a>
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item {{ Request::is('products.list') ? 'active' : '' }}">
                                    <a href="{{ route('products.list') }}" class="nav-link">
                                        <span class="ml-lg-2">Products</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ Request::is('my.dashboard') ? 'active' : '' }}">
                                    <a href="{{ route('my.dashboard') }}" class="nav-link">
                                        <span class="ml-lg-2">Dashboard</span>
                                    </a>
                                </li>


                            </ul>
                        </div>

                        <ul class="navbar-nav d-flex flex-row">
                            <li class="nav-item">
                                <a class="nav-link text-muted" href="#" data-toggle="modal" data-target=".modal-shortcut">
                                    <span class="avatar avatar-sm">
                                        <img src="{{ asset(Auth::user()->profile->profile_image ?? 'images/photo.jpeg') }}"
                                            alt="User" style="width: 50px; height: 50px; object-fit: cover;"
                                            class="avatar-img rounded-circle">
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>


                <div class="modal fade modal-shortcut modal-slide" tabindex="-1" role="dialog"
                    aria-labelledby="defaultModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="defaultModalLabel">{{ Auth::user()->first_name }}
                                    {{ Auth::user()->last_name }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body px-5">
                                <div class="row align-items-center">
                                    <div class="col-12 text-center">
                                        <img src="{{ asset(Auth::user()->profile->profile_image ?? 'images/photo.jpeg') }}"
                                            style="width: 150px; height: 150px; object-fit: cover;" alt="User"
                                            class="avatar-img rounded-circle">

                                        <div class=" mt-3">
                                            <h3>ID: <span id="userId">{{ Auth::user()->userId }}</span></h3>
                                            <div id="copyFeedback" class="text-success fw-bold text-sm"
                                                style="display: none;">Copied!</div>
                                            <button id="copyButton" class="btn btn-outline-secondary btn-sm">
                                                <i class="bi bi-clipboard me-1"></i> Copy
                                            </button>
                                        </div>

                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-6 text-center">
                                        <a href="{{ route('profile.edit') }}"
                                            class="squircle bg-primary justify-content-center">
                                            <i class="fe fe-user fe-32 align-self-center text-white"></i>
                                        </a>
                                        <p>Profile</p>
                                    </div>

                                    <div class="col-6 text-center">
                                        <a href="javascript:void(0);"
                                            class="squircle bg-primary justify-content-center" data-toggle="modal"
                                            data-target="#uploadModal">
                                            <i class="fe fe-upload-cloud fe-32 align-self-center text-white"></i>
                                        </a>
                                        <p>Upload</p>
                                    </div>

                                    <!-- Upload Modal -->
                                    <div id="uploadModal" class="modal fade" tabindex="-1" role="dialog"
                                        aria-labelledby="uploadModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="uploadModalLabel">Upload Profile Image
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('prof.update') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="file" name="profile_image"
                                                            class="form-control mb-3" required>
                                                        <button type="submit"
                                                            class="btn btn-primary w-100">Upload</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <a class="btn btn-danger btn-block" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <main role="main" class="main-content">

                    @include('elements.spinner')

                    @yield('content')

                </main>

            </div>
        @else
            @include('elements.spinner')
            <div class="wrapper vh-100">
                <div class="align-items-center h-100 d-flex w-50 mx-auto">
                    <div class="mx-auto text-center">
                        <h1 class="display-1 m-0 font-weight-bolder text-muted mb-3">
                            <div class="spinner-grow mr-3" style="width: 3rem; height: 3rem;" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </h1>
                        <h1 class="mb-1 text-muted ">Setup is on progress...</h1>
                        <h6 class="mb-3 text-muted">Congratulations {{ Auth::user()->first_name }}
                            {{ Auth::user()->last_name }} on completing your registration! Please wait while your
                            account
                            is being verified.</h6>
                        <a href="javascript:void(0);" class="btn btn-lg btn-primary px-5"
                            onclick="location.reload();">Refresh</a>

                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="wrapper vh-100">
            <div class="align-items-center h-100 d-flex w-50 mx-auto">
                <div class="mx-auto text-center">
                    <h2 class="mb-1 font-weight-bold text-danger">Permission Denied!</h2>
                    <h4 class="mb-3 text-muted">You don't have permission to access this page.</h4>
                    <a href="{{ url()->previous() }}" class="btn btn-lg btn-dark px-5">Go Back</a>
                </div>
            </div>
        </div>

    @endif


    <script>
        document.getElementById('copyButton').addEventListener('click', function() {
            // Select the userId text
            const userId = document.getElementById('userId').textContent;

            // Copy to clipboard
            navigator.clipboard.writeText(userId).then(() => {
                // Show "Copied!" feedback
                const feedback = document.getElementById('copyFeedback');
                feedback.style.display = 'block';

                // Hide the feedback after 2 seconds
                setTimeout(() => {
                    feedback.style.display = 'none';
                }, 2000);
            }).catch(err => {
                console.error('Failed to copy text: ', err);
            });
        });
    </script>


    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/simplebar.min.js') }}"></script>
    <script src='{{ asset('js/daterangepicker.js') }}'></script>
    <script src='{{ asset('js/jquery.stickOnScroll.js') }}'></script>
    <script src="{{ asset('js/tinycolor-min.js') }}"></script>
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('js/d3.min.js') }}"></script>
    <script src="{{ asset('js/topojson.min.js') }}"></script>
    <script src="{{ asset('js/datamaps.all.min.js') }}"></script>
    <script src="{{ asset('js/datamaps-zoomto.js') }}"></script>
    <script src="{{ asset('js/datamaps.custom.js') }}"></script>
    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script>
        /* defind global options */
        Chart.defaults.global.defaultFontFamily = base.defaultFontFamily;
        Chart.defaults.global.defaultFontColor = colors.mutedColor;
    </script>
    <script src="{{ asset('js/gauge.min.js') }}"></script>
    <script src="{{ asset('js/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('js/apexcharts.custom.js') }}"></script>
    <script src='{{ asset('js/jquery.mask.min.js') }}'></script>
    <script src='{{ asset('js/select2.min.js') }}'></script>
    <script src='{{ asset('js/jquery.steps.min.js') }}'></script>
    <script src='{{ asset('js/jquery.validate.min.js') }}'></script>
    <script src='{{ asset('js/jquery.timepicker.js') }}'></script>
    <script src='{{ asset('js/dropzone.min.js') }}'></script>
    <script src='{{ asset('js/uppy.min.js') }}'></script>
    <script src='{{ asset('js/quill.min.js') }}'></script>

    <script src="{{ asset('js/app.js') }}"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>

</body>

</html>

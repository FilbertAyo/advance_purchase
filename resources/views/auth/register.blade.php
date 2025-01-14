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
</head>

<body>


    <!-- Topbar Start -->
    <div class="container-fluid bg-light p-0">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fa fa-map-marker-alt text-primary me-2"></small>
                    <small>Samora J.M Mall , Posta</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center py-3">
                    <small class="far fa-clock text-primary me-2"></small>
                    <small>Mon - Fri : 09.00 AM - 09.00 PM</small>
                </div>
            </div>
            <div class="col-lg-5 px-5 text-end">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fa fa-phone-alt text-primary me-2"></small>
                    <small>0748569702</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center">
                    <a class="btn btn-sm-square bg-white text-primary me-1" href=""><i
                            class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-sm-square bg-white text-primary me-1" href=""><i
                            class="fab fa-twitter"></i></a>
                    <a class="btn btn-sm-square bg-white text-primary me-1" href=""><i
                            class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-sm-square bg-white text-primary me-0" href=""><i
                            class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <img src="front-end/img/shortblogo.png" alt="" style="height: 60px;">
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ url('/') }}" class="nav-item nav-link active">Home</a>
                <a href="{{ url('/') }}#about" class="nav-item nav-link">About</a>
                <a href="{{ url('/') }}#contact" class="nav-item nav-link">Contact</a>
                <a href="{{ url('/register') }}" class="nav-item nav-link">Application Form</a>
            </div>
            @if (Route::has('login'))

                @auth

                    <a href="{{ url('/dashboard') }}" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Log in</a>
                    @if (Route::has('register'))
                    @endif
                @endauth

            @endif

        </div>
    </nav>

    <!-- Navbar End -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(front-end/img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Application Form</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Application Form</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @include('elements.spinner')
                <div class="bg-primary d-flex flex-column justify-content-center text-center p-5 wow">
                    <h1 class="text-white mb-4">Enter your details</h1>

                    <form method="POST" action="{{ url('/registration_form') }}">
                        @csrf

                        <div class="row g-3">
                            <!-- First Name -->
                            <div class="col-12 col-sm-6">
                                <input type="text" name="first_name" class="form-control border-0"
                                    placeholder="First Name" value="{{ old('first_name') }}" style="height: 55px;"
                                    required>
                            </div>
                            <!-- Last Name -->
                            <div class="col-12 col-sm-6">
                                <input type="text" name="last_name" class="form-control border-0"
                                    placeholder="Last Name" value="{{ old('last_name') }}" style="height: 55px;"
                                    required>
                            </div>
                            <!-- Phone -->
                            <div class="col-12 col-sm-6">
                                <input type="tel" name="phone" class="form-control border-0"
                                    placeholder="Phone Number" value="{{ old('phone') }}" style="height: 55px;"
                                    required>
                            </div>
                            <!-- User Type -->
                            <div class="col-12 col-sm-6">
                                <input type="email" name="email" class="form-control border-0"
                                    placeholder="Email" value="{{ old('email') }}" style="height: 55px;" required>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />

                            </div>
                            <!-- NIDA -->
                            <div class="col-12 col-sm-6">
                                <input type="text" name="nida" class="form-control border-0"
                                    placeholder="NIDA Number" value="{{ old('nida') }}" style="height: 55px;"
                                    required>
                            </div>
                            <!-- Level -->
                            {{-- <div class="col-12 col-sm-6">
                                    <input type="text" name="level" class="form-control border-0" placeholder="Level" style="height: 55px;">
                                </div> --}}
                            <!-- Guarantor -->
                            {{-- <div class="col-12 col-sm-6">
                                    <input type="text" name="gurantor" class="form-control border-0" placeholder="Guarantor" style="height: 55px;">
                                </div> --}}
                            <!-- Ward -->
                            <div class="col-12 col-sm-6">
                                <input type="text" name="ward" class="form-control border-0"
                                    value="{{ old('ward') }}" placeholder="Ward" style="height: 55px;">
                            </div>
                            <!-- District -->
                            <div class="col-12 col-sm-6">
                                <input type="text" name="district" class="form-control border-0"
                                    value="{{ old('district') }}" placeholder="District" style="height: 55px;">
                            </div>
                            <!-- Street -->
                            <div class="col-12 col-sm-6">
                                <input type="text" name="street" class="form-control border-0"
                                    value="{{ old('street') }}" placeholder="Street" style="height: 55px;">
                            </div>
                            <!-- City -->
                            <div class="col-12 col-sm-6">
                                <input type="text" name="city" class="form-control border-0"
                                    value="{{ old('city') }}" placeholder="City" style="height: 55px;">
                            </div>
                            <!-- Gender -->
                            <div class="col-12 col-sm-6">
                                <select name="gender" class="form-select border-0" value="{{ old('gender') }}"
                                    style="height: 55px;" required>
                                    <option selected>Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <!-- Occupation -->
                            <div class="col-12 col-sm-6">
                                <input type="text" name="occupation" class="form-control border-0"
                                    value="{{ old('occupation') }}" placeholder="Occupation" style="height: 55px;">
                            </div>
                            <!-- Email -->
                            {{-- <div class="col-12">
                                    <select name="userType" class="form-select border-0" style="height: 55px;" required>
                                        <option selected>Select User Type</option>
                                        <option value="individual">Individual</option>
                                        <option value="business">Business</option>
                                    </select>
                                </div> --}}
                            <!-- Submit Button -->

                            <div class="col-12 col-sm-6 position-relative">
                                <input type="password" id="password" name="password" class="form-control border-0"
                                    value="{{ old('password') }}" placeholder="Password" style="height: 55px;">
                                <span class="position-absolute top-50 end-0 translate-middle-y pe-3"
                                    style="cursor: pointer;"
                                    onclick="togglePasswordVisibility('password', 'password-toggle')">
                                    <i id="password-toggle" class="fa fa-eye"></i>
                                </span>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <div class="col-12 col-sm-6 position-relative">
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="form-control border-0" placeholder="Repeat Your password"
                                    style="height: 55px;">
                                <span class="position-absolute top-50 end-0 translate-middle-y pe-3"
                                    style="cursor: pointer;"
                                    onclick="togglePasswordVisibility('password_confirmation', 'password-confirmation-toggle')">
                                    <i id="password-confirmation-toggle" class="fa fa-eye"></i>
                                </span>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>



                            <div class="form-row" style="display: none;">
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="userType" value="0"
                                        required>
                                    <input type="text" class="form-control" name="status" value="inactive"
                                        required>
                                </div>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-secondary bg-danger w-100 py-3" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Booking End -->


    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Address</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Samora J.M Mall , Posta</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>0748569702</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Opening Hours</h4>
                    <h6 class="text-light">Monday - Friday:</h6>
                    <p class="mb-4">09.00 AM - 09.00 PM</p>
                    <h6 class="text-light">Saturday - Sunday:</h6>
                    <p class="mb-0">09.00 AM - 12.00 PM</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Services</h4>
                    <a class="btn btn-link" href="">Advance Payment</a>
                    <a class="btn btn-link" href="">Free Delivery</a>
                    <a class="btn btn-link" href="">Warranty</a>
                    <a class="btn btn-link" href="">Service Center</a>
                    <a class="btn btn-link" href="">Support</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Newsletter</h4>
                    <p>Enter your email to get updates</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text"
                            placeholder="Your email">
                        <button type="button"
                            class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">Mars Communication Ltd</a>, All Right Reserved.


                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="">Home</a>
                            <a href="">Cookies</a>
                            <a href="">Help</a>
                            <a href="">FQAs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <script>
        function togglePasswordVisibility(inputId, toggleIconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(toggleIconId);

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>


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

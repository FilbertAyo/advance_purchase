<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Mars Communication - Samsung TV Guard</title>

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
    <link rel="stylesheet" href ="{{ asset('css/jquery.steps.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/quill.snow.css') }}">
    <!-- Date Range Picker CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('css/daterangepicker.css') }}"> --}}
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('css/app-light.css') }}" id="lightTheme">
    <link rel="stylesheet" href="{{ asset('css/app-dark.css') }}" id="darkTheme" disabled>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="vertical light">

    @if (in_array(Auth::user()->userType, [1, 2, 3, 4]))

        <div class="wrapper">
            @include('layouts.navigation')
            {{-- @include('elements.toast') --}}
            @include('layouts.aside')


            @if (Auth::user()->status == 'active')
                <main role="main" class="main-content">
                    {{ $slot }}
                </main> <!-- main -->
            @else
                @include('errors.deactivated')
            @endif
        </div>
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


    {{-- main js  --}}
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    {{-- <script src="{{ asset('js/simplebar.min.js') }}"></script>
    <script src='{{ asset('js/daterangepicker.js') }}'></script> --}}
    <script src='{{ asset('js/jquery.stickOnScroll.js') }}'></script>
    <script src="{{ asset('js/tinycolor-min.js') }}"></script>
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('js/d3.min.js') }}"></script>
    <script src="{{ asset('js/topojson.min.js') }}"></script>
    <script src="{{ asset('js/datamaps.all.min.js') }}"></script>
    <script src="{{ asset('js/datamaps-zoomto.js') }}"></script>
    <script src="{{ asset('js/datamaps.custom.js') }}"></script>
    {{-- <script src="{{ asset('js/Chart.min.js') }}"></script> --}}
    {{-- <script>
        /* defind global options */
        Chart.defaults.global.defaultFontFamily = base.defaultFontFamily;
        Chart.defaults.global.defaultFontColor = colors.mutedColor;
    </script> --}}
    <script src="{{ asset('js/gauge.min.js') }}"></script>
    <script src="{{ asset('js/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('js/apexcharts.custom.js') }}"></script>
    <script src='{{ asset('js/jquery.mask.min.js') }}'></script>
    <script src='{{ asset('js/select2.min.js') }}'></script>
    <script src='{{ asset('js/jquery.steps.min.js') }}'></script>
    <script src='{{ asset('js/jquery.validate.min.js') }}'></script>
    {{-- <script src='{{ asset('js/jquery.timepicker.js') }}'></script> --}}
    <script src='{{ asset('js/dropzone.min.js') }}'></script>
    <script src='{{ asset('js/uppy.min.js') }}'></script>
    <script src='{{ asset('js/quill.min.js') }}'></script>

    {{-- <script src='{{ asset('js/jquery.dataTables.min.js') }}'></script>
    <script src='{{ asset('js/dataTables.bootstrap4.min.js') }}'></script> --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>

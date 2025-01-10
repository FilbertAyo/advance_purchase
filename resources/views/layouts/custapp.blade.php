<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Mars Communication -  Advanced Payment</title>

    <link rel="shortcut icon" type="image/x-icon" href="images/iconW.png">

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

    @if(Auth::user()->status == 'active')
    <div class="wrapper">

        <nav class="navbar navbar-expand-lg navbar-light bg-white flex-row border-bottom shadow">
            <div class="container-fluid">
                <a class="navbar-brand mx-lg-1 mr-0" href="./index.html">
                    <div class="w-100 d-flex">
                        <img src="{{ asset('images/marslogo.png') }}" class="navbar-brand-img" alt=""
                                style="height: 40px">
                    </div>
                  </a>
              <button class="navbar-toggler mt-2 mr-auto toggle-sidebar text-muted">
                <i class="fe fe-menu navbar-toggler-icon"></i>
              </button>
              <div class="navbar-slide bg-white ml-lg-4" id="navbarSupportedContent">
                <a href="#" class="btn toggle-sidebar d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
                  <i class="fe fe-x"><span class="sr-only"></span></i>
                </a>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a href="{{ url('/dashboard') }}" class="dropdown-toggle nav-link">
                          <span class="ml-lg-2">Dashboard</span><span class="sr-only">(current)</span>
                        </a>
                      </li>
                      <li class="nav-item dropdown">
                        <a href="#" id="ui-elementsDropdown" class="dropdown-toggle nav-link" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="ml-lg-2">Products</span>
                            <span class="badge badge-pill badge-primary">New</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="ui-elementsDropdown">
                            <a class="nav-link pl-lg-2" href="{{ url('/product?category=Television') }}"><span class="ml-1">Television</span></a>
                            <a class="nav-link pl-lg-2" href="{{ url('/product?category=Air Conditioner') }}"><span class="ml-1">Air Conditioner</span></a>
                            <a class="nav-link pl-lg-2" href="{{ url('/product?category=Fridges') }}"><span class="ml-1">Fridges</span></a>
                            <a class="nav-link pl-lg-2" href="{{ url('/product?category=Chest freezer') }}"><span class="ml-1">Chest freezer</span></a>
                            <a class="nav-link pl-lg-2" href="{{ url('/product?category=Sound Bar') }}"><span class="ml-1">Sound Bar</span></a>
                            <a class="nav-link pl-lg-2" href="{{ url('/product?category=Small Home Appliances') }}"><span class="ml-1">Small Home Appliances</span></a>
                            <a class="nav-link pl-lg-2" href="{{ url('/product?category=Washing Machine') }}"><span class="ml-1">Washing Machine</span></a>
                            <a class="nav-link pl-lg-2" href="{{ url('/product?category=Cookers') }}"><span class="ml-1">Cookers</span></a>
                        </div>
                    </li>
                    </ul>
                  </li>
                </ul>
              </div>
              <form class="form-inline ml-md-auto d-none d-lg-flex ">
                <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="hidden" >
              </form>
              <ul class="navbar-nav d-flex flex-row">
                  <li class="nav-item dropdown">
                      <a class="nav-link text-muted" href="#" id="navbarDropdown" role="button" data-toggle="modal" data-target=".modal-shortcut">
                          <span class="avatar avatar-sm">
                              <img src="{{ asset('images/photo.jpeg') }}" alt="User" class="avatar-img rounded-circle">
                          </span>
                      </a>

                  </li>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>



      <div class="modal fade modal-shortcut modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="defaultModalLabel">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body px-5">
                <div class="row align-items-center">
                    <div class="col-12 text-center">
                     <img src="{{ asset('images/photo.jpeg') }}" style="height: 150px;" alt="User" class="avatar-img rounded-circle">
                      </div>
                  </div>
              <div class="row align-items-center">
                <div class="col-6 text-center">
                    <a href="{{ route('profile.edit') }}" class="squircle bg-primary justify-content-center">
                      <i class="fe fe-user fe-32 align-self-center text-white"></i>
                    </a>
                    <p>Profile</p>
                  </div>

                <div class="col-6 text-center">
                  <div class="squircle bg-primary justify-content-center">
                    <i class="fe fe-activity fe-32 align-self-center text-white"></i>
                  </div>
                  <p>History</p>
                </div>
              </div>
              <div class="row align-items-center">
                <div class="col-6 text-center">
                    <div class="squircle bg-primary justify-content-center">
                      <i class="fe fe-upload-cloud fe-32 align-self-center text-white"></i>
                    </div>
                    <p>Upload</p>
                  </div>
                <div class="col-6 text-center">
                    <div class="squircle bg-primary justify-content-center">
                      <i class="fe fe-settings fe-32 align-self-center text-white"></i>
                    </div>
                    <p>Settings</p>
                  </div>

              </div>

              <div class="row align-items-center">

                <a class="btn btn-danger btn-block" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                 Logout
             </a>
             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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

      </main> <!-- main -->

    </div> <!-- .wrapper -->

    @else
    @include('elements.spinner')
    <div class="wrapper vh-100">
        <div class="align-items-center h-100 d-flex w-50 mx-auto">
          <div class="mx-auto text-center">
            <h1 class="display-1 m-0 font-weight-bolder text-muted mb-3"> <div class="spinner-grow mr-3" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
              </div></h1>
            <h1 class="mb-1 text-muted ">Setup is on progress...</h1>
            <h6 class="mb-3 text-muted">Congratulations {{ Auth::user()->first_name }}  {{ Auth::user()->last_name }} on completing your registration! Please wait while your account is being verified.</h6>
            <a href="javascript:void(0);" class="btn btn-lg btn-primary px-5" onclick="location.reload();">Refresh</a>

          </div>
        </div>
      </div>
    @endif


    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/simplebar.min.js"></script>
    <script src='js/daterangepicker.js'></script>
    <script src='js/jquery.stickOnScroll.js'></script>
    <script src="js/tinycolor-min.js"></script>
    <script src="js/config.js"></script>
    <script src="js/d3.min.js"></script>
    <script src="js/topojson.min.js"></script>
    <script src="js/datamaps.all.min.js"></script>
    <script src="js/datamaps-zoomto.js"></script>
    <script src="js/datamaps.custom.js"></script>
    <script src="js/Chart.min.js"></script>
    <script>
      /* defind global options */
      Chart.defaults.global.defaultFontFamily = base.defaultFontFamily;
      Chart.defaults.global.defaultFontColor = colors.mutedColor;
    </script>
    <script src="js/gauge.min.js"></script>
    <script src="js/jquery.sparkline.min.js"></script>
    <script src="js/apexcharts.min.js"></script>
    <script src="js/apexcharts.custom.js"></script>
    <script src='js/jquery.mask.min.js'></script>
    <script src='js/select2.min.js'></script>
    <script src='js/jquery.steps.min.js'></script>
    <script src='js/jquery.validate.min.js'></script>
    <script src='js/jquery.timepicker.js'></script>
    <script src='js/dropzone.min.js'></script>
    <script src='js/uppy.min.js'></script>
    <script src='js/quill.min.js'></script>
    <script>
      $('.select2').select2(
      {
        theme: 'bootstrap4',
      });
      $('.select2-multi').select2(
      {
        multiple: true,
        theme: 'bootstrap4',
      });
      $('.drgpicker').daterangepicker(
      {
        singleDatePicker: true,
        timePicker: false,
        showDropdowns: true,
        locale:
        {
          format: 'MM/DD/YYYY'
        }
      });
      $('.time-input').timepicker(
      {
        'scrollDefault': 'now',
        'zindex': '9999' /* fix modal open */
      });
      /** date range picker */
      if ($('.datetimes').length)
      {
        $('.datetimes').daterangepicker(
        {
          timePicker: true,
          startDate: moment().startOf('hour'),
          endDate: moment().startOf('hour').add(32, 'hour'),
          locale:
          {
            format: 'M/DD hh:mm A'
          }
        });
      }
      var start = moment().subtract(29, 'days');
      var end = moment();

      function cb(start, end)
      {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
      }
      $('#reportrange').daterangepicker(
      {
        startDate: start,
        endDate: end,
        ranges:
        {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
      }, cb);
      cb(start, end);
      $('.input-placeholder').mask("00/00/0000",
      {
        placeholder: "__/__/____"
      });
      $('.input-zip').mask('00000-000',
      {
        placeholder: "____-___"
      });
      $('.input-money').mask("#.##0,00",
      {
        reverse: true
      });
      $('.input-phoneus').mask('(000) 000-0000');
      $('.input-mixed').mask('AAA 000-S0S');
      $('.input-ip').mask('0ZZ.0ZZ.0ZZ.0ZZ',
      {
        translation:
        {
          'Z':
          {
            pattern: /[0-9]/,
            optional: true
          }
        },
        placeholder: "___.___.___.___"
      });
      // editor
      var editor = document.getElementById('editor');
      if (editor)
      {
        var toolbarOptions = [
          [
          {
            'font': []
          }],
          [
          {
            'header': [1, 2, 3, 4, 5, 6, false]
          }],
          ['bold', 'italic', 'underline', 'strike'],
          ['blockquote', 'code-block'],
          [
          {
            'header': 1
          },
          {
            'header': 2
          }],
          [
          {
            'list': 'ordered'
          },
          {
            'list': 'bullet'
          }],
          [
          {
            'script': 'sub'
          },
          {
            'script': 'super'
          }],
          [
          {
            'indent': '-1'
          },
          {
            'indent': '+1'
          }], // outdent/indent
          [
          {
            'direction': 'rtl'
          }], // text direction
          [
          {
            'color': []
          },
          {
            'background': []
          }], // dropdown with defaults from theme
          [
          {
            'align': []
          }],
          ['clean'] // remove formatting button
        ];
        var quill = new Quill(editor,
        {
          modules:
          {
            toolbar: toolbarOptions
          },
          theme: 'snow'
        });
      }
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function()
      {
        'use strict';
        window.addEventListener('load', function()
        {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');
          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form)
          {
            form.addEventListener('submit', function(event)
            {
              if (form.checkValidity() === false)
              {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
    <script>
      var uptarg = document.getElementById('drag-drop-area');
      if (uptarg)
      {
        var uppy = Uppy.Core().use(Uppy.Dashboard,
        {
          inline: true,
          target: uptarg,
          proudlyDisplayPoweredByUppy: false,
          theme: 'dark',
          width: 770,
          height: 210,
          plugins: ['Webcam']
        }).use(Uppy.Tus,
        {
          endpoint: 'https://master.tus.io/files/'
        });
        uppy.on('complete', (result) =>
        {
          console.log('Upload complete! We’ve uploaded these files:', result.successful)
        });
      }
    </script>
    <script src="js/apps.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag()
      {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      gtag('config', 'UA-56159088-1');
    </script>
  </body>
</html>

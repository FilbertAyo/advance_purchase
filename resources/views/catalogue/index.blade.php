<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Mars - Catalogue</title>
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

<body
    style="background-image: url(images/download.jpeg); background-attachment: fixed; background-size: cover; background-repeat: no-repeat; background-position: center;">

    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(images/marslg.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 ">Catalogue</h1>
                <div class="container mb-4 bg-light p-3 rounded shadow-sm">

                    <form method="GET" action="{{ url('/catalogue') }}">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6">
                                <input type="text" name="query" class="form-control" placeholder="Search Products..."
                                    value="{{ request('query') }}">
                            </div>
                            <div class="col-md-4">
                                <select name="category" class="form-select">
                                    <option value="">All Products</option>
                                    <option value="Television"
                                        {{ request('category') == 'Television' ? 'selected' : '' }}>Television</option>
                                    <option value="Air Conditioner"
                                        {{ request('category') == 'Air Conditioner' ? 'selected' : '' }}>Air Conditioner
                                    </option>
                                    <option value="Fridge" {{ request('category') == 'Fridge' ? 'selected' : '' }}>
                                        Fridge</option>
                                    <option value="Chest Freezer"
                                        {{ request('category') == 'Chest Freezer' ? 'selected' : '' }}>Chest Freezer
                                    </option>
                                    <option value="Sound Bar"
                                        {{ request('category') == 'Sound Bar' ? 'selected' : '' }}>Sound Bar</option>
                                    <option value="Small Home Appliances"
                                        {{ request('category') == 'Small Home Appliances' ? 'selected' : '' }}>Small
                                        Home Appliances</option>
                                    <option value="Washing Machine"
                                        {{ request('category') == 'Washing Machine' ? 'selected' : '' }}>Washing Machine
                                    </option>
                                    <option value="Cooker" {{ request('category') == 'Cooker' ? 'selected' : '' }}>
                                        Cooker</option>
                                    <option value="W/Dispenser"
                                        {{ request('category') == 'W/Dispenser' ? 'selected' : '' }}>W/Dispenser
                                    </option>
                                    <option value="V/Cleaner"
                                        {{ request('category') == 'V/Cleaner' ? 'selected' : '' }}>V/Cleaner</option>
                                </select>

                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-danger w-100">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/catalogue') }}" class="text-danger">Category</a>
                        </li>
                        <li class="breadcrumb-item text-white active" aria-current="page">
                            {{ request('category') ?? 'All Products' }}
                        </li>
                    </ol>
                </nav>

            </div>
        </div>
    </div>




    @include('elements.spinner')

    <div class="container my-4">
        <div class="row">

           @foreach ($products as $product)
    <div id="product-{{ $product->id }}" class="bg-white col-lg-12 p-5 rounded shadow-sm mb-3">
        <div class="mb-3 text-center">

            @if ($product->brand == 'HISENSE')
                <img src="images/hisense.png" alt="Product Image" class="img-fluid rounded mb-3"
                    style="height: 50px;">
            @elseif ($product->brand == 'SAMSUNG')
                <img src="images/samsung.png" alt="Product Image" class="img-fluid rounded mb-3"
                    style="height: 50px;">
            @elseif ($product->brand == 'LG')
                <img src="images/lg.png" alt="Product Image" class="img-fluid rounded mb-3"
                    style="height: 50px;">
            @elseif ($product->brand == 'TOSHIBA')
                <img src="images/toshiba.png" alt="Product Image" class="img-fluid rounded mb-3"
                    style="height: 50px;">
            @endif

            <h4 class="text-muted">Model: {{ $product->code }}</h4>
            <h3>Price: <strong class="text-success">{{ number_format($product->credit_price) }}/=</strong></h3>
        </div>

        <div class="row align-items-center mb-3">
            <div class="col-md-6 text-center">
                @if ($product->productImages)
                    <img src="{{ asset(optional($product->productImages->first())->image_url ?? 'images/no-image.jpg') }}"
                        alt="Product Image" class="card-img-top img-fluid rounded py-1"
                        style="height: 500px; width: 100%; object-fit: contain;">
                @endif
            </div>
            <div class="col-md-6">
                <h4 class="mb-3 text-danger">Specifications:</h4>
                <p>{!! nl2br(e($product->description)) !!}</p>
            </div>
        </div>

      <div class="d-flex justify-content-between align-items-center mb-2">
    <h5 class="text-muted mb-0">{{ $product->category }}</h5>
    <a href="#" class="text-decoration-none fs-4 text-muted" data-bs-toggle="modal" data-bs-target="#shareModal"
       onclick="setShareLink('{{ url()->current() }}#product-{{ $product->id }}')">
        <i class="bi bi-share"></i>
    </a>
</div>



    </div>
@endforeach


        </div>
    </div>

    <!-- Share Link Modal -->
<div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="shareModalLabel">Share Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="text" id="shareLink" class="form-control" readonly>
        <button class="btn btn-primary mt-2" onclick="copyToClipboard()">Copy Link</button>
        <p id="copyMessage" class="text-success mt-2" style="display: none;">Link copied!</p>
      </div>
    </div>
  </div>
</div>


<script>
    function setShareLink(link) {
        document.getElementById("shareLink").value = link;
        document.getElementById("copyMessage").style.display = "none";
    }

    function copyToClipboard() {
        const copyText = document.getElementById("shareLink");
        copyText.select();
        copyText.setSelectionRange(0, 99999); // for mobile
        document.execCommand("copy");

        document.getElementById("copyMessage").style.display = "block";
    }
</script>



    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

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
    <script src="front-end/js/main.js"></script>
</body>

</html>

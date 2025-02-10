@extends('layouts.custapp')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">

                <div class="mx-auto text-center justify-content-center">
                    <h2 class="page-title mb-0">What do you want?</h2>
                    <p class="help-text text-muted">Search for a product and start to pay in installment.</p>
                    <form class="searchform searchform-lg" action="{{ route('products.search') }}" method="GET">
                        <input class="form-control form-control-lg bg-white rounded-pill pl-5"
                               type="search"
                               name="query"
                               placeholder="Search"
                               aria-label="Search"
                               value="{{ request('query') }}">
                    </form>

                </div>

                <div class="row align-items-center my-3">
                    <div class="col">
                        <h2 class="page-title">
                            @if (request('category'))
                                {{ request('category') }}
                            @else
                                All Products
                            @endif
                        </h2>
                    </div>

                    <li class="nav-item dropdown col-auto d-flex">
                        <a href="#" id="ui-elementsDropdown" class="nav-link btn-sm btn-danger" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="fe fe-filter fe-16"></span>
                        </a>
                        <button type="button" class="btn btn-sm ml-2" onclick="reloadPage()">
                            <i class="fe fe-16 fe-refresh-ccw text-muted"></i>
                        </button>

                        <div class="dropdown-menu mr-5" aria-labelledby="ui-elementsDropdown">
                            <a class="nav-link pl-lg-2" href="{{ url('/product?category=Television') }}"><span
                                    class="ml-1">Television</span></a>
                            <a class="nav-link pl-lg-2" href="{{ url('/product?category=Air Conditioner') }}"><span
                                    class="ml-1">Air Conditioner</span></a>
                            <a class="nav-link pl-lg-2" href="{{ url('/product?category=Fridges') }}"><span
                                    class="ml-1">Fridges</span></a>
                            <a class="nav-link pl-lg-2" href="{{ url('/product?category=Chest freezer') }}"><span
                                    class="ml-1">Chest freezer</span></a>
                            <a class="nav-link pl-lg-2" href="{{ url('/product?category=Sound Bar') }}"><span
                                    class="ml-1">Sound Bar</span></a>
                            <a class="nav-link pl-lg-2" href="{{ url('/product?category=Small Home Appliances') }}"><span
                                    class="ml-1">Small Home Appliances</span></a>
                            <a class="nav-link pl-lg-2" href="{{ url('/product?category=Washing Machine') }}"><span
                                    class="ml-1">Washing Machine</span></a>
                            <a class="nav-link pl-lg-2" href="{{ url('/product?category=Cookers') }}"><span
                                    class="ml-1">Cookers</span></a>
                        </div>

                </div>
                <h6 class="mb-3">List of Products</h6>

                <div class="row mb-4">

                    @if ($products->isEmpty())
                    <div class="col-12">
                        <p class="text-center text-danger mt-5">No products found.</p>
                    </div>

                    @else
                        @foreach ($products as $product)
                            <div class="col-6 col-md-4 col-lg-2 mb-3">
                                <div class="card border-1 h-100 d-flex flex-column bg-light">
                                    @if ($product->productImages)
                                  <img src="{{ asset(optional($product->productImages->first())->image_url ?? 'images/no-image.jpg') }}"
                                        alt="Product Image" class="card-img-top img-fluid rounded py-1"
                                        style="height: 180px; width: 100%; object-fit: contain; ">
                                @endif

                                    <div class="d-flex flex-column justify-content-between p-2 mt-1">
                                        <h5 class="card-title text-muted text-truncate text-sm">{{ $product->item_name }}
                                        </h5>
                                        <h6 class="text-secondary text-xs">Model: {{ $product->code }} ,
                                            {{ $product->brand }}</h6>

                                        <div class="mt-auto d-flex justify-content-between align-items-center">
                                            <h6 class="fw-bold text-sm">TZS {{ number_format($product->sales) }}/=</h6>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#buyModal-{{ $product->id }}">
                                                Buy
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="buyModal-{{ $product->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="buyModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="buyModalLabel">Confirm Your Purchase</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <!-- Small images for carousel -->
                                                    <div id="carouselExampleControls-{{ $product->id }}"
                                                        class="carousel slide" data-ride="carousel">
                                                        <div class="carousel-inner">
                                                            @foreach ($product->productImages as $index => $image)
                                                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                                    <img src="{{ asset($image->image_url) }} " alt="..."
                                                                        class="d-block w-100 img-thumbnail"
                                                                        style="cursor: pointer;"
                                                                        onclick="changeImage('{{ asset($image->image_url) }}', {{ $product->id }})">
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <a class="carousel-control-prev"
                                                            href="#carouselExampleControls-{{ $product->id }}" role="button"
                                                            data-slide="prev">
                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                        <a class="carousel-control-next"
                                                            href="#carouselExampleControls-{{ $product->id }}"
                                                            role="button" data-slide="next">
                                                            <span class="carousel-control-next-icon"
                                                                aria-hidden="true"></span>
                                                            <span class="sr-only">Next</span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 mt-3">
                                                    <!-- Product details section -->
                                                    <h4>{{ $product->item_name }}</h4>
                                                    <p>Model: {{ $product->code }}</p>
                                                    <p>Brand: {{ $product->brand }}</p>
                                                    <p><strong>Price: </strong> TZS {{ number_format($product->sales) }}/=</p>
                                                    <p><strong>Short Description</strong></p>
                                                    <p class="text-muted">{{ $product->description }}</p>

                                                    <form action="{{ route('application.store') }}" method="POST"
                                                        id="buyForm-{{ $product->id }}">
                                                        @csrf
                                                        <input type="hidden" name="created_by" value="Customer">
                                                        <input type="hidden" name="paid_amount" value="0">
                                                        <input type="hidden" name="customer_name"
                                                            value="{{ Auth::user()->id }} {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}">
                                                        <input type="hidden" name="item_name"
                                                            value="{{ $product->sales }} {{ $product->item_name }} {{ $product->code }}">
                                                        <button type="submit" class="btn btn-success btn-block mt-3">Confirm
                                                            Purchase</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif



                </div> <!-- .row -->
            </div>
        </div> <!-- .row -->
    </div>


    <div class="modal fade modal-notif modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Product Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="list-group list-group-flush my-n3">
                        <!-- Display Product Name -->
                        <div class="list-group-item bg-transparent">
                            <strong id="modal-product-name"></strong>
                        </div>
                        <!-- Display Product Price -->
                        <div class="list-group-item bg-transparent">
                            <span id="modal-product-price"></span>
                        </div>
                        <!-- Display Product Image -->
                        <div class="list-group-item bg-transparent">
                            <img src="" alt="" id="modal-product-image" class="img-fluid rounded">
                        </div>
                    </div> <!-- / .list-group -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Clear All</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

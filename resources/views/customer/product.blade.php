@extends('layouts.custapp')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="row align-items-center my-4">
                    <div class="col">
                        <h2 class="page-title">
                            @if (request('category'))
                                {{ request('category') }}
                            @endif
                        </h2>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-secondary">
                            <span class="fe fe-filter fe-16"></span>
                        </button>
                    </div>
                </div>
                <h6 class="mb-3">List of Products</h6>

                <div class="row mb-4">


                    @foreach ($products as $product)
                        <div class="col-6 col-md-4 col-lg-3 mb-3">
                            <div class="card border-0 bg-transparent py-3">
                                <!-- Show only the first image -->
                                @if ($product->productImages)
                                <img src="{{ optional($product->productImages->first())->image_url ?? asset('images/no-image.jpg') }}" alt="..."
                                        class="card-img-top img-fluid rounded" style="height: 300px;">
                                @endif

                                <div class="card-body" style="background-color: #ededed;">
                                    <h5 class="h4 card-title mb-1 text-muted">{{ $product->item_name }}</h5>
                                    <h6 class="text-secondary"> Model: {{ $product->code }} , {{ $product->brand }}</h6>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="fw-bold">TZS {{ number_format($product->sales) }}/=</h5>
                                        <!-- Form to post product data -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
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
                                                <div id="carouselExampleControls-{{ $product->id }}" class="carousel slide"
                                                    data-ride="carousel">
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
                                                        href="#carouselExampleControls-{{ $product->id }}" role="button"
                                                        data-slide="next">
                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                        <span class="sr-only">Next</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
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

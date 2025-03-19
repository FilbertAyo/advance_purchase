@extends('layouts.custapp')

<style>
    .carousel-inner img {
        width: 100%;
        /* Ensures full width */
        height: 500px;
        object-fit: contain;
    }
</style>

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">

                <div class="row align-items-center my-3">
                    <div class="col">
                        <h2 class="page-title">
                            Product Details
                        </h2>
                    </div>

                    <li class="nav-item dropdown col-auto d-flex">

                        <button type="button" class="btn btn-sm ml-2" onclick="reloadPage()">
                            <i class="fe fe-16 fe-refresh-ccw text-muted"></i>
                        </button>
                </div>

                <div class="card p-3">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <!-- Product Image Carousel -->
                            <div id="carouselExampleControls-{{ $product->id }}" class="carousel slide"
                                data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($product->productImages as $index => $image)
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                            <img src="{{ asset($image->image_url) }}" alt="Product Image"
                                                class="d-block w-100 img-thumbnail" style="cursor: pointer;"
                                                onclick="changeImage('{{ asset($image->image_url) }}', {{ $product->id }})">
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls-{{ $product->id }}"
                                    role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls-{{ $product->id }}"
                                    role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>

                            <!-- Thumbnail Images -->
                            <div class="mt-2 d-flex thumbnail-container">
                                @foreach ($product->productImages as $image)
                                    <img src="{{ asset($image->image_url) }}" alt="Thumbnail" class="img-thumbnail mx-1"
                                        style="width: 60px; height: 60px; cursor: pointer;"
                                        onclick="changeImage('{{ asset($image->image_url) }}', {{ $product->id }})">
                                @endforeach
                            </div>
                        </div>

                        <!-- Product Details -->
                        <div class="col-md-6">
                            <h2>{{ $product->item_name }}</h2>
                            <div class="text-warning">
                                ★★★★☆ (4.9)
                            </div>
                            <h4 class="mt-2">TZS {{ number_format($product->sales) }}/=</h4>
                            <p><strong>Model:</strong> {{ $product->code }}</p>
                            <p><strong>Brand:</strong> {{ $product->brand }}</p>
                            <p><strong>Short Description:</strong></p>
                            <p> {{ $product->description }}</p>

                            <div class="mt-4">
                                <p class="text-danger"><strong>make it yours!</strong></p>
                            </div>

                            <form action="{{ route('application.store') }}" method="POST"
                                id="buyForm-{{ $product->id }}">
                                @csrf
                                <input type="hidden" name="created_by" value="Customer">
                                <input type="hidden" name="paid_amount" value="0">
                                <input type="hidden" name="customer_name"
                                    value="{{ Auth::user()->id }} {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}">
                                <input type="hidden" name="item_name"
                                    value="{{ $product->sales }} {{ $product->item_name }} {{ $product->code }}">

                                <button type="submit" class="btn btn-dark btn-block mt-3">Confirm Purchase</button>
                            </form>
                        </div>
                    </div>
                </div>
                <footer class="bg-dark text-white text-center py-3 mt-5">
                    <p class="mb-0">&copy; 2024 Mars communications limited. All Rights Reserved.</p>
                    <p class="mb-0">
                        <a href="#" class="text-white mx-2">Privacy Policy</a> |
                        <a href="#" class="text-white mx-2">Terms of Service</a> |
                        <a href="#" class="text-white mx-2">Contact Us</a>
                    </p>
                </footer>

            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@extends('layouts.custapp')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">


                @if ($relative->isEmpty())

                <div id="relativeModal" class="modal" tabindex="-1" role="dialog"
                    aria-labelledby="relativeModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="relativeModalLabel">Complete Your Profile</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>You haven't filled in your relative details yet. Complete them to continue?
                                </p>
                            </div>
                            <div class="modal-footer">
                                <a href="{{ route('profile.edit') }}" class="btn btn-primary">Finish Now</a>

                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    // Delay the modal opening for 5 seconds
                    setTimeout(function() {
                        $('#relativeModal').modal('show');
                    }, 20000);

                </script>
            @endif

                <div class="mx-auto text-center justify-content-center">
                    <h2 class="page-title mb-0">What do you want?</h2>
                    <p class="help-text text-muted">Search for a product and start to pay in installment.</p>
                    <form class="searchform searchform-lg" action="{{ route('products.search') }}" method="GET">
                        <input class="form-control form-control-lg bg-white rounded-pill pl-5" type="search" name="query"
                            placeholder="Search" aria-label="Search" value="{{ request('query') }}">
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
                            <a class="nav-link pl-lg-2" href="{{ url('/product?category=Fridge') }}"><span
                                    class="ml-1">Fridges</span></a>
                            <a class="nav-link pl-lg-2" href="{{ url('/product?category=Chest freezer') }}"><span
                                    class="ml-1">Chest freezer</span></a>
                            <a class="nav-link pl-lg-2" href="{{ url('/product?category=Sound Bar') }}"><span
                                    class="ml-1">Sound Bar</span></a>
                            <a class="nav-link pl-lg-2" href="{{ url('/product?category=Small Home Appliances') }}"><span
                                    class="ml-1">Small Home Appliances</span></a>
                            <a class="nav-link pl-lg-2" href="{{ url('/product?category=Washing Machine') }}"><span
                                    class="ml-1">Washing Machine</span></a>
                            <a class="nav-link pl-lg-2" href="{{ url('/product?category=Cooker') }}"><span
                                    class="ml-1">Cookers</span></a>
                                    <a class="nav-link pl-lg-2" href="{{ url('/product?category=V/Cleaner') }}"><span
                                        class="ml-1">Vacuum Cleaner</span></a>
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
                            <div class="col-6 col-md-3 col-lg-3 mb-3">
                                <div class="card border-1 h-100 d-flex flex-column bg-white">
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

                                            <a class="btn btn-primary btn-sm" href="{{ route('product.view', $product->id) }}">Buy</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    @endif

                    <div class="d-flex justify-content-center mt-3">
                        {{ $products->links('vendor.pagination.bootstrap-4') }}
                    </div>

                </div>

            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

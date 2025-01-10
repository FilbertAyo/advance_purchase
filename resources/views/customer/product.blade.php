
@extends('layouts.custapp')

@section('content')
        <div class="container-fluid">

            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                  <div class="row align-items-center my-4">
                    <div class="col">
                      <h2 class="page-title">Products</h2>
                    </div>
                    <div class="col-auto">
                      <button type="button" class="btn btn-lg btn-primary">
                        <span class="fe fe-plus fe-16 mr-3"></span>New
                      </button>
                    </div>
                  </div>
                  <h6 class="mb-3">Quick Access</h6>

                  <div class="row mb-4">


                    @foreach($products as $product)
                    <div class="col-6 col-md-4 col-lg-3 mb-3" >
                        <div class="card border-0 bg-transparent py-3" >
                            <img src="{{ asset($product->image) }}" alt="..." class="card-img-top img-fluid rounded" style="height: 200px;">
                            <div class="card-body" style="background-color: #ededed;">
                                <h5 class="h4 card-title mb-1">{{ $product->item_name }}</h5>

                                <h6 class="text-secondary"> Model: {{ $product->code }} , {{ $product->brand }}</h6>

                                <div class="d-flex justify-content-between align-items-center">

                                    <span class="text-muted">TZS {{ number_format($product->sales) }}/=</span>
                                    <!-- Form to post product data -->
                                    <form action="{{ route('application.store') }}" method="POST" id="buyForm">
                                        @csrf
                                        <input type="hidden" name="created_by" value="Customer">
                                        <input type="hidden" name="paid_amount" value="0">
                                        <input type="hidden" name="customer_name" value="{{ Auth::user()->id }} {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}">
                                        <input type="hidden" name="item_name" value="{{ $product->sales }} {{ $product->item_name }} {{ $product->code }}">

                                        <button type="button" class="btn btn-primary" onclick="confirmPurchase(event)">
                                            Buy
                                        </button>
                                    </form>

                                    <script>
                                        function confirmPurchase(event) {
                                            // Show confirmation dialog
                                            if (confirm("Are you sure you want to buy this item?")) {
                                                // If confirmed, submit the form
                                                document.getElementById('buyForm').submit();
                                            } else {
                                                // If canceled, prevent form submission
                                                event.preventDefault();
                                            }
                                        }
                                    </script>

                                </div>
                            </div>
                        </div> <!-- .card -->
                    </div> <!-- .col -->
                @endforeach

                  </div> <!-- .row -->
                </div>
              </div> <!-- .row -->
            </div> <!-- .container-fluid -->


            <div class="modal fade modal-notif modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
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




          @endsection

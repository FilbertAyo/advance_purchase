<x-app-layout>

            @include('elements.spinner')
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">

                        <div class="row align-items-center mb-3 border-bottom no-gutters">
                            <div class="col">
                                <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                                            role="tab" aria-controls="home" aria-selected="true">Product Details</a>
                                    </li>

                                </ul>
                            </div>
                            <div class="col-auto">

                                <button type="button" class="btn btn-sm" onclick="reloadPage()">
                                    <i class="fe fe-16 fe-refresh-ccw text-muted"></i>
                                </button>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-9">
                                <div class="card shadow mb-4">
                                    <div class="card-header">
                                        <strong class="card-title">{{ $item->item_name }}</strong>
                                        <span class="float-right badge badge-pill badge-success text-white"
                                                >{{ $item->item_type }}</span>
                                    </div>
                                    <div class="card-body">

                                        <dl class="row mb-0">
                                            <dt class="col-sm-2 mb-3 text-muted">Barcode</dt>
                                            <dd class="col-sm-4 mb-3">{{ $item->code }}</dd>

                                            {{-- <dt class="col-sm-2 mb-3 text-muted">Income</dt>
                                            <dd class="col-sm-4 mb-3">
                                                <span class="badge badge-pill badge-danger">{{ $item->income }}</span>

                                            </dd> --}}
                                            <dt class="col-sm-2 mb-3 text-muted">Category</dt>
                                            <dd class="col-sm-4 mb-3">
                                                <span class="bg-warning mr-2"></span> {{ $item->category }}
                                            </dd>
                                            <dt class="col-sm-2 mb-3 text-muted">Brand</dt>
                                            <dd class="col-sm-4 mb-3">
                                                <span class="dot dot-md bg-warning mr-2"></span> {{ $item->brand }}
                                            </dd>
                                            <dt class="col-sm-2 mb-3 text-muted">As of Date</dt>
                                            <dd class="col-sm-4 mb-3">{{ $item->created_at }}</dd>
                                            <dt class="col-sm-2 mb-3 text-muted">Last Update</dt>
                                            <dd class="col-sm-4 mb-3">{{ $item->updated_at }}</dd>
                                            <dt class="col-sm-2 mb-3 text-muted">Expire date</dt>
                                            <dd class="col-sm-4 mb-3">{{ $item->expire_date }}</dd>
                                            <dt class="col-sm-2 mb-3 text-muted">Last updated by</dt>
                                            <dd class="col-sm-4 mb-3">
                                                <strong>{{ $item->created_by }}</strong>
                                            </dd>

                                            <dt class="col-sm-2 text-muted">Description</dt>
                                            <dd class="col-sm-4"> {{ $item->description }} </dd>
                                        </dl>

                                    </div> <!-- .card-body -->
                                </div> <!-- .card -->

                            </div> <!-- .col-md -->

                            <div class="col-md-3">
                                <div class="card shadow mb-4">
                                  <div class="card-body">
                                    <h3 class="h5 mb-1">Product Image</h3>
                                    <img src="{{ asset( $item->image) }}" alt="..." class="card-img-top img-fluid rounded">
                                  </div>
                                </div>
                              </div> <!-- .col-md -->

                        </div> <!-- .col-md -->

                    </div> <!-- .col-12 -->
                </div> <!-- .row -->
            </div> <!-- .container-fluid -->


</x-app-layout>

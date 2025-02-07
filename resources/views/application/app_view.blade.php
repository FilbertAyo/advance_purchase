<x-app-layout>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">

                <div class="row align-items-center mb-3 border-bottom no-gutters">
                    <div class="col">
                        <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                    aria-controls="home" aria-selected="true">Product Details</a>
                            </li>

                        </ul>
                    </div>
                    <div class="col-auto">

                        <button type="button" class="btn btn-sm" onclick="reloadPage()">
                            <i class="fe fe-16 fe-refresh-ccw text-muted"></i>
                        </button>

                        @if ($application->status == 'inactive')
                            @if (Auth::user()->userType == 1 || Auth::user()->userType == 2)
                                <button type="button" class="btn mb-2 btn-success btn-sm" data-toggle="modal"
                                    data-target="#varyModal1" data-whatever="@mdo">Activate
                                    <span class="fe fe-check fe-16 ml-2"></span></button>
                            @else
                                <button class="btn mb-2 btn-success btn-sm permission-alert">Activate
                                    <span class="fe fe-check fe-16 ml-2"></span></button>
                            @endif
                        @endif

                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card-header d-flex justify-content-between">
                                <strong class="card-title">{{ $application->customer_name }}</strong>
                                @if ($application->outstanding == 0 && $application->serial_number != null)
                                    <strong>Serial Number: {{ $application->serial_number }}
                                    </strong>

                                @endif
                            </div>

                            <div class="card-body">

                                <dl class="row mb-0">

                                    <dt class="col-sm-2 mb-3 text-muted">Product Name</dt>

                                    <dd class="col-sm-4 mb-3">{{ $application->item_name }}</dd>

                                    <dt class="col-sm-2 mb-3 text-muted">Price</dt>
                                    <dd class="col-sm-4 mb-3">
                                        <span class="bg-warning mr-2"></span> {{ $application->price }}
                                    </dd>
                                    <dt class="col-sm-2 mb-3 text-muted">Paid Amount</dt>
                                    <dd class="col-sm-4 mb-3">
                                        <span class="dot dot-md bg-success mr-2"></span> {{ $application->paid_amount }}
                                    </dd>
                                    <dt class="col-sm-2 mb-3 text-muted">Total Outstanding</dt>
                                    <dd class="col-sm-4 mb-3 text-danger">{{ $application->outstanding }}</dd>
                                    <dt class="col-sm-2 mb-3 text-muted">Last Update</dt>
                                    <dd class="col-sm-4 mb-3">{{ $application->updated_at }}</dd>
                                    <dt class="col-sm-2 mb-3 text-muted">As of Date</dt>
                                    <dd class="col-sm-4 mb-3">{{ $application->created_at }}</dd>
                                    <dt class="col-sm-2 mb-3 text-muted">Initialized by</dt>
                                    <dd class="col-sm-4 mb-3">
                                        <strong>{{ $application->created_by }}</strong>
                                    </dd>
                                    <dt class="col-sm-2 mb-3 text-muted">Status</dt>

                                    <dd class="col-sm-4 mb-3">
                                        @if ($application->status == 'inactive')
                                            <strong class="btn btn-danger p-1">Inactive</strong>
                                        @else
                                            @if ($application->outstanding == 0)
                                                <strong class="badge badge-success p-1 text-white">Complete</strong>
                                            @else
                                                <strong class="badge badge-info p-1">Ongoing</strong>
                                            @endif

                                        @endif
                                    </dd>

                                </dl>


                            </div> <!-- .card-body -->
                        </div> <!-- .card -->

                    </div> <!-- .col-md -->



                </div> <!-- .col-md -->

                @if($application->outstanding == 0)
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between">
                            <strong class="card-title">Contact Support</strong>
                            @if($application->serial_number != null && $application->delivery_status == 'Not Delivered' && in_array(Auth::user()->userType, [1, 4]))
                            <button type="button" class="btn mb-2 btn-secondary btn-sm" data-toggle="modal"
                                data-target="#delivery" data-whatever="@mdo">
                                Deliverey Status
                                <span class="fe fe-alert-octagon fe-16 ml-2"></span>
                            </button>

                            @endif
                        </div>

                        <div class="card-body">

                            <dl class="row mb-0">
                                <dt class="col-sm-2 mb-3 text-muted">Phone Number</dt>
                                <dd class="col-sm-4 mb-3">{{ $application->user->phone }}</dd>

                                <dt class="col-sm-2 mb-3 text-muted">Email</dt>
                                <dd class="col-sm-4 mb-3">
                                    <span class="bg-warning"></span> {{ $application->user->email }}
                                </dd>
                                <dt class="col-sm-2 mb-3 text-muted">Address</dt>
                                <dd class="col-sm-4 mb-3">
                                    <span class="dot dot-md bg-success mr-2"></span>
                                    {{ $application->user->profile->street ?? '' }},{{ $application->user->profile->ward ?? '' }},{{ $application->user->profile->district ?? '' }}
                                </dd>
                                <dt class="col-sm-2 mb-3 text-muted">Region</dt>
                                <dd class="col-sm-4 mb-3">{{ $application->user->profile->city ?? '' }}</dd>

                                <dt class="col-sm-2 mb-3 text-muted">Delivered on</dt>
                                <dd class="col-sm-4 mb-3">
                                    @if($application->delivery_status == 'delivered')
                                    {{ $application->updated_at }}
                                    @endif
                                </dd>
                                <dt class="col-sm-2 mb-3 text-muted">Status</dt>
                                <dd class="col-sm-4 mb-3"><span class="badge ml-1 {{ $application->delivery_status == 'Not Delivered' ? 'badge-danger' : 'badge-success' }}">
                                    {{ $application->delivery_status }}
                                </span>
                                </dd>


                             </dl>
                      </div>
                    </div> <!-- .card -->

                @endif


                @if ($application->status == 'active')

                    <div class="row align-items-center mb-3 border-bottom no-gutters">
                        <div class="col">
                            <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                                        role="tab" aria-controls="home" aria-selected="true">Advance Payment Statements</a>
                                </li>

                            </ul>
                        </div>
                        <div class="col-auto">
                            @if (in_array(Auth::user()->userType, [1, 4]) && $application->outstanding == 0)

                                @if($application->serial_number == null)
                                <button type="button" class="btn mb-2 btn-success btn-sm" data-toggle="modal"
                                    data-target="#serialNo" data-whatever="@mdo">
                                    Update Serial No
                                </button>
                                @endif

                            @elseif ($application->outstanding > 0)
                                @if (in_array(Auth::user()->userType, [1, 3]))
                                    <!-- Show Update Amount Button for userType 1 or 4 when outstanding > 0 -->
                                    <button type="button" class="btn mb-2 btn-primary btn-sm" data-toggle="modal"
                                        data-target="#varyModal" data-whatever="@mdo">
                                        Update Amount
                                        <span class="fe fe-edit fe-16 ml-2"></span>
                                    </button>
                                @else
                                    <!-- Show Disabled Update Amount Button for other user types -->
                                    <button class="btn mb-2 btn-primary btn-sm permission-alert">
                                        Update Amount
                                        <span class="fe fe-edit fe-16 ml-2"></span>
                                    </button>
                                @endif
                            @else
                                <button class="btn mb-2 btn-success btn-sm permission-alert">
                                    Update Serial No
                                    <span class="fe fe-edit fe-16 ml-2"></span>
                                </button>
                            @endif

                        </div>

                    </div>

                    @include('elements.spinner')

                    <div class="row my-2">


                        <div class="col-md-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <!-- table -->
                                    <table class="table table-bordered" id="dataTable-1">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Added Amount</th>
                                                <th>Remaining</th>
                                                <th>Updated by</th>
                                                <th>Time Updated</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($advances->count() > 0)
                                                @foreach ($advances as $index => $advance)
                                                    @if ($advance->added_amount > 0)
                                                        <tr>
                                                            <td>{{ $loop->index + 1 }}</td>
                                                            <td>{{ $advance->added_amount }}</td>
                                                            <td>{{ $advance->outstanding }}</td>
                                                            <td>{{ $advance->updated_by }}</td>
                                                            <td>{{ $advance->created_at }}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach

                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- simple table -->

                    </div> <!-- end section -->

                @endif

            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->


    <div class="modal fade" id="varyModal1" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="varyModalLabel">Activation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('application.activate', $application->id) }}">
                        @csrf

                        <div>
                            <h5 class="modal-title">Are you sure you want to activate this application for
                                {{ $application->customer_name }}?</h5>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">No</button>
                            <button type="submit" class="btn mb-2 btn-primary">Yes, Activate</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade" id="varyModal" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="varyModalLabel">Balance Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('application.update', $application->id) }}" validate>
                        @csrf
                        @method('PUT')

                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="">Amount Added</label>
                                <input type="text" class="form-control" id="arrivalStock" name="added_amount"
                                    required>
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                            <div class="col-md-12 mb-3" style="display: none;">
                                <input type="text" class="form-control"
                                    value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}"
                                    name="updated_by" required>
                                <input type="number" class="form-control" id="openingStock" name="price"
                                    value="{{ $application->price }}" readonly>
                                <input type="text" class="form-control" id="arrivalStock" name="paid_amount"
                                    value="{{ $application->paid_amount }}" readonly>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn mb-2 btn-primary">Save and Close</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>



    <div class="modal fade" id="serialNo" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="varyModalLabel">Serial Number Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('serialNo.update', $application->id) }}" validate>
                        @csrf
                        @method('PUT')

                        <div class="form-row">

                            <div class="col-md-12 mb-3">
                                <label for="">Serial Number</label>
                                <input type="text" class="form-control" id="arrivalStock" name="serial_number"
                                    required>
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn mb-2 btn-primary">Save and Close</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="delivery" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="varyModalLabel">Delivery Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('delivery.update', $application->id) }}" validate>
                    @csrf
                    @method('PUT')

                    <div>
                        <h5 class="modal-title">Is this delivery Done already?</h5>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn mb-2 btn-primary">Yes, Delivered</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

</x-app-layout>

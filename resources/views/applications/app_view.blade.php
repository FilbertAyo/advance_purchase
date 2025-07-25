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

                        @if ($application->outstanding == 0)
                            <a href="{{ route('invoice', $application->id) }}" type="button" class="btn btn-sm">
                                <i class="fe fe-16 fe-printer text-muted"></i>
                            </a>
                        @endif

                        @if ($application->status == 'inactive')
                            @if (auth()->check() &&
                                    auth()->user()->hasAnyRole(['superuser', 'admin']))
                                <form method="POST" action="{{ route('application.activate', $application->id) }}">
                                    @csrf
                                    <x-primary-button label="Activate" />
                                </form>
                            @else
                                <button class="btn mb-2 btn-success btn-sm permission-alert">Activate
                                    <span class="fe fe-check fe-16 ml-2"></span></button>
                            @endif
                        @endif

                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        @if ($application->refund_amount != null && $application->status == 'active')
                            <div class="alert alert-secondary d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="spinner-border mr-3 text-secondary" role="status">
                                    </div>
                                    This Refund of <strong>TZS {{ number_format($application->refund_amount) }}</strong>
                                    is waiting for
                                    approval...
                                </div>
                                <form action="{{ route('refund.approve', $application->id) }}" method="POST"
                                    style="margin: 0;">
                                    @csrf
                                    @method('PUT')
                                    <x-primary-button label="Approve" class="btn-secondary" />
                                </form>

                            </div>
                        @elseif ($application->refund_amount != null && $application->status == 'refunded')
                            <div class="alert alert-secondary d-flex justify-content-between align-items-center">
                                <div>
                                    <strong><i class="fe fe-check-circle"></i> Completed:</strong>
                                    This refund of <strong>TZS {{ number_format($application->refund_amount) }}</strong>
                                    has already been approved and the application is considered Refunded.
                                </div>
                            </div>
                            <div class="alert alert-danger d-flex justify-content-between align-items-center">
                                <div>
                                    <strong><i class="fe fe-book"></i> Reason:</strong>
                                    {{ $application->reason }}
                                </div>
                            </div>
                        @endif

                        <div class="card  mb-4">
                            <div class="card-header d-flex justify-content-between">
                                <strong class="card-title">{{ $application->user->first_name }}
                                    {{ $application->user->middle_name }} {{ $application->user->last_name }} -
                                    {{ $application->user->userId }}</strong>
                                @if ($application->outstanding == 0 && $application->serial_number != null)
                                    <strong>Serial Number: {{ $application->serial_number }}
                                    </strong>
                                @endif
                            </div>
                            <div class="card-body">
                                <dl class="row mb-0">
                                    <dt class="col-sm-2 mb-3 text-muted">Product Name</dt>
                                    <dd class="col-sm-4 mb-3">{{ $application->item->item_name }}</dd>
                                    <dt class="col-sm-2 mb-3 text-muted">Price</dt>
                                    <dd class="col-sm-4 mb-3">
                                        <span class="bg-warning mr-2"></span>TZS
                                        {{ number_format($application->price) }}
                                    </dd>
                                    <dt class="col-sm-2 mb-3 text-muted">Paid Amount</dt>
                                    <dd class="col-sm-4 mb-3">
                                        <span class="dot dot-md bg-success mr-2"></span>TZS
                                        {{ number_format($application->paid_amount) }}
                                    </dd>
                                    <dt class="col-sm-2 mb-3 text-muted">Total Outstanding</dt>
                                    <dd class="col-sm-4 mb-3 text-danger">TZS
                                        {{ number_format($application->outstanding) }}</dd>
                                    <dt class="col-sm-2 mb-3 text-muted">Last Update</dt>
                                    <dd class="col-sm-4 mb-3">{{ $application->updated_at }}</dd>
                                    <dt class="col-sm-2 mb-3 text-muted">As of Date</dt>
                                    <dd class="col-sm-4 mb-3">{{ $application->created_at }}</dd>

                                    <dt class="col-sm-2 mb-3 text-muted">Status</dt>

                                    <dd class="col-sm-4 mb-3">
                                        @if ($application->status == 'inactive')
                                            <strong class="badge badge-danger p-1">Inactive</strong>
                                        @elseif ($application->status == 'refunded')
                                            <strong class="badge badge-secondary p-1">Refunded</strong> : <strong>TZS
                                                {{ number_format($application->refund_amount) }} /=</strong>
                                        @else
                                            @if ($application->outstanding == 0)
                                                <strong class="badge badge-success p-1 text-white">Complete</strong>
                                            @else
                                                <strong class="badge badge-info p-1">Ongoing</strong>
                                            @endif

                                        @endif
                                    </dd>
                                </dl>
                            </div>
                        </div>

                    </div> <!-- .col-md -->


                </div>

                @if ($application->outstanding == 0)
                    <div class="card  mb-4">
                        <div class="card-header d-flex justify-content-between">
                            <strong class="card-title">Contact Support</strong>
                            @if (
                                $application->serial_number != null &&
                                    $application->delivery_status == 'Not Delivered' &&
                                    auth()->check() &&
                                    auth()->user()->hasAnyRole(['superuser', 'delivery']))
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
                                    @if ($application->delivery_status == 'delivered')
                                        {{ $application->updated_at }}
                                    @endif
                                </dd>
                                <dt class="col-sm-2 mb-3 text-muted">Status</dt>
                                <dd class="col-sm-4 mb-3"><span
                                        class="badge ml-1 {{ $application->delivery_status == 'Not Delivered' ? 'badge-danger' : 'badge-success' }}">
                                        {{ $application->delivery_status }}
                                    </span>
                                </dd>
                            </dl>
                        </div>
                    </div> <!-- .card -->

                @endif


                @if ($application->status != 'inactive')

                    @include('elements.spinner')

                    <div class="row my-2">


                        <div class="col-md-6">
                            <div class="row align-items-center mb-2">
                                <div class="col">
                                    <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab"
                                                href="#home" role="tab" aria-controls="home"
                                                aria-selected="true">Advance Payment Statements</a>
                                        </li>

                                    </ul>
                                </div>
                                <div class="col-auto">
                                    @if (auth()->check() &&
                                            auth()->user()->hasAnyRole(['superuser', 'delivery']) &&
                                            $application->outstanding == 0 &&
                                            $application->refund_amount == null)

                                        @if ($application->serial_number == null)
                                            <button type="button" class="btn mb-2 btn-success btn-sm"
                                                data-toggle="modal" data-target="#serialNo" data-whatever="@mdo">
                                                Update Serial No
                                            </button>
                                        @endif
                                    @elseif ($application->outstanding > 0 && $application->refund_amount == null)
                                        @if (auth()->check() &&
                                                auth()->user()->hasAnyRole(['superuser', 'cashier']))
                                            <button type="button" class="btn mb-2 btn-primary btn-sm"
                                                data-toggle="modal" data-target="#varyModal" data-whatever="@mdo">
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
                            <div class="card">
                                <div class="card-body">
                                    <!-- table -->
                                    <table class="table table-bordered table-sm" id="dataTable-1">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Added Amount</th>
                                                <th>Remaining</th>
                                                <th>Updated by</th>
                                                <th>Time Updated</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($advances->count() > 0)
                                                @foreach ($advances as $index => $advance)
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>{{ $advance->added_amount }}</td>
                                                        <td>{{ $advance->outstanding }}</td>
                                                        <td>{{ $advance->updated_by }}</td>
                                                        <td>{{ $advance->created_at }}</td>
                                                        <td>

                                                            @if (auth()->check() &&
                                                                    auth()->user()->hasAnyRole(['superuser', 'admin']))
                                                                <form id="deleteForm-{{ $advance->id }}"
                                                                    action="{{ route('advances.destroy', $advance->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button"
                                                                        onclick="showSweetAlert(event, '{{ $advance->id }}')"
                                                                        class="btn btn-sm btn-danger">
                                                                        <span class="fe fe-trash-2 fe-16"></span>
                                                                    </button>

                                                                </form>
                                                            @else
                                                                <button
                                                                    class="btn btn-sm btn-danger permission-alert"><span
                                                                        class="fe fe-trash-2 fe-16 permission-alert"></span></button>
                                                            @endif


                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr class="alert alert-danger">
                                                    <td colspan="6" class="text-center">
                                                        No Any installments paid.
                                                    </td>
                                                </tr>
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row align-items-center mb-2">

                                <div class="col">
                                    <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab"
                                                href="#home" role="tab" aria-controls="home"
                                                aria-selected="true">Payment Screenshot</a>
                                        </li>

                                    </ul>
                                </div>

                            </div>

                            <div class="card  mb-4 p-3">
                                <table class="table table-bordered table-hover mb-0 table-sm" id="statementsTable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Image</th>
                                            <th>Date Updated</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($screenshots->count())
                                            @php $no = 1; @endphp
                                            @foreach ($screenshots as $screen)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td><img src="{{ asset($screen->screenshot) }}" alt=""
                                                            style="height: 30px;"></td>
                                                    <td>{{ $screen->created_at }}</td>
                                                    <td>
                                                        <a href="{{ asset($screen->screenshot) }}" target="_blank"
                                                            class="btn btn-sm btn-primary">
                                                            <span class="fe fe-eye fe-16"></span></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="alert alert-danger">
                                                <td colspan="6" class="text-center">
                                                    No Screenshot found.
                                                </td>
                                            </tr>

                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div> <!-- end section -->

                @endif

            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->



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
                            <x-primary-button label="Save" class="mb-2" />
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
                            <x-primary-button label="Save" class="mb-2" />
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
                            <x-primary-button label="Yes, Delivered" class="mb-2" />
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>

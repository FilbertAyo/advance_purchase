<x-app-layout>


    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">

                <div class="row align-items-center mb-3 border-bottom no-gutters">
                    <div class="col">
                        <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                    aria-controls="home" aria-selected="true">Custumer Details</a>
                            </li>

                        </ul>
                    </div>
                    <div class="col-auto">

                        <button type="button" class="btn btn-sm" onclick="reloadPage()">
                            <i class="fe fe-16 fe-refresh-ccw text-muted"></i>
                        </button>

                        @if ($user->status == 'inactive')
                            @if (Auth::user()->userType == 1 || Auth::user()->userType == 2)
                                <button type="button" class="btn mb-2 btn-primary btn-sm" data-toggle="modal"
                                    data-target="#varyModal" data-whatever="@mdo">Verify
                                    <span class="fe fe-check fe-16 ml-2"></span></button>
                            @else
                                <button class="btn mb-2 btn-primary btn-sm permission-alert">Verify
                                    <span class="fe fe-check fe-16 ml-2"></span></button>
                            @endif

                        @endif

                        {{-- <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Verify</a> --}}

                    </div>
                </div>


                @include('elements.spinner')

                <div class="row my-2">

                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <strong class="card-title">{{ $user->first_name }} {{ $user->last_name }} <span
                                        class="text-danger">[ID: {{ $user->userId }}]</span></strong>

                            </div>
                            <div class="card-body">

                                <dl class="row mb-0">
                                    <dt class="col-sm-2 mb-3 text-muted">Phone Number</dt>
                                    <dd class="col-sm-4 mb-3">{{ $user->phone }}</dd>

                                    <dt class="col-sm-2 mb-3 text-muted">Email</dt>
                                    <dd class="col-sm-4 mb-3">
                                        <span class="bg-warning"></span> {{ $user->email }}
                                    </dd>
                                    <dt class="col-sm-2 mb-3 text-muted">Address</dt>
                                    <dd class="col-sm-4 mb-3">
                                        <span class="dot dot-md bg-success mr-2"></span>
                                        {{ $user->profile->street ?? '' }},{{ $user->profile->ward ?? '' }},{{ $user->profile->district ?? '' }}
                                    </dd>
                                    <dt class="col-sm-2 mb-3 text-muted">Region</dt>
                                    <dd class="col-sm-4 mb-3">{{ $user->profile->city ?? '' }}</dd>
                                    <dt class="col-sm-2 mb-3 text-muted">{{ $user->profile->id_type }}</dt>
                                    <dd class="col-sm-4 mb-3">{{ $user->profile->id_number }} <a href="#"
                                            class="badge badge-primary" data-bs-toggle="modal"
                                            data-bs-target="#attachmentModal"
                                            data-attachment="{{ asset($user->profile->id_attachment) }}">
                                            View Attachment
                                        </a>
                                    </dd>
                                    <dt class="col-sm-2 mb-3 text-muted">Employment Status</dt>
                                    <dd class="col-sm-4 mb-3">{{ $user->profile->employment_status }}:
                                        @if ($user->profile->employment_status == 'Employed')
                                            {{ $user->profile->occupation ?? '' }}[{{ $user->profile->organization ?? '' }}]
                                        @elseif($user->profile->employment_status == 'Self-Employed')
                                            {{ $user->profile->occupation ?? '' }}
                                        @endif
                                    </dd>
                                    <dt class="col-sm-2 mb-3 text-muted">Created on</dt>
                                    <dd class="col-sm-4 mb-3">{{ $user->created_at }}</dd>
                                    <dt class="col-sm-2 mb-3 text-muted">Status</dt>
                                    @if ($user->status == 'active')
                                        <dd class="col-sm-4 mb-3 "><span class="btn btn-success">Active</span></dd>
                                    @elseif($user->status == 'inactive')
                                        <dd class="col-sm-4 mb-3"><span class="btn btn-danger">Unverified</span></dd>
                                    @endif

                                </dl>
                            </div> <!-- .card-body -->
                        </div> <!-- .card -->

                    </div>

                    @if ($user->status == 'active')
                        <div class="row align-items-center mb-3 border-bottom no-gutters">
                            <div class="col">
                                <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                                            role="tab" aria-controls="home"
                                            aria-selected="true">{{ $user->first_name }}'s Items</a>
                                    </li>

                                </ul>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <!-- table -->
                                    <table class="table datatables" id="dataTable-1">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Item</th>
                                                <th>Serial No</th>
                                                <th>Price</th>
                                                <th>Paid</th>
                                                <th>Outstanding</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($applications->count() > 0)
                                                @foreach ($applications as $index => $item)
                                                @if($item->status == 'active')
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $item->item_name }}</td>
                                                        <td>{{ $item->serial_number ?? '-'}}</td>
                                                        <td>{{ $item->price }}</td>
                                                        <td><span class="text-success">{{ $item->paid_amount }}</span>
                                                        </td>
                                                        <td><span class="text-danger">{{ $item->outstanding }}</span>
                                                        </td>
                                                        <td>{{ $item->created_at }}</td>
                                                        <td>
                                                            @if ($item->outstanding <= 0)
                                                                <span class="badge bg-success text-white">Completed</span>
                                                            @else
                                                                <span class="badge bg-info text-white">Ongoing</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div style="display: flex; gap: 2px;">


                                                                <a href="{{ route('application.show', $item->id) }}"
                                                                    class="btn btn-sm  btn-warning text-white"><span
                                                                        class="fe fe-eye fe-16"></span>
                                                                </a>

                                                                @if (Auth::user()->userType == 1 || Auth::user()->userType == 3)
                                                                    <form id="deleteForm-{{ $item->id }}"
                                                                        action="{{ route('application.destroy', $item->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="button"
                                                                            onclick="showSweetAlert(event, '{{ $item->id }}')"
                                                                            class="btn btn-sm btn-danger">
                                                                            <span class="fe fe-trash-2 fe-16"></span>
                                                                        </button>

                                                                    </form>
                                                                @else
                                                                    <button
                                                                        class="btn btn-sm btn-danger permission-alert"><span
                                                                            class="fe fe-trash-2 fe-16 permission-alert"></span></button>
                                                                @endif

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="9" class="text-center">No Item found</td>
                                                </tr>
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    @endif
                </div>
            </div>
        </div>


    </div> <!-- .row -->
    </div> <!-- .container-fluid -->


    <div class="modal fade" id="varyModal" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="varyModalLabel">Verification</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('customer.update', $user->id) }}" validate>
                        @csrf
                        @method('PUT')

                        <div>
                            <h5 class="modal-title">Are you sure you want to Register this User?</h5>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">No</button>
                            <button type="submit" class="btn mb-2 btn-primary">Yes , Register</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <!-- Modal Structure -->
    <div class="modal fade" id="attachmentModal" tabindex="-1" aria-labelledby="attachmentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="attachmentModalLabel">Attachment</h5>
                    <a href="{{ asset($user->profile->id_attachment) }}" class="badge badge-primary"
                        download>Download Attachment</a>

                </div>
                <div class="modal-body text-center">
                    <!-- Attachment Content -->
                    <img id="attachmentImage" src="" alt="Attachment" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const attachmentModal = document.getElementById('attachmentModal');
            const attachmentImage = document.getElementById('attachmentImage');

            attachmentModal.addEventListener('show.bs.modal', function(event) {
                // Button that triggered the modal
                const button = event.relatedTarget;

                // Extract URL from data attribute
                const attachmentUrl = button.getAttribute('data-attachment');

                // Update the modal's content
                attachmentImage.src = attachmentUrl;
            });
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


</x-app-layout>

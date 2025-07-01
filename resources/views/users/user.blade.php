<x-app-layout>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">

                <div class="row align-items-center mb-3 border-bottom no-gutters">
                    <div class="col">
                        <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                    aria-controls="home" aria-selected="true">All Users</a>
                            </li>

                        </ul>
                    </div>
                    <div class="col-auto">

                        <button type="button" class="btn btn-sm" onclick="reloadPage()">
                            <i class="fe fe-16 fe-refresh-ccw text-muted"></i>
                        </button>

                        @can('manage users')
                            <button type="button" class="btn mb-2 btn-primary btn-sm" data-toggle="modal"
                                data-target=".modal-full">New User<span class="fe fe-plus fe-16 ml-2"></span></button>
                        @else
                            <button class="btn mb-2 btn-primary btn-sm permission-alert">New User<span
                                    class="fe fe-plus fe-16 ml-2"></span></button>
                        @endcan
                    </div>
                </div>
                @include('elements.spinner')

                <div class="row">

                    @foreach ($users as $index => $user)
                        <div class="col-md-3">
                            <div class="card  mb-4">
                                <div class="card-body text-center">
                                    <div class="avatar avatar-lg mt-4">
                                        <a href="">
                                            <img src="{{ asset('images/photo.jpeg') }}" alt="..."
                                                class="avatar-img rounded-circle">
                                        </a>
                                    </div>
                                    <div class="card-text my-2">
                                        <strong class="card-title my-0">{{ $user->first_name }}
                                            {{ $user->last_name }}</strong>
                                        <p class="small text-muted mb-0">{{ $user->phone }} |
                                            {{ $user->email }}</p>
                                        <p class="small"><span class="badge badge-warning text-white">

                                                @php
                                                    $role = $user->getRoleNames()->first();
                                                @endphp

                                                {{ $role }}

                                            </span>
                                        </p>
                                    </div>
                                </div> <!-- ./card-text -->
                                <div class="card-footer">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col-auto">
                                            <small>
                                                <span
                                                    class="dot dot-lg {{ $user->status === 'active' ? 'bg-success' : 'bg-danger' }} mr-1"></span>
                                                {{ ucfirst($user->status) }}
                                            </small>
                                        </div>

                                        <div class="col-auto">
                                            <div class="file-action">
                                                <button type="button"
                                                    class="btn btn-link dropdown-toggle more-vertical p-0 text-muted mx-auto"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                </button>

                                                <div class="dropdown-menu m-2">
                                                    <a class="dropdown-item" href="#"><i
                                                            class="fe fe-edit fe-15 mr-2"></i>Edit Roles</a>

                                                    <a class="dropdown-item text-primary {{ $user->status === 'active' ? 'text-danger' : 'text-active' }}"
                                                        href="#"
                                                        onclick="confirmToggleStatus('{{ $user->id }}', '{{ $user->status }}')">
                                                        <i class="fe fe-user fe-15 mr-2"></i>
                                                        {{ $user->status === 'active' ? 'Deactivate' : 'Activate' }}
                                                    </a>

                                                    <form id="toggle-status-{{ $user->id }}"
                                                        action="{{ route('user.toggleStatus', $user->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                    </form>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div> <!-- /.card-footer -->
                            </div>
                        </div> <!-- .col -->
                    @endforeach


                </div> <!-- .col-12 -->
            </div> <!-- .row -->
        </div>




        <div class="modal fade modal-full" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
            data-backdrop="static" aria-hidden="true">
            <button aria-label="" type="button" class="close p-3" data-dismiss="modal" aria-hidden="true"
                style="position: absolute; right: 20px; top: 20px;">
                <span aria-hidden="true" style="font-size: 3rem;" class="text-danger">×</span>
            </button>

            <div class="modal-dialog modal-xl bg-white p-3" role="document" style="width: 100%;">
                <div class="modal-content">
                    <div class="modal-body">
                        <form method="POST" action="{{ route('users.register') }}" validate
                            style="height: 100%; display: flex; flex-direction: column; justify-content: center;"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-row text-center">
                                <div class="col-md-12 mb-3">
                                    <h3>User Registration</h3>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom9">First Name</label>
                                    <input type="text" class="form-control" id="validationCustom9" name="first_name"
                                        required>
                                    <div class="valid-feedback"> Looks good! </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom3">Middle Name (*Optional)</label>
                                    <input type="text" class="form-control" id="validationCustom3"
                                        name="middle_name">
                                    <div class="valid-feedback"> Looks good! </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom3">Last Name</label>
                                    <input type="text" class="form-control" id="validationCustom3"
                                        name="last_name" required>
                                    <div class="valid-feedback"> Looks good! </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom3">Phone Number</label>
                                    <input type="text" class="form-control" id="validationCustom3" name="phone"
                                        required>
                                    <div class="valid-feedback"> Looks good! </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom3">Email</label>
                                    <input type="email" class="form-control" id="validationCustom3" name="email"
                                        required>
                                    <div class="valid-feedback"> Looks good! </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="validationSelect2">Role</label>
                                    <select class="form-control select2" id="validationSelect2" name="role"
                                        required>
                                        <option value="" disabled selected>Select a role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}">
                                                {{ ucwords(str_replace('_', ' ', $role->name)) }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Please select a valid role.</div>
                                </div>


                                <div class="col-md-6 mb-3">
                                    <label for="validationSelect3">Status</label>
                                    <select class="form-control select2" id="validationSelect3" name="status"
                                        required>
                                        <optgroup label="Select Store">
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </optgroup>
                                    </select>
                                    <div class="invalid-feedback"> Please select a valid state. </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom3">Password</label>
                                    <input type="text" class="form-control" id="validationCustom3"
                                        name="password" required>
                                    <div class="valid-feedback"> Looks good! </div>
                                </div>

                            </div>

                            <x-primary-button label="Register" class="w-100" />
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>


    <script>
        function confirmToggleStatus(userId, currentStatus) {
            const actionText = currentStatus === 'active' ? 'deactivate' : 'activate';
            Swal.fire({
                title: `Are you sure?`,
                text: `You are about to ${actionText} this user.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, do it!',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`toggle-status-${userId}`).submit();
                }
            });
        }
    </script>



</x-app-layout>

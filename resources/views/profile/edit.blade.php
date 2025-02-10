@extends('layouts.custapp')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="my-1">
                    <div class="col-md-12 mb-4">
                        <div class="flex justify-between">
                            <h4>Profile</h4>
                        </div>
                        <div class="accordion w-100" id="accordion1">
                            <div class="card shadow">
                                <div class="card-header" id="heading1">
                                    <a role="button" href="#collapse1" data-toggle="collapse" data-target="#collapse1"
                                        aria-expanded="false" aria-controls="collapse1">
                                        <strong>Profile Information</strong>
                                    </a>
                                </div>
                                <div id="collapse1" class="collapse show px-3 mb-3" aria-labelledby="heading1"
                                    data-parent="#accordion1">

                                    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                                        @csrf
                                        @method('patch')
                                        <div class="row mt-5 align-items-center">
                                            <div class="col-md-2 text-center mb-5">
                                                <div class="avatar avatar-xl">
                                                    <img src="{{ asset(Auth::user()->profile->profile_image ?? 'images/photo.jpeg') }}"
                                                    style="width: 150px; height: 150px; object-fit: cover;"
                                                    alt="User"
                                                    class="avatar-img rounded-circle">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h4 class="mb-1">{{ $user->first_name }}, {{ $user->last_name }}</h4>
                                                <p class="small mb-3"><span
                                                        class="badge badge-dark">{{ $user->location }}</span></p>
                                                <p class="">ID: <span
                                                        class="text-danger">{{ $user->userId ?? 'Uknown' }}</span></p>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="first_name">First Name</label>
                                                <input type="text" id="first_name" name="first_name" class="form-control"
                                                    value="{{ old('first_name', $user->first_name) }}" readonly>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="first_name">Middle Name</label>
                                                <input type="text" id="middle_name" name="middle_name"
                                                    class="form-control"
                                                    value="{{ old('middle_name', $user->middle_name) }}" readonly>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="last_name">Last Name</label>
                                                <input type="text" id="last_name" name="last_name" class="form-control"
                                                    value="{{ old('last_name', $user->last_name) }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" id="email" name="email" class="form-control"
                                                value="{{ old('email', $user->email) }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="address">Phone number</label>
                                            <input type="text" id="address" name="phone" class="form-control"
                                                value="{{ old('phone', $user->phone) }}">
                                        </div>

                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </form>


                                </div>
                            </div>
                            <div class="card shadow">
                                <div class="card-header" id="heading1">
                                    <a role="button" href="#collapse2" data-toggle="collapse" data-target="#collapse2"
                                        aria-expanded="false" aria-controls="collapse2">
                                        <strong>Security</strong>
                                    </a>
                                </div>
                                <div id="collapse2" class="collapse px-3 m-3" aria-labelledby="heading2"
                                    data-parent="#accordion1">

                                    <form method="post" action="{{ route('password.update') }}">
                                        @csrf
                                        @method('put')

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="current_password">Current Password</label>
                                                <input type="password" id="current_password" name="current_password"
                                                    class="form-control" autocomplete="current-password">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="password">New Password</label>
                                                <input type="password" id="password" name="password"
                                                    class="form-control" autocomplete="new-password">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="password_confirmation">Confirm Password</label>
                                                <input type="password" id="password_confirmation"
                                                    name="password_confirmation" class="form-control"
                                                    autocomplete="new-password">
                                            </div>
                                            <div class="col-md-6">
                                                <p class="mb-2">Password requirements</p>
                                                <p class="small text-muted mb-2"> To create a new password, you have to
                                                    meet all of the following requirements: </p>
                                                <ul class="small text-muted pl-4 mb-0">
                                                    <li> Minimum 8 character </li>
                                                    <li>At least one special character</li>
                                                    <li>At least one number</li>
                                                    <li>Can’t be the same as a previous password </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Update Password</button>
                                    </form>

                                </div>
                            </div>
                            <div class="card shadow">
                                <div class="card-header" id="heading1">
                                    <a role="button" href="#collapse3" data-toggle="collapse" data-target="#collapse3"
                                        aria-expanded="false" aria-controls="collapse3">
                                        <strong>Next of Kin</strong>
                                    </a>
                                </div>
                                <div id="collapse3" class="collapse {{ $relatives->isEmpty() ? 'show' : '' }}"
                                    aria-labelledby="heading3" data-parent="#accordion1">
                                    <div class="col-md-12 my-4">

                                        <div class="card shadow">

                                            @if ($relatives->isNotEmpty())
                                                <!-- Check if collection has data -->
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr role="row">
                                                            <th>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        id="all">
                                                                    <label class="custom-control-label"
                                                                        for="all"></label>
                                                                </div>
                                                            </th>
                                                            <th>No</th>
                                                            <th>Full Name</th>
                                                            <th>Phone Number</th>
                                                            <th>Email</th>
                                                            <th>Address</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($relatives as $relationship => $group)
                                                            <tr role="group" class="bg-light">
                                                                <td colspan="7">
                                                                    <strong>{{ ucfirst($relationship) }}</strong></td>
                                                            </tr>

                                                            @foreach ($group as $index => $relative)
                                                                <tr>
                                                                    <td>
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox"
                                                                                class="custom-control-input"
                                                                                id="relative_{{ $relative->id }}">
                                                                            <label class="custom-control-label"
                                                                                for="relative_{{ $relative->id }}"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>{{ $index + 1 }}</td>
                                                                    <td>{{ strtoupper($relative->relative_name) }}</td>
                                                                    <td>{{ $relative->phone_number }}</td>
                                                                    <td>{{ $relative->email }}</td>
                                                                    <td>{{ $relative->address }}</td>
                                                                    <td>
                                                                        <form action="{{ route('relative.destroy', $relative->id) }}" method="POST" style="display:inline;">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this relative?')">
                                                                                Delete
                                                                            </button>
                                                                        </form>

                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @else
                                            <div class="text-center">
                                                <p class="text-danger my-5">No relatives found.</p>
                                            </div>

                                            @endif


                                        </div>
                                        <div class="col ml-auto py-3">
                                            <button type="button" class="btn btn-primary float-right"
                                                data-toggle="modal" data-target="#relativeModal">
                                                Add Relative +
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="relativeModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="relativeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="relativeModalLabel">Add Next of Kin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('relative.store') }}" method="POST">
                    @csrf

                    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="relative_name">Full Name</label>
                            <input type="text" class="form-control" id="relative_name" name="relative_name" required>
                        </div>

                        <div class="form-group">
                            <label for="relationship">Relationship</label>
                            <select class="form-control" id="relationship" name="relationship" required>
                                <option value="">--Select Relationship--</option>
                                <option value="Father">Father</option>
                                <option value="Mother">Mother</option>
                                <option value="Brother">Brother</option>
                                <option value="Sister">Sister</option>
                                <option value="Spouse">Spouse</option>
                                <option value="Guardian">Guardian</option>
                                <option value="Friend">Friend</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email (Optional)</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>

                        <div class="form-group">
                            <label for="address">Address (Optional)</label>
                            <input type="text" class="form-control" id="address" name="address">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Relative</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if ($relatives->isEmpty())
        <script>
            setTimeout(function() {
                $('#relativeModal').modal('show');
            }, 100);
        </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection

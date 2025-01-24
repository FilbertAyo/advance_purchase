
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 col-xl-8">
                    <div class="my-4">

                        <div class="flex justify-between">
                            <h4>Profile</h4>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary float-right">Back</a>
                        </div>


                        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('patch')
                            <div class="row mt-5 align-items-center">
                                <div class="col-md-2 text-center mb-5">
                                    <div class="avatar avatar-xl">
                                        <img src="{{ asset('images/photo.jpeg') }}" alt="Profile Picture" class="avatar-img rounded-circle">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="mb-1">{{ $user->first_name }}, {{ $user->last_name }}</h4>
                                    <p class="small mb-3"><span class="badge badge-dark">{{ $user->location }}</span></p>
                                    <p class="">ID: <span class="text-danger">{{ $user->userId ?? 'Uknown' }}</span></p>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="first_name">First Name</label>
                                    <input type="text" id="first_name" name="first_name" class="form-control" value="{{ old('first_name', $user->first_name) }}" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" id="last_name" name="last_name" class="form-control" value="{{ old('last_name', $user->last_name) }}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="address">Phone number</label>
                                <input type="text" id="address" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>

                        <!-- Security Section -->
                        <h4 class="mt-5">Security</h4>
                        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('put')

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="current_password">Current Password</label>
                                    <input type="password" id="current_password" name="current_password" class="form-control" autocomplete="current-password">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="password">New Password</label>
                                    <input type="password" id="password" name="password" class="form-control" autocomplete="new-password">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" autocomplete="new-password">
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2">Password requirements</p>
                                    <p class="small text-muted mb-2"> To create a new password, you have to meet all of the following requirements: </p>
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
            </div>
        </div>
    </div>
</x-app-layout>

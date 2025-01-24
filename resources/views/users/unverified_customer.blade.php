<x-app-layout>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">

                <div class="row align-items-center mb-3 border-bottom no-gutters">
                    <div class="col">
                        <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                    aria-controls="home" aria-selected="true">Unverified Customers</a>
                            </li>

                        </ul>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-sm" onclick="reloadPage()">
                            <i class="fe fe-16 fe-refresh-ccw text-muted"></i>
                        </button>

                        @if (Auth::user()->userType == 1 || Auth::user()->userType == 2)
                            <button type="button" class="btn mb-2 btn-primary btn-sm" data-toggle="modal"
                                data-target=".modal-full">New Customer<span
                                    class="fe fe-plus fe-16 ml-2"></span></button>
                        @else
                            <button class="btn mb-2 btn-primary btn-sm permission-alert">New Customer<span
                                    class="fe fe-plus fe-16 ml-2"></span></button>
                        @endif
                    </div>
                </div>


                @include('elements.spinner')
                <div class="row my-2">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- table -->
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Reference No.</th>
                                            <th>Phone Number</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @if ($user->count() > 0) --}}
                                        @foreach ($user as $index => $user)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                                <td>{{ $user->userId }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->street }},{{ $user->ward }},{{ $user->district }},{{ $user->city }}
                                                </td>
                                                <td>
                                                    <div style="display: flex; gap: 2px;">

                                                        @if (Auth::user()->userType == 1 || Auth::user()->userType == 2)
                                                            <a href="{{ route('customer.show', $user->id) }}"
                                                                class="btn btn-sm  btn-warning text-white"><span
                                                                    class="fe fe-eye fe-16"></span></a>
                                                        @else
                                                            <a href="{{ route('customer.show', $user->id) }}"
                                                                class="btn btn-sm btn-warning text-white"
                                                                style="pointer-events: none; opacity: 0.6;">
                                                                <span class="fe fe-eye fe-16"></span>
                                                            </a>
                                                        @endif

                                                        @if (Auth::user()->userType == 1 || Auth::user()->userType == 2)
                                                            <form action="{{ route('customer.destroy', $user->id) }}"
                                                                method="POST"
                                                                onsubmit="return showSweetAlert(event, '{{ $user->id }}');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button onclick="showSweetAlert()"
                                                                    class="btn btn-sm btn-danger"><span
                                                                        class="fe fe-trash-2 fe-16"></span></button>
                                                            </form>
                                                        @else
                                                            <button class="btn btn-sm btn-danger permission-alert"><span
                                                                    class="fe fe-trash-2 fe-16 permission-alert"></span></button>
                                                        @endif


                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        {{-- @else
                                        <tr>
                                            <td colspan="9" class="text-center">No Item found</td>
                                        </tr>
                                    @endif --}}

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- simple table -->


                </div> <!-- .row -->
            </div> <!-- .container-fluid -->



            {{-- User registration --}}

            <div class="modal fade modal-full" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
                data-backdrop="static" aria-hidden="true">
                <button aria-label="" type="button" class="close p-3" data-dismiss="modal" aria-hidden="true"
                    style="position: absolute; right: 20px; top: 20px;">
                    <span aria-hidden="true" style="font-size: 3rem;" class="text-danger">×</span>
                </button>

                <div class="modal-dialog modal-dialog-centered modal-xl bg-white" role="document" style="width: 100%;">
                    <div class="modal-content">
                        <div class="modal-body">

                            <form method="POST" action="{{ url('/register') }}" validate
                                style="height: 100%; display: flex; flex-direction: column; justify-content: center;">
                                @csrf

                                <div class="form-row text-center">
                                    <div class="col-md-12 mb-3">
                                        <h3>Customer Registration</h3>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom3">First Name</label>
                                        <input type="text" class="form-control" id="validationCustom3"
                                            name="first_name" required>
                                        <div class="valid-feedback"> Looks good! </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom3">Last Name</label>
                                        <input type="text" class="form-control" id="validationCustom3"
                                            name="last_name" required>
                                        <div class="valid-feedback"> Looks good! </div>
                                    </div>

                                </div>

                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom3">Phone Number</label>
                                        <input type="text" class="form-control" id="validationCustom3" name="phone"
                                            required>
                                        <div class="valid-feedback"> Looks good! </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom3">Email</label>
                                        <input type="text" class="form-control" id="validationCustom3"
                                            name="email" required>
                                        <div class="valid-feedback"> Looks good! </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationSelect1">City</label>
                                        <select class="form-control select2" id="validationSelect1" name="city"
                                            required>

                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}">{{ $city->city_name }}</option>
                                            @endforeach
                                        </select>

                                        <div class="invalid-feedback"> Please select a valid state. </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationSelect2">District</label>
                                        <div class="input-group">
                                            <select class="form-control select2" id="validationSelect2"
                                                name="district" required>
                                                <optgroup label="Select District">
                                                    @foreach ($districts as $district)
                                                        <option value="{{ $district->region_name }}">
                                                            {{ $district->region_name }}</option>
                                                    @endforeach

                                                </optgroup>
                                            </select>
                                        </div>
                                        <div class="invalid-feedback"> Please select a valid state. </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationSelect2">Ward</label>
                                        <select class="form-control select2" id="validationSelect3" name="ward"
                                            required>
                                            @foreach ($wards as $ward)
                                                <option value="{{ $ward->ward_name }}">{{ $ward->ward_name }}
                                                </option>
                                            @endforeach

                                        </select>
                                        <div class="invalid-feedback"> Please select a valid state. </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom5">Street</label>
                                        <input type="text" class="form-control" id="validationCustom5"
                                            name="street" required>
                                        <div class="valid-feedback"> Looks good! </div>
                                    </div>
                                </div>
                                <div class="form-row">

                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom6">Occupation</label>
                                        <input type="text" class="form-control" id="validationCustom6"
                                            name="occupation" required>
                                        <div class="valid-feedback"> Looks good! </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom6">NIDA Number</label>
                                        <input type="text" class="form-control" id="validationCustom6"
                                            name="nida" required>
                                        <div class="valid-feedback"> Looks good! </div>
                                    </div>
                                </div>


                                <div class="form-row" style="display: none;">
                                    <div class="col-md-6 mb-3">

                                        <input type="text" class="form-control" name="userType" value="0"
                                            required>
                                        <input type="text" class="form-control" name="status" value="inactive"
                                            required>

                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="validat">Password</label>
                                        <input type="password" class="form-control" id="validat" name="password"
                                            value="12345678" required>

                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="validati">Confirm Password</label>
                                        <input type="password" class="form-control" id="validati"
                                            name="password_confirmation" value="12345678" readonly>

                                    </div>


                                </div>

                                <button type="submit" class="btn btn-primary mt-3">Register Customer</button>
                            </form>
                        </div>
                    </div>
                </div>


            </div>

</x-app-layout>

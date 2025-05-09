
<x-app-layout>

            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">

                        <div class="row align-items-center mb-3 border-bottom no-gutters">
                            <div class="col">
                                <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                                            role="tab" aria-controls="home" aria-selected="true">All Customers</a>
                                    </li>

                                </ul>
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-sm" onclick="reloadPage()">
                                    <i class="fe fe-16 fe-refresh-ccw text-muted"></i>
                                </button>
                            </div>
                        </div>


                        @include('elements.spinner')
                    <div class="row my-2">
                        <!-- Small table -->
                        <div class="col-md-12">
                            <div class="card shadow">
                                <div class="card-body">

                                    <form method="GET" action="{{ route('customers.list') }}" class="row card-header">

                                        <div class="col-md-6 d-flex">
                                            <label class="mr-2 align-self-center">Per page:</label>
                                            <select name="perPage" class="form-control w-auto me-2" onchange="this.form.submit()">
                                                @foreach ([10, 20, 50, 100] as $size)
                                                    <option value="{{ $size }}" {{ request('perPage', 10) == $size ? 'selected' : '' }}>{{ $size }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 d-flex">
                                            <input type="text" name="search" class="form-control w-100 mr-2" placeholder="Search name or ID..." value="{{ request('search') }}">
                                            <button type="submit" class="btn btn-primary">Search</button>
                                        </div>
                                    </form>

                                    <table class="table table-bordered table-sm">
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
                                                @foreach ($users as $index => $user)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $user->first_name }} {{ $user->middle_name ?? '' }} {{ $user->last_name }}</td>
                                                        <td>{{ $user->userId }}</td>
                                                        <td>{{ $user->phone }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->profile->street ?? '' }},{{ $user->profile->ward ?? '' }},{{ $user->profile->district ?? '' }},{{ $user->profile->city ?? '' }}
                                                        <td>
                                                            <div style="display: flex; gap: 2px;">
                                                                <a href="{{ route('customer.show', $user->id) }}"
                                                                    class="btn btn-sm btn-secondary text-white"><span
                                                                        class="fe fe-eye fe-16"></span></a>
                                                                <button
                                                                    class="btn btn-sm btn-danger permission-alert"><span
                                                                        class="fe fe-trash-2 fe-16 permission-alert"></span></button>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                        </tbody>
                                    </table>

                                    <div class="d-flex justify-content-between">
                                        <div class="align-self-center">
                                            <p>Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} Items</p>
                                        </div>
                                        <div class="align-self-center">
                                            {{ $users->appends(['search' => request('search')])->links('vendor.pagination.bootstrap-4') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                </div>
            </div>



        </x-app-layout>

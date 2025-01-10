
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
                                    <!-- table -->
                                    <table class="table datatables" id="dataTable-1">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Phone Number</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                                @foreach ($user as $index => $user)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                                        <td>{{ $user->phone }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->street }},{{ $user->ward }},{{ $user->district }},{{ $user->city }}</td>
                                                        <td>
                                                            <div style="display: flex; gap: 2px;">


                                                                <a href="{{ route('customer.show', $user->id) }}"
                                                                    class="btn btn-sm  btn-warning text-white"><span
                                                                        class="fe fe-eye fe-16"></span></a>

                                                                        @if(Auth::user()->userType == 1 || Auth::user()->userType == 2)
                                                                <form
                                                                    action="{{ route('customer.destroy', $user->id) }}"
                                                                    method="POST"
                                                                    onsubmit="return showSweetAlert(event, '{{ $user->id }}');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-danger"><span
                                                                            class="fe fe-trash-2 fe-16"></span></button>
                                                                </form>

                                                                @else

                                                                <button
                                                                    class="btn btn-sm btn-danger permission-alert"><span
                                                                        class="fe fe-trash-2 fe-16 permission-alert"></span></button>

                                                                @endif


                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- simple table -->


                </div> <!-- .row -->
            </div> <!-- .container-fluid -->



        </x-app-layout>

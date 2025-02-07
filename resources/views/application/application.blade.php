
<x-app-layout>


            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">

                        <div class="row align-items-center mb-3 border-bottom no-gutters">
                            <div class="col">
                                <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                                            role="tab" aria-controls="home" aria-selected="true">All Applications</a>
                                    </li>

                                </ul>
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-sm">
                                    <i class="fe fe-16 fe-printer text-muted"></i>
                                </button>
                                <button type="button" class="btn btn-sm">
                                    <i class="fe fe-16 fe-file text-muted"></i>
                                </button>
                                <button type="button" class="btn btn-sm"  onclick="reloadPage()">
                                    <i class="fe fe-16 fe-refresh-ccw text-muted"></i>
                                </button>

                            </div>
                        </div>

                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="mb-0 page-title">Application</h4>
                            </div>
                        </div>

                        @include('elements.spinner')
                        <div class="row my-2">
                            <!-- Small table -->
                            <div class="col-md-12">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <!-- table -->
                                        <table class="table table-bordered" id="dataTable-1">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Product</th>
                                                    <th>Price</th>
                                                    <th>Paid</th>
                                                    <th>Outstanding</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($application->count() > 0)
                                                    @foreach ($application as $index => $item)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $item->customer_name }}</td>
                                                            <td>{{ $item->item_name }}</td>
                                                            <td>{{ $item->price }}</td>
                                                            <td><span class="text-success">{{ $item->paid_amount}}</span></td>
                                                            <td><span class="text-danger">{{ $item->outstanding }}</span></td>
                                                            <td>{{ $item->created_at }}</td>
                                                            <td>

                                                                @if($item->outstanding == 0)
                                                                <span class="badge badge-success">complete</span>

                                                                @else
                                                                <span class="badge badge-danger">pending</span>
                                                                @endif
                                                            </td>
                                                            <td>

                                                                <div style="display: flex; gap: 2px;">


                                                                    <a href="{{ route('application.show', $item->id) }}"
                                                                        class="btn btn-sm  btn-warning text-white"><span
                                                                            class="fe fe-eye fe-16"></span>
                                                                        </a>

                                                                        @if(Auth::user()->userType == 1 || Auth::user()->userType == 3)

                                                                        <form id="deleteForm-{{ $item->id }}"
                                                                            action="{{ route('application.destroy', $item->id) }}"
                                                                            method="POST"
                                                                           >
                                                                          @csrf
                                                                          @method('DELETE')
                                                                            <button type="button" onclick="showSweetAlert(event, '{{ $item->id }}')"
                                                                                class="btn btn-sm btn-danger">
                                                                            <span class="fe fe-trash-2 fe-16"></span>
                                                                        </button>

                                                                      </form>
                                                                      @else
                                                                      <button
                                                                      class="btn btn-sm btn-danger permission-alert" ><span
                                                                          class="fe fe-trash-2 fe-16 permission-alert"></span></button>
                                                                      @endif


                                                                </div>
                                                            </td>
                                                        </tr>
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
                            </div> <!-- simple table -->

                        </div> <!-- end section -->
                    </div> <!-- .col-12 -->
                </div> <!-- .row -->
            </div> <!-- .container-fluid -->





        </x-app-layout>

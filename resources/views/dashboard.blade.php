<x-app-layout>

            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">

                        <div class="row align-items-center mb-3 border-bottom no-gutters">
                            <div class="col">
                                <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                                            role="tab" aria-controls="home" aria-selected="true">Dashboard</a>
                                    </li>

                                </ul>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-md-6 col-xl-3 mb-4">
                                <div class="card shadow bg-success text-white border-0">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-2 text-center">
                                                <span class="circle circle-sm bg-success-light">
                                                    <i class="fe fe-16 fe-pocket text-white mb-0"></i>
                                                </span>
                                            </div>
                                            <div class="col pr-0">
                                                <p class="small mb-0">Total collections</p>
                                                <span class="h4 mb-0 text-white">TZS {{ number_format( $collection ) }}/=</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3 mb-4">
                                <div class="card shadow bg-success text-white border-0">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-2 text-center">
                                                <span class="circle circle-sm bg-success-light">
                                                    <i class="fe fe-16 fe-pocket text-white mb-0"></i>
                                                </span>
                                            </div>
                                            <div class="col pr-0">
                                                <p class="small mb-0">Collections with Withheld</p>
                                                <span class="h4 mb-0 text-white">TZS {{ number_format( $collection ) }}/=</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3 mb-4">
                                <div class="card shadow bg-danger text-white border-0">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-2 text-center">
                                                <span class="circle circle-sm bg-danger-light">
                                                    <i class="fe fe-16 fe-pocket text-white mb-0"></i>
                                                </span>
                                            </div>
                                            <div class="col pr-0">
                                                <p class="small text-muted mb-0">Total Refund</p>
                                                <span class="h4 mb-0 text-white">TZS 500000/=</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3 mb-4">
                                <div class="card shadow bg-primary text-white border-0">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-2 text-center">
                                                <span class="circle circle-sm bg-primary-light">
                                                    <i class="fe fe-16 fe-pocket text-white mb-0"></i>
                                                </span>
                                            </div>
                                            <div class="col pr-0">
                                                <p class="small text-muted mb-0">Withheld Amount</p>
                                                <span class="h4 mb-0 text-white">TZS 400000/=</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3 mb-4">
                                <div class="card shadow border-0">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-3 text-center">
                                                <span class="circle circle-sm bg-primary">
                                                    <i class="fe fe-16 fe-user text-white mb-0"></i>
                                                </span>
                                            </div>
                                            <div class="col pr-0">
                                                <p class="small text-muted mb-0">Customers</p>
                                                <span class="h3 mb-0">{{ $customerNo }}</span>
                                                <span class="small text-success">{{ $activeCustomer }}- Active</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3 mb-4">
                                <div class="card shadow border-0">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-3 text-center">
                                                <span class="circle circle-sm bg-primary">
                                                    <i class="fe fe-16 fe-users text-white mb-0"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <p class="small text-muted mb-0">Admins</p>
                                                <div class="row align-items-center no-gutters">
                                                    <div class="col-auto">
                                                        <span class="h3 mr-2 mb-0">{{ $adminNo }}</span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3 mb-4">
                                <div class="card shadow border-0">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-3 text-center">
                                                <span class="circle circle-sm bg-danger">
                                                    <i class="fe fe-16 fe-activity text-white mb-0"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <p class="small text-muted mb-0">New Application</p>
                                                <span class="h3 mb-0">{{ $newApplicationNo }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="py-3 text-center">
                                        <p class="text-muted mb-2">Total Application</p>
                                        <h2 class="mb-1">{{ $totalApplication }}</h2>
                                      </div>
                                  <div class="row items-align-center">
                                    <div class="col-4 text-center">
                                      <p class="mb-1 text-danger">Pending</p>
                                      <h5 class="mb-1 text-danger">{{ $newApplicationNo }}</h5>
                                    </div>
                                    <div class="col-4 text-center">
                                      <p class="text-muted mb-1">Active</p>
                                      <h5 class="mb-1">{{ $activeApplicationNo }}</h5>
                                    </div>
                                    <div class="col-4 text-center">
                                      <p class="text-muted mb-1">Full Paid</p>
                                      <h5 class="mb-1">{{ $fullPaidNo }}</h5>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                        </div>
                    </div> <!-- .col-12 -->
                </div> <!-- .row -->
            </div>


</x-app-layout>

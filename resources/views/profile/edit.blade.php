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
                                <div id="collapse1" class="px-3 mb-3">

                                    @include('profile.partials.update-profile-information-form')

                                </div>
                            </div>
                            <div class="card shadow">
                                <div class="card-header" id="heading1">
                                    <a role="button" href="#collapse2" data-toggle="collapse" data-target="#collapse2"
                                        aria-expanded="false" aria-controls="collapse2">
                                        <strong>Security</strong>
                                    </a>
                                </div>
                                <div class="px-3 m-3" >

                                    @include('profile.partials.update-password-form')

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


                                    @include('profile.partials.next-of-kin')

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
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

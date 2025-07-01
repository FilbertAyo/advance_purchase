@if (auth()->check() &&
        auth()->user()->hasAnyRole(['superuser', 'admin', 'cashier', 'delivery']))
    <x-app-layout>

        <div class="alert alert-danger">
            <div class="align-items-center h-100 d-flex w-50 mx-auto">
                <div class="mx-auto text-center">
                    <h2 class="mb-1 font-weight-bold text-danger">Permission Denied!</h2>
                    <h4 class="mb-3 text-muted">You don't have permission to perform this action.</h4>
                    <a href="{{ url()->previous() }}" class="btn btn-lg btn-dark px-5">Go Back</a>
                </div>
            </div>
        </div>

    </x-app-layout>
@else
    @extends('layouts.custapp')

    @section('content')
        <div class="alert alert-danger mx-5">
            <div class="align-items-center h-100 d-flex w-50 mx-auto">
                <div class="mx-auto text-center">
                    <h2 class="mb-1 font-weight-bold text-danger">Permission Denied!</h2>
                    <h4 class="mb-3 text-muted">You don't have permission to perform this action.</h4>
                    <a href="{{ url()->previous() }}" class="btn btn-lg btn-dark px-5">Go Back</a>
                </div>
            </div>
        </div>
    @endsection

@endif

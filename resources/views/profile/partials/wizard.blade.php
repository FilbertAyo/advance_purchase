<div class="col-md-12 my-4">

    @if ($relatives->isNotEmpty())
        <table class="table table-bordered">
            <thead>
                <tr role="row">
                    <th>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="all">
                            <label class="custom-control-label" for="all"></label>
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
                            <strong>{{ ucfirst($relationship) }}</strong>
                        </td>
                    </tr>

                    @foreach ($group as $index => $relative)
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input"
                                        id="relative_{{ $relative->id }}">
                                    <label class="custom-control-label" for="relative_{{ $relative->id }}"></label>
                                </div>
                            </td>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ strtoupper($relative->relative_name) }}</td>
                            <td>{{ $relative->phone_number }}</td>
                            <td>{{ $relative->email }}</td>
                            <td>{{ $relative->address }}</td>
                            <td>
                                <form action="{{ route('relative.destroy', $relative->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this relative?')">
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

{{--
@php
    $currentStep = request()->routeIs('profile.edit')
        ? 'step1'
        : (request()->routeIs('wizard.step2')
            ? 'step2'
            : (request()->routeIs('wizard.step3')
                ? 'step3'
                : null));
@endphp


<script>
    document.addEventListener("DOMContentLoaded", function() {
        @if ($currentStep === 'step1')
            var step1Modal = new bootstrap.Modal(document.getElementById('modal-step1'));
            step1Modal.show();
        @elseif ($currentStep === 'step2')
            var step2Modal = new bootstrap.Modal(document.getElementById('modal-step2'));
            step2Modal.show();
        @elseif ($currentStep === 'step3')
            var step3Modal = new bootstrap.Modal(document.getElementById('modal-step3'));
            step3Modal.show();
        @endif
    });
</script>


@if ($currentStep === 'step1')
    @component('components.wizard-modal', ['title' => 'Step 1: Personal Information'])

    @endcomponent
@endif


@if ($currentStep === 'step2')
    @component('components.wizard-modal', ['title' => 'Step 2   : Identification and Employment'])

    @endcomponent
@endif


@if ($currentStep === 'step3')
    @component('components.wizard-modal', ['title' => 'Step 3   : Next of Kin'])
        
    @endcomponent

@endif --}}

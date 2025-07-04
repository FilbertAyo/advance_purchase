<form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
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
            <h4 class="mb-1 text-uppercase">{{ $user->first_name }}, {{ $user->last_name }}</h4>

            <p class="">ID: <span
                    class="text-danger">{{ $user->userId ?? 'Uknown' }}</span></p>
                    <p>Address: {{ $user->profile->street }},{{ $user->profile->ward }},{{ $user->profile->district }} <br> {{ $user->profile->city }}</p>

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

    <div class="form-group col-md-6">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" class="form-control"
            value="{{ old('email', $user->email) }}" readonly>
    </div>

    <div class="form-group col-md-6">
        <label for="address">Phone number</label>
        <input type="text" id="address" name="phone" class="form-control"
            value="{{ old('phone', $user->phone) }}" readonly>
    </div>
    </div>

</form>

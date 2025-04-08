
<nav class="topnav navbar navbar-light bg-white">

            <ul class="nav">
                <li class="nav-item">
                    <div class="nav-link text-muted my-2">
                       <h4> Advanced Payment</h4>
                    </div>
                </li>
            </ul>
            <ul class="nav">

                <li class="nav-item">
                    <a class="nav-link text-muted my-2" href="./#" data-toggle="modal"
                        data-target=".modal-shortcut">
                        <span class="fe fe-grid fe-16"></span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <div class="nav-link text-muted pr-0 d-flex align-items-center">

                        <!-- Profile Picture on the Left -->
                        <span class="avatar avatar-sm">
                            <img src="{{ asset('images/photo.jpeg') }}" alt="Profile" class="avatar-img rounded-circle">
                        </span>

                        <!-- Name and Email on the Right -->
                        <div class="ml-2 text-left">
                            <div class="font-weight-bold">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
                            <div class="font-weight-light">{{ Auth::user()->phone }}</div>
                        </div>

                    </div>
                </li>

            </ul>
        </nav>

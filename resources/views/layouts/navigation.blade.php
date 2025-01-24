

        <nav class="topnav navbar navbar-light bg-white">

            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="light">
                       <h4> Advanced Payment</h4>
                    </a>
                </li>
            </ul>
            <ul class="nav">

                <li class="nav-item">
                    <a class="nav-link text-muted my-2" href="./#" data-toggle="modal"
                        data-target=".modal-shortcut">
                        <span class="fe fe-grid fe-16"></span>
                    </a>
                </li>
                <li class="nav-item nav-notif">
                    {{-- <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-notif">
                        <span class="fe fe-bell fe-16"></span>
                        <span class="dot dot-md bg-danger"></span>
                    </a> --}}
                </li>
                <li class="nav-item dropdown">
                    <!-- Laravel dropdown integration -->
                    <a class="nav-link text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="avatar avatar-sm mt-2">
                            <img src="{{ asset('images/photo.jpeg') }}" alt="..." class="avatar-img rounded-circle">
                        </span>
                        <div>{{ Auth::user()->first_name }}</div> <!-- Display Laravel user's name -->
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>

                        <!-- Laravel logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>

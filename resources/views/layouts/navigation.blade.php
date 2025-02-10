
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
                    <!-- Laravel dropdown integration -->
                    <a class="nav-link text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="avatar avatar-sm mt-2">
                            <img src="{{ asset('images/photo.jpeg') }}" alt="..." class="avatar-img rounded-circle">
                        </span>
                        <div>{{ Auth::user()->first_name }}</div> <!-- Display Laravel user's name -->
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <div class="dropdown-item">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>


                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <div class="px-3 mt-1">
                                <a class="dropdown-item btn bg-danger text-white " href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                            </div>

                        </form>
                    </div>
                </li>
            </ul>
        </nav>

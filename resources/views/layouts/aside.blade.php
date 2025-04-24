<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">

        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ url('/dashboard') }}">
                <img src="{{ asset('images/marslogo.png') }}" class="navbar-brand-img" alt="" style="height: 60px">
            </a>
        </div>

        <ul class="navbar-nav flex-fill w-100">
            <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                <a href="{{ url('/dashboard') }}" class="nav-link">
                    <i class="fe fe-home fe-16"></i>
                    <span class="ml-3 item-text">Dashboard</span>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav flex-fill w-100">
            <li class="nav-item dropdown {{ Request::is('user', 'address*', 'bank') ? 'active' : '' }}">
                <a href="#settings" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-settings fe-16"></i>
                    <span class="ml-3 item-text">Settings</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="settings">
                    <li class="nav-item {{ Request::is('user') ? 'active' : '' }}">
                        <a class="nav-link pl-3" href="{{ url('/user') }}">
                            <span class="ml-1 item-text">All Users</span>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('address*') ? 'active' : '' }}">
                        <a class="nav-link pl-3" href="{{ route('address.index') }}">
                            <span class="ml-1 item-text">Address</span>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('bank') ? 'active' : '' }}">
                        <a class="nav-link pl-3" href="{{ url('/bank') }}">
                            <span class="ml-1 item-text">Bank</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <p class="text-muted nav-heading mt-4 mb-1"><span>Manage Assets</span></p>

        <ul class="navbar-nav flex-fill w-100">
            <li class="nav-item dropdown {{ Request::is('item*') ? 'active' : '' }}">
                <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-archive fe-16"></i>
                    <span class="ml-3 item-text">Items</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="dashboard">
                    <li class="nav-item {{ Request::is('item*') ? 'active' : '' }}">
                        <a class="nav-link pl-3" href="{{ route('item.index') }}">
                            <span class="ml-1 item-text">Item List</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <p class="text-muted nav-heading mt-4 mb-1"><span>Management</span></p>

        <ul class="navbar-nav flex-fill w-100">
            <li class="nav-item dropdown {{ Request::is('customer*', 'unverified') ? 'active' : '' }}">
                <a href="#customer" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-users fe-16"></i>
                    <span class="ml-3 item-text">Customers</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="customer">
                    <a class="nav-link pl-3 {{ Request::is('customer*') ? 'active' : '' }}" href="{{ route('customer.index') }}">
                        <span class="ml-1">Active Customers</span>
                    </a>
                    <a class="nav-link pl-3 {{ Request::is('unverified') ? 'active' : '' }}" href="{{ url('/unverified') }}">
                        <span class="ml-1">Requests</span>
                    </a>
                </ul>
            </li>
            <li class="nav-item dropdown {{ Request::is('application*') ? 'active' : '' }}">
                <a href="#contact" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-book fe-16"></i>
                    <span class="ml-3 item-text">Application</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="contact">
                    <a class="nav-link pl-3 {{ Request::is('application') ? 'active' : '' }}" href="{{ route('application.index') }}">
                        <span class="ml-1">Active Application</span>
                    </a>
                    <a class="nav-link pl-3 {{ Request::is('application/inactive') ? 'active' : '' }}" href="{{ route('application.inactive') }}">
                        <span class="ml-1">Pending</span>
                    </a>
                </ul>
            </li>
        </ul>

        <p class="text-muted nav-heading mt-4 mb-1"><span>Deliveries</span></p>

        <ul class="navbar-nav flex-fill w-100">
            <li class="nav-item {{ Request::is('deliveries') ? 'active' : '' }}">
                <a href="{{ url('/deliveries') }}" class="nav-link">
                    <i class="fe fe-check-square fe-16"></i>
                    <span class="ml-3 item-text">Delivery</span>
                </a>
            </li>
        </ul>

        <p class="text-muted nav-heading mt-4 mb-1"><span>Assessment and Reports</span></p>

        <ul class="navbar-nav flex-fill w-100">
            <li class="nav-item dropdown {{ Request::is('report*', 'maintenance') ? 'active' : '' }}">
                <a href="#pages" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-file fe-16"></i>
                    <span class="ml-3 item-text">Reports</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="pages">
                    <li class="nav-item {{ Request::is('report/statements') ? 'active' : '' }}">
                        <a class="nav-link pl-3" href="{{ route('report.statements') }}">
                            <span class="ml-1 item-text">Statements</span>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('report/outstanding') ? 'active' : '' }}">
                        <a class="nav-link pl-3" href="{{ route('report.outstanding') }}">
                            <span class="ml-1 item-text">Outstanding</span>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('report/paid') ? 'active' : '' }}">
                        <a class="nav-link pl-3" href="{{ route('report.paid') }}">
                            <span class="ml-1 item-text">Full Paid</span>
                        </a>
                    </li>

                </ul>
            </li>
        </ul>

        <form method="POST" action="{{ route('logout') }}" class="mt-auto">
            @csrf
            <x-primary-button label="Logout" class="w-100 mt-3 btn-danger"/>
        </form>

    </nav>
</aside>

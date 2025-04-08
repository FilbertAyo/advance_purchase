<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <!-- nav bar -->
        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ url('/dashboard') }}">

                <img src="{{ asset('images/marslogo.png') }}" class="navbar-brand-img" alt=""
                    style="height: 60px">
            </a>
        </div>

        <ul class="navbar-nav flex-fill w-100">
            <li class="nav-item active">
                <a href="{{ url('/dashboard') }}" class=" nav-link">
                    <i class="fe fe-home fe-16"></i>
                    <span class="ml-3 item-text">Dashboard</span>

                </a>

            </li>
        </ul>
        <ul class="navbar-nav flex-fill w-100">
            <li class="nav-item dropdown">
                <a href="#settings" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-settings fe-16"></i>
                    <span class="ml-3 item-text">Settings</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100 w-100" id="settings">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ url('/user') }}">
                            <span class="ml-1 item-text">All Users</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('address.index') }}">
                            <span class="ml-1 item-text">Address</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ url('/bank') }}">
                            <span class="ml-1 item-text">Bank</span>
                        </a>
                    </li>

                </ul>
            </li>
        </ul>

        <p class="text-muted nav-heading mt-4 mb-1">
            <span>Manage Assets</span>
        </p>


        <ul class="navbar-nav flex-fill w-100">
            <li class="nav-item dropdown">
                <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-archive fe-16"></i>
                    <span class="ml-3 item-text">Items</span><span class="sr-only">(current)</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="dashboard">
                    <li class="nav-item active">
                        <a class="nav-link pl-3" href="{{ route('item.index') }}"><span class="ml-1 item-text">Item
                                List</span></a>
                    </li>

                </ul>
            </li>

        </ul>
        <p class="text-muted nav-heading mt-4 mb-1">
            <span>Management</span>
        </p>
        <ul class="navbar-nav flex-fill w-100">

            <li class="nav-item dropdown">
                <a href="#customer" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-users fe-16"></i>
                    <span class="ml-3 item-text">Customers</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="customer">
                    <a class="nav-link pl-3" href="{{ route('customer.index') }}"><span class="ml-1">Active
                            Customers</span></a>
                    <a class="nav-link pl-3" href="{{ url('/unverified') }}"><span class="ml-1">Requests</span></a>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#contact" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-book fe-16"></i>
                    <span class="ml-3 item-text">Application</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="contact">

                    <a class="nav-link pl-3" href="{{ route('application.index') }}"><span class="ml-1">Active
                            Application</span></a>
                    <a class="nav-link pl-3" href="{{ route('application.inactive') }}"><span
                            class="ml-1">Pending</span></a>
                </ul>
            </li>
        </ul>
        <p class="text-muted nav-heading mt-4 mb-1">
            <span>Deliveries </span>
        </p>
        <ul class="navbar-nav flex-fill w-100">
            <li class="nav-item dropdown">
                <a href="{{ url('/deliveries') }}" aria-expanded="false" class="nav-link">
                    <i class="fe fe-check-square fe-16"></i>
                    <span class="ml-3 item-text">Delivery</span>
                </a>
            </li>
        </ul>

        <p class="text-muted nav-heading mt-4 mb-1">
            <span>Assessment and Reports</span>
        </p>
        <ul class="navbar-nav flex-fill w-100">
            <li class="nav-item dropdown">
                <a href="#pages" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe fe-file fe-16"></i>
                    <span class="ml-3 item-text">Reports</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100 w-100" id="pages">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('report.statements') }}">
                            <span class="ml-1 item-text">Statements</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('report.outstanding') }}">
                            <span class="ml-1 item-text">Outstanding</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('report.paid') }}">
                            <span class="ml-1 item-text">Full Paid</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('maintenance') }}">
                            <span class="ml-1 item-text">Detailed Report</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('maintenance') }}">
                            <span class="ml-1 item-text">Summarized Report</span>
                        </a>
                    </li>

                </ul>
            </li>
        </ul>


        <!-- Logout Button at Bottom -->
        <form method="POST" action="{{ route('logout') }}" class="mt-auto">
            @csrf
            <div class="mt-3">
                <a class="btn bg-danger text-white w-100" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </a>
            </div>
        </form>
    </nav>
</aside>

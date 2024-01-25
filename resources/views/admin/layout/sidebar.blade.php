<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('admin/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (!empty(Auth::guard('admin')->user()->image))
                    @php
                        $imageName = Auth::guard('admin')->user()->image;
                    @endphp
                    <img src="{{ url('admin/img/photos/' . $imageName) }}" class="elevation-2" alt="User Image"
                        style="width: 50px;height: 50px;border-radius: 50%;object-fit: cover;">
                @else
                    <img src="{{ asset('admin/img/user2-160x160.jpg') }}" class="elevation-2"
                        style="width: 50px;height: 50px;border-radius: 50%;object-fit: cover;" alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
                <span class="d-block text-secondary">{{ ucfirst(Auth::guard('admin')->user()->type) }}</span>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                @if (Session::get('page') === 'dashboard')
                    @php
                        $active = 'active';
                    @endphp
                @else
                    @php
                        $active = '';
                    @endphp
                @endif
                <li class="nav-item">
                    <a href="{{ url('admin/dashboard') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @if (Session::get('page') === 'update-password' || Session::get('page') === 'update-admin-details')
                    @php
                        $active = 'active';
                        $menu = 'menu-open';
                    @endphp
                @else
                    @php
                        $active = '';
                        $menu = '';
                    @endphp
                @endif
                <li class="nav-item {{ $menu }}">
                    <a href="#" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            @if (Session::get('page') === 'update-password')
                                @php
                                    $active = 'active';
                                @endphp
                            @else
                                @php
                                    $active = '';
                                @endphp
                            @endif
                            <a href="{{ url('admin/update-password') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Update Admin Password</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            @if (Session::get('page') === 'update-admin-details')
                                @php
                                    $active = 'active';
                                @endphp
                            @else
                                @php
                                    $active = '';
                                @endphp
                            @endif
                            <a href="{{ url('admin/update-admin-details') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Update Admin Details</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @if (Session::get('page') === 'cms-pages')
                    @php
                        $active = 'active';
                    @endphp
                @else
                    @php
                        $active = '';
                    @endphp
                @endif
                <li class="nav-item">
                    <a href="{{ url('admin/cms-pages') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Cms Pages
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

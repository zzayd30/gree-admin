<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('admin/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Panel</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                {{-- @can('view-permission')
                    <li class="nav-item  {{ request()->is('admin/permission') ? 'active' : '' }}">
                        <a href="{{ route('admin.permission') }}" class="nav-link">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Permissions</p>
                        </a>
                    </li>
                @endcan
                @can('view-role')
                    <li class="nav-item {{ request()->is('admin/role') ? 'active' : '' }}">
                        <a href="{{ route('admin.role') }}" class="nav-link">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Role</p>
                        </a>
                    </li>
                @endcan
                @can('view-user')
                    <li class="nav-item {{ request()->is('admin/users') ? 'active' : '' }}">
                        <a href="{{ route('admin.users') }}" class="nav-link">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Users</p>
                        </a>
                    </li>
                @endcan --}}
                <li class="nav-item {{ request()->is('/logout') ? 'active' : '' }}">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

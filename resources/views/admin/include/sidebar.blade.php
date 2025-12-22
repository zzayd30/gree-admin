<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('admin/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Users -->
                <li class="nav-item {{ request()->is('admin/users*') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>

                <!-- Roles -->
                <li class="nav-item {{ request()->is('admin/roles*') ? 'active' : '' }}">
                    <a href="{{ route('roles.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-shield"></i>
                        <p>Roles</p>
                    </a>
                </li>

                <!-- Permissions -->
                <li class="nav-item {{ request()->is('admin/permissions*') ? 'active' : '' }}">
                    <a href="{{ route('permissions.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-key"></i>
                        <p>Permissions</p>
                    </a>
                </li>

                <!-- Logout -->
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link text-center">
        <img src="{{ asset('images/gree-logo.png') }}" alt="Gree Logo" class="brand-image img-fluid" style="float: none; max-height: 40px;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th-large"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Users -->
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users Management</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('customers.index') }}" class="nav-link {{ request()->is('admin/customers*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Customer Management</p>
                    </a>
                </li>

                <!-- Roles -->
                <li class="nav-item">
                    <a href="{{ route('roles.index') }}" class="nav-link {{ request()->is('admin/roles*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-tag"></i>
                        <p>Roles</p>
                    </a>
                </li>

                <!-- Permissions -->
                <li class="nav-item">
                    <a href="{{ route('permissions.index') }}" class="nav-link {{ request()->is('admin/permissions*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shield-alt"></i>
                        <p>Permissions</p>
                    </a>
                </li>

                <!-- Categories -->
                <li class="nav-item {{ request()->is('admin/categories*') ? 'active' : '' }}">
                    <a href="{{ route('categories.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>Categories</p>
                    </a>
                </li>

                <!-- Videos -->
                <li class="nav-item {{ request()->is('admin/videos*') ? 'active' : '' }}">
                    <a href="{{ route('videos.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-video"></i>
                        <p>Videos</p>
                    </a>
                </li>

                <!-- Profile -->
                <li class="nav-item {{ request()->is('profile') ? 'active' : '' }}">
                    <a href="{{ route('profile.edit') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p>My Profile</p>
                    </a>
                </li>


                <!-- Divider -->
                <li class="nav-header text-uppercase px-4" style="font-size: 0.7rem; color: rgba(255,255,255,0.4);">Account</li>

                <!-- Logout -->
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" id="logout-form">
                        @csrf
                        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="nav-icon fas fa-power-off"></i>
                            <p>Logout</p>
                        </a>
                    </form>
                </li>

            </ul>
        </nav>
    </div>
</aside>
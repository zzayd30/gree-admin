<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Right navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <div class="navbar-nav pl-2">
        <!-- <ol class="breadcrumb p-0 m-0 bg-white">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol> -->
    </div>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link p-0 pe-3" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('admin/img/avatar5.png') }}" class="img-circle elevation-2" width="40"
                    height="40" alt="User Avatar">
            </a>

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg p-3">
                <li>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-user-cog me-2"></i> Settings
                    </a>
                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-lock me-2"></i> Change Password
                    </a>
                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>
                    <a href="{{ route('logout') }}" class="dropdown-item text-danger">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </a>
                </li>
            </ul>
        </li>


    </ul>
</nav>

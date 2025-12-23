@extends('admin.layout.app')
@section('title', 'Admin Dashboard')

@section('content')
<style>
    /* Background contrast theek karne ke liye */
    .content-wrapper {
        background-color: var(--secondary-color) !important; /* Boss's secondary color */
    }

    .dashboard-header h1 {
        color: var(--primary-color);
        font-weight: 800;
        margin-bottom: 0;
    }

    /* Modern Glassy Cards */
    .modern-card {
        background: #ffffff;
        border: none;
        border-radius: 24px;
        padding: 30px;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        height: 100%;
        position: relative;
        overflow: hidden;
        border-top: 4px solid var(--primary-color); /* Top accent line */
    }

    .modern-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(36, 58, 127, 0.12);
    }

    /* Icon Circle */
    .icon-circle {
        width: 65px;
        height: 65px;
        background-color: var(--primary-color-light);
        border-radius: 50%; /* Circle shape */
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        transition: 0.3s;
    }

    .modern-card:hover .icon-circle {
        background-color: var(--primary-color);
    }

    .modern-card:hover .icon-circle i {
        color: #ffffff;
    }

    .icon-circle i {
        font-size: 24px;
        color: var(--primary-color);
    }

    /* Text Elements */
    .stat-value {
        font-size: 32px;
        font-weight: 850;
        color: var(--primary-color);
        line-height: 1;
        margin-bottom: 8px;
    }

    .stat-label {
        color: #8492a6;
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Footer Details Button */
    .btn-details {
        margin-top: 20px;
        display: inline-flex;
        align-items: center;
        color: var(--primary-color);
        font-weight: 700;
        text-decoration: none !important;
        font-size: 14px;
        opacity: 0.8;
    }

    .btn-details:hover {
        opacity: 1;
    }

    .btn-details i {
        margin-left: 8px;
        font-size: 12px;
    }
</style>

<div class="content-header px-4">
    <div class="container-fluid">
        <div class="row mb-4 pt-4">
            <div class="col-sm-6">
                <div class="dashboard-header">
                    <h1>Dashboard Overview</h1>
                    <p class="text-muted mt-2">Welcome back! Here's what's happening with Gree today.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="content px-4">
    <div class="container-fluid">
        <div class="row">
            <!-- Total Orders -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="modern-card">
                    <div class="icon-circle">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div>
                        <h3 class="stat-value">150</h3>
                        <p class="stat-label">Total Orders</p>
                    </div>
                    <a href="#" class="btn-details">
                        More Information <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Total Customers -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="modern-card">
                    <div class="icon-circle">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div>
                        <h3 class="stat-value">50</h3>
                        <p class="stat-label">Total Customers</p>
                    </div>
                    <a href="#" class="btn-details">
                        Manage Users <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Total Sale -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="modern-card">
                    <div class="icon-circle">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div>
                        <h3 class="stat-value">$1,000</h3>
                        <p class="stat-label">Total Sale</p>
                    </div>
                    <a href="#" class="javascript:void(0);" class="btn-details">
                        Revenue Report <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
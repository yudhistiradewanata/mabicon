<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="/" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?=base_url('assets/images/logo.webp')?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?=base_url('assets/images/logo.webp')?>" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="/" class="logo logo-light">
            <span class="logo-sm">
                <img src="<?=base_url('assets/images/logo.webp')?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?=base_url('assets/images/logo.webp')?>" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="nav-item">
                    <a href="<?=site_url('member/dashboard')?>" class="nav-link">
                        <i class="ri-pie-chart-line"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=site_url('member/account')?>" class="nav-link">
                        <i class="ri-dashboard-2-line"></i> <span>Account Balance</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=site_url('member/topup')?>" class="nav-link">
                        <i class="ri-coins-fill"></i> <span>Deposit</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=site_url('member/withdrawal')?>" class="nav-link">
                        <i class="ri-exchange-dollar-line"></i> <span>Withdrawal</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=site_url('member/trading')?>" class="nav-link">
                        <i class="ri-funds-line"></i> <span>Trading</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=site_url('member/news')?>" class="nav-link">
                        <i class="ri-newspaper-line"></i> <span>News</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
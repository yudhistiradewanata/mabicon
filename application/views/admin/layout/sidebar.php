<?php $countBadge=getAdminCountBadge()?>
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
                    <a href="<?=site_url('admin/dashboard')?>" class="nav-link active">
                        <i class="ri-pie-chart-line"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=site_url('admin/client-management')?>" class="nav-link">
                        <i class="ri-dashboard-2-line"></i> <span>Users</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=site_url('admin/trading-account-management')?>" class="nav-link">
                        <i class="ri-dashboard-2-line"></i> <span>Account Request</span>
                        &nbsp;<span class="topbar-badge fs-10 translate-middle badge rounded-pill bg-danger"><?=$countBadge['countPendingAccount']?></span>
                    </a>

                </li>
                
                <li class="nav-item">
                    <a href="<?=site_url('admin/kyc-management')?>" class="nav-link">
                        <i class="ri-dashboard-2-line"></i> <span>KYC Request</span>
                        &nbsp;<span class="topbar-badge fs-10 translate-middle badge rounded-pill bg-danger"><?=$countBadge['countPendingKyc']?></span>
                    </a>

                </li>
                <!-- <li class="nav-item">
                    <a href="<?=site_url('admin/trading-management')?>" class="nav-link">
                        <i class="ri-coins-fill"></i> <span>Trades</span>
                    </a>
                </li> -->
                <!-- <li class="nav-item">
                    <a href="<?=site_url('admin/balance-management')?>" class="nav-link">
                        <i class="ri-wallet-line"></i> <span>Account Balances</span>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="ri-account-circle-line"></i> <span data-key="t-authentication">Deposit & WD</span>
                        &nbsp;<span class="topbar-badge fs-10 translate-middle badge rounded-pill bg-danger"><?=$countBadge['countPendingTransaction']?></span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAuth">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?=site_url('admin/transaction-management/pending')?>" class="nav-link">
                                    <i class="ri-exchange-dollar-line"></i> <span>Pending Request</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=site_url('admin/transaction-management/pendingtransferwithdrawal')?>" class="nav-link">
                                    <i class="ri-exchange-line"></i> <span>Pending Transfer WD</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=site_url('admin/transaction-management/index')?>" class="nav-link">
                                    <i class="ri-chat-history-line"></i> <span>All History</span>
                                </a>
                            </li>
                        </ul>
                    </div>
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
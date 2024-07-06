<div class="row mb-3 pb-1">
    <div class="col-12">
        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-16 mb-1">Good Day, <?= getSession('full_name') ?>!</h4>
                <p class="text-muted mb-0">Here's what's happening with your account today.</p>
            </div>
            <div class="mt-3 mt-lg-0">
                
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xxl-3 col-md-6">
        <div class="card card-animate" onclick="location.href='<?= site_url('admin/client-management') ?>'">
            <div class="card-body">
                <div class="d-flex mb-3">
                    <div class="flex-grow-1">
                        <lord-icon src="https://cdn.lordicon.com/fhtaantg.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:55px;height:55px"></lord-icon>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="javascript:void(0);" class="badge bg-warning-subtle text-warning badge-border">USD</a>
                    </div>
                </div>
                <h3 class="mb-2"><?= number_format($currentBalancesOverview, 2) ?></h3>
                <h6 class="text-muted mb-0">All Users Balance</h6>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-md-6">
        <div class="card card-animate" onclick="location.href='<?= site_url('admin/trading-management') ?>'">
            <div class="card-body">
                <div class="d-flex mb-3">
                    <div class="flex-grow-1">
                        <lord-icon src="https://cdn.lordicon.com/qhviklyi.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:55px;height:55px"></lord-icon>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="javascript:void(0);" class="badge bg-warning-subtle text-warning badge-border">USD</a>
                    </div>
                </div>
                <!-- <h3 class="mb-2"><?= number_format($totalPnl, 2) ?></h3> -->
                <h3 class="mb-2">Coming Soon...</h3>
                <h6 class="text-muted mb-0">Total PnL</h6>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-md-6">
        <div class="card card-animate" onclick="location.href='<?= site_url('admin/bonus-management') ?>'">
            <div class="card-body">
                <div class="d-flex mb-3">
                    <div class="flex-grow-1">
                        <lord-icon src="https://cdn.lordicon.com/yeallgsa.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:55px;height:55px"> </lord-icon>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="javascript:void(0);" class="badge bg-warning-subtle text-warning badge-border">USD</a>
                    </div>
                </div>
                <!-- <h3 class="mb-2"><?= number_format($totalBonusesDistributed, 2) ?></h3> -->
                <h3 class="mb-2">Coming Soon...</h3>
                <h6 class="text-muted mb-0">Total Bonuses Distributed</h6>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-md-6">
        <div class="card card-animate" onclick="location.href='<?= site_url('admin/trading-management') ?>'">
            <div class="card-body">
                <div class="d-flex mb-3">
                    <div class="flex-grow-1">
                        <lord-icon src="https://cdn.lordicon.com/vaeagfzc.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:55px;height:55px"></lord-icon>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="javascript:void(0);" class="badge bg-warning-subtle text-warning badge-border">USD</a>
                    </div>
                </div>
                <!-- <h3 class="mb-2"><?= number_format($totalOpenTrade, 2) ?></h3> -->
                <h3 class="mb-2">Coming Soon...</h3>
                <h6 class="text-muted mb-0">Total Open Trades</h6>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Users</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <h6>Last 7 Days</h6>
                        <p class="mb-0"><?= $newUsersLast7Days ?></p>
                    </div>
                    <div class="col-4">
                        <h6>Last 30 Days</h6>
                        <p class="mb-0"><?= $newUsersLast30Days ?></p>
                    </div>
                    <div class="col-4">
                        <h6>All Active Users</h6>
                        <p class="mb-0"><?= $activeUsers ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Deposits & Withdrawals</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h6>Total Deposits</h6>
                        <p class="mb-0"><?= number_format($totalDeposits, 2) ?></p>
                    </div>
                    <div class="col-6">
                        <h6>Pending Deposits</h6>
                        <p class="mb-0"><?= number_format($totalPendingDeposits, 2) ?></p>
                    </div>
                    <div class="col-6 mt-3">
                        <h6>Total Withdrawals</h6>
                        <p class="mb-0"><?= number_format($totalWithdrawals, 2) ?></p>
                    </div>
                    <div class="col-6 mt-3">
                        <h6>Pending Withdrawals</h6>
                        <p class="mb-0"><?= number_format($totalPendingWithdrawals, 2) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Recent Trades</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive table-card">
                    <table class="table align-middle table-nowrap" id="trades-dt">
                        <thead class="table-light text-muted">
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Trade Date</th>
                                <th scope="col">Asset</th>
                                <th scope="col">Order</th>
                                <th scope="col">Status</th>
                                <th scope="col">Margin</th>
                                <th scope="col">Lot</th>
                                <th scope="col">Open</th>
                                <th scope="col">Close</th>
                                <th scope="col">PnL</th>
                                <th scope="col">Rebate</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentTrades as $i => $trade): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= date('Y-m-d H:i:s', strtotime($trade->trade_date)) ?></td>
                                    <td><?= $trade->asset ?></td>
                                    <td><?= $trade->order ?></td>
                                    <td><?= $trade->trade_status ?></td>
                                    <td><?= number_format($trade->margin, 2) ?></td>
                                    <td><?= number_format($trade->lot, 2) ?></td>
                                    <td><?= number_format($trade->open_price, 2) ?></td>
                                    <td><?= number_format($trade->close_price, 2) ?></td>
                                    <td><?= number_format($trade->pnl, 2) ?></td>
                                    <td><?= number_format($trade->rebate, 2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <script>
                        $(document).ready(function() {
                            $('#trades-dt').DataTable();
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>

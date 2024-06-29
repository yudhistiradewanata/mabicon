<div class="row mb-3 pb-1">
    <div class="col-12">
        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-16 mb-1">Good Day, <?=getSession('full_name')?>!</h4>
                <p class="text-muted mb-0">Here's what's happening with your account today.</p>
            </div>
            <div class="mt-3 mt-lg-0">
                <?=form_open('member/dashboard')?>
                    <div class="row g-3 mb-0 align-items-center">
                        <div class="col-sm-auto">
                            <div class="input-group">
                                <input type="text" class="form-control border-0 minimal-border dash-filter-picker shadow" data-provider="flatpickr" data-range-date="true" data-date-format="Y-m-d" data-deafult-date="<?=$startDate.' to '.$endDate?>" name="date_choice">
                                <div class="input-group-text bg-primary border-primary text-white">
                                    <i class="ri-calendar-2-line"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-soft-success material-shadow-none"><i class="ri-search-line align-middle me-1"></i> Search</button>
                        </div>
                        
                    </div>
                <?=form_close()?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card crm-widget">
            <div class="card-body p-0">
                <div class="row row-cols-xxl-5 row-cols-md-3 row-cols-1 g-0">
                    <div class="col">
                        <div class="py-4 px-3 pointer-box" onclick="location.href='<?=site_url('member/account')?>'">
                            <h5 class="text-muted text-uppercase fs-13">Account Balance <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i></h5>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="ri-space-ship-line display-6 text-muted cfs-22"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h2 class="mb-0 cfs-22">$<span class="counter-value" data-target="<?=$balanceSummary->total_balance?>">0</span></h2>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->
                    <div class="col">
                        <div class="mt-3 mt-md-0 py-4 px-3 pointer-box" onclick="location.href='<?=site_url('member/trading')?>'">
                            <h5 class="text-muted text-uppercase fs-13">PnL <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i></h5>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="ri-exchange-dollar-line display-6 text-muted cfs-22"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h2 class="mb-0 cfs-22">$<span class="counter-value" data-target="<?=$tradingSummary->total_pnl?>">0</span></h2>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->
                    <div class="col">
                        <div class="mt-3 mt-md-0 py-4 px-3 pointer-box" onclick="location.href='<?=site_url('member/trading')?>'">
                            <h5 class="text-muted text-uppercase fs-13">Daily Average PnL <i class="ri-arrow-down-circle-line text-danger fs-18 float-end align-middle"></i></h5>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="ri-pulse-line display-6 text-muted cfs-22"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h2 class="mb-0 cfs-22">$<span class="counter-value" data-target="<?=$tradingSummary->total_pnl/$tradingSummary->total_trades?>">0</span></h2>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->
                    <div class="col">
                        <div class="mt-3 mt-lg-0 py-4 px-3 pointer-box" onclick="location.href='<?=site_url('member/bonus')?>'">
                            <h5 class="text-muted text-uppercase fs-13">Bonus <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i></h5>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="ri-trophy-line display-6 text-muted cfs-22"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h2 class="mb-0 cfs-22">$<span class="counter-value" data-target="<?=$bonusSummary->total_bonus?>">0</span></h2>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->
                    <div class="col">
                        <div class="mt-3 mt-lg-0 py-4 px-3 pointer-box" onclick="location.href='<?=site_url('member/kyc')?>'">
                            <h5 class="text-muted text-uppercase fs-13">KYC Status  <i class="ri-arrow-down-circle-line text-danger fs-18 float-end align-middle"></i></h5>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="ri-service-line display-6 text-muted cfs-22"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h2 class="mb-0 cfs-22"><?=strtoupper($kycStatus)?></h2>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->
<div class="row">
    <div class="col-xl-7">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Latest Trades</h4>
                <div class="flex-shrink-0">
                    <a href="<?=site_url('member/trading')?>" class="text-muted text-decoration-underline">Show All</a>
                </div>
            </div><!-- end card header -->

            <div class="card-body">
                <div class="table-responsive table-card">
                    <table class="table table-borderless table-hover table-nowrap align-middle mb-0">
                        <thead class="table-light">
                            <tr class="text-muted">
                                <th scope="col">Date</th>
                                <th scope="col">Asset</th>
                                <th scope="col">Order</th>
                                <th scope="col">Margin</th>
                                <th scope="col">Lot</th>
                                <th scope="col">Open Price</th>
                                <th scope="col">Status</th>
                                <th scope="col">Close Price</th>
                                <th scope="col">PnL</th>
                                <th scope="col">Rebate</th>

                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach($trades as $row){?>
                                <tr>
                                    <td><?=dmy($row->trade_date)?></td>
                                    <td><?=$row->asset?></td>
                                    <td><?=strtoupper($row->order)?></td>
                                    <td><?=number_format($row->margin);?></td>
                                    <td><?=number_format($row->lot,4);?></td>
                                    <td><?=number_format($row->open_price,4);?></td>
                                    <td><?=$row->trade_status;?></td>
                                    <td><?=number_format($row->close_price,4);?></td>
                                    <td><?=number_format($row->pnl,2);?></td>
                                    <td><?=number_format($row->rebate,2);?></td>
                                </tr>
                            <?php } ?>
                        </tbody><!-- end tbody -->
                    </table><!-- end table -->
                </div><!-- end table responsive -->
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->

    <div class="col-xl-5">
        <div class="card card-height-100">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Transaction History</h4>
                <div class="flex-shrink-0">
                    <div class="flex-shrink-0">
                        <a href="<?=site_url('member/transaction')?>" class="text-muted text-decoration-underline">Show All</a>
                    </div>
                </div>
            </div><!-- end card header -->

            <div class="card-body p-0">

                <div class="align-items-center p-3 justify-content-between d-flex">
                    
                </div><!-- end card header -->

                <div data-simplebar style="max-height: 219px;">
                    <ul class="list-group list-group-flush border-dashed px-3">
                        <?php foreach($transactions as $row){?>
                        <li class="list-group-item ps-0">
                            <div class="d-flex align-items-start">
                                <div class="form-check ps-0 flex-sharink-0">
                                    <input type="checkbox" class="form-check-input ms-0">
                                </div>
                                <div class="flex-grow-1">
                                    <label class="form-check-label mb-0 ps-2"><?=ucwords($row->transaction_type).' of $'.number_format($row->amount)?></label>
                                </div>
                                <div class="flex-shrink-0 ms-2">
                                    <p class="text-muted fs-12 mb-0"><?=dmy($row->transaction_date)?></p>
                                </div>
                            </div>
                        </li>
                        <?php } ?>
                    </ul><!-- end ul -->
                </div>
                <div class="p-3 pt-2">
                    
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->
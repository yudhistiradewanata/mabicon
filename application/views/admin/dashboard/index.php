<div class="row mb-3 pb-1">
    <div class="col-12">
        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-16 mb-1">Good Day, <?=getSession('full_name')?>!</h4>
                <p class="text-muted mb-0">Here's what's happening with your account today.</p>
            </div>
            <div class="mt-3 mt-lg-0">
                <?=form_open('admin/dashboard')?>
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
    <div class="col-xxl-3 col-md-6">
        <div class="card card-animate" onclick="location.href='<?=site_url('admin/account')?>'">
            <div class="card-body">
                <div class="d-flex mb-3">
                    <div class="flex-grow-1">
                        <lord-icon src="https://cdn.lordicon.com/fhtaantg.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:55px;height:55px"></lord-icon>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="javascript:void(0);" class="badge bg-warning-subtle text-warning badge-border">USD</a>
                    </div>
                </div>
                <h3 class="mb-2">$<span class="counter-value" data-target="<?=$balanceSummary->total_balance?>">0</span><small class="text-muted fs-13"></small></h3>
                <h6 class="text-muted mb-0">Account Balance</h6>
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->
    <div class="col-xxl-3 col-md-6">
        <div class="card card-animate" onclick="location.href='<?=site_url('admin/trading')?>'">
            <div class="card-body">
                <div class="d-flex mb-3">
                    <div class="flex-grow-1">
                        <lord-icon src="https://cdn.lordicon.com/qhviklyi.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:55px;height:55px"></lord-icon>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="javascript:void(0);" class="badge bg-warning-subtle text-warning badge-border">USD</a>
                    </div>
                </div>
                <h3 class="mb-2">$<span class="counter-value" data-target="<?=$tradingSummary->total_pnl?>">0</span><small class="text-muted fs-13"></small></h3>
                <h6 class="text-muted mb-0">Total PnL</h6>
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->
    <div class="col-xxl-3 col-md-6">
        <div class="card card-animate" onclick="location.href='<?=site_url('admin/bonus')?>'">
            <div class="card-body">
                <div class="d-flex mb-3">
                    <div class="flex-grow-1">
                        <lord-icon src="https://cdn.lordicon.com/yeallgsa.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:55px;height:55px"> </lord-icon>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="javascript:void(0);" class="badge bg-warning-subtle text-warning badge-border">USD</a>
                    </div>
                </div>
                <h3 class="mb-2">$<span class="counter-value" data-target="<?=$bonusSummary->total_bonus?>">0</span><small class="text-muted fs-13"></small></h3>
                <h6 class="text-muted mb-0">Total Bonus</h6>
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->
    <div class="col-xxl-3 col-md-6">
        <div class="card card-animate" onclick="location.href='<?=site_url('admin/bonus')?>'">
            <div class="card-body">
                <div class="d-flex mb-3">
                    <div class="flex-grow-1">
                        <lord-icon src="https://cdn.lordicon.com/vaeagfzc.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:55px;height:55px"></lord-icon>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="javascript:void(0);" class="badge bg-warning-subtle text-warning badge-border">USD</a>
                    </div>
                </div>
                <h3 class="mb-2">$<span class="counter-value" data-target="<?=$tradingSummary->total_margin?>">0</span><small class="text-muted fs-13"></small></h3>
                <h6 class="text-muted mb-0">Trading Volume</h6>
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->
</div>
<!--end row-->

<div class="row align-items-center mb-4 g-3">
    <!--end col-->
    <div class="col-sm-auto ms-auto">
        <div class="d-flex gap-2">
            <a href="<?=site_url('admin/topup')?>" class="btn btn-info">Deposit</a>
            <a href="<?=site_url('admin/withdrawal')?>" class="btn btn-danger">Withdraw</a>
        </div>
    </div>
    <!--end col-->
</div>
<!--end row-->

<div class="card" id="contactList">
    <div class="card-header">
        <div class="row align-items-center g-3">
            <div class="col-md-3">
                <h5 class="card-title mb-0">Trade Histories</h5>
            </div>
            <!--end col-->
            <div class="col-md-auto ms-auto">
                <div class="d-flex gap-2">
                    <div class="search-box">
                        <input type="text" class="form-control search" placeholder="Search for transactions...">
                        <i class="ri-search-line search-icon"></i>
                    </div>
                    
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end card-header-->
    <div class="card-body">
        <div class="table-responsive table-card">
            <table class="table align-middle table-nowrap" id="main-dt">
                <thead class="table-light text-muted">
                    <tr>
                        <th class="sort" data-sort="name" scope="col" style="width: 60px;"></th>
                        <th class="sort" data-sort="trade_date" scope="col">Date</th>
                        <th class="sort" data-sort="asset" scope="col">Asset</th>
                        <th class="sort" data-sort="order" scope="col">Order</th>
                        <th class="sort" data-sort="trade_status" scope="col">Status</th>
                        <th class="sort" data-sort="margin" scope="col">Margin</th>
                        <th class="sort" data-sort="lot" scope="col">Lot</th>
                        <th class="sort" data-sort="open_price" scope="col">Open</th>
                        <th class="sort" data-sort="close_price" scope="col">Close</th>
                        <th class="sort" data-sort="pnl" scope="col">PnL</th>
                        <th class="sort" data-sort="rebate" scope="col">Rebate</th>
                    </tr>
                    <!--end tr-->
                </thead>
                <tbody class="list form-check-all">
                    <?php foreach($trades as $row){?>
                        <tr>
                            <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">#VZ001</a></td>
                            <td>
                                <?php if($row->trade_status=='closed'){?>
                                    <?php if($row->pnl<0){?>
                                    <div class="avatar-xs">
                                        <div class="avatar-title bg-danger-subtle text-danger rounded-circle fs-16">
                                            <i class="ri-arrow-right-down-fill"></i>
                                        </div>
                                    </div>
                                    <?php }else{ ?>
                                    <div class="avatar-xs">
                                        <div class="avatar-title bg-success-subtle text-success rounded-circle fs-16">
                                            <i class="ri-arrow-right-up-fill"></i>
                                        </div>
                                    </div>
                                    <?php } ?>
                                <?php } ?>
                            </td>
                            <td class="trade_date"><?=dmy($row->trade_date)?> <small class="text-muted"><?=his($row->trade_date)?></small></td>
                            <td class="asset">
                                <div class="d-flex align-items-center">
                                    <?=strtoupper($row->asset)?>
                                </div>
                            </td>
                            <td class="order"><?=strtoupper($row->order)?></td>
                            <td class="trade_status">
                                <?php if($row->trade_status=='open'){?>
                                    <span class="badge bg-warning-subtle text-warning fs-11"><i class="ri-time-line align-bottom"></i> Open</span>
                                <?php }else{ ?>
                                    <span class="badge bg-success-subtle text-success fs-11"><i class="ri-time-line align-bottom"></i> Closed</span>
                                <?php } ?>
                                    
                            </td>
                            <td class="margin"><h6 class="mb-1 amount"><?=number_format($row->margin,2)?> USD</h6></td>
                            <td class="lot"><h6 class="mb-1 amount"><?=number_format($row->lot,3)?> USD</h6></td>
                            <td class="open_price"><h6 class="mb-1 amount"><?=number_format($row->open_price,3)?> USD</h6></td>
                            <td class="close_price"><h6 class="mb-1 amount"><?=number_format($row->close_price,3)?> USD</h6></td>
                            <td class="pnl">
                                <?php if($row->pnl<0){?>
                                    <h6 class="text-danger mb-1 amount">-<?=number_format($row->pnl,2)?> USD</h6>
                                <?php }else{ ?>
                                    <h6 class="text-success mb-1 amount"><?=number_format($row->pnl,2)?> USD</h6>
                                <?php } ?>
                            </td>
                            
                            <td class="rebate"><h6 class="mb-1 amount"><?=number_format($row->rebate,3)?> USD</h6></td>
                            
                        </tr>
                    <?php } ?>
                    
                </tbody>
            </table>
            <!--end table-->
        </div>
    </div>
    <!--end card-body-->
</div>
<!--end card-->
<script>
    $("#main-dt").DataTable();
</script>
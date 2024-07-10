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
<div class="alert alert-primary">Your Referral Link: <span class="copy-text" style="word-wrap: break-word;"><?=site_url('member/auth/register/'.getSession('username'))?></span></div>
<div class="row">
    <div class="col-xxl-3 col-md-6">
        <div class="card card-animate" onclick="location.href='<?=site_url('member/account')?>'">
            <div class="card-body">
                <div class="d-flex mb-3">
                    <div class="flex-grow-1">
                        <lord-icon src="https://cdn.lordicon.com/fhtaantg.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:55px;height:55px"></lord-icon>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="javascript:void(0);" class="badge bg-warning-subtle text-warning badge-border">USD</a>
                    </div>
                </div>
                <h3 class="mb-2">
                    $<span class="counter-value" data-target="<?=$transactionSummary->pending_deposit?>">0</span><small class="text-muted fs-13"></small>
                    <!-- Coming Soon... -->
                </h3>
                <h6 class="text-muted mb-0">Pending Deposit</h6>
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->
    <div class="col-xxl-3 col-md-6">
        <div class="card card-animate" onclick="location.href='<?=site_url('member/trading')?>'">
            <div class="card-body">
                <div class="d-flex mb-3">
                    <div class="flex-grow-1">
                        <lord-icon src="https://cdn.lordicon.com/qhviklyi.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:55px;height:55px"></lord-icon>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="javascript:void(0);" class="badge bg-warning-subtle text-warning badge-border">USD</a>
                    </div>
                </div>
                <h3 class="mb-2">$<span class="counter-value" data-target="<?=$transactionSummary->total_deposit?>">0</span><small class="text-muted fs-13"></small></h3>
                <h6 class="text-muted mb-0">Total Deposit </h6>
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->
    <div class="col-xxl-3 col-md-6">
        <div class="card card-animate" onclick="location.href='<?=site_url('member/bonus')?>'">
            <div class="card-body">
                <div class="d-flex mb-3">
                    <div class="flex-grow-1">
                        <lord-icon src="https://cdn.lordicon.com/yeallgsa.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:55px;height:55px"> </lord-icon>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="javascript:void(0);" class="badge bg-warning-subtle text-warning badge-border">USD</a>
                    </div>
                </div>
                <h3 class="mb-2">
                    $<span class="counter-value" data-target="<?=$transactionSummary->pending_withdrawal?>">0</span><small class="text-muted fs-13"></small>
                    <!-- Coming Soon... -->
                </h3>
                <h6 class="text-muted mb-0">Pending Withdrawal</h6>
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->
    <div class="col-xxl-3 col-md-6">
        <div class="card card-animate" onclick="location.href='<?=site_url('member/bonus')?>'">
            <div class="card-body">
                <div class="d-flex mb-3">
                    <div class="flex-grow-1">
                        <lord-icon src="https://cdn.lordicon.com/vaeagfzc.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:55px;height:55px"></lord-icon>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="javascript:void(0);" class="badge bg-warning-subtle text-warning badge-border">USD</a>
                    </div>
                </div>
                <h3 class="mb-2">$<span class="counter-value" data-target="<?=$transactionSummary->total_withdrawal?>">0</span><small class="text-muted fs-13"></small></h3>
                <h6 class="text-muted mb-0">Total Withdrawal</h6>
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
            <a href="<?=site_url('member/topup')?>" class="btn btn-info">Deposit</a>
            <a href="<?=site_url('member/withdrawal')?>" class="btn btn-danger">Withdraw</a>
        </div>
    </div>
    <!--end col-->
</div>
<!--end row-->

<div class="card" id="contactList">
    <div class="card-header">
        <div class="row align-items-center g-3">
            <div class="col-md-3">
                <h5 class="card-title mb-0">My Downlines</h5>
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
                        <th class="sort" scope="col" style="width: 60px;"></th>
                        <th class="sort" scope="col">Username</th>
                        <th class="sort" scope="col">Name</th>
                        <th class="sort" scope="col">Phone</th>
                        <th class="sort" scope="col">Email</th>
                        <th class="sort" scope="col">KYC</th>
                        <th class="sort" scope="col">Pending Topup</th>
                        <th class="sort" scope="col">Approved Topup</th>
                        <th class="sort" scope="col">Pending WD</th>
                        <th class="sort" scope="col">Approved WD</th>
                    </tr>
                    <!--end tr-->
                </thead>
                <tbody class="list form-check-all">
                    <?php foreach($downlines as $i=>$row){?>
                        <tr>
                            <td><?=($i+1)?></td>
                            <td><?=$row->username?></td>
                            <td><?=$row->full_name?></td>
                            <td><?=$row->phone_number?></td>
                            <td><?=$row->email?></td>
                            <td><?=ucwords($row->kyc_status)?></td>
                            <td><h6 class="mb-1 amount"><?=number_format($row->pending_topup,2)?> USD</h6></td>
                            <td><h6 class="mb-1 amount"><?=number_format($row->approved_topup,2)?> USD</h6></td>
                            <td><h6 class="mb-1 amount"><?=number_format($row->pending_withdrawal,2)?> USD</h6></td>
                            <td><h6 class="mb-1 amount"><?=number_format($row->approved_withdrawal,2)?> USD</h6></td>
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
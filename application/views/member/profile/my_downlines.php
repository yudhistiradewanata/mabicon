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
                        <!-- <input type="text" class="form-control search" placeholder="Search for transactions..."> -->
                        <!-- <i class="ri-search-line search-icon"></i> -->
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
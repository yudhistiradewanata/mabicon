<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <span class="text-secondary float-end">Current Balance: <b>$ <?=number_format($balanceSummary->total_balance)?></b></span>
                <h5 class="card-title mb-0">My Account Balance</h5>
            </div>
            <div class="card-body">
                <table id="main-dt" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Date</th>
                            <th>Open</th>
                            <th>Debit</th>
                            <th>Credit</th>
                            <th>Close</th>
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($balances as $i=>$row){?>
                        <tr>
                            <td><?=($i+1)?></td>
                            <td><?=dmy($row->created_at)?></td>
                            <td><?=number_format($row->previous_amount,2)?></td>
                            <td><?=number_format($row->debit_amount,2)?></td>
                            <td><?=number_format($row->credit_amount,2)?></td>
                            <td><?=number_format($row->balance_amount,2)?></td>
                            <td><?=$row->notes?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!--end col-->
</div><!--end row-->
<script>
    $("#main-dt").DataTable();
</script>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <span class="text-secondary float-end">Total PnL: <b>$ <?=number_format($tradingSummary->total_pnl)?></b></span>
                <h5 class="card-title mb-0">My Trade Histories</h5>
            </div>
            <div class="card-body">
                <table id="main-dt" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
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
                        <?php foreach($tradingHistories as $i=>$row){?>
                        <tr>
                            <td><?=($i+1)?></td>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div><!--end col-->
</div><!--end row-->
<script>
    $("#main-dt").DataTable();
</script>
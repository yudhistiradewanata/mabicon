<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#new-deposit-modal">
                    New Deposit
                </button>
                <h5 class="card-title mb-0">My Deposit History</h5>
                
            </div>
            <div class="card-body">
                <table id="main-dt" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Account ID</th>
                            <th>Date</th>
                            <th>Trf To</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Proof</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($topUpRequests as $i=>$row){?>
                        <tr>
                            <td><?=($i+1)?></td>
                            <td><?=$row->account_id?></td>
                            <td><?=dmy($row->topup_date)?></td>
                            <td><?=format_str($row->transfer_destination)?></td>
                            <td><?=number_format($row->topup_amount,2)?></td>
                            <td><?=format_str($row->status)?></td>
                            <td><a href="<?=base_url('assets/uploads/deposit/'.$row->transfer_proof_file)?>" target="_blank"><img src="<?=base_url('assets/uploads/deposit/'.$row->transfer_proof_file)?>" width="100"></a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!--end col-->
</div><!--end row-->

<div class="modal fade" id="new-deposit-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="topUpRequestModalLabel">New Top Up Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-5">
                <?=form_open_multipart('member/trading/topup')?>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="account_id" class="form-label">Trading Account</label>
                            <select class="form-control" id="account_id" name="account_id" required>
                                <?php foreach($tradingAccounts as $account): ?>
                                    <option value="<?= $account->account_id ?>"><?= $account->account_id ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="topup_amount" class="form-label">Top Up Amount</label>
                            <input type="number" step="0.01" class="form-control" id="topup_amount" name="topup_amount" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="topup_date" class="form-label">Top Up Date (as shown in proof)</label>
                            <input type="text" class="form-control" id="topup_date" name="topup_date" data-provider="flatpickr" data-date-format="Y-m-d" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="transfer_proof_file" class="form-label">Transfer Proof File</label>
                            <input type="file" class="form-control" id="transfer_proof_file" name="transfer_proof_file" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="transfer_destination" class="form-label">Transfer Destination</label>
                            <input type="text" class="form-control" id="transfer_destination" name="transfer_destination" readonly value="usdt_address">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                <?=form_close()?>
            </div>
        </div>
    </div>
</div>
<script>
    $("#main-dt").DataTable();
</script>

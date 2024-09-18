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
                            <td><?=format_str($row->transfer_destination.' | '.$row->transfer_destination_target)?></td>
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
                                <option value="">- Choose Your Trading Account --</option>
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
                        <div class="mb-3 col-md-12">
                            <label for="" class="form-label">Transfer TO</label>
                            <select class="form-select" id="transfer-destination" name="transfer_destination" onchange="selecttransferdest(this)" required>
                                <option value="">Choose Transfer Destination</option>
                                <option value="usdt_address|TRC20 - TR4zFfbpYBWcC6kRt2RuNUmwA9BxeTNbd2">USDT | TRC20 - TR4zFfbpYBWcC6kRt2RuNUmwA9BxeTNbd2</option>
                                <option value="bank_account|ABSA BANK - ROSE BANK - 41-1126-6763">Bank Transfer | ABSA BANK - ROSE BANK - 41-1126-6763</option>
                                <option value="bank_account|Rochmad Indra Kusuma - BCA - 7851178019">Bank Transfer | Rochmad Indra Kusuma - BCA - 7851178019</option>
                            </select>
                        </div>
                        
                        <div class="mb-3 col-md-12 d-none" id="transfer-to-usdt">
                            <label for="" class="form-label">Transfer TO</label>
                            <input type="text" class="form-control" disabled value="TRC20 - TR4zFfbpYBWcC6kRt2RuNUmwA9BxeTNbd2">
                        </div>
                        <div class="mb-3 col-md-12 d-none" id="transfer-to-rosebank">
                            <label for="" class="form-label">Transfer TO</label>
                            <div class="tab-content" style="padding:10px;border:1px solid grey;" >
                                <div class="tab-pane active" id="tab-international" role="tabpanel">
                                    Account Name: MABICON (PTY) LTD<br>
                                    Registration Number: 2022/562779/07<br>
                                    Account Number: 41-1126-6763<br>
                                    Account Type: CURRENT ACCOUNT<br>
                                    Bank: ABSA BANK - ROSE BANK<br>
                                    Branch Code: 632005<br>
                                    Absa Swift Code: ABSAZAJJ<br>
                                    Address: 7th Floor, Absa Towers West. 15 Troye Street, Johannesburg, 2001<br>
                                    Status: ACTIVE
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 col-md-12 d-none" id="transfer-to-bca">
                            <label for="" class="form-label">Transfer TO</label>
                            <div class="tab-content" style="padding:10px;border:1px solid grey;" >
                                <div class="tab-pane active" id="tab-indonesian" role="tabpanel">
                                    Name: Rochmad Indra Kusuma <br>
                                    Bank Account : 7851178019<br>
                                    Swift code : CENAIDJAXXX<br>
                                    Bank Central Asia<br>
                                    Indonesia
                                </div>
                            </div>
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
    function selecttransferdest(elm){
        console.log($(elm).val());
        if($(elm).val()=="usdt_address|TRC20 - TR4zFfbpYBWcC6kRt2RuNUmwA9BxeTNbd2"){
            $("#transfer-to-usdt").removeClass("d-none");
            $("#transfer-to-rosebank").addClass("d-none");
            $("#transfer-to-bca").addClass("d-none");
        }
        else if($(elm).val()=="bank_account|ABSA BANK - ROSE BANK - 41-1126-6763"){
            $("#transfer-to-usdt").addClass("d-none");
            $("#transfer-to-rosebank").removeClass("d-none");
            $("#transfer-to-bca").addClass("d-none");
        }
        else if($(elm).val()=="bank_account|Rochmad Indra Kusuma - BCA - 7851178019"){
            $("#transfer-to-usdt").addClass("d-none");
            $("#transfer-to-rosebank").addClass("d-none");
            $("#transfer-to-bca").removeClass("d-none");
        }
        // alert($(this).val());
    }
</script>

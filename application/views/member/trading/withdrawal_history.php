<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#new-withdrawal-modal">
                    New Withdrawal
                </button>
                <h5 class="card-title mb-0">My Withdrawal History</h5>
                
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
                        <?php foreach($withdrawalRequests as $i=>$row){?>
                        <tr>
                            <td><?=($i+1)?></td>
                            <td><?=$row->account_id?></td>
                            <td><?=dmy($row->created_at)?></td>
                            <td><?= ($row->usdt_address!=null)?format_str($row->usdt_address):format_str($row->bank_account)?></td>
                            <td><?=number_format($row->withdrawal_amount,2)?></td>
                            <td><?=format_str($row->status)?></td>
                            <td></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!--end col-->
</div><!--end row-->
<div class="modal fade" id="new-withdrawal-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="withdrawalRequestModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="withdrawalRequestModalLabel">New Withdrawal Request</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center p-5">
        <?= form_open_multipart('member/trading/withdraw') ?>
          <div class="row">
            <div class="mb-3 col-md-12">
              <label for="withdraw_to" class="form-label">Withdraw to</label>
              <select class="form-select" id="withdraw_to" name="withdraw_to" required>
                <option value="">Choose Withdraw Destination</option>
                <?php foreach($usdtAddresses as $row){?>
                    <option value="usdt_address|<?=$row->usdt_address?>">TRC20 | <?=$row->usdt_address?></option>
                <?php } ?>
                <?php foreach($bankAccounts as $row){?>
                    <option value="bank_account|<?=$row->bank_name.' - '.$row->account_holder_name.' - '.$row->account_number?>">Bank Transfer | <?=$row->bank_name.' - '.$row->account_holder_name.' - '.$row->account_number?></option>
                <?php } ?>
              </select>
            </div>
            
            <div class="mb-3 col-md-4">
                <label for="account_id" class="form-label">Trading Account</label>
                <select class="form-control" id="account_id" name="account_id" required>
                    <?php foreach($tradingAccounts as $account): ?>
                        <option value="<?= $account->account_id ?>"><?= $account->account_id ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3 col-md-4">
              <label for="withdrawal_amount" class="form-label">Withdrawal Amount</label>
              <input type="number" step="0.01" class="form-control" id="withdrawal_amount" name="withdrawal_amount" required>
            </div>
            <div class="mb-3 col-md-4">
              <label for="otp" class="form-label">OTP</label>
              <input type="text" class="form-control" id="otp" name="otp" required>
              <button type="button" class="btn btn-secondary mt-2" id="requestOtpBtn">Request OTP</button>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>
<script>
    $('#requestOtpBtn').on('click', function() {
      $.ajax({
        url: '<?= site_url('member/trading/requestOtp') ?>',
        method: 'post',
        dataType:"json",
        success: function(response) {
          alert(response.message);
        },
        error: function(err) {
          alert(err);
        }
      });
    });
    $("#main-dt").DataTable();
</script>
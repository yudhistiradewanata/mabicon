<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#new-trading-account-modal">
                    Request New Trading Account
                </button>
                <h5 class="card-title mb-0">My Trading Accounts</h5>
            </div>
            <div class="card-body">
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
                <?php endif; ?>
                <table id="main-dt" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Account ID</th>
                            <th>Requested At</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($tradingAccounts as $i => $account): ?>
                        <tr>
                            <td><?= ($i+1) ?></td>
                            <td><?= $account->account_id ?? '-' ?></td>
                            <td><?= date('d-m-Y H:i:s', strtotime($account->requested_at)) ?></td>
                            <td><?= ucfirst($account->status) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!--end col-->
</div><!--end row-->

<div class="modal fade" id="new-trading-account-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newTradingAccountModalLabel">Request New Trading Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-5">
                <?=form_open('member/tradingaccount/create')?>
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="account_id" class="form-label">Trading Account ID (Optional)</label>
                            <input type="text" class="form-control" id="account_id" name="account_id">
                            <small class="form-text text-muted">Leave blank if you do not have a trading account ID.</small>
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

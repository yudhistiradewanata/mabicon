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
                            <th>Password</th>
                            <th>Requested At</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($tradingAccounts as $i => $account): ?>
                        <tr>
                            <td><?= ($i+1) ?></td>
                            <td><?= $account->account_id ?? '-' ?></td>
                            <td><button class="btn btn-sm btn-success" onclick="showPasswordModal(<?= $account->id ?>)">Show</button></td>
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
                <?= form_open('member/tradingaccount/create') ?>
                    <button type="submit" class="btn btn-primary">Submit</button>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Password Confirmation -->
<div class="modal fade" id="confirm-password-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmPasswordModalLabel">Confirm Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-5">
                <input type="hidden" id="trading_account_id">
                <div class="mb-3">
                    <label for="user_password" class="form-label">User Password</label>
                    <input type="password" class="form-control" id="user_password" name="user_password" required>
                </div>
                <button type="button" class="btn btn-primary" onclick="confirmPassword()">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Showing Trading Account Password -->
<div class="modal fade" id="show-trading-account-password-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showTradingAccountPasswordModalLabel">Trading Account Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-5">
                <div class="mb-3">
                    <label for="trading_account_password" class="form-label">Password</label>
                    <input type="text" class="form-control" id="trading_account_password" readonly>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#main-dt").DataTable();

    function showPasswordModal(accountId) {
        $('#trading_account_id').val(accountId);
        $('#confirm-password-modal').modal('show');
    }

    function confirmPassword() {
        const accountId = $('#trading_account_id').val();
        const userPassword = $('#user_password').val();

        $.ajax({
            url: '<?= site_url("member/tradingaccount/verifyPassword") ?>',
            method: 'POST',
            dataType:'json',
            data: {
                account_id: accountId,
                user_password: userPassword
            },
            success: function(response) {
                if (response.status === 'success') {
                    $('#trading_account_password').val(response.trading_account_password);
                    $('#confirm-password-modal').modal('hide');
                    $('#show-trading-account-password-modal').modal('show');
                } else {
                    alert(response.message);
                }
            }
        });
    }
</script>

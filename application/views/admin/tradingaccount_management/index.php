<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
            <div class="flex-grow-1">
                <p class="text-muted mb-0">Review and manage pending trading account requests.</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <span class="text-secondary float-end">Total Pending Requests: <b><?= count($pendingAccounts) ?></b></span>
                <h5 class="card-title mb-0">Pending Trading Account Requests</h5>
            </div>
            <div class="card-body">
                <table id="main-dt" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Username</th>
                            <th>Requested At</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pendingAccounts as $i => $account): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= $account->username ?></td>
                            <td><?= date('Y-m-d H:i:s', strtotime($account->requested_at)) ?></td>
                            <td><?= ucfirst($account->status) ?></td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" onclick="showModal('approve', <?= $account->id ?>, '<?= $account->username ?>', '<?= date('Y-m-d H:i:s', strtotime($account->requested_at)) ?>')">Approve</button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="showModal('reject', <?= $account->id ?>, '<?= $account->username ?>', '<?= date('Y-m-d H:i:s', strtotime($account->requested_at)) ?>')">Reject</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!--end col-->
</div><!--end row-->

<!-- Modal -->
<div class="modal fade" id="tradingAccountModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tradingAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tradingAccountModalLabel">Trading Account Request Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-5">
                <input type="hidden" id="modal_account_id" name="account_id">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="user_id" class="form-label">Username</label>
                        <input type="text" class="form-control" id="modal_username" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="requested_at" class="form-label">Requested At</label>
                        <input type="text" class="form-control" id="modal_requested_at" readonly>
                    </div>
                </div>
                <div class="row mb-3 approve-section">
                    <div class="col-md-6">
                        <label for="account_id" class="form-label">Trading Account ID</label>
                        <input type="text" class="form-control" id="account_id" name="account_id">
                    </div>
                    <div class="col-md-6">
                        <label for="account_id" class="form-label">Password</label>
                        <input type="text" class="form-control" id="account_password" name="password">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 approve-section">
                        <?= form_open('admin/trading-account-management/approve', ['id' => 'approveForm', 'class' => 'd-inline']) ?>
                            <input type="hidden" id="approve_id" name="id">
                            <input type="hidden" id="approve_account_id" name="account_id">
                            <input type="hidden" id="approve_password" name="password">
                            <button type="submit" class="btn btn-primary">Approve</button>
                        <?= form_close() ?>
                    </div>
                    <div class="col-md-6">
                        <?= form_open('admin/trading-account-management/reject', ['id' => 'rejectForm', 'class' => 'd-inline']) ?>
                            <input type="hidden" id="reject_id" name="id">
                            <button type="submit" class="btn btn-danger">Reject</button>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#main-dt").DataTable();
    });

    function showModal(action, id, username, requested_at) {
        $('#modal_username').val(username);
        $('#modal_requested_at').val(requested_at);
        $('#approve_id').val(id);
        
        $('#reject_id').val(id);
        if (action === 'approve') {
            $('.approve-section').show();
            $('#approveForm').show();
            $('#rejectForm').hide();
        } else {
            $('.approve-section').hide();
            $('#approveForm').hide();
            $('#rejectForm').show();
        }
        $('#tradingAccountModal').modal('show');
    }

    $('#approveForm').submit(function(e) {
        $('#approve_account_id').val($('#account_id').val());
        $('#approve_password').val($('#account_password').val());
        
    });
</script>

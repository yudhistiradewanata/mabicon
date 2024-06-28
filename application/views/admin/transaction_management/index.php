<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
            <div class="flex-grow-1">
                <p class="text-muted mb-0">Review and manage deposit and withdrawal.</p>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="row mb-3">
    <div class="col-12">
        <?= form_open('admin/transaction-management', ['method' => 'get']) ?>
        <div class="row g-3">
            <div class="col-md-4">
                <input type="text" class="form-control" name="user_id" placeholder="User ID" value="<?= $filters['user_id'] ?? '' ?>">
            </div>
            <div class="col-md-3">
                <select class="form-select" name="transaction_type">
                    <option value="">ALL</option>
                    <option value="topup" <?= isset($filters['transaction_type']) && $filters['transaction_type'] == 'topup' ? 'selected' : '' ?>>Top-up</option>
                    <option value="withdrawal" <?= isset($filters['transaction_type']) && $filters['transaction_type'] == 'withdrawal' ? 'selected' : '' ?>>Withdrawal</option>
                </select>
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control" name="start_date" placeholder="Start Date" value="<?= $filters['start_date'] ?? '' ?>" data-provider="flatpickr" data-date-format="Y-m-d">
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control" name="end_date" placeholder="End Date" value="<?= $filters['end_date'] ?? '' ?>" data-provider="flatpickr" data-date-format="Y-m-d">
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
        <?= form_close() ?>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <span class="text-secondary float-end">Total Pending Deposits: <b><?= count($topUpRequests) ?></b></span>
                <h5 class="card-title mb-0">Pending Deposit List</h5>
            </div>
            <div class="card-body">
                <table id="main-dt-deposits" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">User ID</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Date</th>
                            <th scope="col">Proof</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($topUpRequests as $i => $deposit): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= $deposit->username ?></td>
                            <td><?= number_format($deposit->topup_amount, 2) ?></td>
                            <td><?= date('Y-m-d H:i:s', strtotime($deposit->topup_date)) ?></td>
                            <td><img src="<?= base_url('uploads/proofs/' . $deposit->transfer_proof_file) ?>" alt="Proof Image" style="width: 50px; height: 50px;"></td>
                            <td>
                                <?php if($deposit->status=='pending'){?>
                                    <button type="button" class="btn btn-success btn-sm" onclick="showDepositModal(<?= $deposit->id ?>, '<?= $deposit->username ?>', <?= $deposit->topup_amount ?>, '<?= base_url('uploads/proofs/' . $deposit->transfer_proof_file) ?>', '<?= date('Y-m-d H:i:s', strtotime($deposit->topup_date)) ?>')">Approve</button>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="showDepositModal(<?= $deposit->id ?>, '<?= $deposit->username ?>', <?= $deposit->topup_amount ?>, '<?= base_url('uploads/proofs/' . $deposit->transfer_proof_file) ?>', '<?= date('Y-m-d H:i:s', strtotime($deposit->topup_date)) ?>')">Reject</button>
                                <?php }else{ ?>
                                    <?php if($deposit->status=='approved'){?>
                                        <span class="badge bg-success-subtle text-success fs-11"><i class="ri-time-line align-bottom"></i> Approved</span>
                                    <?php }else{ ?>
                                        <span class="badge bg-danger-subtle text-danger fs-11"><i class="ri-time-line align-bottom"></i> Rejected</span>
                                    <?php } ?>
                                <?php }?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!--end col-->
</div><!--end row-->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <span class="text-secondary float-end">Total Pending Withdrawals: <b><?= count($withdrawalRequests) ?></b></span>
                <h5 class="card-title mb-0">Pending Withdrawal List</h5>
            </div>
            <div class="card-body">
                <table id="main-dt-withdrawals" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">User ID</th>
                            <th scope="col">Amount</th>
                            <th scope="col">USDT Address</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($withdrawalRequests as $i => $withdrawal): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= $withdrawal->username ?></td>
                            <td><?= number_format($withdrawal->withdrawal_amount, 2) ?></td>
                            <td><?= $withdrawal->usdt_address ?></td>
                            <td>
                                <?php if($withdrawal->status=='pending'){?>
                                    <button type="button" class="btn btn-success btn-sm" onclick="showWithdrawalModal(<?= $withdrawal->id ?>, '<?= $withdrawal->username ?>', <?= $withdrawal->withdrawal_amount ?>, '<?= $withdrawal->usdt_address ?>', '<?= $withdrawal->otp ?>')">Approve</button>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="showWithdrawalModal(<?= $withdrawal->id ?>, '<?= $withdrawal->username ?>', <?= $withdrawal->withdrawal_amount ?>, '<?= $withdrawal->usdt_address ?>', '<?= $withdrawal->otp ?>')">Reject</button>
                                <?php }else{ ?>
                                    <?php if($withdrawal->status=='approved'){?>
                                        <span class="badge bg-success-subtle text-success fs-11"><i class="ri-time-line align-bottom"></i> Approved</span>
                                    <?php }else{ ?>
                                        <span class="badge bg-danger-subtle text-danger fs-11"><i class="ri-time-line align-bottom"></i> Rejected</span>
                                    <?php } ?>
                                <?php }?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!--end col-->
</div><!--end row-->

<!-- Deposit Modal -->
<div class="modal fade" id="depositModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="depositModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="depositModalLabel">Deposit Request Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-5">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="deposit_username" class="form-label">User ID</label>
                        <input type="text" class="form-control" id="deposit_username" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="topup_amount" class="form-label">Amount</label>
                        <input type="text" class="form-control" id="deposit_amount" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <img id="deposit_proof_image" alt="Proof Image" class="img-fluid">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= form_open('admin/transaction-management/approveTopUp', ['id' => 'approveDepositForm', 'class' => 'd-inline']) ?>
                            <input type="hidden" id="approve_deposit_id" name="id">
                            <button type="submit" class="btn btn-primary">Approve</button>
                        <?= form_close() ?>
                    </div>
                    <div class="col-md-6">
                        <?= form_open('admin/transaction-management/rejectTopUp', ['id' => 'rejectDepositForm', 'class' => 'd-inline']) ?>
                            <input type="hidden" id="reject_deposit_id" name="id">
                            <button type="submit" class="btn btn-danger">Reject</button>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Withdrawal Modal -->
<div class="modal fade" id="withdrawalModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="withdrawalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="withdrawalModalLabel">Withdrawal Request Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-5">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="withdrawal_username" class="form-label">User ID</label>
                        <input type="text" class="form-control" id="withdrawal_username" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="withdrawal_amount" class="form-label">Amount</label>
                        <input type="text" class="form-control" id="withdrawal_amount" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="usdt_address" class="form-label">USDT Address</label>
                        <input type="text" class="form-control" id="withdrawal_usdt_address" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= form_open('admin/transaction-management/approveWithdrawal', ['id' => 'approveWithdrawalForm', 'class' => 'd-inline']) ?>
                            <input type="hidden" id="approve_withdrawal_id" name="id">
                            <button type="submit" class="btn btn-primary">Approve</button>
                        <?= form_close() ?>
                    </div>
                    <div class="col-md-6">
                        <?= form_open('admin/transaction-management/rejectWithdrawal', ['id' => 'rejectWithdrawalForm', 'class' => 'd-inline']) ?>
                            <input type="hidden" id="reject_withdrawal_id" name="id">
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
        $("#main-dt-deposits").DataTable();
        $("#main-dt-withdrawals").DataTable();
    });

    function showDepositModal(id, username, amount, proof, date) {
        $('#deposit_username').val(username);
        $('#deposit_amount').val(amount);
        $('#deposit_proof_image').attr('src', proof);
        $('#approve_deposit_id').val(id);
        $('#reject_deposit_id').val(id);
        $('#depositModal').modal('show');
    }

    function showWithdrawalModal(id, username, amount, usdt_address, otp) {
        $('#withdrawal_username').val(username);
        $('#withdrawal_amount').val(amount);
        $('#withdrawal_usdt_address').val(usdt_address);
        $('#approve_withdrawal_id').val(id);
        $('#reject_withdrawal_id').val(id);
        $('#withdrawalModal').modal('show');
    }
</script>

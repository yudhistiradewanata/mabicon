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
                <input type="text" class="form-control" name="search" placeholder="User ID / Account ID" value="<?= $filters['search'] ?? '' ?>">
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
                <span class="text-secondary float-end">Total Pending Transfer Withdrawals: <b><?= count($withdrawalRequests) ?></b></span>
                <h5 class="card-title mb-0">Pending Transfer Withdrawal List</h5>
            </div>
            <div class="card-body">
                <table id="main-dt-withdrawals" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">User ID</th>
                            <th scope="col">Account ID</th>
                            <th scope="col">WD To</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($withdrawalRequests as $i => $withdrawal): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= $withdrawal->username ?></td>
                            <td><?= $withdrawal->account_id ?></td>
                            <td><?= ($withdrawal->usdt_address!=null)?format_str($withdrawal->usdt_address):format_str($withdrawal->bank_account)?></td>
                            <td><?= number_format($withdrawal->withdrawal_amount, 2) ?></td>
                            <td>
                                <?php if($withdrawal->status=='approved'){?>
                                    <button type="button" class="btn btn-success btn-sm" onclick="showWithdrawalModal(<?= $withdrawal->id ?>, '<?= $withdrawal->username ?>', <?= $withdrawal->withdrawal_amount ?>, '<?= $withdrawal->usdt_address ?>', '<?= $withdrawal->otp ?>')">Confirm Transfer</button>
                                <?php }else{ ?>
                                    <?php if($withdrawal->status=='transfered'){?>
                                        <span class="badge bg-success-subtle text-success fs-11"><i class="ri-time-line align-bottom"></i> Transfered</span>
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
                        <?= form_open('admin/transaction-management/transferWithdrawal', ['id' => 'approveWithdrawalForm', 'class' => 'd-inline']) ?>
                            <input type="hidden" id="transfer_withdrawal_id" name="id">
                            <button type="submit" class="btn btn-primary">Confirm Transfer</button>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#main-dt-withdrawals").DataTable();
    });


    function showWithdrawalModal(id, username, amount, usdt_address, otp) {
        $('#withdrawal_username').val(username);
        $('#withdrawal_amount').val(amount);
        $('#withdrawal_usdt_address').val(usdt_address);
        $('#transfer_withdrawal_id').val(id);
        $('#withdrawalModal').modal('show');
    }
</script>

<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
            <div class="flex-grow-1">
                <p class="text-muted mb-0">Manage and review your client accounts.</p>
            </div>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?= form_open('admin/client-management', ['method' => 'get']) ?>
                <div class="row g-3 mb-3">
                    <div class="col-md-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= $this->input->get('username') ?>" placeholder="Username">
                    </div>
                    <div class="col-md-3">
                        <label for="username" class="form-label">Referral</label>
                        <input type="text" class="form-control" id="referral_username" name="referral_username" value="<?= $this->input->get('referral_username') ?>" placeholder="Referral Username">
                    </div>
                    <div class="col-md-2">
                        <label for="join_date_from" class="form-label">Join Date From</label>
                        <input type="text" class="form-control datepicker" id="join_date_from" name="join_date_from" value="<?= $this->input->get('join_date_from') ?>" placeholder="YYYY-MM-DD">
                    </div>
                    <div class="col-md-2">
                        <label for="join_date_to" class="form-label">Join Date To</label>
                        <input type="text" class="form-control datepicker" id="join_date_to" name="join_date_to" value="<?= $this->input->get('join_date_to') ?>" placeholder="YYYY-MM-DD">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <span class="text-secondary float-end">Total Users: <b><?= count($users) ?></b></span>
                <h5 class="card-title mb-0">Client List</h5>
            </div>
            <div class="card-body">
                <table id="main-dt" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Username</th>
                            <th scope="col">Referral</th>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Join Date</th>
                            <!-- <th scope="col">Current Balance</th> -->
                            <th scope="col">Pending Deposit</th>
                            <th scope="col">Pending Withdrawal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $i => $user): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= $user->username ?></td>
                            <td><?= $user->referral_username ?></td>
                            <td><?= $user->full_name ?></td>
                            <td><?= $user->phone_number ?></td>
                            <td><?= date('Y-m-d', strtotime($user->created_at)) ?></td>
                            <!-- <td><?= number_format($user->current_balance, 2) ?></td> -->
                            <td><?= $user->has_pending_deposit ? 'Yes' : 'No' ?></td>
                            <td><?= $user->has_pending_withdrawal ? 'Yes' : 'No' ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!--end col-->
</div><!--end row-->
<script>
    $(document).ready(function() {
        $("#main-dt").DataTable();
        $(".datepicker").flatpickr({
            dateFormat: "Y-m-d"
        });
    });
</script>

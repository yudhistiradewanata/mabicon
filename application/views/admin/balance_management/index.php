<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
            <div class="flex-grow-1">
                <p class="text-muted mb-0">Review and manage users' balances.</p>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="row mb-3">
    <div class="col-12">
        <?= form_open('admin/balance-management', ['method' => 'get']) ?>
        <div class="row g-3">
            <div class="col-md-3">
                <input type="text" class="form-control" name="username" placeholder="Username" value="<?= $filters['username'] ?? '' ?>">
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" name="start_date" placeholder="Start Date" value="<?= $filters['start_date'] ?? '' ?>" data-provider="flatpickr" data-date-format="Y-m-d">
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" name="end_date" placeholder="End Date" value="<?= $filters['end_date'] ?? '' ?>" data-provider="flatpickr" data-date-format="Y-m-d">
            </div>
            <div class="col-md-3">
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
                <span class="text-secondary float-end">Total Records: <b><?= count($balances) ?></b></span>
                <h5 class="card-title mb-0">User Balances</h5>
            </div>
            <div class="card-body">
                <table id="main-dt" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Username</th>
                            <th scope="col">Open</th>
                            <th scope="col">Debit</th>
                            <th scope="col">Credit</th>
                            <th scope="col">Balance</th>
                            <th scope="col">Notes</th>
                            <th scope="col">Last Updated</th>
                            <th scope="col">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($balances as $i => $balance): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= $balance->username ?></td>
                            <td><?= number_format($balance->previous_amount, 2) ?></td>
                            <td><?= number_format($balance->debit_amount, 2) ?></td>
                            <td><?= number_format($balance->credit_amount, 2) ?></td>
                            <td><?= number_format($balance->balance_amount, 2) ?></td>
                            <td><?= $balance->notes ?></td>
                            <td><?= date('Y-m-d H:i:s', strtotime($balance->last_updated)) ?></td>
                            <td><?= date('Y-m-d H:i:s', strtotime($balance->created_at)) ?></td>
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
    });
</script>

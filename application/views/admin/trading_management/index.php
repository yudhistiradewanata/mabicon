<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
            <div class="flex-grow-1">
                <p class="text-muted mb-0">Review and manage users' trading data.</p>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="row mb-3">
    <div class="col-12">
        <?= form_open('admin/trading-management', ['method' => 'get']) ?>
        <div class="row g-3">
            <div class="col-md-3">
                <input type="text" class="form-control" name="username" placeholder="Username" value="<?= $filters['username'] ?? '' ?>">
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control" name="asset" placeholder="Asset" value="<?= $filters['asset'] ?? '' ?>">
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control" name="start_date" placeholder="Start Date" value="<?= $filters['start_date'] ?? '' ?>" data-provider="flatpickr" data-date-format="Y-m-d">
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control" name="end_date" placeholder="End Date" value="<?= $filters['end_date'] ?? '' ?>" data-provider="flatpickr" data-date-format="Y-m-d">
            </div>
            <div class="col-md-3">

                <button type="submit" class="btn btn-primary">Filter</button>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importModal">Import CSV</button>
            </div>
            
        </div>
        <?= form_close() ?>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <span class="text-secondary float-end">Total Records: <b><?= count($tradingHistories) ?></b></span>
                <h5 class="card-title mb-0">Trading Data</h5>
            </div>
            <div class="card-body">
                <table id="main-dt" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Username</th>
                            <th scope="col">Trade Date</th>
                            <th scope="col">Asset</th>
                            <th scope="col">Order</th>
                            <th scope="col">Open Price</th>
                            <th scope="col">Status</th>
                            <th scope="col">Close Date</th>
                            <th scope="col">Close Price</th>
                            <th scope="col">PnL</th>
                            <th scope="col">Margin</th>
                            <th scope="col">Lot</th>
                            <th scope="col">Rebate</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tradingHistories as $i => $trade): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= $trade->username ?></td>
                            <td><?= date('Y-m-d H:i:s', strtotime($trade->trade_date)) ?></td>
                            <td><?= $trade->asset ?></td>
                            <td><?= strtoupper($trade->order) ?></td>
                            <td><?= number_format($trade->open_price, 4) ?></td>
                            <td><?= ucwords($trade->trade_status) ?></td>
                            <td><?= date('Y-m-d H:i:s', strtotime($trade->close_date)) ?></td>
                            <td><?= number_format($trade->close_price, 4) ?></td>
                            <td><?= number_format($trade->pnl, 4) ?></td>
                            <td><?= number_format($trade->margin, 4) ?></td>
                            <td><?= number_format($trade->lot, 4) ?></td>
                            <td><?= number_format($trade->rebate, 4) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!--end col-->
</div><!--end row-->
<!-- Import Modal -->
<div class="modal fade" id="importModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Trading Histories</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <a href="<?= base_url('assets/template/trading-histories.csv') ?>" class="btn btn-info mb-3">Download CSV Template</a>
                <?= form_open_multipart('admin/trading-management/import') ?>
                    <div class="mb-3">
                        <label for="trading_csv" class="form-label">Upload CSV File</label>
                        <input type="file" class="form-control" id="trading_csv" name="trading_csv" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#main-dt").DataTable();
    });
</script>

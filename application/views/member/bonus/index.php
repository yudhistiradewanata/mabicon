<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <span class="text-secondary float-end">Total Bonus: <b>$ <?= number_format($bonusSummary->total_bonus, 2) ?></b></span>
                <h5 class="card-title mb-0">My Bonuses</h5>
            </div>
            <div class="card-body">
                <table id="main-dt" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Date</th>
                            <th scope="col">Type</th>
                            <th scope="col">Description</th>
                            <th scope="col">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($userBonuses as $i => $row): ?>
                        <tr>
                            <td><?= ($i + 1) ?></td>
                            <td><?= date('Y-m-d H:i:s', strtotime($row->created_at)) ?></td>
                            <td><?= ucwords($row->bonus_type) ?></td>
                            <td><?= $row->description ?></td>
                            <td><?= number_format($row->bonus_amount, 2) ?></td>
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

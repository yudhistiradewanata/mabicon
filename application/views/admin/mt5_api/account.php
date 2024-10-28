<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
            <div class="flex-grow-1">
                <p class="text-muted mb-0">Review and manage pending MT5 Account Creation.</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <span class="text-secondary float-end">Total Pending MT5 Account Creation: <b><?= count($accounts) ?></b></span>
                <h5 class="card-title mb-0">Pending MT5 Account Creation</h5>
            </div>
            <div class="card-body">
                <table id="main-dt" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Username</th>
                            <th scope="col">Name</th>
                            <th scope="col">KYC ID</th>
                            <th scope="col">Submitted Since</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($accounts as $i => $row): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= $row->username ?></td>
                            <td><?= $row->full_name ?></td>
                            <td><?= $row->kyc_id_number ?></td>
                            <td><?= date('Y-m-d H:i:s', strtotime($row->created_at)) ?></td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" onclick="showModal(<?= $row->id ?>, '<?= $row->full_name ?>', '<?=$row->kyc_id_number?>', '<?= date('Y-m-d H:i:s', strtotime($row->created_at)) ?>')">Create MT5</button>
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
<div class="modal fade" id="sendModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Account Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-5">
                <input type="hidden" id="modal_account_id" name="account_id">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="modal_fullname" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">ID Number</label>
                        <input type="text" class="form-control" id="modal_idnumber" readonly>
                    </div>
                    
                    <div class="col-md-4">
                        <label for="submitted_at" class="form-label">Submitted Since</label>
                        <input type="text" class="form-control" id="modal_submitted_since" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?= form_open('admin/mt5-api/sendAccount/', ['id' => 'sendForm', 'class' => 'd-inline']) ?>
                            <input type="hidden" id="send_id" name="send_id">
                            <button type="submit" class="btn btn-primary">Send to MT5</button>
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

    function showModal(id, full_name, id_number, submitted_since) {
        $('#modal_account_id').val(id);
        $('#modal_fullname').val(full_name);
        $('#modal_idnumber').val(id_number);
        $('#modal_submitted_since').val(submitted_since);
        $('#send_id').val(id);
        $('#sendModal').modal('show');
    }
</script>

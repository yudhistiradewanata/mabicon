<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
            <div class="flex-grow-1">
                <p class="text-muted mb-0">Review and manage pending KYC requests.</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <span class="text-secondary float-end">Total Pending KYC: <b><?= count($pendingKYC) ?></b></span>
                <h5 class="card-title mb-0">Pending KYC List</h5>
            </div>
            <div class="card-body">
                <table id="main-dt" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">User ID</th>
                            <th scope="col">Image</th>
                            <th scope="col">Status</th>
                            <th scope="col">Submitted At</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pendingKYC as $i => $kyc): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= $kyc->username ?></td>
                            <td><a href="<?= base_url('assets/uploads/kyc/' . $kyc->image) ?>" target="_blank"><img src="<?= base_url('assets/uploads/kyc/' . $kyc->image) ?>" alt="KYC Image" style="width: 50px; height: 50px;"></a></td>
                            <td><?= ucfirst($kyc->status) ?></td>
                            <td><?= date('Y-m-d H:i:s', strtotime($kyc->created_at)) ?></td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" onclick="showModal(<?= $kyc->id ?>, <?= $kyc->user_id ?>, '<?= $kyc->username ?>', '<?= base_url('assets/uploads/kyc/' . $kyc->image) ?>', '<?= date('Y-m-d H:i:s', strtotime($kyc->created_at)) ?>')">Approve</button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="showModal(<?= $kyc->id ?>, <?= $kyc->user_id ?>, '<?= base_url('assets/uploads/kyc/' . $kyc->image) ?>', '<?= date('Y-m-d H:i:s', strtotime($kyc->created_at)) ?>')">Reject</button>
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
<div class="modal fade" id="kycModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="kycModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kycModalLabel">KYC Request Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-5">
                <input type="hidden" id="modal_user_id" name="user_id">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="user_id" class="form-label">User Name</label>
                        <input type="text" class="form-control" id="modal_username" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="submitted_at" class="form-label">Submitted At</label>
                        <input type="text" class="form-control" id="modal_submitted_at" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <img id="modal_kyc_image" alt="KYC Image" class="img-fluid">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= form_open('admin/kyc-management/approve/', ['id' => 'approveForm', 'class' => 'd-inline']) ?>
                            <input type="hidden" id="approve_id" name="id">
                            <button type="submit" class="btn btn-primary">Approve</button>
                        <?= form_close() ?>
                    </div>
                    <div class="col-md-6">
                        <?= form_open('admin/kyc-management/reject/', ['id' => 'rejectForm', 'class' => 'd-inline']) ?>
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

    function showModal(id, user_id, username, image, submitted_at) {
        $('#modal_user_id').val(user_id);
        $('#modal_username').val(username);
        $('#modal_submitted_at').val(submitted_at);
        $('#modal_kyc_image').attr('src', image);
        $('#approve_id').val(id);
        $('#reject_id').val(id);
        $('#kycModal').modal('show');
    }
</script>

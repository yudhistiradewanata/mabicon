
<div class="row">    
    <!--end col-->
    <div class="col-xxl-12">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link <?=($activeTab=='personalDetails')?'active':''?>" data-bs-toggle="tab" href="#personalDetails" role="tab">
                            <i class="fas fa-home"></i> Personal Details
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?=($activeTab=='changePassword')?'active':''?>" data-bs-toggle="tab" href="#changePassword" role="tab">
                            <i class="far fa-user"></i> Change Password
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?=($activeTab=='usdtAddresses')?'active':''?>" data-bs-toggle="tab" href="#usdtAddresses" role="tab">
                            <i class="far fa-envelope"></i> USDT Addresses
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?=($activeTab=='kyc')?'active':''?>" data-bs-toggle="tab" href="#kyc" role="tab">
                            <i class="fas fa-home"></i> KYC
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body p-4">
                <div class="tab-content">
                    <div class="tab-pane <?=($activeTab=='personalDetails')?'active':''?>" id="personalDetails" role="tabpanel">
                        <?=form_open('member/profile')?>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control" placeholder="Enter your fullname" value="<?=$user->username?>" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-6"></div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" class="form-control" placeholder="Enter your fullname" value="<?=$user->full_name?>" name="full_name">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" placeholder="Enter your email" value="<?=$user->email?>" name="email">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Phone Number</label>
                                        <input type="text" class="form-control" placeholder="Enter your phone number" value="<?=$user->phone_number?>" name="phone_number">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Joining Date</label>
                                        <input type="text" class="form-control" value="<?=dmy($user->created_at)?>" disabled/>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Input your password to edit</label>
                                        <input type="password" class="form-control" placeholder="Enter your password to edit" value="" name="password" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="hstack">
                                        <button type="submit" class="btn btn-primary">Update Profile</button>
                                    </div>
                                </div>
                            </div>
                        <?=form_close()?>
                    </div>
                    <div class="tab-pane <?=($activeTab=='changePassword')?'active':''?>" id="changePassword" role="tabpanel">
                        <?=form_open('member/profile/editPassword')?>
                            <div class="row g-2">
                                <div class="col-lg-4">
                                    <div>
                                        <label for="oldpasswordInput" class="form-label">Old Password*</label>
                                        <input type="password" class="form-control" id="oldpasswordInput" placeholder="Enter current password" name="old_password">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div>
                                        <label for="newpasswordInput" class="form-label">New Password*</label>
                                        <input type="password" class="form-control" id="newpasswordInput" placeholder="Enter new password" name="new_password">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div>
                                        <label for="confirmpasswordInput" class="form-label">Confirm Password*</label>
                                        <input type="password" class="form-control" id="confirmpasswordInput" placeholder="Confirm password" name="confirm_password">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div>
                                        <button type="submit" class="btn btn-success float-end">Change Password</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        <?=form_close()?>
                        <div class="mt-4 mb-3 border-bottom pb-2">
                            
                            <h5 class="card-title">Login History</h5>
                        </div>
                        <?php foreach($loginHistories as $row){?>
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 avatar-sm">
                                    <div class="avatar-title bg-light text-primary rounded-3 fs-18 material-shadow">
                                        <i class="ri-smartphone-line"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6><?=$row->platform?></h6>
                                    <p class="text-muted mb-0"><?=$row->browser.', '.$row->login_date?></p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="tab-pane <?=($activeTab=='usdtAddresses')?'active':''?>" id="usdtAddresses" role="tabpanel">
                        <button type="button" onclick="newUsdtAddress()" class="btn btn-primary"><i class="fa fa-plus"></i> New USDT Address</button>
                        <table id="usdt-dt" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%;margin-top: 20px;">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    
                                    <th scope="col">Date</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Address</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($usdtAddresses as $i=>$row){?>
                                <tr>
                                    <td><?=($i+1)?></td>
                                    
                                    <td><?=dmy($row->created_at)?></td>
                                    <td><?=$row->title?></td>
                                    <td><?=$row->usdt_address?></td>
                                    <td>
                                        <?php if($row->is_default){?>
                                            <span class="badge bg-success">Default</span>
                                        <?php }else{ ?>
                                            <a class="badge bg-primary" href="<?=site_url('member/profile/defaultUSDTAddress/'.$row->id)?>">Make Default</a>
                                        <?php } ?>
                                    </td>
                                    
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane <?=($activeTab=='kyc')?'active':''?>" id="kyc" role="tabpanel">
                        <?=form_open_multipart('member/profile/uploadKYC')?>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">KYC Photo</label>
                                        <?php if($kyc==null){?>
                                            <input type="file" class="form-control" placeholder="Enter your ID Photo" name="kyc_image">
                                        <?php }else{ ?>
                                            <img src="<?=base_url('assets/uploads/kyc/'.$kyc->image)?>" width="100%">
                                        <?php } ?>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <input type="text" class="form-control" placeholder="Enter your email" value="<?=format_str(isset($kyc)?$kyc->status:'KYC Not Done')?>" disabled>
                                    </div>
                                </div>
                                <?php if($kyc==null){?>
                                <div class="col-lg-12">
                                    <div class="hstack">
                                        <button type="submit" class="btn btn-primary">Update KYC</button>
                                    </div>
                                </div>
                                <?php } ?>
                                
                            </div>
                            <!--end row-->
                        <?=form_close()?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end col-->
</div>
<!--end row-->
<!-- Modal -->
<div class="modal fade" id="addUsdtModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addUsdtModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kycModalLabel">Add New USDT Address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-5">
                <?= form_open('member/profile/addUsdtAddress', ['id' => 'addUsdtForm', 'class' => 'd-inline']) ?>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="title">
                    </div>
                    <div class="col-md-6">
                        <label for="title" class="form-label">Default Address</label>
                        <select class="form-select" name="is_default" id="is_default" required>
                            <option value="">-- PLEASE SELECT --</option>
                            <option value="1">YES</option>
                            <option value="0">NO</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="usdt-address" class="form-label">USDT Address</label>
                        <input type="text" class="form-control" name="usdt_address" id="usdt-address">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">    
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
<script>
    function newUsdtAddress(){
        $("#addUsdtModal").modal("show");
    }
</script>
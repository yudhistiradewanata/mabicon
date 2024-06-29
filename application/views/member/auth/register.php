<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>
    <meta charset="utf-8" />
    <title>Mabicon - Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Mabicon - Register" name="description" />
    <meta content="YD" name="author" />
    <link rel="shortcut icon" href="<?=base_url('assets/images/favicon.ico')?>">
    <?php $this->load->view('member/layout/css') ?>
</head>
<body>
    <div class="auth-page-wrapper pt-5">
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <div class="auth-page-content">
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">
                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <img src="<?=base_url('assets/images/logo.webp')?>" alt="" height="40">
                                    <p class="text-muted">Open Your Trading Account</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <?=showFlashData()?>
                                    <?=form_open('member/auth/register')?>
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="full_name" class="form-label">Full Name</label>
                                            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter full name" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="full_name" class="form-label">Phone Number</label>
                                            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter Phone Number" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="referral_username" class="form-label">Referral Username </label>
                                            <input type="text" class="form-control" id="referral_username" name="referral_username" placeholder="Enter referral username" value="<?=(isset($referral_username)?$referral_username:'')?>" <?=(isset($referral_username)?'readonly':'')?>>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" class="form-control pe-5 password-input" placeholder="Enter password" id="password-input" name="password" required>
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">Register</button>
                                        </div>

                                        <div class="mt-4 text-center">
                                            <div class="signin-other-title">
                                                <h5 class="fs-13 mb-4 title">Already have an account?</h5>
                                            </div>
                                            <a class="btn btn-primary w-100" href="<?=site_url('member/auth/login')?>">Sign In</a>
                                        </div>
                                    <?=form_close()?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php $this->load->view('member/layout/footer') ?>
    </div>
    <?php $this->load->view('member/layout/scripts') ?>
    <script src="<?=base_url('assets/libs/particles.js/particles.js')?>"></script>
    <script src="<?=base_url('assets/js/pages/particles.app.js')?>"></script>
    <script src="<?=base_url('assets/js/pages/password-addon.init.js')?>"></script>
</body>
</html>

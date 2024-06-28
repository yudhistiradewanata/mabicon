<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>
    <meta charset="utf-8" />
    <title>Mabicon - Your No. 1 Forex Broker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Mabicon - Your No. 1 Forex Broker" name="description" />
    <meta content="YD" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?=base_url('assets/images/favicon.ico')?>">
    <?php $this->load->view('admin/layout/css') ?>
</head>
<body>
    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <a href="/" class="d-inline-block auth-logo">
                                        <img src="<?=base_url('assets/images/logo.webp')?>" alt="" height="40">
                                    </a>
                                    <p class="text-muted">Sign in to continue to Admin System.</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <?php if(!empty($this->session->flashdata('error'))): ?>
                                    <div class="alert alert-danger" role="alert">
                                        <strong> Error! </strong> <?= $this->session->flashdata('error') ?>
                                    </div>
                                    <?php endif; ?>
                                    <?=form_open('admin/auth/login')?>
                                        <input type="hidden" id="browser-code" name="browserCode">
                                        <input type="hidden" id="platform" name="platform">
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username / Email</label>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username or email" value="admin@example.com" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" class="form-control pe-5 password-input" placeholder="Enter password" id="password-input" name="password" value="password" required>
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">Sign In</button>
                                        </div>

                                    <?=form_close()?>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->
        
        <?php $this->load->view('admin/layout/footer') ?>
    </div>
    <!-- END layout-wrapper -->
    <?php $this->load->view('admin/layout/scripts') ?>
    <!-- particles js -->
    <script src="<?=base_url('assets/libs/particles.js/particles.js')?>"></script>
    <!-- particles app js -->
    <script src="<?=base_url('assets/js/pages/particles.app.js')?>"></script>
    <!-- password-addon init -->
    <script src="<?=base_url('assets/js/pages/password-addon.init.js')?>"></script>
    <script>
        $("#browser-code").val(navigator.appCodeName);
        $("#platform").val(navigator.platform);
        console.log(navigator.appCodeName);
    </script>
</body>
</html>
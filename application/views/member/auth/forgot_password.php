<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>
    <meta charset="utf-8" />
    <title>Forgot Password - Mabicon</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Mabicon - Your No. 1 Forex Broker" name="description" />
    <meta content="YD" name="author" />
    <!-- App favicon -->
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="/" class="d-inline-block auth-logo">
                                    <img src="<?=base_url('assets/images/logo.webp')?>" alt="" height="40">
                                </a>
                            </div>
                            <p class="mt-3 fs-15 fw-medium">Trade with better market conditions</p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">
                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Forgot Password</h5>
                                    <p class="text-muted">Enter your email to reset your password.</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <?php if(!empty($this->session->flashdata('error'))): ?>
                                    <div class="alert alert-danger" role="alert">
                                        <strong> Error! </strong> <?= $this->session->flashdata('error') ?>
                                    </div>
                                    <?php endif; ?>
                                    <?php if(!empty($this->session->flashdata('success'))): ?>
                                    <div class="alert alert-success" role="alert">
                                        <strong> Success! </strong> <?= $this->session->flashdata('success') ?>
                                    </div>
                                    <?php endif; ?>
                                    <?=form_open('member/auth/forgotPassword')?>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                                        </div>
                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">Send Reset Link</button>
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
</body>
</html>

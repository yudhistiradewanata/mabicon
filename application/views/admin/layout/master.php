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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <?php $this->load->view('admin/layout/scripts') ?>
</head>
<body>
    <!-- Begin page -->
    <div id="layout-wrapper">
        <?php $this->load->view('admin/layout/topbar') ?>
        <?php $this->load->view('admin/layout/sidebar') ?>
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <?php if(isset($hidePageTitle) && $hidePageTitle){
                    }
                    else{
                        $this->load->view('admin/layout/page-title', array('pagetitle'=>$title, 'title'=>$title));
                    } ?>
                    <?=showFlashData()?>
                    <?=$content?>
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            <?php $this->load->view('admin/layout/footer') ?>
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->
    
    
    <!-- apexcharts -->
    <script src="<?=base_url('assets/libs/apexcharts/apexcharts.min.js')?>"></script>
    <!-- Dashboard init -->
    <script src="<?=base_url('assets/js/pages/dashboard-crm.init.js')?>"></script>
    <!-- App js -->
    <script src="<?=base_url('assets/js/app.js')?>"></script>
</body>
</html>
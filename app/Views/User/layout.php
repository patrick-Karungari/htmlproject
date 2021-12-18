<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $site_title ?? "Admin Panel"; ?></title>
    <!-- base:css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/vendors/mdi/css/materialdesignicons.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendors/flag-icon-css/css/flag-icon.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendors/css/vendor.bundle.base.css') ?>">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/vertical-layout-dark/style.css') ?>">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/logo.png') ?>"/>

</head>
<body >
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="<?php echo site_url('user/account') ?>"><img src="<?php echo base_url('assets/img/logo.png') ?>" alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini" href="<?php echo site_url('user/account') ?>"><img src="<?php echo base_url('assets/img/logo.png') ?>" alt="logo"/></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="mdi mdi-menu"></span>
            </button>
            <ul class="navbar-nav navbar-nav-left">
                <?php
if ((new \App\Libraries\Auth())->isAdmin()) {
    ?>
                    <li class="nav-item d-none d-lg-block">
                        <a href="<?php echo site_url('admin') ?>" class="nav-link"><p>Admin Dashboard</p></a>
                    </li>
                    <?php
}
?>
                <li class="nav-item d-none d-lg-block">
                    <a href="<?php echo site_url('user/deposits/create') ?>" class="nav-link"><p>Deposit</p></a>
                </li>
                <li class="nav-item d-none d-lg-block">
                    <a href="<?php echo site_url('user/withdraws/create') ?>" class="nav-link"><p>Withdraw</p></a>
                </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-search d-none d-lg-block">
                    <div class="input-group">
                        <div class="input-group-prepend">
                <span class="input-group-text" id="search">
                  <i class="mdi mdi-magnify"></i>
                </span>
                        </div>
                        <input type="text" class="form-control" placeholder="Type to search" aria-label="search"
                               aria-describedby="search">
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center"
                       id="notificationDropdown" href="#" data-toggle="dropdown">
                        <i class="mdi mdi-bell-outline mx-0"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                         aria-labelledby="notificationDropdown">
                        <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-success">
                                    <i class="mdi mdi-information mx-0"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <h6 class="preview-subject font-weight-normal">Welcome, <?php echo $current_user->name; ?></h6>
                                <p class="font-weight-light small-text mb-0">
                                    Just now
                                </p>
                            </div>
                        </a>
                    </div>
                </li>

                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link" href="#" data-toggle="dropdown" id="profileDropdown">
                        <img src="<?php echo $current_user->avatarUrl ?>" alt="profile"/>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="<?php echo site_url('user/settings') ?>">
                            <i class="mdi mdi-settings text-primary"></i>
                            Settings
                        </a>
                        <a class="dropdown-item" href="<?php echo site_url('auth/logout') ?>">
                            <i class="mdi mdi-logout text-primary"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="sidebar-profile">
                <div class="d-flex align-items-center justify-content-between">
                    <img src="<?php echo $current_user->avatarUrl ?>" alt="profile">
                    <div class="profile-desc">
                        <p class="name mb-0"><?php echo $current_user->name ?></p>
                        <p class="designation mb-0">User</p>
                    </div>
                </div>
            </div>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link collapsed" href="<?php echo site_url('user/account'); ?>">
                        <i class="mdi mdi-shield-half-full menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#plans" aria-expanded="false"
                       aria-controls="icons">
                        <i class="mdi mdi-chart-line menu-icon"></i>
                        <span class="menu-title">Investments</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="plans">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="<?php echo site_url('user/invest') ?>">Create Investment</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo site_url('user/invest/investments'); ?>">My Investments</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('user/deposits') ?>">
                        <i class="mdi mdi-arrow-up menu-icon"></i>
                        <span class="menu-title">Deposits</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('user/withdraws') ?>">
                        <i class="mdi mdi-arrow-down menu-icon"></i>
                        <span class="menu-title">Withdraws</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('user/referrals') ?>">
                        <i class="mdi mdi-stack-exchange menu-icon"></i>
                        <span class="menu-title">My Referrals</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('user/transactions') ?>">
                        <i class="mdi mdi-stack-exchange menu-icon"></i>
                        <span class="menu-title">My Transactions</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('user/settings') ?>">
                        <i class="mdi mdi-cogs menu-icon"></i>
                        <span class="menu-title">Profile Settings</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <?php
if ($current_user->registration != 1) {
    ?>
                    <div class="alert alert-warning text-center">
                        Please subscribe by paying a one-time fee of <b>Kshs <?php echo get_option('registration_fee') ?></b> to enjoy our investment packages and earn referrals.<br/><br/>
                        <a class="btn btn-primary" href="<?php echo site_url('user/deposits/create') ?>">Deposit Now</a>
                    </div>
                    <?php
} else {
    ?>
                    <div class="alert alert-info">
                            My referral link: <code><?php echo site_url('auth/register') . '?ref=' . $current_user->username; ?></code>
                    </div>
                    <?php
}
?>
                <?php
bootstrap_alerts();
echo $_html_content;
?>
            </div>
            <!-- content-wrapper ends -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-center text-sm-left d-block d-sm-inline-block">Copyright © <?php echo date('Y') ?>. All rights reserved.</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Made with <i
                                class="mdi mdi-heart text-danger"></i> by <a target="_blank" href="https://alpha-capital-investments.com">Alpha Investments</a> </span>
                </div>
            </footer>
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- base:js -->
<script src="<?php echo base_url('assets/vendors/js/vendor.bundle.base.js') ?>"></script>
<!-- endinject -->
<!-- inject:js -->
<script src="<?php echo base_url('assets/js/off-canvas.js') ?>"></script>
<script src="<?php echo base_url('assets/js/hoverable-collapse.js') ?>"></script>
<script src="<?php echo base_url('assets/js/template.js') ?>"></script>
<script src="<?php echo base_url('assets/js/settings.js') ?>"></script>
<script src="<?php echo base_url('assets/js/todolist.js') ?>"></script>
<!-- endinject -->
<!-- plugin js for this page -->
<script src="<?php echo base_url('assets/vendors/chart.js/Chart.min.js') ?>"></script>
<!-- End plugin js for this page -->
 <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
<!-- Custom js for this page-->
<script src="<?php echo base_url('assets/js/dashboard.js') ?>"></script>
<!-- End custom js for this page-->
</body>

</html>

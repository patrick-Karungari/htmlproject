<?php
/***
 * Created by Bennito254
 *
 * Github: https://github.com/bennito254
 * E-Mail: bennito254@gmail.com
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
    <link rel="stylesheet" href="<?php echo base_url('assets/vendors/datatables/datatables.min.css') ?>"/>
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
    <script src="<?php echo base_url('assets/vendors/js/vendor.bundle.base.js') ?>"></script>
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="<?php echo site_url('admin') ?>"><img src="<?php echo base_url('assets/img/logo.png') ?>" alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini" href="<?php echo site_url('admin') ?>"><img src="<?php echo base_url('assets/img/logo.png') ?>" alt="logo"/></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="mdi mdi-menu"></span>
            </button>
            <ul class="navbar-nav navbar-nav-left">
                <li class="nav-item d-none d-lg-block">
                    <a href="<?php echo site_url('user/account') ?>" class="nav-link"><p>User Dashboard</p></a>
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
                                <h6 class="preview-subject font-weight-normal">Welcome, <?php echo $current_user->name ?></h6>
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
                        <a class="dropdown-item">
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
                        <p class="designation mb-0">Web Administrator</p>
                    </div>
                </div>
            </div>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link collapsed" href="<?php echo site_url('admin'); ?>">
                        <i class="mdi mdi-shield-half-full menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#users" aria-expanded="false"
                       aria-controls="icons">
                        <i class="mdi mdi-face-profile menu-icon"></i>
                        <span class="menu-title">Users</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="users">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="<?php echo site_url('admin/users'); ?>">All Users</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo site_url('admin/users/active'); ?>">Active Users</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo site_url('admin/users/inactive'); ?>">Inactive Users</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#plans" aria-expanded="false"
                       aria-controls="icons">
                        <i class="mdi mdi-chart-line menu-icon"></i>
                        <span class="menu-title">Investment Plans</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="plans">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="<?php echo site_url('admin/plans'); ?>">All Plans</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo site_url('admin/plans/create'); ?>">New Plan</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('admin/investments') ?>">
                        <i class="mdi mdi-chart-line menu-icon"></i>
                        <span class="menu-title">Investments</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('admin/deposits') ?>">
                        <i class="mdi mdi-arrow-up menu-icon"></i>
                        <span class="menu-title">Deposits</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('admin/withdraws') ?>">
                        <i class="mdi mdi-arrow-down menu-icon"></i>
                        <span class="menu-title">Withdraws</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#settings" aria-expanded="false"
                       aria-controls="icons">
                        <i class="mdi mdi-cogs menu-icon"></i>
                        <span class="menu-title">Settings</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="settings">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="<?php echo site_url('admin/settings'); ?>">System Settings</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo site_url('admin/settings/mpesa'); ?>">M-Pesa C2B Settings</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo site_url('admin/settings/b2c'); ?>">M-Pesa B2C Settings</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo site_url('admin/settings/email'); ?>">E-Mail Settings</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <?php
                bootstrap_alerts();
                echo $_html_content;
                ?>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-center text-sm-left d-block d-sm-inline-block">Copyright © <?php echo date('Y') ?>. All rights reserved.</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Made with <i
                                class="mdi mdi-heart text-danger"></i> by <a target="_blank" href="https://alpha-capital-investments.com">Alpha Inveestments</a> </span>
                </div>
            </footer>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<script src="<?php echo base_url('assets/js/off-canvas.js') ?>"></script>
<script src="<?php echo base_url('assets/js/hoverable-collapse.js') ?>"></script>
<script src="<?php echo base_url('assets/js/template.js') ?>"></script>
<script src="<?php echo base_url('assets/js/settings.js') ?>"></script>
<script src="<?php echo base_url('assets/js/todolist.js') ?>"></script>
<!-- endinject -->
<!-- plugin js for this page -->
<script src="<?php echo base_url('assets/vendors/chart.js/Chart.min.js') ?>"></script>
<!-- End plugin js for this page -->
<script src="<?php echo base_url('assets/vendors/datatables/datatables.min.js') ?>"></script>
<!-- Custom js for this page-->
<script src="<?php echo base_url('assets/js/dashboard.js') ?>"></script>
<!-- End custom js for this page-->
<script>
    $(document).ready(function () {
        $('table').DataTable();
    })
</script>
</body>

</html>

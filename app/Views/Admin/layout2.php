<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */
// dd($_SERVER['REQUEST_URI']);
?>
<!DOCTYPE html>
<html class="loading dark-layout" lang="en" data-layout="dark-layout" data-textdirection="ltr">
    <!-- BEGIN: Head-->

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
        <meta name="description"
            content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
        <meta name="keywords"
            content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="PIXINVENT">
        <title>AxE Capital - Admin Dashboard</title>
        <link rel="apple-touch-icon" href="<?php echo base_url('assets/images/ico/apple-icon-120.png') ?>">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('assets/images/ico/favicon.ico') ?>">
        <link
            href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
            rel="stylesheet">

        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendors/css/vendors.min.css') ?>">
        <link rel="stylesheet" type="text/css"
            href="<?php echo base_url('assets/vendors/css/extensions/toastr.min.css') ?>">
        <link rel="stylesheet" type="text/css"
            href="<?php echo base_url('assets/vendors/css/charts/apexcharts.css') ?>">
        <link rel="stylesheet" type="text/css"
            href="<?php echo base_url('assets/css/pages/dashboard-ecommerce.css') ?>">
        <link rel="stylesheet" type="text/css"
            href="<?php echo base_url('assets/css/plugins/charts/chart-apex.css') ?>">

        <!-- END: Vendor CSS-->


        <!-- BEGIN: Theme CSS-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap-extended.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/colors.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/components.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/themes/dark-layout.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/themes/bordered-layout.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/themes/semi-dark-layout.css') ?>">

        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css"
            href="<?php echo base_url('assets/bootstrap-icons/font/bootstrap-icons.css') ?>">
        <link rel="stylesheet" type="text/css"
            href="<?php echo base_url('assets/css/core/menu/menu-types/vertical-menu.css') ?>">
        <link rel="stylesheet" type="text/css"
            href="<?php echo base_url('assets/css/plugins/extensions/ext-component-toastr.css') ?>">
        <!-- END: Page CSS-->



        <!-- BEGIN: Vendor JS-->
        <script src="<?php echo base_url('assets/vendors/js/vendors.min.js') ?>"></script>
        <!-- END: Vendor JS-->


        <!-- BEGIN: Blog JS -->




        <!-- END: Blog JS-->


    </head>
    <!-- END: Head-->

    <!-- BEGIN: Body-->

    <body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
        data-menu="vertical-menu-modern" data-col="">

        <!-- BEGIN: Header-->
        <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-dark navbar-shadow">
            <div class="navbar-container d-flex content">
                <div class="bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav d-xl-none">
                        <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon"
                                    data-feather="menu"></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav bookmark-icons">
                        <li class="nav-item d-none d-lg-block"><a class="nav-link"
                                href="<?php echo base_url('admin/email') ?>" data-toggle="tooltip" data-placement="top"
                                title="Email"><i class="ficon" data-feather="mail"></i></a></li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link"
                                href="<?php echo base_url('admin/chat') ?>" data-toggle="tooltip" data-placement="top"
                                title="Chat"><i class="ficon" data-feather="message-square"></i></a></li>
                    </ul>

                </div>
                <ul class="nav navbar-nav align-items-center ml-auto">
                    <li class="nav-item dropdown dropdown-language"><a class="nav-link dropdown-toggle"
                            id="dropdown-flag" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"><i class="flag-icon flag-icon-us"></i><span
                                class="selected-language">English</span></a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-flag"><a
                                class="dropdown-item" href="javascript:void(0);" data-language="en"><i
                                    class="flag-icon flag-icon-us"></i> English</a><a class="dropdown-item"
                                href="javascript:void(0);" data-language="fr"><i class="flag-icon flag-icon-fr"></i>
                                French</a><a class="dropdown-item" href="javascript:void(0);" data-language="de"><i
                                    class="flag-icon flag-icon-de"></i> German</a><a class="dropdown-item"
                                href="javascript:void(0);" data-language="pt"><i class="flag-icon flag-icon-pt"></i>
                                Portuguese</a></div>
                    </li>
                    <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon"
                                data-feather="sun"></i></a></li>
                    <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon"
                                data-feather="search"></i></a>
                        <div class="search-input">
                            <div class="search-input-icon"><i data-feather="search"></i></div>
                            <input class="form-control input" type="text" placeholder="Explore Vuexy..." tabindex="-1"
                                data-search="search">
                            <div class="search-input-close"><i data-feather="x"></i></div>
                            <ul class="search-list search-list-main"></ul>
                        </div>
                    </li>

                    <li class="nav-item dropdown dropdown-notification mr-25"><a class="nav-link"
                            href="javascript:void(0);" data-toggle="dropdown"><i class="ficon"
                                data-feather="bell"></i><span
                                class="badge badge-pill badge-danger badge-up">5</span></a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <div class="dropdown-header d-flex">
                                    <h4 class="notification-title mb-0 mr-auto">Notifications</h4>
                                    <div class="badge badge-pill badge-light-primary">6 New</div>
                                </div>
                            </li>
                            <li class="scrollable-container media-list"><a class="d-flex" href="javascript:void(0)">
                                    <div class="media d-flex align-items-start">
                                        <div class="media-left">
                                            <div class="avatar"><img
                                                    src="<?php echo base_url('assets/images/portrait/small/avatar-s-15.jpg') ?>"
                                                    alt="avatar" width="32" height="32"></div>
                                        </div>
                                        <div class="media-body">
                                            <p class="media-heading"><span class="font-weight-bolder">Congratulation Sam
                                                    ðŸŽ‰</span>winner!</p><small class="notification-text"> Won the
                                                monthly best seller badge.</small>
                                        </div>
                                    </div>
                                </a><a class="d-flex" href="javascript:void(0)">
                                    <div class="media d-flex align-items-start">
                                        <div class="media-left">
                                            <div class="avatar"><img
                                                    src="<?php echo base_url('assets/images/portrait/small/avatar-s-3.jpg') ?>"
                                                    alt="avatar" width="32" height="32"></div>
                                        </div>
                                        <div class="media-body">
                                            <p class="media-heading"><span class="font-weight-bolder">New
                                                    message</span>&nbsp;received</p><small class="notification-text">
                                                You have 10 unread messages</small>
                                        </div>
                                    </div>
                                </a><a class="d-flex" href="javascript:void(0)">
                                    <div class="media d-flex align-items-start">
                                        <div class="media-left">
                                            <div class="avatar bg-light-danger">
                                                <div class="avatar-content">MD</div>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <p class="media-heading"><span class="font-weight-bolder">Revised Order
                                                    ðŸ‘‹</span>&nbsp;checkout</p><small class="notification-text"> MD
                                                Inc. order updated</small>
                                        </div>
                                    </div>
                                </a>
                                <div class="media d-flex align-items-center">
                                    <h6 class="font-weight-bolder mr-auto mb-0">System Notifications</h6>
                                    <div class="custom-control custom-control-primary custom-switch">
                                        <input class="custom-control-input" id="systemNotification" type="checkbox"
                                            checked="">
                                        <label class="custom-control-label" for="systemNotification"></label>
                                    </div>
                                </div><a class="d-flex" href="javascript:void(0)">
                                    <div class="media d-flex align-items-start">
                                        <div class="media-left">
                                            <div class="avatar bg-light-danger">
                                                <div class="avatar-content"><i class="avatar-icon" data-feather="x"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <p class="media-heading"><span class="font-weight-bolder">Server
                                                    down</span>&nbsp;registered</p><small class="notification-text"> USA
                                                Server is down due to hight CPU usage</small>
                                        </div>
                                    </div>
                                </a><a class="d-flex" href="javascript:void(0)">
                                    <div class="media d-flex align-items-start">
                                        <div class="media-left">
                                            <div class="avatar bg-light-success">
                                                <div class="avatar-content"><i class="avatar-icon"
                                                        data-feather="check"></i></div>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <p class="media-heading"><span class="font-weight-bolder">Sales
                                                    report</span>&nbsp;generated</p><small class="notification-text">
                                                Last month sales report generated</small>
                                        </div>
                                    </div>
                                </a><a class="d-flex" href="javascript:void(0)">
                                    <div class="media d-flex align-items-start">
                                        <div class="media-left">
                                            <div class="avatar bg-light-warning">
                                                <div class="avatar-content"><i class="avatar-icon"
                                                        data-feather="alert-triangle"></i></div>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <p class="media-heading"><span class="font-weight-bolder">High
                                                    memory</span>&nbsp;usage</p><small class="notification-text"> BLR
                                                Server using high memory</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="dropdown-menu-footer"><a class="btn btn-primary btn-block"
                                    href="javascript:void(0)">Read all notifications</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link"
                            id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder"
                                    id="user_name_d"><?php echo $current_user->name ?></span><span
                                    class="user-status">Admin</span></div><span class="avatar"><img class="round"
                                    src="<?php echo base_url('assets/images/portrait/small/avatar-s-11.jpg') ?>"
                                    alt="avatar" height="40" width="40"><span
                                    class="avatar-status-online"></span></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                            <a class="dropdown-item" href="<?php echo site_url('admin/profile') ?>"><i class="mr-50"
                                    data-feather="user"></i> Profile</a>
                            <a class="dropdown-item" href="<?php echo site_url('admin/email') ?>"><i class="mr-50"
                                    data-feather="mail"></i> Inbox</a>
                            <a class="dropdown-item" href="<?php echo site_url('admin/chat') ?>"><i class="mr-50"
                                    data-feather="message-square"></i> Chats</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo site_url('admin/settings/profile') ?>"><i
                                    class="mr-50" data-feather="settings"></i> Settings</a>
                            <a class="dropdown-item" href="<?php echo site_url('auth/logout') ?>"><i class="mr-50"
                                    data-feather="power"></i> Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- END: Header-->


        <!-- BEGIN: Main Menu-->
        <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mr-auto"><a class="navbar-brand" href="<?php echo site_url('admin') ?>"><span
                                class="brand-logo">
                                <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                                    <defs>
                                        <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%"
                                            y2="89.4879456%">
                                            <stop stop-color="#000000" offset="0%"></stop>
                                            <stop stop-color="#FFFFFF" offset="100%"></stop>
                                        </lineargradient>
                                        <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%"
                                            x2="37.373316%" y2="100%">
                                            <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                            <stop stop-color="#FFFFFF" offset="100%"></stop>
                                        </lineargradient>
                                    </defs>
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                            <g id="Group" transform="translate(400.000000, 178.000000)">
                                                <path class="text-primary" id="Path"
                                                    d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z"
                                                    style="fill:currentColor"></path>
                                                <path id="Path1"
                                                    d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z"
                                                    fill="url(#linearGradient-1)" opacity="0.2"></path>
                                                <polygon id="Path-2" fill="#000000" opacity="0.049999997"
                                                    points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325">
                                                </polygon>
                                                <polygon id="Path-21" fill="#000000" opacity="0.099999994"
                                                    points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338">
                                                </polygon>
                                                <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994"
                                                    points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288">
                                                </polygon>
                                            </g>
                                        </g>
                                    </g>
                                </svg></span>
                            <h2 class="brand-text">AxE Capital</h2>
                        </a></li>
                    <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                                class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                                class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary"
                                data-feather="disc" data-ticon="disc"></i></a></li>
                </ul>
            </div>
            <div class="shadow-bottom"></div>
            <div class="main-menu-content">
                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                    <li class=" nav-item" id="dashboard"><a class="d-flex align-items-center"
                            href="<?php echo base_url('admin/dashboard') ?>"><i data-feather="home"></i><span
                                class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span></a>
                    </li>
                    <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i
                            data-feather="more-horizontal"></i>
                    </li>
                    <li id="email" class=" nav-item"><a class="d-flex align-items-center"
                            href="<?php echo base_url('admin/email') ?>"><i data-feather="mail"></i><span
                                class="menu-title text-truncate" data-i18n="Email">Email</span></a>
                    </li>
                    <li id="chat" class=" nav-item"><a class="d-flex align-items-center"
                            href="<?php echo base_url('admin/chat') ?>"><i data-feather="message-square"></i><span
                                class="menu-title text-truncate" data-i18n="Chat">Chat</span></a>
                    </li>
                    <li class=" nav-item"><a class="d-flex align-items-center" href=""><i
                                data-feather='trending-up'></i></i><span class="menu-title text-truncate"
                                data-i18n="Pages">Blog</span></a>
                        <ul class="menu-content">
                            <li id="recent-blog"><a class="d-flex align-items-center"
                                    href="<?php echo base_url('admin/blog') ?>"><i data-feather="circle"></i><span
                                        class="menu-item text-truncate" data-i18n="Authentication">Recent
                                        Posts</span></a>
                            </li>
                            <li id="my-blog"><a class="d-flex align-items-center"
                                    href="<?php echo base_url('admin/blog') ?>"><i data-feather="circle"></i><span
                                        class="menu-item text-truncate" data-i18n="Account Settings">My Blogs</span></a>
                            </li>
                            <li id="blog-create"><a class="d-flex align-items-center"
                                    href="<?php echo base_url('admin/blog/create') ?>"><i
                                        data-feather="circle"></i><span class="menu-item text-truncate"
                                        data-i18n="Account Settings">New Blog</span></a>
                            </li>
                        </ul>
                    </li>
                    <li id="users" class=" nav-item"><a class="d-flex align-items-center"
                            href="<?php echo base_url('admin/users') ?>"><i data-feather="user"></i><span
                                class="menu-title text-truncate" data-i18n="User">Users</span></a>
                    </li>
                    <li id="plans" class=" nav-item"><a class="d-flex align-items-center"
                            href="<?php echo base_url('admin/plans') ?>"><i data-feather='user'></i></i><span
                                class="menu-title text-truncate" data-i18n="Profile">Plans</span></a>
                    </li>
                    <li id="investments" class=" nav-item"><a class="d-flex align-items-center"
                            href="<?php echo base_url('admin/investments') ?>"><i data-feather='dollar-sign'></i><span
                                class="menu-title text-truncate" data-i18n="Profile">Investments</span></a>
                    </li>
                    <li id="deposits" class=" nav-item"><a class="d-flex align-items-center"
                            href="<?php echo base_url('admin/profile') ?>"><i data-feather='chevrons-up'></i><span
                                class="menu-title text-truncate" data-i18n="Profile">Deposits</span></a>
                    </li>
                    <li id="withdrawals" class=" nav-item"><a class="d-flex align-items-center"
                            href="<?php echo base_url('admin/profile') ?>"><i data-feather='chevrons-down'></i><span
                                class="menu-title text-truncate" data-i18n="Profile">Withdrawals</span></a>
                    </li>
                    <li class=" nav-item"><a class="d-flex align-items-center" href=""><i
                                data-feather="file-text"></i><span class="menu-title text-truncate"
                                data-i18n="Invoice">Invoice</span></a>
                        <ul class="menu-content">
                            <li><a class="d-flex align-items-center" href="app-invoice-list.html"><i
                                        data-feather="circle"></i><span class="menu-item text-truncate"
                                        data-i18n="List">List</span></a>
                            </li>
                            <li><a class="d-flex align-items-center" href="app-invoice-preview.html"><i
                                        data-feather="circle"></i><span class="menu-item text-truncate"
                                        data-i18n="Preview">Preview</span></a>
                            </li>
                            <li><a class="d-flex align-items-center" href="app-invoice-edit.html"><i
                                        data-feather="circle"></i><span class="menu-item text-truncate"
                                        data-i18n="Edit">Edit</span></a>
                            </li>
                            <li><a class="d-flex align-items-center" href="app-invoice-add.html"><i
                                        data-feather="circle"></i><span class="menu-item text-truncate"
                                        data-i18n="Add">Add</span></a>
                            </li>
                        </ul>
                    </li>
                    <li id="profile" class=" nav-item"><a class="d-flex align-items-center"
                            href="<?php echo base_url('admin/profile') ?>"><i data-feather='user'></i></i><span
                                class="menu-title text-truncate" data-i18n="Profile">Profile</span></a>
                    </li>
                    <li class=" nav-item"><a class="d-flex align-items-center" href=""><i
                                data-feather='settings'></i><span class="menu-title text-truncate"
                                data-i18n="Pages">Settings</span></a>
                        <ul class="menu-content">
                            <li id="sys-set"><a class="d-flex align-items-center" href=""><i
                                        data-feather='server'></i></i><span class="menu-item text-truncate"
                                        data-i18n="Authentication">System Settings</span></a>
                                <ul class="menu-content">
                                    <li id="set-sys">
                                        <a class="d-flex align-items-center"
                                            href="<?php echo base_url('admin/settings/system') ?>"><i
                                                data-feather='settings'></i></i></i><span
                                                class="menu-item text-truncate" data-i18n="System settings">System
                                                Settings</span></a>
                                    </li>
                                    <li id="set-mpesa">
                                        <a class="d-flex align-items-center"
                                            href="<?php echo base_url('admin/settings/mpesa') ?>"><i
                                                data-feather='smartphone'></i></i><span class="menu-item text-truncate"
                                                data-i18n="Authentication">M-PESA C2B Settings</span></a>
                                    </li>
                                    <li id="set-b2c">
                                        <a class="d-flex align-items-center"
                                            href="<?php echo base_url('admin/settings/b2c') ?>"><i
                                                data-feather='terminal'></i></i><span class="menu-item text-truncate"
                                                data-i18n="Authentication">M-PESA B2C Settings</span></a>
                                    </li>
                                    <li id="set-email">
                                        <a class="d-flex align-items-center"
                                            href="<?php echo base_url('admin/settings/email') ?>"><i
                                                data-feather='mail'></i></i><span class="menu-item text-truncate"
                                                data-i18n="Authentication">E-MAIL Settings</span></a>
                                    </li>
                                </ul>
                            </li>
                            <li id="acc-set"><a class="d-flex align-items-center"
                                    href="<?php echo base_url('admin/settings/profile') ?>"><i
                                        data-feather="sliders"></i><span class="menu-item text-truncate"
                                        data-i18n="Account Settings">Account Settings</span></a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
        <!-- END: Main Menu-->

        <!-- BEGIN: Content-->
        <div class="app-content content ">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    <!-- Dashboard Analytics Start -->
                    <div class="scrollbar" id="style-7">
                        <div class="force-overflow"></div>
                    </div>
                    <?php
                                bootstrap_alerts();
                                echo $_html_content;
                                if ($_SERVER['REQUEST_URI'] === "/admin/blog/create") {
                                    //dd($_SERVER['REQUEST_URI']);
                                    echo "<script src='" . base_url('assets/js/scripts/pages/page-blog-edit.js') . "'></script>\n";
                                } elseif (str_contains('/admin/users', $_SERVER['REQUEST_URI'])) {
                                    echo "<script src='" . base_url('assets/js/scripts/pages/app-user-list.js') . "'></script>\n";

                                } elseif ($_SERVER['REQUEST_URI'] === "/admin/chat") {
                                    echo "<script src='" . base_url('assets/js/scripts/pages/app-chat.js') . "'></script>\n";
                                } elseif ($_SERVER['REQUEST_URI'] === "/admin/users/view") {
                                    echo "<script src='" . base_url('assets/js/scripts/pages/app-users-view.js') . "'></script>\n";

                                }

                            ?>
                    <!-- Dashboard Analytics end -->

                </div>
            </div>
        </div>
        <!-- END: Content-->

        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>

        <!-- BEGIN: Footer-->
        <footer class="footer footer-static footer-light">
            <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2021<a
                        class="ml-25" href="https://1.envato.market/pixinvent_portfolio"
                        target="_blank">Pixinvent</a><span class="d-none d-sm-inline-block">, All rights
                        Reserved</span></span><span class="float-md-right d-none d-md-block">Hand-crafted & Made with<i
                        data-feather="heart"></i></span></p>
        </footer>
        <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
        <!-- END: Footer-->


        <!-- BEGIN: Blog Vendor JS-->
        <!--<script src="<?php /*echo base_url('assets/vendors/js/forms/select/select2.full.min.js') */?>"></script>
<script src="<?php /*echo base_url('assets/vendors/js/editors/quill/katex.min.js') */?>"></script>
<script src="<?php /*echo base_url('assets/vendors/js/editors/quill/highlight.min.js') */?>"></script>
<script src="<?php /*echo base_url('assets/vendors/js/editors/quill/quill.min.js') */?>"></script>-->
        <!--<script src="<?php /*echo base_url('assets/vendors/js/charts/apexcharts.min.js')*/?>"></script>-->
        <script src="<?php echo base_url('assets/vendors/js/extensions/toastr.min.js') ?>"></script>
        <!-- END: Blog Vendor JS-->


        <!--<script>

    document.getElementById("all-users").className += " active";

</script>-->
        <!-- BEGIN: Theme JS-->
        <script src="<?php echo base_url('assets/js/core/app-menu.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/core/app.js') ?>"></script>
        <!-- END: Theme JS-->


        <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
        </script>
    </body>
    <!-- END: Body-->

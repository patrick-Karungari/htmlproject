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
        <title> Dashboard - Ken Coin</title>
        <link rel="apple-touch-icon" href="<?php echo base_url('assets/images/ico/apple-icon-120.png') ?>')?>">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('assets/images/ico/favicon.ico') ?>">
        <link
            href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
            rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendors/css/vendors.min.css') ?>">

        <link rel="stylesheet" type="text/css"
            href="<?php echo base_url('assets/vendors/css/extensions/toastr.min.css') ?>">


        <!-- END: Vendor CSS-->
        <!-- END: Page CSS-->

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
              href="<?php echo base_url('assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') ?>">
        <link rel="stylesheet" type="text/css"
              href="<?php echo base_url('assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') ?>">
        <link rel="stylesheet" type="text/css"
              href="<?php echo base_url('assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') ?>">
        <link rel="stylesheet" type="text/css"
            href="<?php echo base_url('assets/css/core/menu/menu-types/vertical-menu.css') ?>">

        <link rel="stylesheet" type="text/css"
            href="<?php echo base_url('assets/css/plugins/extensions/ext-component-toastr.css') ?>">


        <!-- BEGIN: Vendor JS-->
        <script src="<?php echo base_url('assets/vendors/js/vendors.min.js') ?>">
        </script>
        <!-- BEGIN Vendor JS-->

        <style>
        .scrollbar {


            overflow-y: scroll;
            /* Add the ability to scroll */
        }

        /* Hide scrollbar for Chrome, Safari and Opera */
        .scrollbar::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .scrollbar {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        /* Steps Progress bar */
        .widget-steps>.step {
            padding: 0;
            position: relative;
        }

        .widget-steps>.step .step-name {
            font-size: 16px;
            margin-bottom: 5px;
            text-align: center;
        }

        .widget-steps>.step>.step-dot {
            position: absolute;
            width: 30px;
            height: 30px;
            display: block;
            background: #fff;
            border: 1px solid #28a745;
            top: 45px;
            left: 50%;
            margin-top: -15px;
            margin-left: -15px;
            border-radius: 50%;
        }

        .widget-steps>.step>.step-dot:after {
            width: 10px;
            height: 10px;
            border-radius: 50px;
            position: absolute;
            top: 9px;
            left: 9px;
        }

        .widget-steps>.step.complete>.step-dot {
            background: #28a745;
        }

        .widget-steps>.step.complete>.step-dot:after {
            content: '\e876';
            font-weight: 900;
            color: #fff;
            font-family: "Material Icons";
            top: 3px;
            left: 7px;
        }

        .widget-steps>.step.active>.step-dot:after {
            background: #28a745;
            content: '';
        }

        .widget-steps>.step>.progress {
            position: relative;
            background: #bbb;
            border-radius: 0px;
            height: 1px;
            box-shadow: none;
            margin: 22px 0;
        }

        .widget-steps>.step>.progress>.progress-bar {
            width: 0px;
            box-shadow: none;
            background: #28a745;
        }

        .widget-steps>.step.complete>.progress>.progress-bar {
            width: 100%;
        }

        .widget-steps>.step.active>.progress>.progress-bar {
            width: 50%;
        }

        .widget-steps>.step:first-child.active>.progress>.progress-bar {
            width: 0%;
        }

        .widget-steps>.step:last-child.active>.progress>.progress-bar {
            width: 100%;
        }

        .widget-steps>.step.disabled>.step-dot {
            border-color: #bbb;
        }

        .widget-steps>.step:first-child>.progress {
            left: 50%;
            width: 50%;
        }

        .widget-steps>.step:last-child>.progress {
            width: 50%;
        }

        .widget-steps>.step.disabled a.step-dot {
            pointer-events: none;
        }

        @media (max-width: 575.98px) {
            .widget-steps>.step .step-name {
                font-size: 14px;
            }
        }

        .rtl .widget-steps>.step>.step-dot {
            top: 45px;
            right: 50%;
            left: auto;
            margin-left: 0;
            margin-right: -15px;
        }

        .rtl .widget-steps>.step>.step-dot:after {
            left: 0px;
            right: 9px;
        }

        .rtl .widget-steps>.step.complete>.step-dot:after {
            left: 0px;
            right: 7px;
        }

        .rtl .widget-steps>.step:first-child>.progress {
            left: auto;
            right: 50%;
        }

        </style>
        <script>
        currency = '<?php echo $currency ?>';
        </script>
    </head>
    <!-- END: Head-->

    <!-- BEGIN: Body-->


    <body class="vertical-layout vertical-menu-modern  scrollbar navbar-floating footer-static  " data-open="click"
        data-menu="vertical-menu-modern" data-col="">

        <!-- BEGIN: Header-->
        <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-dark navbar-shadow">
            <div class="navbar-container d-flex content">
                <div class="bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav d-xl-none">
                        <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon"
                                    data-feather="menu"></i></a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav bookmark-icons">
                        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-email.html"
                                data-toggle="tooltip" data-placement="top" title="Email"><i class="ficon"
                                    data-feather="mail"></i></a></li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-chat.html"
                                data-toggle="tooltip" data-placement="top" title="Chat"><i class="ficon"
                                    data-feather="message-square"></i></a></li>

                    </ul>

                </div>
                <ul class="nav navbar-nav align-items-center ml-auto">

                    <li class="nav-item"><a class="nav-link nav-link-style"><i class="ficon" data-feather="sun"></i></a>
                    </li>
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
                    <?php
                    $notificationsModel = new \App\Models\Notifications();
                    $newNotifications = $notificationsModel->where('user', $current_user->id)->orderBy('id', 'DESC')->where('read', '0')->findAll();
                    ?>
                    <li class="nav-item dropdown dropdown-notification mr-25"><a class="nav-link "
                            style="overflow: visible;" href="javascript:void(0);" data-toggle="dropdown"><i
                                class="ficon" data-feather="bell"></i><span
                                class="badge badge-pill badge-danger badge-up"><?php echo count($newNotifications) ?></span></a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <div class="dropdown-header d-flex">
                                    <h4 class="notification-title mb-0 mr-auto">Notifications</h4>
                                    <div class="badge badge-pill badge-light-primary"><?php echo count($newNotifications) ?> New</div>
                                </div>
                            </li>
                            <li class="scrollable-container media-list">
                                <?php
                                if  (count($newNotifications) > 0) {
                                    $n = 0;
                                    foreach ($newNotifications as $newNotification) {
                                        $n++;
                                        ?>
                                        <a class="d-flex" href="javascript:void(0)">
                                            <div class="media d-flex align-items-start">
                                                <div class="media-left">
                                                    <div class="avatar"><img
                                                                src="<?php echo base_url('assets/images/portrait/small/avatar-s-15.jpg') ?>"
                                                                alt="avatar" width="32" height="32"></div>
                                                </div>
                                                <div class="media-body">
                                                    <p class="media-heading"><span class="font-weight-bolder"><?php echo $newNotification->title ?></span></p>
                                                    <small class="notification-text"><?php echo $newNotification->notification; ?></small>
                                                </div>
                                            </div>
                                        </a>
                                            <?php
                                    }
                                } else {
                                    ?>
                                    <a href="#">No new notifications</a>
                                    <?php
                                }
                                ?>
                            </li>
                            <li class="dropdown-menu-footer"><a class="btn btn-primary btn-block"
                                    href="<?php echo site_url('user/notifications') ?>">Read all notifications</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link"
                            id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder"
                                    id="user_name_d"><?php echo $current_user->name ?></span><span
                                    class="user-status">Invester</span></div>
                            <span class="avatar"><img class="round"
                                    src="<?php echo $current_user->getAvatarUrl() ?>"
                                    alt="avatar" height="40" width="40"><span
                                    class="avatar-status-online"></span></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">

                            <a class="dropdown-item" href="<?php echo site_url('user/email') ?>"><i class="mr-50"
                                    data-feather="mail"></i>
                                Inbox</a>
                            <a class="dropdown-item" href="<?php echo site_url('user/chat') ?>"><i class="mr-50"
                                    data-feather="message-square"></i>
                                Chats</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo site_url('user/settings') ?>"><i class="mr-50"
                                    data-feather="settings"></i>
                                Settings</a>
                            <a class="dropdown-item" href="<?php echo site_url('logout') ?>"><i class="mr-50"
                                    data-feather="power"></i> Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <ul class="main-search-list-defaultlist d-none">
            <li class="d-flex align-items-center"><a href="javascript:void(0);">
                    <h6 class="section-label mt-75 mb-0">Files</h6>
                </a></li>
            <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100"
                    href="app-file-manager.html">
                    <div class="d-flex">
                        <div class="mr-75"><img src="<?php echo base_url('assets/images/icons/xls.png') ?>" alt="png"
                                height="32">
                        </div>
                        <div class="search-data">
                            <p class="search-data-title mb-0">Two new item submitted</p><small
                                class="text-muted">Marketing Manager</small>
                        </div>
                    </div>
                    <small class="search-data-size mr-50 text-muted">&apos;17kb</small>
                </a></li>
            <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100"
                    href="app-file-manager.html">
                    <div class="d-flex">
                        <div class="mr-75"><img src="<?php echo base_url('assets/images/icons/jpg.png') ?>" alt="png"
                                height="32">
                        </div>
                        <div class="search-data">
                            <p class="search-data-title mb-0">52 JPG file Generated</p><small class="text-muted">FontEnd
                                Developer</small>
                        </div>
                    </div>
                    <small class="search-data-size mr-50 text-muted">&apos;11kb</small>
                </a></li>
            <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100"
                    href="app-file-manager.html">
                    <div class="d-flex">
                        <div class="mr-75"><img src="<?php echo base_url('assets/images/icons/pdf.png') ?>" alt="png"
                                height="32">
                        </div>
                        <div class="search-data">
                            <p class="search-data-title mb-0">25 PDF File Uploaded</p><small class="text-muted">Digital
                                Marketing Manager</small>
                        </div>
                    </div>
                    <small class="search-data-size mr-50 text-muted">&apos;150kb</small>
                </a></li>
            <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100"
                    href="app-file-manager.html">
                    <div class="d-flex">
                        <div class="mr-75"><img src="<?php echo base_url('assets/images/icons/doc.png') ?>" alt="png"
                                height="32">
                        </div>
                        <div class="search-data">
                            <p class="search-data-title mb-0">Anna_Strong.doc</p><small class="text-muted">Web
                                Designer</small>
                        </div>
                    </div>
                    <small class="search-data-size mr-50 text-muted">&apos;256kb</small>
                </a></li>
            <li class="d-flex align-items-center"><a href="javascript:void(0);">
                    <h6 class="section-label mt-75 mb-0">Members</h6>
                </a></li>
            <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100"
                    href="app-user-view.html">
                    <div class="d-flex align-items-center">
                        <div class="avatar mr-75"><img
                                src="<?php echo base_url('assets/images/portrait/small/avatar-s-8.jpg') ?>" alt="png"
                                height="32"></div>
                        <div class="search-data">
                            <p class="search-data-title mb-0">John Doe</p><small class="text-muted">UI designer</small>
                        </div>
                    </div>
                </a></li>
            <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100"
                    href="app-user-view.html">
                    <div class="d-flex align-items-center">
                        <div class="avatar mr-75"><img
                                src="<?php echo base_url('assets/images/portrait/small/avatar-s-1.jpg') ?>" alt="png"
                                height="32"></div>
                        <div class="search-data">
                            <p class="search-data-title mb-0">Michal Clark</p><small class="text-muted">FontEnd
                                Developer</small>
                        </div>
                    </div>
                </a></li>
            <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100"
                    href="app-user-view.html">
                    <div class="d-flex align-items-center">
                        <div class="avatar mr-75"><img
                                src="<?php echo base_url('assets/images/portrait/small/avatar-s-14.jpg') ?>" alt="png"
                                height="32"></div>
                        <div class="search-data">
                            <p class="search-data-title mb-0">Milena Gibson</p><small class="text-muted">Digital
                                Marketing Manager</small>
                        </div>
                    </div>
                </a></li>
            <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100"
                    href="app-user-view.html">
                    <div class="d-flex align-items-center">
                        <div class="avatar mr-75"><img
                                src="<?php echo base_url('assets/images/portrait/small/avatar-s-6.jpg') ?>" alt="png"
                                height="32"></div>
                        <div class="search-data">
                            <p class="search-data-title mb-0">Anna Strong</p><small class="text-muted">Web
                                Designer</small>
                        </div>
                    </div>
                </a></li>
        </ul>
        <ul class="main-search-list-defaultlist-other-list d-none">
            <li class="auto-suggestion justify-content-between"><a
                    class="d-flex align-items-center justify-content-between w-100 py-50">
                    <div class="d-flex justify-content-start"><span class="mr-75"
                            data-feather="alert-circle"></span><span>No results found.</span>
                    </div>
                </a></li>
        </ul>
        <!-- END: Header-->


        <!-- BEGIN: Main Menu-->
        <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mr-auto"><a class="navbar-brand" href="<?php echo site_url('account') ?>"><span
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
                            href="<?php echo base_url('user/account') ?>"><i data-feather="home"></i><span
                                class="menu-title text-truncate" data-i18n="Dashboard">Dashboard</span></a>
                    </li>
                    <li class=" nav-item"><a class="d-flex align-items-center"><i
                                data-feather='trending-up'></i></i><span class="menu-title text-truncate"
                                data-i18n="Investments">Investments</span></a>
                        <ul class="menu-content">
                            <li id="investments"><a class="d-flex align-items-center"
                                    href="<?php echo base_url('user/invest') ?>"><i data-feather="circle"></i><span
                                        class="menu-item text-truncate" data-i18n="Investment
                                        Plans">Investment
                                        Plans</span></a>
                            </li>
                            <li id="my-investments"><a class="d-flex align-items-center"
                                    href="<?php echo base_url('user/investments') ?>"><i data-feather="circle"></i><span
                                        class="menu-item text-truncate" data-i18n="My Investments">My
                                        Investments</span></a>
                            </li>

                        </ul>
                    </li>


                    <li id="deposits" class=" nav-item"><a class="d-flex align-items-center"
                            href="<?php echo base_url('user/deposits') ?>"><i data-feather="upload-cloud"></i><span
                                class=" menu-title text-truncate" data-i18n="Deposits">Wallet Deposit</span></a>
                    </li>
                    <li class=" nav-item"><a class="d-flex align-items-center"><i data-feather='trending-up'></i><span
                                class="menu-title text-truncate" data-i18n="Investments">Transact</span></a>
                        <ul class="menu-content">
                            <li id="transfer-btc"><a class="d-flex align-items-center"
                                    href="<?php echo base_url('user/transfers') ?>"><i data-feather="circle"></i><span
                                        class="menu-item text-truncate" data-i18n="Transfer BTC">Transfer BTC</span></a>
                            </li>
                            <li id="transfer-money"><a class="d-flex align-items-center"
                                    href="<?php echo base_url('user/transfers/money') ?>"><i
                                        data-feather="circle"></i><span class="menu-item text-truncate"
                                        data-i18n="Transfer Money">Transfer Money</span></a>
                            </li>

                        </ul>
                    </li>
                    <li class=" nav-item"><a class="d-flex align-items-center"><i
                                data-feather='download-cloud'></i><span class="menu-title text-truncate"
                                data-i18n="Investments">Withdraws</span></a>
                        <ul class="menu-content">
                            <li id="transfer-btc"><a class="d-flex align-items-center"
                                    href="<?php echo base_url('user/withdraws/btc') ?>"><i
                                        data-feather="circle"></i><span class="menu-item text-truncate"
                                        data-i18n="Transfer BTC">Withdraw BTC</span></a>
                            </li>
                            <li id="transfer-money"><a class="d-flex align-items-center"
                                    href="<?php echo base_url('user/withdraws/money') ?>"><i
                                        data-feather="circle"></i><span class="menu-item text-truncate"
                                        data-i18n="Transfer Money">Withdraw Money</span></a>
                            </li>

                        </ul>
                    </li>
<!--                    <li id="withdrawals" class=" nav-item"><a class="d-flex align-items-center"-->
<!--                            href="--><?php //echo base_url('user/withdraws') ?><!--"><i data-feather="download-cloud"></i><span-->
<!--                                class=" menu-title text-truncate" data-i18n="Withdrawals">Withdrawals</span></a>-->
<!--                    </li>-->
                    <li id="referrals" class=" nav-item"><a class="d-flex align-items-center"
                            href="<?php echo base_url('user/referrals') ?>"><i data-feather="users"></i><span
                                class=" menu-title text-truncate" data-i18n="Withdrawals">Referrals</span></a>
                    </li>


                    <li id="acc-set"><a class="d-flex align-items-center"
                            href="<?php echo base_url('user/settings') ?>"><i data-feather="user"></i><span
                                class="menu-item text-truncate" data-i18n="Account Settings">My Profile</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- END: Main Menu-->

        <!-- BEGIN: Content-->
        <div class="app-content content">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper">
                <div id="coinlib" class="mb-1">
                </div>
                <?php
        if ($current_user->registration != 1) {
            ?>
                <div class="alert alert-warning text-center">
                    Please subscribe by paying a one-time fee of <b>Kshs
                        <?php echo get_option('registration_fee') ?></b> to enjoy our investment packages and earn
                    referrals.<br /><br />
                    <a class="btn btn-primary" href="<?php echo site_url('user/deposits/create') ?>">Deposit Now</a>
                </div>
                <?php
        } else {
            ?>
                <div class="align-items-stretch flex-nowrap row ">
                    <div class="alert flex-fill flex-wrap py-1 px-1 ml-1 alert-info">
                        <div> My referral link:</div>
                        <div><code>
                            <?php echo site_url('auth/register') . '?ref=' . $current_user->username; ?></code></div>

                    </div>
                    <div
                        class="d-flex flex-wrap justify-content-center align-self-end align-self-stretch alert py-1 px-1 mr-1 ml-1 alert-success">


                        <p class="text-success">
                            <?php $btcs = (new \App\Models\Bitcoins())->where('user', $current_user->id)->find();
                        $btc = 0;
                        foreach ($btcs as $btc) {
                            $btc = $btc->balance;
                        }

                        echo number_format($btc, 8);
                        ?>
                        </p>
                        <div class="border-right pr-1 d-none d-sm-none d-xl-block d-md-block d-lg-block"></div>
                        <div class="border-left pl-1 d-none d-sm-none d-xl-block d-md-block d-lg-block"></div>
                        <p class=" text-info font-weight-bolder">BTC</p>
                    </div>
                </div>

                <?php
        }
        ?>

                <div class="content-body ">
                    <!-- Dashboard Analytics Start -->

                    <?php
            // dd($_SERVER);


            if ((str_contains($_SERVER['REQUEST_URI'], "/user/account") && (isset($_SERVER['HTTP_REFERER'])) && str_contains($_SERVER['HTTP_REFERER'], "/auth"))) {
                //dd($_SERVER);
                $session = \Config\Services::session();
                if (!empty($session->getFlashData('success'))) {
                    if (str_contains($session->getFlashData('success'), 'You are already signed in.')) {
                        bootstrap_alerts();
                        // dd(true);
                    }
                }
                echo $_html_content;
                //dd($session->getFlashData());

                toastr_alerts($session);
            } else {
                bootstrap_alerts();
                echo $_html_content;


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
            <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT
                    &copy;
                    2021<a class="ml-25" href="https://1.envato.market/pixinvent_portfolio"
                        target="_blank">Pixinvent</a><span class="d-none d-sm-inline-block">, All rights
                        Reserved</span></span><span class="float-md-right d-none d-md-block">Hand-crafted &
                    Made
                    with<i data-feather="heart"></i></span></p>
        </footer>
        <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
        <!-- END: Footer-->


        <!-- BEGIN: Theme JS-->
        <script src="<?php echo base_url('assets/vendors/js/tables/datatable/jquery.dataTables.min.js') ?>">
        </script>
        <script src="<?php echo base_url('assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/vendors/js/tables/datatable/dataTables.responsive.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/vendors/js/tables/datatable/responsive.bootstrap4.js') ?>"></script>
        <script src="<?php echo base_url('assets/vendors/js/tables/datatable/datatables.buttons.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/vendors/js/forms/validation/jquery.validate.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/core/app-menu.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/core/app.js') ?>"></script>
        <!-- END: Theme JS-->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js">
        </script>

        <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
        $('table').DataTable();
        </script>

    </body>
    <!-- END: Body-->

</html>

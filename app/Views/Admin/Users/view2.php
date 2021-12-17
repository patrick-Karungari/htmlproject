<!-- BEGIN: Vendor CSS-->
<?php
/***
 * Created by Pkarungari
 *
 * Github: https://github.com/patrick-karungari
 * E-Mail: pkarungari@gmail.com
 */


 
$deposits = (new \App\Models\Deposits())->where('user', $user->id)->orderBy('id', 'DESC')->find();
$withdraws = (new \App\Models\Withdraws())->where('user', $user->id)->orderBy('id', 'DESC')->find();
$investments = (new \App\Models\Investments())->where('user', $user->id)->orderBy('id', 'DESC')->findAll();
$referrals = (new \App\Models\Referrals())->where('user', $user->id)->orderBy('id', 'DESC')->findAll();
$m_deposits = number_format( (new \App\Libraries\Metrics())->getCurrentMonthDeposit($user->id), 2);
$m_withdraws = number_format((new \App\Libraries\Metrics())->getCurrentMonthWithdraw($user->id), 2);
$ref_bonus = number_format((new \App\Libraries\Metrics())->getUserReferralBonusTotals($user->id), 2);

$_withdraws['data']=$withdraws;
$_deposits['data']=$deposits;
?>
<link rel="stylesheet" type="text/css" href="../../../assets/vendors/css/vendors.min.css">
<link rel="stylesheet" type="text/css"
    href="../../../assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css"
    href="../../../assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="../../../assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
<!-- END: Vendor CSS-->

<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="../../../assets/css/core/menu/menu-types/vertical-menu.css">
<link rel="stylesheet" type="text/css" href="../../../assets/css/pages/app-invoice-list.css">
<link rel="stylesheet" type="text/css" href="../../../assets/css/pages/app-user.css">
<!-- END: Page CSS-->


<section class="app-user-view">
    <!-- User Card & Plan Starts -->
    <div class="row d-flex flex-row align-items-stretch">
        <!-- User Card starts-->
        <div class=" col-xl-9 col-lg-8 col-md-7">
            <div class=" card user-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                            <div class="user-avatar-section">
                                <div class="d-flex justify-content-start">
                                    <img class="img-fluid rounded" src="../../../assets/images/avatars/7.png"
                                        height="104" width="104" alt="User avatar" />
                                    <div class="d-flex flex-column ml-1">
                                        <div class="user-info mb-1">
                                            <h4 class="mb-0"><?php echo ($user->name) ?></h4>
                                            <span class="card-text"><?php echo ($user->email) ?>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-wrap">
                                            <a href="./user-edit.html" class="btn btn-primary">Edit</a>
                                            <button class="btn btn-outline-danger ml-1">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-6 col-lg-12 mt-2 mt-xl-0">
                            <div class="user-info-wrapper">
                                <div class="d-flex flex-wrap">
                                    <div class="user-info-title">
                                        <i data-feather="user" class="mr-1"></i>
                                        <span class="card-text user-info-title font-weight-bold mb-0">Username</span>
                                    </div>
                                    <p class="card-text mb-0"><?php echo ($user->username) ?>
                                    </p>
                                </div>
                                <div class="d-flex flex-wrap my-50">
                                    <div class="user-info-title">
                                        <i data-feather="check" class="mr-1"></i>
                                        <span class="card-text user-info-title font-weight-bold mb-0">Status</span>
                                    </div>
                                    <p class="card-text mb-0"><?php if ($user->registration == 1){
                                        echo "Active";}
                                        else echo "Inactive";  ?>
                                    </p>
                                </div>
                                <div class="d-flex flex-wrap my-50">
                                    <div class="user-info-title">
                                        <i data-feather="star" class="mr-1"></i>
                                        <span class="card-text user-info-title font-weight-bold mb-0">Role</span>
                                    </div>
                                    <p class="card-text mb-0">Admin</p>
                                </div>
                                <div class="d-flex flex-wrap my-50">
                                    <div class="user-info-title">
                                        <i data-feather="flag" class="mr-1"></i>
                                        <span class="card-text user-info-title font-weight-bold mb-0">Country</span>
                                    </div>
                                    <p class="card-text mb-0"><?php echo ($user->country) ?>
                                    </p>
                                </div>
                                <div class="d-flex flex-wrap">
                                    <div class="user-info-title">
                                        <i data-feather="phone" class="mr-1"></i>
                                        <span class="card-text user-info-title font-weight-bold mb-0">Contact</span>
                                    </div>
                                    <p class="card-text mb-0"><?php echo ($user->phone) ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class=" d-flex w-100 mx-1 user-total-numbers">

                            <div class="d-flex align-items-center  mr-3">
                                <div class="color-box bg-light-success">
                                    <i data-feather="trending-up" class="text-success"></i>
                                </div>
                                <div class="ml-1">
                                    <h5 class="mb-0"><?php echo 'Kshs ' .$m_deposits; ?>
                                    </h5>
                                    <small>Monthly Deposits</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mr-3 ">
                                <div class="color-box bg-light-danger">
                                    <i data-feather="trending-down" class="text-danger"></i>
                                </div>
                                <div class="ml-1">
                                    <h5 class="mb-0"><?php echo 'Kshs ' . $m_withdraws; ?></h5>
                                    <small>Monthly Withdraws</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mr-3 ">
                                <div class="color-box bg-light-success">
                                    <i data-feather="dollar-sign" class="text-success"></i>
                                </div>
                                <div class="ml-1">
                                    <h5 class="mb-0"><?php echo 'Kshs ' . $ref_bonus; ?></h5>
                                    <small>Total Bonus</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center ">
                                <div class="color-box bg-light-primary">
                                    <i data-feather="user-plus" class="text-primary"></i>
                                </div>
                                <div class="ml-1">
                                    <h5 class="mb-0"><?php echo ' ' . count($referrals); ?></h5>
                                    <small>Total Downlines</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /User Card Ends-->

        <!-- Balance Card starts-->
        <div class="col-xl-3 col-lg-4 col-md-5 d-flex">
            <div class="card plan-card border-primary w-100">
                <div class="card-header d-flex justify-content-center align-items-center pt-75 mt-5 pb-1">
                    <h2 class="mb-0 align-items-center ">Available Balance: </h2>
                </div>
                <div class=" card-body d-flex align-items-center">

                    <a href="<?php echo base_url('admin/users/pay') ?>"
                        class=" badge badge-light-success text-center btn-block pt-75 pb-75"
                        style="font-size: 32px;">Kshs
                        <?php echo number_format($user->account, 2) ?>
                    </a>
                </div>
            </div>
        </div>
        <!-- /Plan CardEnds -->
    </div>
    <!-- User Card & Plan Ends -->

    <!-- User Timeline & Permissions Starts -->
    <div class=" row ">
        <!-- information starts -->
        <div class=" mx-1 w-100">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-2">User Timeline</h4>
                </div>
                <div class="card-body">
                    <ul class="timeline">
                        <li class="timeline-item">
                            <span class="timeline-point timeline-point-indicator"></span>
                            <div class="timeline-event">
                                <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                    <h6>12 Invoices have been paid</h6>
                                    <span class="timeline-event-time">12 min ago</span>
                                </div>
                                <p>Invoices have been paid to the company.</p>
                                <div class="media align-items-center">
                                    <img class="mr-1" src="../../../assets/images/icons/file-icons/pdf.png"
                                        alt="invoice" height="23" />
                                    <div class="media-body">invoice.pdf</div>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-item">
                            <span class="timeline-point timeline-point-warning timeline-point-indicator"></span>
                            <div class="timeline-event">
                                <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                    <h6>Client Meeting</h6>
                                    <span class="timeline-event-time">45 min ago</span>
                                </div>
                                <p>Project meeting with john @10:15am.</p>
                                <div class="media align-items-center">
                                    <div class="avatar">
                                        <img src="../../../assets/images/avatars/12-small.png" alt="avatar" height="38"
                                            width="38" />
                                    </div>
                                    <div class="media-body ml-50">
                                        <h6 class="mb-0">John Doe (Client)</h6>
                                        <span>CEO of Infibeam</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-item">
                            <span class="timeline-point timeline-point-info timeline-point-indicator"></span>
                            <div class="timeline-event">
                                <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                    <h6>Create a new project for client</h6>
                                    <span class="timeline-event-time">2 days ago</span>
                                </div>
                                <p class="mb-0">Add files to new design folder</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- information Ends -->

        <!-- User Permissions Starts -->

        <!-- User Permissions Ends -->
    </div>
    <!-- User Timeline & Permissions Ends -->

    <!-- User Invoice Starts-->
    <div class="row invoice-list-wrapper">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-2">User Transactions</h4>
                </div>
                <div class="card-datatable table-responsive pb-1">
                    <table class="deposit-list-table table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>Amount</th>
                                <th class="text-truncate">Date</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th class="cell-fit">Description</th>
                                <th class="cell-fit">Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /User Invoice Ends-->





    <script>
    deposits = '<?php echo json_encode($_deposits)  ;?>';
    withdraws = '<?php echo json_encode($_withdraws ) ;?>';
    id = '<?php echo $user->id ;?>';
    </script>


    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../assets/vendors/js/extensions/moment.min.js"></script>
    <script src="../../../assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="../../../assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <script src="../../../assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="../../../assets/vendors/js/tables/datatable/responsive.bootstrap4.js"></script>
    <script src="../../../assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="../../../assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js"></script>
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Page JS-->
    <script src="../../../assets/js/scripts/pages/app-user-view.js"></script>
    <!-- END: Page JS-->

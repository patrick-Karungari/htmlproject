<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */


$referrals = (new \App\Models\Referrals())->where('user', $current_user->id)->where('status', 'completed')->orderBy('id', 'DESC')->findAll();
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/plugins/charts/chart-apex.css')?>">
<link rel="stylesheet" type="text/css"
    href="<?php echo base_url('assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css"
    href="<?php echo base_url('assets/vendors/css/tables/datatable/responsive.bootstrap.min.css')?>">

<section id="dashboard-analytics">
    <div class="row d-flex ">
        <!-- Greetings Card starts -->
        <div class=" flex-fill ml-1 mr-1">
            <div class="card card-congratulations">
                <div class="card-body text-center"><img
                        src="<?php echo base_url('assets/images/elements/decore-left.png')?>"
                        class="congratulations-img-left" alt="card-img-left" /><img
                        src="../../../assets/images/elements/decore-right.png" class="congratulations-img-right"
                        alt="card-img-right" />
                    <div class="avatar avatar-xl bg-primary shadow">
                        <div class="avatar-content"><i data-feather="award" class="font-large-1"></i></div>
                    </div>
                    <div class="text-center">
                        <h1 class="mb-1 text-white">Congratulations <?php echo $current_user->name ?>,
                        </h1>
                        <p class="card-text m-auto w-75">You have done <strong>57.6%</strong> more sales today. Check
                            your new badge in your profile. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Greetings Card ends -->
    <div class="row d-flex ">
        <div class=" d-flex align-self-stretch flex-fill ml-1 mr-1 mh-100 ">
            <div class="card flex-fill mh-100 text-center align-self-stretch">
                <div class="card-header">
                    <h4 class="card-title ">Available Balance</h4>
                </div>
                <div class="d-flex flex-column w-100 h-100">
                    <div class="card-body w-100 d-flex align-items-center  ">
                        <div class="d-flex align-self-end">
                            <div class="avatar bg-light-success pl-1 p-50 mb-1">
                                <div class="avatar-content"><i data-feather="dollar-sign" class="font-medium-5"></i>
                                </div>
                            </div>
                            <div class=" ml-2 d-flex align-self-center align-items-center">
                                <h2 class="font-weight-bolder">KES
                                    <?php echo number_format($current_user->account, 2) ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Statistics Card -->
        <div class="flex-fill ml-1 mr-1">
            <div style="cursor:pointer" onclick="document.location='deposits'" onmouseover="textprimary(this)"
                onmouseout="removeclass(this)" class="card h-card text-center">
                <div class="card-body">
                    <div class="avatar bg-light-success p-50 mb-1">
                        <div class="avatar-content"><i data-feather="trending-up" class="font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="font-weight-bolder">KES
                        <?php echo number_format((new \App\Models\Deposits())->where('user', $current_user->id)->where('status', 'completed')->selectSum('amount', 'totalWithdraws')->get()->getLastRow()->totalWithdraws, 2) ?>
                    </h2>
                    <p class="card-text">Deposits</p>
                </div>
            </div>
        </div>
        <div class=" flex-fill ml-1 mr-1">
            <div style="cursor:pointer" onclick="document.location='withdraws'" onmouseover="textdanger(this)"
                onmouseout="removeclass(this)" class="card h-card text-center">
                <div class="card-body">
                    <div class="avatar bg-light-danger p-50 mb-1">
                        <div class="avatar-content"><i data-feather="trending-down" class="font-medium-5"></i></div>
                    </div>
                    <h2 class="font-weight-bolder">KES
                        <?php echo number_format((new \App\Models\Withdraws())->where('user', $current_user->id)->where('status', 'completed')->selectSum('amount', 'totalWithdraws')->get()->getLastRow()->totalWithdraws, 2) ?>
                    </h2>
                    <p class="card-text">Withdrawals</p>
                </div>
            </div>
        </div>
        <!--/ Statistics Card -->
    </div>
    <div class="row d-flex ">
        <div class="flex-fill mr-1 ml-1 h-100">
            <div class="card card-statistics">
                <div class="card-header">
                    <h4 class="card-title">Statistics</h4>
                    <div class="d-flex align-items-center">
                        <p id="timer" class="card-text font-small-2 mr-25 mb-0">Updated a few seconds ago</p>
                        <ul class="list-inline ml-2 mb-0">
                            <li><a data-action="reload"><i data-feather="rotate-cw"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body statistics-body">
                    <div class="row">
                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                            <div style="cursor:pointer" onclick="document.location='investments'" class="media">
                                <div class="avatar bg-light-primary mr-2">
                                    <div class="avatar-content"><i data-feather="trending-up" class="avatar-icon"></i>
                                    </div>
                                </div>
                                <div class="media-body my-auto">
                                    <h4 id="ri" class="font-weight-bolder mb-0">
                                        <?php echo number_format((new \App\Models\Investments())->where('user', $current_user->id)->where('status', 'pending')->selectSum('total', 'totalInvestments')->get()->getLastRow()->totalInvestments, 2) ?>
                                    </h4>
                                    <p class="card-text font-small-3 mb-0">Running Investments</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                            <div style="cursor:pointer" onclick="document.location='investments'" class="media">
                                <div class="avatar bg-light-info mr-2">
                                    <div class="avatar-content"><i data-feather="user" class="avatar-icon"></i>
                                    </div>
                                </div>
                                <div class="media-body my-auto">
                                    <h4 id="tp" class="font-weight-bolder mb-0">
                                        <?php echo number_format((new \App\Models\Investments())->where('user', $current_user->id)->where('status', 'completed')->selectSum('return', 'totalInvestments')->get()->getLastRow()->totalInvestments, 2) ?>
                                    </h4>
                                    <p class="card-text font-small-3 mb-0">Total Profits</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                            <div style="cursor:pointer" onclick="document.location='referrals'" class="media">
                                <div class="avatar bg-light-danger mr-2">
                                    <div class="avatar-content"><i data-feather="box" class="avatar-icon"></i>
                                    </div>
                                </div>
                                <div class="media-body my-auto">
                                    <h4 id="ar" class="font-weight-bolder mb-0">
                                        <?php  echo count($referrals) ?>
                                    </h4>
                                    <p class="card-text font-small-3 mb-0">Active Referrals</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                            <div style="cursor:pointer" onclick="document.location='referrals'" class="media">
                                <div class="avatar bg-light-info mr-2">
                                    <div class="avatar-content"><i data-feather="user" class="avatar-icon"></i>
                                    </div>
                                </div>
                                <div class="media-body my-auto">
                                    <h4 id="tb" class="font-weight-bolder mb-0">
                                        <?php echo number_format((new \App\Libraries\Metrics())->getUserReferralBonusTotals($current_user->id), 2) ?>
                                    </h4>
                                    <p class="card-text font-small-3 mb-0">Total Bonus</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.getElementById("dashboard").className += " active";
id = '<?php echo $current_user->id ;?>';

function textprimary(x) {
    x.className += " bg-success";
}

function textdanger(x) {
    x.className += " bg-danger";
}

function removeclass(x) {

    x.classList.remove("bg-success");
    x.classList.remove("bg-danger");


}
</script>
<!-- BEGIN: Page Vendor JS-->
<script nomodule src="<?php echo base_url('assets/vendors/countup/dist/countUp.umd.js') ?>
"></script>
<script src="<?php echo base_url('assets/vendors/js/charts/apexcharts.min.js')?>"></script>
<script src="<?php echo base_url('assets/vendors/js/extensions/toastr.min.js')?>"></script>
<script src="<?php echo base_url('assets/vendors/js/extensions/moment.min.js')?>"></script>
<script src="<?php echo base_url('assets/vendors/js/tables/datatable/datatables.min.js')?>"></script>
<script src="<?php echo base_url('assets/vendors/js/tables/datatable/datatables.buttons.min.js')?>"></script>
<script src="<?php echo base_url('assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')?>"></script>
<script src="<?php echo base_url('assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>"></script>
<script src="<?php echo base_url('assets/vendors/js/tables/datatable/responsive.bootstrap.min.js')?>"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Page JS-->
<script type="module" src="<?php echo base_url('assets/js/scripts/pages/dashboard-analytics.js')?>"></script>
<!-- END: Page JS-->

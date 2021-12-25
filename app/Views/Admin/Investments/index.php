<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

use Carbon\Carbon;

$year = !empty(\Config\Services::request()->getGet('year')) ? \Config\Services::request()->getGet('year') : date('Y');
$month = !empty(\Config\Services::request()->getGet('month')) ? \Config\Services::request()->getGet('month') : date('m');
$day = !empty(\Config\Services::request()->getGet('date')) ? \Config\Services::request()->getGet('date') : date('d');

$model = new \App\Models\Investments();

$date = date('Y-m-d');

if ($year && $month && $day) {
    $date = $year . '-' . $month . '-' . $day;
}
$start_of_day = Carbon::parse($date)->startOfDay()->getTimestamp();
$end_of_day = Carbon::parse($date)->endOfDay()->getTimestamp();

$amountCOB = $model->selectSum('total', 'totalAmount')->where('end_time >=', $start_of_day)->where('end_time <=', $end_of_day)->get()->getFirstRow('object')->totalAmount;

$investments = $model->where('user <', '11')->orderBy('id', 'DESC')->findAll();
?>
<!-- BEGIN: Vendor CSS-->

<link rel="stylesheet" type="text/css" href="../../../assets/vendors/css/pickers/pickadate/pickadate.css">
<link rel="stylesheet" type="text/css" href="../../../assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
<!-- END: Vendor CSS-->
<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="../../../assets/css/plugins/forms/pickers/form-flat-pickr.css">
<link rel="stylesheet" type="text/css" href="../../../assets/css/plugins/forms/pickers/form-pickadate.css">
<!-- END: Page CSS-->
<div class="card">
    <div class="card-body justify-content-center text-center">
        <div class="d-flex align-items-start justify-content-between">
            <p class="card-title flex-grow">Day's Payouts</p>
        </div>
        <form class="">
            <div class="content-body">
                <!-- Flatpickr Starts -->
                <section id="flatpickr">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Flatpickr</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="fp-range">Range</label>
                                    <input type="text" id="fp-range" class="form-control flatpickr-range"
                                        placeholder="YYYY-MM-DD to YYYY-MM-DD" />
                                </div>

                            </div>

                        </div>
                    </div>
                </section>
        </form>

        <h5 id="heading" class="text-white mt-3 mb-3">Payouts for <?php echo Carbon::parse($date)->format('M, d Y') ?>
        </h5>
        <h1 id="subheading" class="font-weight-medium mb-0 pt-3 mr-2 text-center">Kshs
            <?php echo number_format($amountCOB, 2); ?></h1>
    </div>
</div>
<div class="card mt-4">
    <div class="card-header">
        <h4 class="card-title">User Investments</h4>
    </div>
    <div class="card-body">
        <?php
if (count($investments) > 0) {
    ?>
        <div class="table-responsive">
            <table id="table" class="table">
                <thead>
                    <tr>
                        <th class="pl-0 pt-0">ID</th>
                        <th>Name</th>
                        <th class="pl-0 pt-0">Days</th>
                        <th class="pt-0">Investment</th>
                        <th class="pt-0">Earnings</th>
                        <th class="pt-0">Total</th>
                        <th class="pt-0">Status</th>
                        <th class="pt-0">Investment Date</th>
                        <th class="pt-0">Settlement Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
$n = 0;
    foreach ($investments as $investment) {
        $n++;
        ?>
                    <tr>
                        <td class="pl-0"><?php echo $n; ?></td>
                        <td>
                            <?php

        if ($investment->user->name) {
            ?>
                            <a
                                href="<?php echo site_url('admin/users/view/' . $investment->user->id) ?>"><?php echo $investment->user->name; ?></a>
                            <?php
} else {
            echo "Deleted User";
        }
        ?>
                        </td>
                        <td><?php echo $investment->plan->title; ?></td>
                        <td><?php echo 'Kshs ' . number_format($investment->amount, 2); ?></td>
                        <td><?php echo 'Kshs ' . number_format($investment->return, 2); ?></td>
                        <td><?php echo 'Kshs ' . number_format($investment->total, 2); ?></td>
                        <td>
                            <?php
$status = $investment->status;
        if ($status == 'completed') {
            ?> <label class="badge badge-outline-success mr-4 mr-xl-2">Completed</label>
                            <?php
} else if ($status == 'pending') {
            ?> <label class="badge badge-outline-warning mr-4 mr-xl-2">Pending</label> <?php
} else if ($status == 'failed') {
            ?> <label class="badge badge-outline-danger mr-4 mr-xl-2">Failed</label> <?php
} else if ($status == 'cancelled') {
            ?> <label class="badge badge-outline-danger mr-4 mr-xl-2">Cancelled</label> <?php
}
        ?>
                        </td>
                        <td><?php echo $investment->created_at->format('d/m/Y h:i a'); ?></td>
                        <td><?php echo \Carbon\Carbon::createFromTimestamp($investment->end_time)->format('d/m/Y h:i a') ?>
                        </td>
                    </tr>
                    <?php
}
    ?>
                </tbody>
            </table>
        </div>
        <?php
} else {
    ?>
        <div class="alert alert-warning">
            You have not made any investments yet
        </div>
        <?php
}
?>
    </div>
</div>
<script>
document.getElementById("investments").className += " active";
</script>
<!-- BEGIN: Page Vendor JS-->
<script src="../../../assets/vendors/js/pickers/pickadate/picker.js"></script>
<script src="../../../assets/vendors/js/pickers/pickadate/picker.date.js"></script>
<script src="../../../assets/vendors/js/pickers/pickadate/picker.time.js"></script>
<script src="../../../assets/vendors/js/pickers/pickadate/legacy.js"></script>
<script src="../../../assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Page JS-->
<script src="../../../assets/js/scripts/forms/pickers/form-pickers.js"></script>
<!-- END: Page JS-->

<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

$deposits = (new \App\Models\Deposits())->where('user', $user->id)->orderBy('id', 'DESC')->findAll();
$withdraws = (new \App\Models\Withdraws())->where('user', $user->id)->orderBy('id', 'DESC')->findAll();
$investments = (new \App\Models\Investments())->where('user', $user->id)->orderBy('id', 'DESC')->findAll();
$referrals = (new \App\Models\Referrals())->where('user', $user->id)->orderBy('id', 'DESC')->findAll();

?>
<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css"
    href="../../../assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css"
    href="<?php echo base_url('assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') ?>">
<link rel="stylesheet" type="text/css"
    href="<?php echo base_url('assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') ?>">
<!-- END: Vendor CSS-->

<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/plugins/forms/form-validation.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/pages/app-user.css') ?>">
<!-- END: Page CSS-->


<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between flex-wrap">
            <div class="d-flex align-items-center dashboard-header flex-wrap mb-3 mb-sm-0">
                <h5 class="mr-4 mb-0 font-weight-bold"><?php echo $user->name; ?></h5>
            </div>
            <div class="d-flex">
                <div class="mr-3">
                    <button type="button" class="btn btn-primary">Bal: Kshs
                        <?php echo number_format($user->account, 2) ?></button>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="card mt-4">
    <div class="card-body ">
        <h4 class="card-title">Deposits</h4>
        <?php
if (count($deposits) > 0) {
    ?>
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th class="pl-0 pt-0">ID</th>
                        <th class="pl-0 pt-0">Phone</th>
                        <th class="pt-0">Amount</th>
                        <th class="pt-0">Transaction ID</th>
                        <th class="pt-0">Status</th>
                        <th class="pt-0">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
$n = 0;
    foreach ($deposits as $deposit) {
        $n++;
        ?>
                    <tr>
                        <td class="pl-0"><?php echo $n; ?></td>
                        <td><?php echo $deposit->phone; ?></td>
                        <td><?php echo $deposit->amount; ?></td>
                        <td><?php echo $deposit->trx_id; ?></td>
                        <td>
                            <?php
$status = $deposit->status;
        if ($status == 'completed') {
            ?> <label class="badge badge-outline-success mr-4 mr-xl-2">Completed</label> <?php
} else if ($status == 'pending') {
            ?> <label class="badge badge-outline-warning mr-4 mr-xl-2">Pending</label> <?php
} else if ($status == 'failed') {
            ?> <label class="badge badge-outline-danger mr-4 mr-xl-2">Failed</label> <?php
} else if ($status == 'cancelled') {
            ?> <label class="badge badge-outline-danger mr-4 mr-xl-2">Cancelled</label> <?php
}
        ?>
                        </td>
                        <td><?php echo $deposit->date->format('d/m/Y h:i a'); ?></td>
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
            User not made any deposits yet
        </div>
        <?php
}
?>
    </div>
</div>



<div class="card mt-4">
    <div class="card-body">
        <h4 class="card-title">Referrals</h4>
        <?php
if (count($referrals) > 0) {
    ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="pl-0 pt-0">ID</th>
                        <th class="pl-0 pt-0">Name</th>
                        <th class="pt-0">First Deposit</th>
                        <th class="pt-0">My Commission</th>
                        <th class="pt-0">My Bonus</th>
                        <th class="pt-0">Status</th>
                        <th class="pt-0">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
$n = 0;
    foreach ($referrals as $referral) {
        //dd($referral->ref);
        $n++;
        ?>
                    <tr>
                        <td class="pl-0"><?php echo $n; ?></td>
                        <td><?php echo $referral->ref->name ?? "Deleted User"; ?></td>
                        <td><?php echo $referral->first_amount; ?></td>
                        <td><?php echo $referral->commission; ?></td>
                        <td><?php echo $referral->bonus; ?></td>
                        <td>
                            <?php
$status = $referral->status;
        if ($status == 'completed') {
            ?> <label class="badge badge-outline-success mr-4 mr-xl-2">Completed</label> <?php
} else if ($status == 'pending') {
            ?> <label class="badge badge-outline-warning mr-4 mr-xl-2">Pending</label> <?php
} else if ($status == 'failed') {
            ?> <label class="badge badge-outline-danger mr-4 mr-xl-2">Failed</label> <?php
} else if ($status == 'cancelled') {
            ?> <label class="badge badge-outline-danger mr-4 mr-xl-2">Cancelled</label> <?php
}
        ?>
                        </td>
                        <td><?php echo $referral->date->format('d/m/Y h:i a'); ?></td>
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
            User not referred anyone yet
        </div>
        <?php
}
?>
    </div>
</div>


<div class="card mt-4">
    <div class="card-body">
        <h4 class="card-title">Withdraws</h4>
        <?php
if (count($withdraws) > 0) {
    ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="pl-0 pt-0">ID</th>
                        <th class="pl-0 pt-0">Phone</th>
                        <th class="pt-0">Amount</th>
                        <th class="pt-0">Transaction ID</th>
                        <th class="pt-0">Status</th>
                        <th class="pt-0">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
$n = 0;
    foreach ($withdraws as $withdraw) {
        $n++;
        ?>
                    <tr>
                        <td class="pl-0"><?php echo $n; ?></td>
                        <td><?php echo $withdraw->phone; ?></td>
                        <td><?php echo $withdraw->amount; ?></td>
                        <td><?php echo $withdraw->trx_id; ?></td>
                        <td>
                            <?php
$status = $withdraw->status;
        if ($status == 'completed') {
            ?> <label class="badge badge-outline-success mr-4 mr-xl-2">Completed</label> <?php
} else if ($status == 'pending') {
            ?> <label class="badge badge-outline-warning mr-4 mr-xl-2">Pending</label> <?php
} else if ($status == 'failed') {
            ?> <label class="badge badge-outline-danger mr-4 mr-xl-2">Failed</label> <?php
}
        ?>
                        </td>
                        <td><?php echo $withdraw->date->format('d/m/Y h:i a'); ?></td>
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
            User not made any withdraws yet
        </div>
        <?php
}
?>
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
            <table class="table">
                <thead>
                    <tr>
                        <th class="pl-0 pt-0">ID</th>
                        <th class="pl-0 pt-0">Days</th>
                        <th class="pt-0">Investment</th>
                        <th class="pt-0">Earnings</th>
                        <th class="pt-0">Status</th>
                        <th class="pt-0">Settlement Date</th>
                        <th class="pt-0">Date</th>
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
                        <td><?php echo $investment->plan->title; ?></td>
                        <td><?php echo 'Kshs ' . number_format($investment->amount, 2); ?></td>
                        <td><?php echo 'Kshs ' . number_format($investment->return, 2); ?></td>
                        <td>
                            <?php
$status = $investment->status;
        if ($status == 'completed') {
            ?> <label class="badge badge-outline-success mr-4 mr-xl-2">Completed</label> <?php
} else if ($status == 'pending') {
            ?> <label class="badge badge-outline-warning mr-4 mr-xl-2">Pending</label> <?php
} else if ($status == 'failed') {
            ?> <label class="badge badge-outline-danger mr-4 mr-xl-2">Failed</label> <?php
} else if ($status == 'cancelled') {
            ?> <label class="badge badge-outline-danger mr-4 mr-xl-2">Cancelled</label> <?php
}
        ?>
                        </td>
                        <td><?php echo \Carbon\Carbon::createFromTimestamp($investment->end_time)->format('d/m/Y h:i a') ?>
                        </td>
                        <td><?php echo $investment->created_at->format('d/m/Y h:i a'); ?></td>
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
            User not made any investments yet
        </div>
        <?php
}
?>
    </div>
</div>

<?php
$transactions = (new \App\Models\Transactions())
    ->orderBy('id', 'DESC')
    ->where('user', $user->id)->findAll();
?>
<div class="card mt-4">
    <div class="card-body">
        <h4 class="card-title">My Transactions</h4>
        <?php
if (count($transactions) > 0) {
    ?>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php
$n = 0;
    foreach ($transactions as $transaction) {
        $n++;
        ?>
                <tr>
                    <td><?php echo $n; ?></td>
                    <td><?php echo $transaction->date; ?></td>
                    <td><?php echo $transaction->amount; ?></td>
                    <td><?php echo $transaction->type; ?></td>
                    <td><?php echo $transaction->description; ?></td>
                </tr>
                <?php
}
    ?>
            </tbody>
        </table>
        <?php
} else {
    ?>
        <div class="alert alert-warning">
            No data available
        </div>
        <?php
}
?>
    </div>
</div>
<!-- BEGIN: Page Vendor JS-->
<script src="<?php echo base_url('assets/vendors/js/tables/datatable/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendors/js/tables/datatable/dataTables.responsive.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendors/js/tables/datatable/responsive.bootstrap4.js') ?>"></script>
<script src="<?php echo base_url('assets/vendors/js/tables/datatable/datatables.buttons.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendors/js/forms/validation/jquery.validate.min.js') ?>"></script>
<!-- END: Page Vendor JS-->

<?php
/***
 * Created by Bennito254
 *
 * Github: https://github.com/bennito254
 * E-Mail: bennito254@gmail.com
 */

use Carbon\Carbon;

$year = !empty(\Config\Services::request()->getGet('year')) ? \Config\Services::request()->getGet('year') : date('Y');
$month = !empty(\Config\Services::request()->getGet('month')) ? \Config\Services::request()->getGet('month') : date('m');
$day = !empty(\Config\Services::request()->getGet('date')) ? \Config\Services::request()->getGet('date') : date('d');

$model = new \App\Models\Investments();

$date = date('Y-m-d');

if ($year && $month && $day) {
    $date = $year.'-'.$month.'-'.$day;
}
$start_of_day = Carbon::parse($date)->startOfDay()->getTimestamp();
$end_of_day = Carbon::parse($date)->endOfDay()->getTimestamp();
//d($start_of_day);
//d($end_of_day);
$amountCOB = $model->selectSum('total', 'totalAmount')->where('end_time >=', $start_of_day)->where('end_time <=', $end_of_day)->get()->getFirstRow('object')->totalAmount;

$investments = $model->where('user <', '11')->orderBy('id', 'DESC')->findAll();
?>
<div class="card">
    <div class="card-body justify-content-center text-center">
        <div class="d-flex align-items-start justify-content-between">
            <p class="card-title flex-grow">Day's Payouts</p>
        </div>
        <form class="">
            <select class="form-control-sm d-inline" name="year">
                <?php
                $old_year = date('Y')-2;
                for($i = $old_year; $i <= $old_year+2; $i++) {
                    ?>
                    <option <?php echo ($i == date('Y') || $i == $year) ? 'selected' : '' ?> value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php
                }
                ?>
            </select>
            <select class="form-control-sm d-inline" name="month">
                <?php
                for($i = 1; $i <= 12; $i++) {
                    ?>
                    <option <?php echo ($i == date('m') || $i == $month) ? 'selected' : '' ?> value="<?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?>"><?php echo Carbon::parse('2021-'.str_pad($i, 2, '0', STR_PAD_LEFT).'-01')->isoFormat('MMM') ?></option>
                    <?php
                }
                ?>
            </select>
            <select class="form-control-sm d-inline" name="date">
                <?php
                for ($i = 1; $i <= 31; $i++) {
                    ?>
                    <option <?php echo ($i == date('d') || $i == $day) ? 'selected' : '' ?> value="<?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?>"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                    <?php
                }
                ?>
            </select>
            <button type="submit" class="btn btn-sm btn-primary d-inline">View</button>
        </form>

        <h5 class="text-white mt-3 mb-3">Payouts for <?php echo Carbon::parse($date)->format('M, d Y') ?> </h5>
        <h1 class="font-weight-medium mb-0 pt-3 mr-2 text-center">Kshs <?php echo number_format($amountCOB,2); ?></h1>
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
                                    <a href="<?php echo site_url('admin/users/view/'.$investment->user->id) ?>"><?php echo $investment->user->name; ?></a>
                                    <?php
                                } else {
                                    echo "Deleted User";
                                }
                                ?>
                            </td>
                            <td><?php echo $investment->plan->title; ?></td>
                            <td><?php echo 'Kshs '.number_format($investment->amount, 2); ?></td>
                            <td><?php echo 'Kshs '.number_format($investment->return, 2); ?></td>
                            <td><?php echo 'Kshs '.number_format($investment->total, 2); ?></td>
                            <td>
                                <?php
                                $status = $investment->status;
                                if ($status == 'completed') {
                                    ?> <label class="badge badge-outline-success mr-4 mr-xl-2">Completed</label>
                                    <?php
                                } else if($status == 'pending') {
                                    ?> <label class="badge badge-outline-warning mr-4 mr-xl-2">Pending</label> <?php
                                } else if($status == 'failed') {
                                    ?> <label class="badge badge-outline-danger mr-4 mr-xl-2">Failed</label> <?php
                                } else if($status == 'cancelled') {
                                    ?> <label class="badge badge-outline-danger mr-4 mr-xl-2">Cancelled</label> <?php
                                }
                                ?>
                            </td>
                            <td><?php echo $investment->created_at->format('d/m/Y h:i a'); ?></td>
                            <td><?php echo \Carbon\Carbon::createFromTimestamp($investment->end_time)->format('d/m/Y h:i a') ?></td>
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
    $(document).ready( function () {
        $('#table').DataTable();
    } );
</script>
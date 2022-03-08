<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

$investments = (new \App\Models\Investments())->where('user', $current_user->id)->orderBy('id', 'DESC')->findAll();
?>
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between flex-wrap">
            <div class="d-flex align-items-center dashboard-header flex-wrap mb-3 mb-sm-0">
                <h5 class="mr-4 mb-0 font-weight-bold">My Investments</h5>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h4 class="card-title">My Investments</h4>
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
                        <td><?php echo $investment->plan->title; ?></td>
                        <td><?php echo 'Kshs ' . number_format($investment->amount, 2); ?></td>
                        <td><?php echo 'Kshs ' . number_format($investment->return, 2); ?></td>
                        <td><?php echo 'Kshs ' . number_format($investment->total, 2); ?></td>
                        <td>
                            <?php
$status = $investment->status;
        if ($status == 'completed') {
            ?> <label class="badge badge-outline-success mr-4 mr-xl-2">Completed</label>
                            <form class="d-inline" method="post" action="<?php echo site_url('user/invest/create') ?>">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="plan" value="<?php echo $investment->plan->id ?>">
                                <input type="hidden" name="amount" value="<?php echo $investment->total ?>">
                                <button type="submit" class="btn btn-sm btn-success"
                                    title="Reinvest Kshs <?php echo $investment->total ?>">Reinvest</button>
                            </form>
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
        <div class="alert alert-warning py-1 pl-1">
            You have not made any investments yet
        </div>
        <?php
}
?>
    </div>
</div>
<script>
document.getElementById("my-investments").className += " active";
</script>

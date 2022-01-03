<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

$withdraws = (new \App\Models\Withdraws())->where('user', $current_user->id)->orderBy('id', 'DESC')->findAll();
?>
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between flex-wrap">
            <div class="d-flex align-items-center dashboard-header flex-wrap mb-3 mb-sm-0">
                <h5 class="mr-4 mb-0 font-weight-bold">My Withdraws</h5>
            </div>
            <div class="d-flex">
                <div class="mr-3">
                    <a class="btn btn-primary" href="<?php echo site_url('user/withdraws/create') ?>">Withdraw Funds</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
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
                        <th class="pt-0">Description</th>
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
} else if ($status == 'cancelled') {
            ?> <label class="badge badge-outline-danger mr-4 mr-xl-2">Cancelled</label> <?php
}
        ?>
                            </td>
                            <td><?php echo $withdraw->description; ?></td>
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
                You have not made any withdraws yet
            </div>
            <?php
}
?>
    </div>
</div>
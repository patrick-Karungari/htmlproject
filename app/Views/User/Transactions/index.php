<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

$type = \Config\Services::request()->getGet('type');
$types = ['referral', 'reversal', 'investment', 'withdraw', 'deposit', 'registration', 'bonus', 'returns'];
$model = (new \App\Models\Transactions())
    ->orderBy('id', 'DESC');
if ($type && in_array($type, $types)) {
    $model->where('type', $type);
}
$transactions = $model->where('user', $current_user->id)->findAll();
?>
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between flex-wrap">
            <div class="d-flex align-items-center dashboard-header flex-wrap mb-3 mb-sm-0">
                <h5 class="mr-4 mb-0 font-weight-bold">My Transactions</h5>
            </div>
        </div>
    </div>
</div>
<div class="mb-2">
    <?php
foreach ($types as $type) {
    ?>
        <a class="btn btn-sm btn-primary" href="<?php echo site_url('user/transactions?type=' . $type) ?>"><?php echo ucwords($type) ?></a>
        <?php
}
?>
</div>
<div class="card">
    <div class="card-body">
        <?php
if (count($transactions) > 0) {
    ?>
            <div class="table-responsive">
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
            </div>
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
<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

$referrals = (new \App\Models\Referrals())->where('user', $current_user->id)->orderBy('id', 'DESC')->findAll(); 
dd($referrals);
?>


<div class="card">
    <h5 class="m-2 mb-0 font-weight-bold">My Referrals</h5>
    <div class="card-body">
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
        <div class="alert p-1 alert-warning">
            You have not referred anyone yet
        </div>
        <?php
}
?>
    </div>
</div>

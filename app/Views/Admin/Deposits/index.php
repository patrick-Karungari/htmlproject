<?php
/***
 * Created by Bennito254
 *
 * Github: https://github.com/bennito254
 * E-Mail: bennito254@gmail.com
 */

$deposits = (new \App\Models\Deposits())->orderBy('id', 'DESC')->findAll();
?>
<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
            <p class="card-title flex-grow">User Deposits</p>
        </div>

        <?php
        if (count($deposits) > 0) {
            ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th class="pl-0 pt-0">ID</th>
                        <th class="pl-0 pt-0">User</th>
                        <th class="pt-0">Amount</th>
                        <th class="pt-0">Transaction ID</th>
                        <th>Status</th>
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
                            <td><?php echo $deposit->user->name; ?></td>
                            <td><?php echo $deposit->amount; ?></td>
                            <td><?php echo $deposit->trx_id; ?></td>
                            <td>
                                <?php
                                $status = $deposit->status;
                                if ($status == 'completed') {
                                    ?> <label class="badge badge-outline-success mr-4 mr-xl-2">Completed</label> <?php
                                } else if($status == 'pending') {
                                    ?> <label class="badge badge-outline-warning mr-4 mr-xl-2">Pending</label>
                                    <a href="<?php echo site_url('admin/deposits/approve/'.$deposit->id); ?>" class="btn btn-sm btn-warning">Approve</a>
                                    <?php
                                } else if($status == 'failed') {
                                    ?> <label class="badge badge-outline-danger mr-4 mr-xl-2">Failed</label> <?php
                                } else if($status == 'cancelled') {
                                    ?> <label class="badge badge-outline-danger mr-4 mr-xl-2">Cancelled</label> <?php
                                }
                                ?>
                            </td>
                            <td><?php echo $deposit->date; ?></td>
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
                No deposits available
            </div>
            <?php
        }
        ?>
    </div>
</div>

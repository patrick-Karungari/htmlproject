<?php
$model = new \App\Models\BitcoinWithdraws();

$date_filter = \Config\Services::request()->getGet('date');
//$model->where('method', 'mo')
if (!empty($date_filter)) {
    $model->like('created_at', $date_filter, 'after');
}
$model->orderBy('id', 'DESC');
$withdraws = $model->findAll();
//$pager = $model->pager;

?>
<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
            <p class="card-title flex-grow">User Withdraws</p>
        </div>

        <?php
        if (count($withdraws) > 0) {
            ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th class="pl-0 pt-0">ID</th>
                        <th class="pl-0 pt-0">User</th>
                        <th class="pt-0">Amount</th>
                        <th class="pt-0">Address</th>
                        <th class="pt-0">Status</th>
                        <th class="pt-0">Transaction ID</th>
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
                            <td><?php echo $withdraw->user->name; ?></td>
                            <td><?php echo $withdraw->amount; ?></td>
                            <td><code><?php echo $withdraw->address; ?></code></td>
                            <td>
                                <?php
                                $status = $withdraw->status;
                                if ($status == '1') {
                                    ?> <span data-search="Completed" class="badge badge-pill ml-1 bg-light-success" text-uppercase=""><i class="" data-feather="check-circle"></i> Completed</span> <?php
                                } else if ($status == '0') {
                                    ?>
                                    <span class="badge badge-pill ml-1 bg-light-warning"><i class="" data-feather="refresh-cw"></i> Pending</span>
                                    <button data-toggle="modal" data-target="#exampleModal<?php echo $withdraw->id ?>"
                                            data-amount="<?php echo $withdraw->amount; ?>"
                                            data-name="<?php echo $withdraw->user->name; ?>"
                                            data-account="<?php echo $withdraw->account; ?>"
                                            data-userid="<?php echo $withdraw->user->id; ?>"
                                            data-withdrawid="<?php echo $withdraw->id; ?>" type="button"
                                            class="btn btn-sm btn-success"
                                            title="Pay Kshs <?php echo $withdraw->amount ?>">Pay</button>


                                    <div class="modal fade" id="exampleModal<?php echo $withdraw->id ?>" tabindex="-1"
                                         role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">New Payment to
                                                        <?php echo $withdraw->user->name; ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form class="d-inline " method='post'
                                                      action="<?php echo site_url('admin/withdraws/manualwithdraw') ?>">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="id" value="<?php echo $withdraw->id; ?>" />
                                                    <input type="hidden" name="user_id"
                                                           value="<?php echo $withdraw->user->id; ?>" />
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Phone Number</label>
                                                            <input id="phone" type="text" name="phone"
                                                                   value="<?php echo $withdraw->user->phone ?>"
                                                                   class="form-control" required />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Amount</label>
                                                            <input id="amount" type="number" name="amount"
                                                                   value="<?php echo $withdraw->amount ?>" class="form-control"
                                                                   required />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Transaction ID</label>
                                                            <input
                                                                oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);"
                                                                type="text" name="trx_id" class="form-control" value=""
                                                                autocomplete="off" required />

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-sm btn-success">Confirm
                                                                Payment</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                } else if ($status == '2') {
                                    ?>
                                    <span class="badge badge-pill ml-1 bg-light-danger"><i class="" data-feather="x-circle"></i> Failed</span>
                                    <?php
                                } else {
                                    ?> <span class="badge badge-pill ml-1 bg-light-danger"><i class="" data-feather="x-circle"></i> Cancelled</span> <?php
                                }
                                ?>
                            </td>
                            <td><?php echo $withdraw->trx_id; ?></td>
                            <td><?php echo $withdraw->date; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <?php
            //echo $pager->links();
        } else {
            ?>
            <div class="alert alert-warning">
                No withdraws available
            </div>
            <?php
        }
        ?>
    </div>
</div>
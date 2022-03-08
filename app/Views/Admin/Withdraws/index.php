<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

$withdraws = (new \App\Models\Withdraws())->orderBy('date', 'DESC')->findAll();
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
                        <td>
                            <?php
$status = $withdraw->status;
        if ($status == 'completed') {
            ?> <label class="badge badge-outline-success mr-4 mr-xl-2">Completed</label> <?php
} else if ($status == 'pending') {
            ?>
                            <label class="badge badge-outline-warning mr-4 mr-xl-2">Pending</label>
                            <button data-toggle="modal" data-target="#exampleModal<?php echo $withdraw->id ?>"
                                data-amount="<?php echo $withdraw->amount; ?>"
                                data-name="<?php echo $withdraw->user->name; ?>"
                                data-phone="<?php echo $withdraw->phone; ?>"
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
                                            <?php echo csrf_field(); ?>
                                            action="<?php echo site_url('admin/withdraws/manualwithdraw') ?>">
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
} else if ($status == 'failed') {
            ?>
                            <label class="badge badge-outline-danger mr-4 mr-xl-2">Failed</label>
                            <?php
} else if ($status == 'cancelled') {
            ?> <label class="badge badge-outline-danger mr-4 mr-xl-2">Cancelled</label> <?php
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


<style>
input:read-only {
    width: 100%;

    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

</style>

<script>
$('#exampleModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('name') // Extract info from data-* attributes
    var amount = button.data('amount')
    var phone = button.data('phone')
    var userID = button.data('userid')
    var withdrawID = button.data('withdrawID')
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-title').text('New Payment to ' + recipient + " wihtdraw ID" + withdrawID)
    modal.find('#phone').val(phone)
    modal.find('#amount').val(amount)
    modal.find('#user_id').val(userID)
    modal.find('input[id=withdraw_id]').val('' + withdrawID)
    //$('#withdraw_id').attr('value', withdrawID)
})
</script>

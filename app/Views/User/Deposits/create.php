<?php
/***
 * Created by Bennito254
 *
 * Github: https://github.com/bennito254
 * E-Mail: bennito254@gmail.com
 */
?>
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between flex-wrap">
            <div class="d-flex align-items-center dashboard-header flex-wrap mb-3 mb-sm-0">
                <h5 class="mr-4 mb-0 font-weight-bold">Deposit Funds</h5>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h4 class="text-center">Deposit via M-Pesa</h4>
                <hr/>
                <?php
                if ($current_user->registration != 1) {
                    ?>
                    <div class="alert alert-warning">
                        You will be deducted a registration fee of Kshs <?php echo number_format(get_option('registration_fee', 0)) ?> on your first deposit
                    </div>
                    <?php
                }
                ?>
                <form method="post">
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone" class="form-control" value="<?php echo old('phone', $current_user->phone) ?>" required />
                    </div>
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="number" name="amount" class="form-control" min="10" value="<?php echo old('amount', 50) ?>" required />
                    </div>
                    <button type="submit" class="btn btn-primary">Send Payment Request</button>
                </form>
            </div>
        </div>
    </div>
</div>
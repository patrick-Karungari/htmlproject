<?php
/***
 * Created by Bennito254
 *
 * Github: https://github.com/bennito254
 * E-Mail: bennito254@gmail.com
 */

use App\Libraries\Metrics;

?>
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between flex-wrap">
            <div class="d-flex align-items-center dashboard-header flex-wrap mb-3 mb-sm-0">
                <h5 class="mr-4 mb-0 font-weight-bold">Withdraw Funds</h5>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <?php
        $minimum_withdraw_amount = get_option('minimum_bonus_withdraw', 0);
        $minimum_running_investment = get_option('minimum_running_investment', 0);
        $investmentTotals = (new Metrics())->getUserInvestmentTotals($current_user->id);
        $acc_bal = $current_user->account;
        if($minimum_running_investment > $investmentTotals ) {
            ?>
            <div class="alert alert-warning">
                <?php
                echo "You must have running investments of Kshs $minimum_running_investment. Your current running investment is Kshs $investmentTotals";
                ?>
            </div>
            <?php
        }else {
                     
            ?>
            
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h4 class="text-center">Withdraw via M-Pesa</h4>
                    <hr/>
                    <form method="post">
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" name="phone" class="form-control disabled" value="<?php echo old('phone', $current_user->phone) ?>" required />
                            <small>While you can deposit from whichever number you want, the money will be withdrawn to the number you registered with to avoid fraud</small>
                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="number" name="amount" class="form-control" min="10" value="<?php echo old('amount', $minimum_withdraw_amount) ?>" required />
                        </div>
                        <button type="submit" class="btn btn-primary">Withdraw</button>
                    </form>
                </div>
            </div>
            <?php 
             }
        
        ?>
    </div>
</div>
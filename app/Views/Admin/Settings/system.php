<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */
?>


<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">System Settings</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo site_url('admin/dashboard') ?>">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Settings</a>
                        </li>
                        <li class="breadcrumb-item active"> System Settings
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
            <div class="dropdown">
                <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="app-todo.html"><i class="mr-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="mr-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="mr-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="mr-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
            </div>
        </div>
    </div>
</div>
<div class="card mb-3">
    <div class="card-body">
        <h4 class="card-title">System Settings</h4>
        <form class="forms-sample" method="post">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="exampleInputUsername1">Site Title</label>
                <input type="text" name="site_title" value="<?php echo get_option('site_title', '"MLM Project'); ?>" class="form-control" id="exampleInputUsername1" placeholder="Site title">
            </div>
            <div class="form-group">
                <label for="exampleInputUsername1">Site Description</label>
                <textarea class="form-control" rows="4" name="site_description"><?php echo get_option('site_description', "MLM Project") ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary mr-2">Save Changes</button>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Registration Settings</h4>
                <form class="forms-sample" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Registration Fee</label>
                        <input type="number" min="0" name="registration_fee" value="<?php echo get_option('registration_fee', '0'); ?>" class="form-control" id="exampleInputUsername1" placeholder="Registration Fee">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Minimum investment Amount</label>
                        <input type="number" min="0" name="minimum_investment" value="<?php echo get_option('minimum_investment', 50); ?>" class="form-control" id="exampleInputUsername1" placeholder="Registration Fee">
                    </div>
                    <div class="form-group">
                        <label>Withdraws Approval</label>
                        <select class="form-control" name="withdraw_approval" required disabled readonly="">
                            <option <?php echo get_option('withdraw_approval', 0) == '0' ? 'selected' : '' ?> value="0">Automatic withdraw</option>
                            <option <?php echo get_option('withdraw_approval', 0) == '1' ? 'selected' : '' ?> value="1">Manual Approval</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Minimum balance to withdraw</label>
                        <input type="number" min="0" name="minimum_bonus_withdraw" value="<?php echo get_option('minimum_bonus_withdraw', 0); ?>" class="form-control" id="exampleInputUsername1" placeholder="Minimum balance to withdraw">
                        <small>The minimum bonus balance a user must have to withdraw</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Minimum running investment</label>
                        <input type="number" min="0" name="minimum_running_investment" value="<?php echo get_option('minimum_running_investment', 0); ?>" class="form-control" id="exampleInputUsername1" placeholder="Minimum running investment">
                        <small>The minimum running investment must have to withdraw</small>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Referral Settings</h4>
                <form class="forms-sample" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Referral Bonus (%)</label>
                        <input type="number" min="0" max="100" name="referral_bonus" value="<?php echo get_option('referral_bonus', '0'); ?>" class="form-control" id="exampleInputUsername1" placeholder="Referral bonus">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Registration Bonus</label>
                        <input type="number" min="0" max="100" name="registration_bonus" value="<?php echo get_option('registration_bonus', '0'); ?>" class="form-control" id="exampleInputUsername1" placeholder="Referral bonus">
                        <small>The bonus the uplink will receive after a successful registration fee payment</small>
                    </div>
<!--                    <div class="form-group">-->
<!--                        <label for="exampleInputUsername1">Earn Referral Bonus after these referrals</label>-->
<!--                        <input type="number" min="0" name="referral_threshold" value="--><?php //echo get_option('referral_threshold', '0'); ?><!--" class="form-control" id="exampleInputUsername1" placeholder="Referral threshold">-->
<!--                    </div>-->
                    <button type="submit" class="btn btn-primary mr-2">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<h4>Admin E-Mail Notification Settings</h4>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Deposit Email Notification</h4>
                <form method="post">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="deposit_emails_notifications">Email</label>
                        <input type="text" class="form-control" name="deposit_emails_notifications" id="deposit_emails_notifications" value="<?php echo old('deposit_emails_notifications', get_option('deposit_emails_notifications', '')) ?>" placeholder="Comma separated emails" />
                        <small>Separate multiple email addresses with a comma (,)</small>
                    </div>
                    <div class="form-group">
                        <label>Email Template</label>
                        <textarea name="deposit_email_template" class="form-control" rows="4"><?php echo old('deposit_email_template', get_option('deposit_email_template', '')) ?></textarea>
                        <small>Available placeholders:</small><br/>
                        <code>
                            {name}, {phone}, {deposit_phone}, {account_balance}, {deposit_amount}, {transaction_id}, {datetime}
                        </code>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Withdraw Email Notification</h4>
                <form method="post">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="withdraw_emails_notifications">Email</label>
                        <input type="text" class="form-control" name="withdraw_emails_notifications" id="withdraw_emails_notifications" value="<?php echo old('withdraw_emails_notifications', get_option('withdraw_emails_notifications', '')) ?>" placeholder="Comma separated emails" />
                        <small>Separate multiple email addresses with a comma (,)</small>
                    </div>
                    <div class="form-group">
                        <label>Email Templates</label>
                        <textarea name="withdraw_email_template" class="form-control" rows="4"><?php echo old('withdraw_email_template', get_option('withdraw_email_template', '')) ?></textarea>
                        <small>Available placeholders:</small><br/>
                        <code>
                            {name}, {phone}, {withdraw_phone}, {account_balance}, {withdraw_amount}, {transaction_id}, {datetime}, {mpesa_name}
                        </code>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<hr/>
<h4>User E-Mail Notification Settings</h4>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Deposit Email Notification</h4>
                <form method="post">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label>Email Template</label>
                        <textarea name="user_deposit_email_template" class="form-control" rows="4"><?php echo old('user_deposit_email_template', get_option('user_deposit_email_template', '')) ?></textarea>
                        <small>Available placeholders:</small><br/>
                        <code>
                            {name}, {phone}, {deposit_phone}, {account_balance}, {deposit_amount}, {transaction_id}, {datetime}
                        </code>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Withdraw Email Notification</h4>
                <form method="post">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label>Email Template</label>
                        <textarea name="user_withdraw_email_template" class="form-control" rows="4"><?php echo old('user_withdraw_email_template', get_option('user_withdraw_email_template', '')) ?></textarea>
                        <small>Available placeholders:</small><br/>
                        <code>
                            {name}, {phone}, {withdraw_phone}, {account_balance}, {withdraw_amount}, {transaction_id}, {datetime}, {mpesa_name}
                        </code>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

    document.getElementById("set-sys").className += " active";

</script>
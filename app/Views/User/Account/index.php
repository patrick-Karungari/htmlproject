<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */
?>
<style>
@import url(https://fonts.googleapis.com/css?family=Lato:700);

body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: #f0f0f0;
}

.box {
    position: relative;
    max-width: 600px;
    width: 90%;
    height: 400px;
    background: #fff;
    box-shadow: 0 0 15px rgba(0, 0, 0, .1);
}

/* common */
.ribbon {
    width: 150px;
    height: 150px;
    overflow: hidden;
    position: absolute;
}

.ribbon::before,
.ribbon::after {
    position: absolute;
    z-index: -1;
    content: '';
    display: block;
    border: 5px solid #2980b9;
}

.ribbon span {
    position: absolute;
    display: block;
    width: 225px;
    padding: 15px 0;
    background-color: #d00000;
    box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
    color: #fff;
    font: 700 18px/1 'Lato', sans-serif;
    text-shadow: 0 1px 1px rgba(0, 0, 0, .2);
    text-transform: uppercase;
    text-align: center;
}

/* top left*/
.ribbon-top-left {
    top: -10px;
    left: -10px;
}

.ribbon-top-left::before,
.ribbon-top-left::after {
    border-top-color: transparent;
    border-left-color: transparent;
}

.ribbon-top-left::before {
    top: 0;
    right: 0;
}

.ribbon-top-left::after {
    bottom: 0;
    left: 0;
}

.ribbon-top-left span {
    right: -25px;
    top: 30px;
    transform: rotate(-45deg);
}

/* top right*/
.ribbon-top-right {
    top: -10px;
    right: -10px;
}

.ribbon-top-right::before,
.ribbon-top-right::after {
    border-top-color: transparent;
    border-right-color: transparent;
}

.ribbon-top-right::before {
    top: 0;
    left: 0;
}

.ribbon-top-right::after {
    bottom: 0;
    right: 0;
}

.ribbon-top-right span {
    left: -25px;
    top: 30px;
    transform: rotate(45deg);
}

/* bottom left*/
.ribbon-bottom-left {
    bottom: -10px;
    left: -10px;
}

.ribbon-bottom-left::before,
.ribbon-bottom-left::after {
    border-bottom-color: transparent;
    border-left-color: transparent;
}

.ribbon-bottom-left::before {
    bottom: 0;
    right: 0;
}

.ribbon-bottom-left::after {
    top: 0;
    left: 0;
}

.ribbon-bottom-left span {
    right: -25px;
    bottom: 30px;
    transform: rotate(225deg);
}

/* bottom right*/
.ribbon-bottom-right {
    bottom: -10px;
    right: -10px;
}

.ribbon-bottom-right::before,
.ribbon-bottom-right::after {
    border-bottom-color: transparent;
    border-right-color: transparent;
}

.ribbon-bottom-right::before {
    bottom: 0;
    left: 0;
}

.ribbon-bottom-right::after {
    top: 0;
    right: 0;
}

.ribbon-bottom-right span {
    left: -25px;
    bottom: 30px;
    transform: rotate(-225deg);
}

.blink_me {
    animation: blinker 1s linear infinite;
}

@keyframes blinker {
    50% {
        opacity: 0;
    }
}

</style>
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between flex-wrap">
            <div class="d-flex align-items-center dashboard-header flex-wrap mb-3 mb-sm-0">
                <h5 class="mr-4 mb-0 font-weight-bold">Dashboard</h5>
            </div>
            <div class="d-flex">
                <div class="mr-3">
                    <button type="button" class="btn btn-primary"><?php echo date('d F Y') ?></button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-6 col-md-3 grid-margin stretch-card">
        <div class="card icon-card-primary">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="icon mb-0 mb-md-2 mb-xl-0 mr-2">
                        <i class="mdi mdi-circle"></i>
                    </div>
                    <p class="font-weight-medium mb-0">Account Balance</p>
                </div>
                <div class="d-flex align-items-center mt-3 flex-wrap">
                    <h3 class="font-weight-medium mb-0 mr-2"><?php echo number_format($current_user->account, 2) ?></h3>

                </div>
                <small class="d-block mt-2"><a class="text-white" href="<?php echo site_url('user/deposits') ?>">Account
                        balance</a></small>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3 grid-margin stretch-card">
        <div class="card icon-card-success">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="icon mb-0 mb-md-2 mb-xl-0 mr-2">
                        <i class="mdi mdi-chart-line"></i>
                    </div>
                    <p class="font-weight-medium mb-0">Total Investments</p>
                </div>
                <div class="d-flex align-items-center mt-3 flex-wrap">
                    <h3 class="font-weight-medium mb-0 mr-2">
                        <?php echo number_format((new \App\Models\Investments())->where('user', $current_user->id)->where('status', 'pending')->selectSum('total', 'totalInvestments')->get()->getLastRow()->totalInvestments, 2) ?>
                    </h3>

                </div>
                <small class="d-block mt-2"><a class="text-white" href="<?php echo site_url('user/invest') ?>">Total
                        investments</a></small>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3 grid-margin stretch-card">
        <div class="card icon-card-info">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="icon mb-0 mb-md-2 mb-xl-0 mr-2">
                        <i class="mdi mdi-plus"></i>
                    </div>
                    <p class="font-weight-medium mb-0">Total Profits</p>
                </div>
                <div class="d-flex align-items-center mt-3 flex-wrap">
                    <h3 class="font-weight-medium mb-0 mr-2">
                        <?php echo number_format((new \App\Models\Investments())->where('user', $current_user->id)->where('status', 'completed')->selectSum('return', 'totalInvestments')->get()->getLastRow()->totalInvestments, 2) ?>
                    </h3>
                </div>
                <small class="d-block mt-2"><a class="text-white"
                        href="<?php echo site_url('user/invest/investments') ?>">Total profits</a></small>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3 grid-margin stretch-card">
        <div class="card icon-card-dark">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="icon mb-0 mb-md-2 mb-xl-0 mr-2">
                        <i class="mdi mdi-minus"></i>
                    </div>
                    <p class="font-weight-medium mb-0">Total Withdraws</p>
                </div>
                <div class="d-flex align-items-center mt-3 flex-wrap">
                    <h3 class="font-weight-medium mb-0 mr-2">
                        <?php echo number_format((new \App\Models\Withdraws())->where('user', $current_user->id)->where('status', 'completed')->selectSum('amount', 'totalWithdraws')->get()->getLastRow()->totalWithdraws, 2) ?>
                    </h3>

                </div>
                <small class="d-block mt-2"><a class="text-white" href="<?php echo site_url('user/withdraws') ?>">Total
                        amount withdrawn</a> </small>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3 grid-margin stretch-card">
        <div class="card icon-card-info">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="icon mb-0 mb-md-2 mb-xl-0 mr-2">
                        <i class="mdi mdi-plus"></i>
                    </div>
                    <p class="font-weight-medium mb-0">Total Deposits</p>
                </div>
                <div class="d-flex align-items-center mt-3 flex-wrap">
                    <h3 class="font-weight-medium mb-0 mr-2">
                        <?php echo number_format((new \App\Models\Deposits())->where('user', $current_user->id)->where('status', 'completed')->selectSum('amount', 'totalWithdraws')->get()->getLastRow()->totalWithdraws, 2) ?>
                    </h3>

                </div>
                <small class="d-block mt-2"><a class="text-white" href="<?php echo site_url('user/deposits') ?>">Total
                        amount deposited</a> </small>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3 grid-margin stretch-card">
        <?php

$deposit_rate = number_format((new \App\Libraries\Metrics())->getDepositRate($current_user->id, 0), 2);
//$deposit_rate = 30;
if ($deposit_rate < -20) {
    $class = "bg-danger";
} elseif ($deposit_rate >= -20 && $deposit_rate <= 20) {
    $class = "bg-warning";
} else {
    $class = "bg-success";
}
?>
        <div class="card icon-card-dark <?php echo $class ?>">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="icon mb-0 mb-md-2 mb-xl-0 mr-2">
                        <i class="mdi mdi-chart-line"></i>
                    </div>
                    <p class="font-weight-medium mb-0">Running Deposit Rate</p>
                </div>
                <div class="d-flex align-items-center mt-3 flex-wrap">
                    <h3 class="font-weight-medium mb-0 mr-2">
                        <?php echo number_format((new \App\Libraries\Metrics())->getDepositRate($current_user->id, 0), 2) ?>
                        %</h3>

                </div>
                <small class="d-block mt-2"><a class="text-white" href="<?php echo site_url('user/withdraws') ?>">Total
                        Deposit Rate</a> </small>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3 grid-margin stretch-card">
        <div class="card icon-card-dark">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="icon mb-0 mb-md-2 mb-xl-0 mr-2">
                        <i class="mdi mdi-minus"></i>
                    </div>
                    <p class="font-weight-medium mb-0" data-toggle="tooltip" data-placement="right"
                        title="This is the accummulative bonus earned by all downlines. Bonus amounts reflect to your account balance upon completion">
                        Total Accumulative Bonus</p>
                </div>
                <div class="d-flex align-items-center mt-3 flex-wrap">
                    <h3 class="font-weight-medium mb-0 mr-2">
                        <?php echo number_format((new \App\Libraries\Metrics())->getUserReferralBonusTotals($current_user->id), 2) ?>
                    </h3>

                </div>
                <!--                <small class="d-block mt-2"><a class="text-white" href="--><?php //echo site_url('user/transactions?type=referral') ?>
                <!--">Total amount withdrawn</a> </small>-->
            </div>
        </div>
    </div>
</div>
<?php
    $plans = (new \App\Models\Plans())->where('active', '1')->orderBy('days', 'ASC')->findAll();
    if (count($plans) > 0) {
?>
<div class="card">
    <div class="card-body">
        <div class="container text-center">
            <h4 class="mb-3 mt-5">Start up your investment today</h4>
            <p class="w-75 mx-auto mb-5">Choose a plan that suits you the best.</p>
            <div class="row pricing-table">
                <?php
$n = 0;
    foreach ($plans as $plan) {
        $n++;
        ?>

                <div class="col-md-6 col-xl-4 grid-margin stretch-card pricing-card">
                    <div class="card border-primary border pricing-card-body" style="padding: 20px 26px 23px 26px;">
                        <?php
if ($plan->days < 2) {
            $class = "ribbon ribbon-top-right blink_me";
            $title = "NEW !!!";
        } else {
            $class = "ribbon ribbon-top-right";
            if ($plan->days == 3) {
                $title = "HOT !!!";
            } elseif ($plan->days == 7) {
                $title = "POPULAR !!!";
            } else {
                $title = "";
                $class = "";
            }

        }
        //echo '';
        ?>
                        <div class=" <?php echo $class ?>"><span><?php echo $title ?></span></div>


                        <div class="text-center pricing-card-head">
                            <h3><?php echo $plan->title ?></h3>
                            <p><?php echo $plan->days ?> day(s) investment</p>
                            <h1 class="font-weight-normal mb-4"><?php echo $plan->returns . '%'; ?></h1>
                        </div>
                        <div class="plan-features">
                            <?php
echo $plan->description;
        ?>
                        </div>
                        <div class="wrapper">
                            <form method="post" action="<?php echo site_url('user/invest/create'); ?>">
                                <input type="hidden" name="plan" value="<?php echo $plan->id; ?>">
                                <div class="form-group">
                                    <label>Amount to Invest</label>
                                    <?php

        if ($plan->returns >= 100 && $plan->returns <= 150) {
            $minimum_investment = 30000;
        } elseif ($plan->returns > 150 && $plan->returns <= 200) {
            $minimum_investment = 65000;
        } elseif ($plan->returns > 200) {
            $minimum_investment = 100000;
        } else {
            $minimum_investment = get_option('minimum_investment', 0);
        }
        ?>
                                    <input type="number" class="form-control" name="amount"
                                        min=" <?php echo $minimum_investment ?>"
                                        value="<?php echo $minimum_investment ?>" required />
                                </div>
                                <button type="submit" class="btn btn-block btn-primary">Invest</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
}
    ?>
            </div>

        </div>
    </div>
</div>
<?php
}
?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
Swal.fire({
    title: '<strong>NEW UPDATE: <u>TERMS AND CONDITIONS</u></strong>',
    showClass: {
        popup: 'animate__animated animate__fadeInDown'
    },
    hideClass: {
        popup: 'animate__animated animate__fadeOutUp'
    },
    icon: 'info',
    html: 'Familiarize yourself with our <b><a href="https://alpha-capital-investments.com/auth/terms">terms and conditions</a></b>'


})
</script>

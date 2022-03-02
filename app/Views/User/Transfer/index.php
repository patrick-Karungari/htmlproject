<!-- Content
============================================= -->

<head>
    <!-- Web Fonts=============================================-->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">

    <!-- Stylesheet
============================================= -->
    <link rel="stylesheet" type="text/css') ?>" href="<?php use App\Models\Bitcoins;

          echo base_url('assets/assets-select/vendor/bootstrap/css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" type="text/css') ?>"
        href="<?php echo base_url('assets/assets-select/vendor/font-awesome/css/all.min.css') ?>" />
    <link rel="stylesheet" type="text/css') ?>"
        href="<?php echo base_url('assets/assets-select/vendor/bootstrap-select/css/bootstrap-select.min.css') ?>" />
    <link rel="stylesheet" type="text/css') ?>"
        href="<?php echo base_url('assets/assets-select/vendor/currency-flags/css/currency-flags.min.css') ?>" />
    <link rel="stylesheet" type="text/css') ?>"
        href="<?php echo base_url('assets/assets-selectcss/stylesheet.css') ?>" />
    <!-- Colors Css -->

</head>
<section>
    <div class="card">
        <div class="row mt-2 mb-1">
            <div class="col-lg-11 mx-auto">
                <div class="row widget-steps">
                    <?php
                    $step = @session()->get('_transfers')['step'] ?? 1;
                    ?>
                    <div class="col-4 step <?php echo $step == 1 ? 'active' : ($step > 1 ? 'complete' : 'disabled') ?>">
                        <div class="step-name">Details</div>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <a href="#" class="step-dot"></a>
                    </div>
                    <div class="col-4 step <?php echo $step == 2 ? 'active' : ($step > 2 ? 'complete' : 'disabled') ?>">
                        <div class="step-name">Confirm</div>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <a href="#" class="step-dot"></a>
                    </div>
                    <div class="col-4 step <?php echo $step == 3 ? 'active' : ($step > 3 ? 'complete' : 'disabled') ?>">
                        <div class="step-name">Success</div>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <a href="#" class="step-dot"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h2 class="fw-400 text-center mt-3">Send BTC</h2>
    <p class="lead text-center mb-4">Send your BTC on anytime, anywhere in the world.</p>
    <div class="card">
        <div class="row">
            <div class="col-md-9 col-lg-7 col-xl-6 mx-auto">
                <?php
                if (@session()->get('_transfers')['step'] == '2') {
                    ?>
                <div class="border-info shadow-sm rounded pt-2 pb-sm-5 px-sm-5 mb-4 mt-2">
                    <h3 class="text-5 fw-400 ">Confirm</h3>
                    <hr class="mx-n3 mx-sm-n5 mb-1">
                    <!-- Send Money Form
                              ============================ -->
                    <form id="form-send-money" method="post">
                        <h4>Confirm that you want to send
                            <b><?php echo session()->get('_transfers')['currency'].' '.session()->get('_transfers')['amount'] ?></b>
                            to
                            <b><?php echo session()->get('_transfers')['user']->username.' ('.session()->get('_transfers')['user']->email.') ?'; ?></b>
                        </h4>
                        <div class="d-grid">
                            <button class="btn btn-primary btn-block" type="submit" name="step"
                                value="<?php echo @session()->get('_transfers')['step']; ?>">
                                Continue
                            </button>
                        </div>
                    </form>
                    <!-- Send Money Form end -->
                </div>
                <?php
                } else if (@session()->get('_transfers')['step'] == '3') {
                    ?>
                <div class="border-info shadow-sm rounded pt-2 pb-sm-5 px-sm-5 mb-4 mt-2">
                    <h3 class="text-5 fw-400">Success</h3>
                    <hr class="mx-n3 mx-sm-n5 mb-1">
                    <!-- Send Money Form
                              ============================ -->
                    <div class="alert alert-success">
                        <h1>SUCCESS</h1>
                    </div>
                    <a class="btn btn-success btn-block" href="<?php echo site_url('user/transfers'); ?>">Finish</a>
                    <!-- Send Money Form end -->
                </div>
                <?php
                } else {
                    ?>
                <div class="border-info shadow-sm rounded pt-2 pb-sm-5 px-sm-5 mb-4 mt-2">
                    <h3 class="text-5 fw-400">Personal Details</h3>
                    <hr class="mx-n3 mx-sm-n5 mb-1">
                    <div class="alert alert-warning p-2">
                        <?php
                            $myBitcoins = (new Bitcoins())->where('user', $current_user->id)->first();
                            ?>
                        <h6>BTC Balance: <b><?php echo $myBitcoins->balance; ?></b></h6>
                    </div>
                    <form id="form-send-money" method="post">
                        <div class="mb-1">
                            <label for="emailID" class="form-label">Recipient</label>
                            <input type="text" value="<?php echo old('username') ?>" class="form-control"
                                data-bv-field="emailid" id="emailID" required name="username"
                                placeholder="Enter Username or Email Address">
                        </div>
                        <div class="mb-1">
                            <label for="youSend" class="form-label">You Send</label>
                            <div class="input-group">
                                <span class="input-group-text">BTC</span>
                                <input type="number" class="form-control" data-bv-field="youSend" id="youSend"
                                    name="amount" min="0" step="0.001" value="<?php echo old('amount') ?>"
                                    placeholder="">

                            </div>
                        </div>
                        <!--
                                                    <p class="text-muted text-center">The current exchange rate is <span class="fw-500">1 USD =
                                                              1.42030 AUD</span></p>
                                                    <hr>
                                                    <p>Total Fees: <span class="float-end">7.21 USD</span></p>
                                                    <hr>
                                                    <p class="text-4 fw-500">Total To Pay: <span class="float-end">1,000.00 USD</span></p>
                                                    -->
                        <div class="d-grid">
                            <button class="btn btn-primary btn-block" type="submit" name="step"
                                value="<?php echo @session()->get('_transfers')['step'] ?? '1'; ?>">
                                Continue
                            </button>
                        </div>
                    </form>
                    <!-- Send Money Form end -->
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

</section>
<!-- Steps Progress bar -->


<!-- Content end -->
<script>
id = '<?php echo $current_user->id ?>';
document.getElementById("transfer-btc").className += " active";
</script>

<!-- Script -->

<script src="<?php echo base_url('assets/assets-select/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>">
</script>
<script src="<?php echo base_url('assets/assets-select/vendor/bootstrap-select/js/bootstrap-select.min.js') ?>">
</script>

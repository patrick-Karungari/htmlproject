<?php


?>
<section>
    <div class="card">
        <div class="row mt-2 mb-1">
            <div class="col-lg-11 mx-auto">
                <div class="row widget-steps">
                    <?php
                    $step = @session()->get('_btc_withdraw')['step'] ?? 1;
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
    <h2 class="title">Withdraw BTC</h2>
    <div class="card">
        <div class="row">
            <div class="col-md-9 col-lg-7 col-xl-6 mx-auto">
                <?php
                if ($step == '2') {
                ?>
                <div class="border-info shadow-sm rounded pt-2 pb-sm-5 px-sm-5 mb-4 mt-2">
                    <h3 class="text-5 fw-400 ">Confirm</h3>
                    <hr class="mx-n3 mx-sm-n5 mb-1">
                    <!-- Send Money Form
                              ============================ -->
                    <form id="form-send-money" method="post">
                        <?php echo csrf_field(); ?>
                        <h4>Confirm that you want to send
                            <b><?php echo session()->get('_btc_withdraw')['amount'] ?> BTC</b>
                            to address
                            <b><?php echo session()->get('_btc_withdraw')['address']->address; ?>?</b>
                        </h4>
                        <div class="d-grid">
                            <button class="btn btn-primary btn-block" type="submit" name="step"
                                    value="<?php echo $step; ?>">
                                Continue
                            </button>
                        </div>
                    </form>
                    <!-- Send Money Form end -->
                </div>
                <?php
                } else if ($step == '3') {
                ?>
                <div class="border-info shadow-sm rounded pt-2 pb-sm-5 px-sm-5 mb-4 mt-2">
                    <h3 class="text-5 fw-400">Success</h3>
                    <hr class="mx-n3 mx-sm-n5 mb-1">
                    <!-- Send Money Form
                              ============================ -->
                    <div class="alert alert-success">
                        <h1>SUCCESS</h1>
                    </div>
                    <a class="btn btn-success btn-block" href="<?php echo site_url('user/withdraws/btc'); ?>">Finish</a>
                    <!-- Send Money Form end -->
                </div>
                <?php
                } else {
                    ?>
                    <div class="border-info shadow-sm rounded pt-2 pb-sm-5 px-sm-5 mb-4 mt-2">
                        <form method="post" action="">
                            <?php echo csrf_field(); ?>
                            <div class="mb-1">
                                <label for="youSend" class="form-label">Withdraw</label>
                                <div class="input-group">
                                    <span class="input-group-text">BTC</span>
                                    <input type="number" class="form-control" data-bv-field="youSend" id="youSend"
                                           name="amount" min="0" step="0.00000001" value="<?php echo old('amount') ?>"
                                           placeholder="">

                                </div>
                            </div>
                            <div class="mb-1">
                                <label for="youSend" class="form-label">To Address</label>
                                <div class="input-group">
                                    <?php
                                    $addresses = (new \App\Models\BtcAddress())->where('user', $current_user->id)->orderBy('id', 'DESC')->findAll();
                                    ?>
                                    <select class="form-control" name="address" required>
                                        <option value="">--Please select--</option>
                                        <?php
                                        if (count($addresses) > 0) {
                                            foreach ($addresses as $address) {
                                                ?>
                                                <option value="<?php echo $address->id; ?>"><?php echo $address->label; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <span data-toggle="modal" data-target="#newBTCAddress" class="input-group-text btn">Add Address</span>
                                </div>
                            </div>
                            <button class="btn btn-info btn-block" type="submit" name="step"
                                    value="<?php echo $step; ?>">Continue</button>
                        </form>
                    </div>
                    <?php
                }
                ?>

            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Withdraw History</h3>
            <div class="table-responsive">
                <?php
                $logs = (new \App\Models\BitcoinWithdraws())->where('user', $current_user->id)->orderBy('id', 'DESC')->findAll();
                if ($logs) {
                    ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $n = 0;
                        foreach ($logs as $log) {
                            $n++;
                            ?>
                            <tr>
                                <td><?php echo $n; ?></td>
                                <td><?php echo $log->created_at; ?></td>
                                <td><?php echo $log->amount; ?> BTC</td>
                                <td><?php
                                    if ($log->status == '0') {
                                        ?> <span class="badge badge-pill ml-1 bg-light-warning"><i class="" data-feather="refresh-cw"></i> Pending</span> <?php
                                    } elseif($log->status == '1') {
                                        ?> <span data-search="Completed" class="badge badge-pill ml-1 bg-light-success" text-uppercase=""><i class="" data-feather="check-circle"></i> Completed</span> <?php
                                    } else {
                                        ?> <span class="badge badge-pill ml-1 bg-light-danger"><i class="" data-feather="x-circle"></i> Failed</span> <?php
                                    }
                                    ?></td>
                                <td><?php echo $log->address; ?></td>
                            </tr>
                                <?php
                        }
                        ?>
                        </tbody>
                    </table>
                        <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>
<?php
if ($step == '1') {
    ?>
    <div class="modal fade" id="newBTCAddress" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" data-backdrop="static" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form method="post" action="<?php echo site_url('user/btcaddress/create') ?>">
                    <?php
                    echo csrf_field();
                    ?>
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticModalLabel">New BTC Address </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="" required>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" name="address" value="" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
}

<?php


?>
<section>
    <div class="card">
        <div class="row mt-2 mb-1">
            <div class="col-lg-11 mx-auto">
                <div class="row widget-steps">
                    <?php
                    $session = @session()->get('_money_withdraw');
                    $step = $session['step'] ?? 1;
                    ?>
                    <div class="col-3 step <?php echo $step == 1 ? 'active' : ($step > 1 ? 'complete' : 'disabled') ?>">
                        <div class="step-name">Amount</div>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <a href="#" class="step-dot"></a>
                    </div>
                    <div class="col-3 step <?php echo $step == 2 ? 'active' : ($step > 2 ? 'complete' : 'disabled') ?>">
                        <div class="step-name">Select account</div>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <a href="#" class="step-dot"></a>
                    </div>
                    <div class="col-3 step <?php echo $step == 3 ? 'active' : ($step > 3 ? 'complete' : 'disabled') ?>">
                        <div class="step-name">Confirm</div>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <a href="#" class="step-dot"></a>
                    </div>
                    <div class="col-3 step <?php echo $step == 4 ? 'active' : ($step > 4 ? 'complete' : 'disabled') ?>">
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
    <h2 class="title">Withdraw Money</h2>
    <div class="card">
        <div class="row">
            <div class="col-md-9 col-lg-7 col-xl-6 mx-auto">
                <?php
                if ($step == '2') {
                    ?>
                    <div class="border-info shadow-sm rounded pt-2 pb-sm-5 px-sm-5 mb-4 mt-2">
                        <h3 class="text-5 fw-400 ">Select Account</h3>
                        <hr class="mx-n3 mx-sm-n5 mb-1">
                        <!-- Send Money Form
                                  ============================ -->
                        <form id="form-send-money" method="post">
                            <?php echo csrf_field(); ?>
                            <h4>Select account to withdraw <b>USD <?php echo $session['amount'] ?></b></h4>
                                <div class="form-group">
                                    <label>Select Account</label>
                                    <div class="input-group">
                                        <select class="form-control" name="account" required>
                                            <option value="">--Please select--</option>
                                            <?php
                                            $methods = (new \App\Models\WithdrawAccounts())->where('method', $session['method'])->where('user', $current_user->id)->findAll();
                                            foreach ($methods as $method) {
                                                ?>
                                                <option value="<?php echo $method->id; ?>">[<?php echo strtoupper($method->method); ?>] <?php echo $method->name; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <span data-toggle="modal" data-target="#newAccount" class="input-group-text btn"><i class="fa fa-plus"></i> Add Account</span>
                                    </div>

                                </div>
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
                        <form method="post" action="<?php echo current_url(); ?>">
                            <?php echo csrf_field(); ?>
                            <h3 class="text-5 fw-400">Confirm</h3>
                            <hr class="mx-n3 mx-sm-n5 mb-1">
                            <!-- Send Money Form
                                      ============================ -->
                            <div class="alert alert-success">
                                <h1>Are you sure you want to withdraw USD <?php echo $session['amount']; ?> to <br/>[<?php echo strtoupper($session['account']->method) ?>] <?php echo $session['account']->account ?></h1>
                            </div>
                            <button type="submit" class="btn btn-success btn-block" name="step"
                                    value="<?php echo $step; ?>">Confirm</button>
                            <!-- Send Money Form end -->
                        </form>
                    </div>
                    <?php
                } else if($step == '4') {
                    //COnfirm
                    ?>
                    <div class="border-info shadow-sm rounded pt-2 pb-sm-5 px-sm-5 mb-4 mt-2">
                        <h3 class="text-5 fw-400">Success</h3>
                        <hr class="mx-n3 mx-sm-n5 mb-1">
                        <!-- Send Money Form
                                  ============================ -->
                        <div class="alert alert-success">
                            <h1>SUCCESS</h1>
                        </div>
                        <a class="btn btn-success btn-block" href="<?php echo site_url('user/withdraws/money'); ?>">Finish</a>
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
                                    <span class="input-group-text">USD</span>
                                    <input type="number" class="form-control" data-bv-field="youSend" id="youSend"
                                           name="amount" min="0" step="1" value="<?php echo old('amount') ?>"
                                           placeholder="">

                                </div>
                            </div>
                            <div class="form-group mb-1">
                                <label for="youSend" class="form-label">Account Type</label>
                                    <select class="form-control" name="method" required>
                                        <option value="">--Please select--</option>
                                        <option value="mobile">Mobile Money</option>
                                        <option value="bank">Bank</option>
                                    </select>
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
                $logs = (new \App\Models\Withdraws())->where('user', $current_user->id)->orderBy('id', 'DESC')->findAll();
                if ($logs) {
                    ?>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Method</th>
                            <th>Account</th>
                            <th>Amount</th>
                            <th>TRX ID</th>
                            <th>Status</th>
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
                                <td><?php echo $log->date; ?></td>
                                <td><?php echo strtoupper($log->method); ?></td>
                                <td><?php echo $log->account; ?></td>
                                <td><?php echo $log->amount; ?> USD</td>
                                <td><?php echo $log->trx_id; ?></td>
                                <td>
                                    <?php
                                    if ($log->status == 'pending') {
                                    ?> <span class="badge badge-pill ml-1 bg-light-warning"><i class="" data-feather="refresh-cw"></i> Pending</span> <?php
                                    }elseif($log->status == 'completed') {
                                    ?> <span data-search="Completed" class="badge badge-pill ml-1 bg-light-success" text-uppercase=""><i class="" data-feather="check-circle"></i> Completed</span> <?php
                                    }else{
                                        ?> <span class="badge badge-pill ml-1 bg-light-danger"><i class="" data-feather="x-circle"></i> Failed</span> <?php
                                    }
                                    ?>
                                </td>
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
if ($step == '2') {
    ?>
    <div class="modal fade" id="newAccount" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" data-backdrop="static" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form method="post" action="<?php echo site_url('user/account/withdraw-accounts') ?>" autocomplete="off">
                    <?php
                    echo csrf_field();
                    ?>
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticModalLabel">New Withdraw Account </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Account Type</label>
                            <select class="form-control" name="method" required>
                                <option value="">--Please select--</option>
                                <option value="mobile">Mobile Money</option>
                                <option value="bank">Bank</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="" required>
                        </div>
                        <div class="form-group">
                            <label>Account</label>
                            <input type="text" class="form-control" name="account" value="" required>
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

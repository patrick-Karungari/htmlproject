<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */
?>
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between flex-wrap">
            <div class="d-flex align-items-center dashboard-header flex-wrap mb-3 mb-sm-0">
                <h5 class="mr-4 mb-0 font-weight-bold">M-Pesa C2B Settings</h5>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">C2B API Settings (Deposits)</h4>
                <button class="btn btn-sm btn-success mb-2" data-toggle="modal" data-target="#testSTKPush" type="button">Test STK PUSH</button>
                <div class="modal fade" id="testSTKPush" tabindex="-1" aria-labelledby="exampleModalScrollableTitle"
                     style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog">
                        <div class="modal-content">
                            <form method="post" action="<?php echo site_url('admin/settings/test'); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="exampleModalScrollableTitle">TEST STK PUSH</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="formrow-firstname-input">Phone Number</label>
                                        <input type="text" name="phone"
                                               value=""
                                               class="form-control" required id="formrow-firstname-input">
                                    </div>
                                    <div class="form-group">
                                        <label for="formrow-firstname-input">Amount</label>
                                        <input type="number" name="amount"
                                               value=""
                                               class="form-control" required id="formrow-firstname-input">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Send Request</button>
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
                <form method="post" action="<?php echo current_url() ?>">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="formrow-firstname-input">Shortcode (Paybill/Store Number)</label>
                        <input type="text" name="mpesa_paybill" value="<?php echo get_option('mpesa_paybill', false) ?>" class="form-control" required id="formrow-firstname-input">
                    </div>
                    <div class="form-group">
                        <label for="formrow-firstname-input">Till Number (If the above is a store Number)</label>
                        <input type="text" name="mpesa_till" value="<?php echo get_option('mpesa_till', false) ?>" class="form-control" id="formrow-firstname-input">
                    </div>
                    <div class="form-group">
                        <label>Shortcode Type</label>
                        <select class="form-control" name="mpesa_type" required>
                            <option value="">-- Please select --</option>
                            <option <?php echo get_option('mpesa_type', 'paybill') == 'paybill' ? 'selected' : ''; ?> value="paybill">Paybill</option>
                            <option <?php echo get_option('mpesa_type', 'paybill') == 'till' ? 'selected' : ''; ?> value="till">Till/Store Number</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="formrow-firstname-input">Consumer Key</label>
                        <input type="text" name="mpesa_consumer_key" value="<?php echo get_option('mpesa_consumer_key', false) ?>" class="form-control" id="formrow-firstname-input">
                    </div>
                    <div class="form-group">
                        <label for="formrow-firstname-input">Consumer Secret</label>
                        <input type="text" name="mpesa_consumer_secret" value="<?php echo get_option('mpesa_consumer_secret', false) ?>" class="form-control" id="formrow-firstname-input">
                    </div>
                    <div class="form-group">
                        <label for="formrow-firstname-input">LNMO Passkey</label>
                        <input type="text" name="mpesa_passkey" value="<?php echo get_option('mpesa_passkey', false) ?>" class="form-control" id="formrow-firstname-input">
                    </div>
                    <div class="form-group">
                        <label>API Environment</label>
                        <select class="form-control" name="mpesa_env" required>
                            <option value="">-- Please select --</option>
                            <option <?php echo get_option('mpesa_env', 'sandbox') == 'live' ? 'selected' : ''; ?> value="live">Live</option>
                            <option <?php echo get_option('mpesa_env', 'sandbox') == 'sandbox' ? 'selected' : ''; ?> value="sandbox">Sandbox</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="formrow-firstname-input">Initiator Username</label>
                        <input type="text" name="mpesa_username" value="<?php echo get_option('mpesa_username', false) ?>" class="form-control" id="formrow-firstname-input">
                    </div>
                    <div class="form-group">
                        <label for="formrow-firstname-input">Initiator Credential</label>
                        <textarea class="form-control" name="mpesa_credential" required><?php echo get_option('mpesa_credential', false) ?></textarea>
                        <small>Encoded Password of the Username above.</small>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

    document.getElementById("set-mpesa").className += " active";

</script>
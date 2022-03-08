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
                <h5 class="mr-4 mb-0 font-weight-bold">M-Pesa B2C Settings</h5>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">B2C API Settings (Withdraws)</h4>

                <form method="post" action="<?php echo current_url() ?>">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="formrow-firstname-input">PayBill Number</label>
                        <input type="text" name="mpesa_b2c_paybill" value="<?php echo get_option('mpesa_b2c_paybill', false) ?>" class="form-control" id="formrow-firstname-input">
                    </div>
                    <div class="form-group">
                        <label for="formrow-firstname-input">Consumer Key</label>
                        <input type="text" name="mpesa_b2c_consumer_key" value="<?php echo get_option('mpesa_b2c_consumer_key', false) ?>" class="form-control" id="formrow-firstname-input">
                    </div>
                    <div class="form-group">
                        <label for="formrow-firstname-input">Consumer Secret</label>
                        <input type="text" name="mpesa_b2c_consumer_secret" value="<?php echo get_option('mpesa_b2c_consumer_secret', false) ?>" class="form-control" id="formrow-firstname-input">
                    </div>
                    <div class="form-group">
                        <label for="formrow-firstname-input">Initiator Username</label>
                        <input type="text" name="mpesa_b2c_username" value="<?php echo get_option('mpesa_b2c_username', false) ?>" class="form-control" id="formrow-firstname-input">
                    </div>
                    <div class="form-group">
                        <label for="formrow-firstname-input">Initiator Password</label>
                        <textarea class="form-control" name="mpesa_b2c_credential" required><?php echo get_option('mpesa_b2c_credential', false) ?></textarea>
                        <small>Encoded Password of the Username above.</small>
                    </div>
                    <div class="form-group">
                        <label>API Environment</label>
                        <select class="form-control" name="mpesa_b2c_env" required>
                            <option value="">-- Please select --</option>
                            <option <?php echo get_option('mpesa_b2c_env', 'sandbox') == 'live' ? 'selected' : ''; ?> value="live">Live</option>
                            <option <?php echo get_option('mpesa_b2c_env', 'sandbox') == 'sandbox' ? 'selected' : ''; ?> value="sandbox">Sandbox</option>
                        </select>
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

    document.getElementById("set-b2c").className += " active";

</script>
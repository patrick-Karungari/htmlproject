<?php
/***
 * Created by Bennito254
 *
 * Github: https://github.com/bennito254
 * E-Mail: bennito254@gmail.com
 */
?>
<div class="card">
    <div class="card-body">
        <h3>E-Mail Settings</h3>
        <form method="post" action="">
            <div class="form-group">
                <label>Sender Email address</label>
                <input type="email" class="form-control" name="mailer_email_from" required
                       value="<?php echo old('mailer_email_from', get_option('mailer_email_from')); ?>"/>
            </div>
            <div class="form-group">
                <label>Sender Name</label>
                <input type="text" class="form-control" name="mailer_email_from_name" required
                       value="<?php echo old('mailer_email_from_name', get_option('mailer_email_from_name')); ?>"/>
            </div>
            <div class="form-group">
                <label>Delivery Method</label>
                <select name="mailer_delivery_method" class="form-control" required>
                    <option <?php echo get_option('mailer_delivery_method', 'no_smtp') == 'no_smtp' ? 'selected' : NULL; ?>
                        value="no_smtp">Internal Mail
                    </option>
                    <option <?php echo get_option('mailer_delivery_method') == 'smtp' ? 'selected' : NULL; ?> value="smtp">SMTP
                        Mail
                    </option>
                </select>
            </div>
            <div id="smtp" <?php echo get_option('mailer_delivery_method', 'no_smtp') == 'smtp' ? 'style="display:block"' : 'style="display:none"'; ?>>
                <div class="form-group">
                    <label>SMTP Server address</label>
                    <input type="text" class="form-control" name="mailer_smtp_host"
                           value="<?php echo old('mailer_smtp_host', get_option('mailer_smtp_host')); ?>"/>
                </div>
                <div class="form-group">
                    <label>SMTP Requires Authentication?</label>
                    <select name="mailer_authentication" class="form-control">
                        <option <?php echo get_option('mailer_authentication', 'yes') == 'yes' ? 'selected' : NULL; ?>
                            value="yes">YES
                        </option>
                        <option <?php echo get_option('mailer_authentication') == 'no' ? 'selected' : NULL; ?> value="no">NO
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label>SMTP Username</label>
                    <input type="text" class="form-control" name="mailer_smtp_username"
                           value="<?php echo old('mailer_smtp_username', get_option('mailer_smtp_username')); ?>"/>
                </div>
                <div class="form-group">
                    <label>SMTP Password</label>
                    <input type="password" class="form-control" name="mailer_smtp_password"
                           value="<?php echo old('mailer_smtp_password', get_option('mailer_smtp_password')); ?>"/>
                </div>
                <div class="form-group">
                    <label>SMTP Port</label>
                    <input type="number" class="form-control" name="mailer_smtp_port"
                           value="<?php echo old('mailer_smtp_port', get_option('mailer_smtp_port')); ?>"/>
                </div>
                <div class="form-group">
                    <label>SMTP Security</label>
                    <select name="mailer_smtp_security" class="form-control">
                        <option <?php echo get_option('mailer_smtp_security', 'none') == 'none' ? 'selected' : NULL; ?>
                            value="none">None
                        </option>
                        <option <?php echo get_option('mailer_smtp_security') == 'ssl' ? 'selected' : NULL; ?> value="ssl">SSL
                        </option>
                        <option <?php echo get_option('mailer_smtp_security') == 'tls' ? 'selected' : NULL; ?> value="tls">TLS
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Verify SMTP Certificate?</label>
                    <select name="mailer_smtp_verify_certs" class="form-control">
                        <option <?php echo get_option('mailer_smtp_verify_certs', 'no') == 'no' ? 'selected' : NULL; ?>
                            value="no">NO
                        </option>
                        <option <?php echo get_option('mailer_smtp_verify_certs') == 'yes' ? 'selected' : NULL; ?> value="yes">
                            YES
                        </option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Save Settings</button>
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('select[name="mailer_delivery_method"]').on('change', function (e) {
            var v = $('select[name="mailer_delivery_method"]').val();
            if (v == 'smtp') {
                $('#smtp').show('medium');
            } else {
                $('#smtp').hide('medium');
            }
        });
    })
</script>
<script>

    document.getElementById("set-email").className += " active";

</script>
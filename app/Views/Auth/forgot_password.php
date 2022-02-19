<?php

/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */
?>

<script>
document.getElementById('myImage').src = '<?php echo site_url('assets/images/pages/forgot-password-v2-dark.svg') ?>';
</script>

<h2 class="card-title font-weight-bold mb-1">Forgot Password? 🔒</h2>
<p class="card-text mb-2">If your email exists in our database we'll send you instructions to reset your password</p>
<form class="auth-forgot-password-form mt-2" action="forgot_password" method="POST">
    <div class="form-group">
        <label class="form-label" for="forgot-password-email">Email</label>
        <input class="form-control" type="text" id="email" name="username" placeholder="john@example.com"
            aria-describedby="forgot-password-email" autofocus="" tabindex="1" required />
    </div>
    <button class="btn btn-primary btn-block" tabindex="2">Send reset link</button>
</form>
<p class="text-center mt-2"><a href="<?php echo site_url('auth') ?>"><span class="iconify"
            data-icon="feather-chevron-left" data-inline="false"></span> Back to
        login</a></p>

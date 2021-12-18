<?php

/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */
?>

<h2 class="card-title font-weight-bold mb-1">Adventure starts here 🚀</h2>
<p class="card-text mb-2">Make your investing journey management easy and fun!</p>
<form class="auth-register-form mt-2" action="<?php echo site_url('auth/register') ?>" method="POST">
    <div class="form-group">
        <label class="form-label" for="register-username">First name</label>
        <input class="form-control" id="register-username" type="text" name="fname" placeholder="John"
               aria-describedby="register-username" autofocus="" tabindex="1" required />
    </div>
    <div class="form-group">
        <label class="form-label" for="register-username">Last name</label>
        <input class="form-control" id="register-username" type="text" name="lname" placeholder="Doe"
               aria-describedby="register-username" autofocus="" tabindex="1" required />
    </div>
    <div class="form-group">
        <label class="form-label" for="register-username">Username</label>
        <input class="form-control" id="register-username" type="text" name="username" placeholder="johndoe"
            aria-describedby="register-username" autofocus="" tabindex="1" required />
    </div>
    <div class="form-group">
        <label class="form-label" for="register-email">Email</label>
        <input class="form-control" id="register-email" type="text" name="email" placeholder="john@example.com"
            aria-describedby="register-email" tabindex="2" required />
    </div>
    <div class="form-group">
        <label class="form-label" for="register-phone">M-PESA Number</label>
        <input class="form-control" id="register-phone" type="tel" name="phone" placeholder="07 12 345 678"
            aria-describedby="register-email" tabindex="2" min="10" maxlength="10"
            pattern="^(?:0)?((?:(?:7(?:(?:[01249][0-9])|(?:5[789])|(?:6[89])))|(?:1(?:[1][0-5])))[0-9]{6})$" required />
        <small>Please use a Safaricom phone number with format : <br><strong>07 12 345 678</strong></small>
    </div>
    <div class="form-group">
        <label class="form-label" for="register-password">Password</label>
        <div class="input-group input-group-merge form-password-toggle">
            <input class="form-control form-control-merge" id="register-password" type="password"
                   name="password" placeholder="············" aria-describedby="register-password" tabindex="3"
                required />
            <div class="input-group-append"><span class="input-group-text cursor-pointer"><i
                        data-feather="eye"></i></span></div>
        </div>
    </div>
    <div class="form-group">
        <label class="form-label" for="register-password">Password</label>
        <div class="input-group input-group-merge form-password-toggle">
            <input class="form-control form-control-merge" id="register-password" type="password"
                   name="confirm_password" placeholder="············" aria-describedby="register-password" tabindex="3"
                   required />
            <div class="input-group-append"><span class="input-group-text cursor-pointer"><i
                            data-feather="eye"></i></span></div>
        </div>
    </div>
    <div class="form-group">
        <div class="custom-control custom-checkbox">
            <input class="custom-control-input" id="register-privacy-policy" type="checkbox" tabindex="4" required />
            <label class="custom-control-label" for="register-privacy-policy">I agree to<a
                    href="<?php echo site_url('auth/terms'); ?>">&nbsp;privacy policy & terms</a></label>
        </div>
    </div>
    <button class=" btn btn-primary btn-block" tabindex="5">Sign up</button>
</form>
<p class="text-center mt-2"><span>Already have an account?</span><a
        href="<?php echo site_url('auth/login'); ?>"><span>&nbsp;Sign in
            instead</span></a></p>
<div class="divider my-2">
    <div class="divider-text">or</div>
</div>
<div class="auth-footer-btn d-flex justify-content-center"><a class="btn btn-facebook" href="javascript:void(0)"><i
            data-feather="facebook"></i></a><a class="btn btn-twitter white" href="javascript:void(0)"><i
            data-feather="twitter"></i></a><a class="btn btn-google" href="javascript:void(0)"><i
            data-feather="mail"></i></a><a class="btn btn-github" href="javascript:void(0)"><i
            data-feather="github"></i></a></div>
<script>
    document.getElementById('myImage').src = '<?php echo site_url('assets/images/pages/register-v2-dark.svg') ?>';
</script>
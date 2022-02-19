<?php

/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

?>

<h2 class="card-title font-weight-bold mb-1">Welcome to Ken Coin ! 👋</h2>
<p class="card-text mb-2">Please sign-in to your account and start the adventure</p>
<form class="auth-login-form mt-2" action="" method="POST">
    <div class="form-group">
        <label class="form-label" for="login-email">Email</label>
        <input class="form-control" id="login-email" type="text" name="username" placeholder="john@example.com"
            aria-describedby="login-email" autofocus="" tabindex="1" />
    </div>
    <div class="form-group">
        <div class="d-flex justify-content-between">
            <label for="login-password">Password</label><a
                href="<?php echo site_url('auth/forgot-password') ?>"><small>Forgot
                    Password?</small></a>
        </div>
        <div class="input-group input-group-merge form-password-toggle">
            <input class="form-control form-control-merge" id="register-password" type="password" name="password"
                placeholder="············" aria-describedby="register-password" tabindex="3" required />
            <div class="input-group-append"><span class="input-group-text cursor-pointer"><svg
                        xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-eye">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg></span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="custom-control custom-checkbox">
            <input class="custom-control-input" id="remember-me" type="checkbox" tabindex="3" name="remember_me" />
            <label class="custom-control-label" for="remember-me"> Remember Me</label>
        </div>
    </div>
    <button class="btn btn-primary btn-block" tabindex="4">Sign in</button>
</form>
<p class="text-right mt-2"><span>New on our platform?</span><a
        href="<?php echo site_url('auth/register') ?>"><span>&nbsp;Create an
            account</span></a></p>

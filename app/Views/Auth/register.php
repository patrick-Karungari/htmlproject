<?php

/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<h2 class="card-title font-weight-bold mb-1">Adventure starts here 🚀</h2>
<p class="card-text mb-2">Make your investment journey management easy and fun!</p>
<form class="auth-register-form mt-2" action="<?php echo site_url('auth/register') ?>" method="POST">
    <div class="form-group">
        <label class="form-label" for="register-username">First name</label>
        <input class="form-control" id="fname" type="text" name="fname" placeholder="John"
            aria-describedby="register-username" autofocus="" tabindex="1" required />
    </div>
    <div class="form-group">
        <label class="form-label" for="register-username">Last name</label>
        <input class="form-control" id="lname" type="text" name="lname" placeholder="Doe"
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
        <label class="form-label" for="register-phone">Phone Number</label>
    </div>
    <div class="form-group d-flex ">
        <input class="form-control" id="i-register-phone" type="tel" name="phone" aria-describedby="register-email"
            tabindex="2" required />
        <input type="submit" class="btn btn-primary ml-2 pr-1" value="Verify" />
    </div>
    <div class="form-group">
        <label class="form-label" for="register-password">Password</label>
        <div class="input-group input-group-merge form-password-toggle">
            <input class="form-control form-control-merge" id="register-password" type="password" name="password"
                placeholder="············" aria-describedby="register-password" tabindex="3" required />
            <div class="input-group-append"><span class="input-group-text cursor-pointer"><i
                        data-feather="eye"></i></span></div>
        </div>
    </div>
    <div class="form-group">
        <label class="form-label" for="register-password">Confirm Password</label>
        <div class="input-group input-group-merge form-password-toggle">
            <input class="form-control form-control-merge" id="confirm-register-password" type="password"
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
                    href="<?php echo site_url('terms'); ?>">&nbsp;privacy policy & terms</a></label>
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
            data-feather='facebook'></i></a><a class="btn btn-twitter white" href="javascript:void(0)"><i
            data-feather='twitter'></i></a><a class="btn btn-google" href="javascript:void(0)"><i
            data-feather='mail'></i></a><a class="btn btn-github" href="javascript:void(0)"><i
            data-feather='github'></i></a></div>

<script>
document.getElementById(' myImage').src = '<?php echo site_url('assets/images/pages/register-v2-dark.svg') ?>';
</script>
<script>
const phoneInputField = document.getElementById('i-register-phone');
const phoneInput = window.intlTelInput(phoneInputField, {
    preferredCountries: ["KE", "UG", "NG", "GH", "RW", "ZM", "US"],
    allowDropdown: false,
    initialCountry: "auto",
    geoIpLookup: getIp,
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
});

function getIp(callback) {
    fetch('https://ipinfo.io/json?token=d449b8666e49bd', {
            headers: {
                'Accept': 'application/json'
            }
        })
        .then((resp) => resp.json())
        .catch(() => {
            return {
                country: 'KE',
            };
        })
        .then((resp) => callback(resp.country));
}
</script>

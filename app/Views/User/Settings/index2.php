<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/plugins/forms/form-validation.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/stylesheet.css')?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<!-- account setting page -->
<section id="page-account-settings">
    <div class="d-flex flex-column justify-content-between">
        <!-- left menu section -->
        <div class="d-flex row  mr-1 ml-1 flex-row justify-content-between mb-2 mb-md-0">
            <ul class="nav nav-pills flex-row nav-left">
                <!-- general -->
                <li class="nav-item">
                    <a class="nav-link active" id="account-pill-general" data-toggle="pill"
                        href="#account-vertical-general" aria-expanded="true">
                        <i data-feather="user" class="font-medium-3 mr-1"></i>
                        <span class="font-weight-bold">General</span>
                    </a>
                </li>
                <!-- change password -->
                <li class="nav-item">
                    <a class="nav-link" id="account-pill-password" data-toggle="pill" href="#account-vertical-password"
                        aria-expanded="false">
                        <i data-feather="lock" class="font-medium-3 mr-1"></i>
                        <span class="font-weight-bold">Change Password</span>
                    </a>
                </li>


            </ul>
        </div>
        <!--/ left menu section -->

        <!-- right content section -->
        <div class="row mr-1 ml-1">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <!-- general tab -->
                        <div role="tabpanel" class="tab-pane active" id="account-vertical-general"
                            aria-labelledby="account-pill-general" aria-expanded="true">
                            <!-- header media -->
                            <div class="media">
                                <a href="javascript:void(0);" class="mr-25">
                                    <img src="../../../app-assets/images/portrait/small/avatar-s-11.jpg"
                                        id="account-upload-img" class="rounded mr-50" alt="profile image" height="80"
                                        width="80" />
                                </a>
                                <!-- upload and reset button -->
                                <div class="media-body mt-75 ml-1">
                                    <label for="account-upload"
                                        class="btn btn-sm btn-primary mb-75 mr-75">Upload</label>
                                    <input type="file" id="account-upload" hidden accept="image/*" />
                                    <button class="btn btn-sm btn-outline-secondary mb-75">Reset</button>
                                    <p>Allowed JPG, GIF or PNG. Max size of 800kB</p>
                                </div>
                                <!--/ upload and reset button -->
                            </div>
                            <!--/ header media -->

                            <!-- form -->
                            <form id="details" class="validate-form mt-2">
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="account-username">Username</label>
                                            <input type="text" class="form-control" id="account-username"
                                                name="username" placeholder="Username" value="johndoe" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="account-name">Name</label>
                                            <input type="text" class="form-control" id="account-name" name="name"
                                                placeholder="Name" value="John Doe" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="account-e-mail">E-mail</label>
                                            <input type="email" class="form-control" id="account-e-mail" name="email"
                                                placeholder="Email" value="granger007@hogward.com" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">

                                        <div class="form-group">
                                            <label class="form-label" for="register-phone">Phone Number</label>
                                            <div class="form-group d-flex ">
                                                <input class="form-control" id="phone" type="tel" name="phone" value="<?php echo $current_user->phone ?>
" aria-describedby="register-email" tabindex="2" required autocomplete="off" />
                                                <buton type="button" id="verify"
                                                    class="btn w-50 d-flex btn-lg justify-content-center <?php echo ($current_user->phone_verified == 0) ? 'btn-primary' : 'btn-outline-success'?> text-center ml-2 ">
                                                    <?php echo ($current_user->phone_verified == 0) ? 'Verified' : 'Verify' ?>

                                                </buton>
                                            </div>

                                        </div>

                                    </div>


                                    <div class="col-12 mt-75">
                                        <div class="alert alert-warning mb-50" role="alert">
                                            <?php if($current_user->phone_verified == 0){
                                                ?>
                                            <div class="alert-body">
                                                <a>Your phone number is not verified. Please verify
                                                    to enable payments.</a>
                                            </div>
                                            <?php }?>

                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary mt-2 mr-1">Save
                                            changes</button>
                                        <button type="reset" class="btn btn-outline-secondary mt-2">Cancel</button>
                                    </div>
                                </div>
                            </form>
                            <!--/ form -->
                        </div>
                        <!--/ general tab -->

                        <!-- change password -->
                        <div class="tab-pane fade" id="account-vertical-password" role="tabpanel"
                            aria-labelledby="account-pill-password" aria-expanded="false">
                            <!-- form -->
                            <form class="validate-form">
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="account-old-password">Old Password</label>
                                            <div class="input-group form-password-toggle input-group-merge">
                                                <input type="password" class="form-control" id="account-old-password"
                                                    name="password" placeholder="Old Password" />
                                                <div class="input-group-append">
                                                    <div class="input-group-text cursor-pointer">
                                                        <i data-feather="eye"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="account-new-password">New Password</label>
                                            <div class="input-group form-password-toggle input-group-merge">
                                                <input type="password" id="account-new-password" name="new-password"
                                                    class="form-control" placeholder="New Password" />
                                                <div class="input-group-append">
                                                    <div class="input-group-text cursor-pointer">
                                                        <i data-feather="eye"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="account-retype-new-password">Retype New Password</label>
                                            <div class="input-group form-password-toggle input-group-merge">
                                                <input type="password" class="form-control"
                                                    id="account-retype-new-password" name="confirm-new-password"
                                                    placeholder="New Password" />
                                                <div class="input-group-append">
                                                    <div class="input-group-text cursor-pointer"><i
                                                            data-feather="eye"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary mr-1 mt-1">Save changes</button>
                                        <button type="reset" class="btn btn-outline-secondary mt-1">Cancel</button>
                                    </div>
                                </div>
                            </form>
                            <!--/ form -->
                        </div>
                        <!--/ change password -->

                    </div>
                </div>
            </div>
        </div>
        <!--/ right content section -->
        <!-- OTP Modal
    =========================== -->
        <div id="otp-modal" class="modal  fade oxyy-login-register" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content  border-0">
                    <div class="modal-body  p-0">

                        <div class="row  g-0">
                            <!-- Welcome Text
                            ====================== -->
                            <div class="col-lg-5 bg-primary d-none d-lg-inline-flex  rounded-left">
                                <div class="row g-0 h-100">
                                    <div class="col-10 col-lg-9 d-flex flex-column mx-auto">
                                        <h3 class="text-white mt-5 mb-4">Verification</h3>
                                        <p class="text-4 text-light lh-base mb-4">To keep connected with us please
                                            verify your phone number.</p>
                                        <div class="mt-auto mb-4"><img class="img-fluid"
                                                src="<?php echo base_url('assets/img/login-vector.png') ?>" alt="Oxyy">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Welcome Text End -->

                            <!-- OTP Form
                            ====================== -->
                            <div class="col-lg-7 d-flex align-items-center bg-white rounded-lg-left rounded-right">
                                <div class="container my-auto py-5">
                                    <div class="row">
                                        <div class="col-11 col-lg-10 mx-auto">
                                            <h3 class="text-center text-6 mb-4">Two-Step Verification</h3>
                                            <p class="text-center"><img class="img-fluid"
                                                    src="<?php echo base_url('assets/img/otp-icon.png') ?>"
                                                    alt="verification">
                                            </p>
                                            <p class="text-muted text-4 text-center">Please enter the OTP (one time
                                                password)
                                                to verify your phone number. A Code has been sent to your phone by SMS
                                            </p>

                                            <form id="otp-screen" class="form-border" onsubmit="return false"
                                                method="post">
                                                <div class="row g-3">
                                                    <div class="col">
                                                        <input type="number" id="code1"
                                                            class="form-control border-2 text-center text-6 px-0 py-2"
                                                            maxlength="1" required autocomplete="off">
                                                    </div>
                                                    <div class="col">
                                                        <input type="number" id="code2"
                                                            class="form-control border-2 text-center text-6 px-0 py-2"
                                                            maxlength="1" required autocomplete="off">
                                                    </div>
                                                    <div class="col">
                                                        <input type="number" id="code3"
                                                            class="form-control border-2 text-center text-6 px-0 py-2"
                                                            maxlength="1" required autocomplete="off">
                                                    </div>
                                                    <div class="col">
                                                        <input type="number" id="code4"
                                                            class="form-control border-2 text-center text-6 px-0 py-2"
                                                            maxlength="1" required autocomplete="off">
                                                    </div>
                                                    <div class="col">
                                                        <input type="number" id="code5"
                                                            class="form-control border-2 text-center text-6 px-0 py-2"
                                                            maxlength="1" required autocomplete="off">
                                                    </div>
                                                    <div class="col">
                                                        <input type="number" id="code6"
                                                            class="form-control border-2 text-center text-6 px-0 py-2"
                                                            maxlength="1" required autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="row my-4">
                                                    <button id="otp-verify"
                                                        class="btn btn-primary  btn-lg w-100 shadow-none"><span
                                                            id="verify-spinner"
                                                            class="spinner-grow d-none text-success spinner-grow-lg"
                                                            style="width: 4rem; height: 3rem" role="status"
                                                            aria-hidden="true"></span>
                                                        <span id="verify-btn"
                                                            class="ml-25 my-1 align-center">Verify</span></button>
                                                </div>
                                            </form>
                                            <p class="text-4 text-center">Not received your code? <a href="#">Resend
                                                    code</a></p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- OTP Form End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- OTP Modal End -->
    </div>
</section>
<!-- / account setting page -->
<!-- BEGIN: Page JS-->
<script src="<?php echo base_url('assets/vendors/js/forms/validation/jquery.validate.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/scripts/pages/page-account-settings.js') ?>">
</script>
<script src="<?php echo base_url('assets/vendors/bootstrap/js/bootstrap.min.js') ?>">
</script>
<!-- END: Page JS-->

<script>
const phoneInputField = document.getElementById('phone');
const phoneInput = window.intlTelInput(phoneInputField, {
    preferredCountries: ["KE", "UG", "NG", "GH", "RW", "ZM", "US"],
    allowDropdown: false,
    initialCountry: "auto",
    geoIpLookup: getIp,
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
});



function verify() {
    var code1 = document.getElementById('code1').value;
    var code2 = document.getElementById('code2').value;
    var code3 = document.getElementById('code3').value;
    var code4 = document.getElementById('code4').value;
    var code5 = document.getElementById('code5').value;
    var code6 = document.getElementById('code6').value;

    var code = code1.concat(code2, code3, code4, code5, code6);
    //console.log(code);
    return code;


}

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

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/plugins/forms/form-validation.css') ?>">

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
                            <form class="validate-form mt-2">
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

                                        <label for="account-phone">Phone</label>
                                        <div class="form-group row d-flex pr-1 justify-content-start">
                                            <input type="text" class="form-control mr-1 ml-1 mb-1 w-75"
                                                id="account-phone" placeholder="Phone number" value="(+656) 254 2568"
                                                name="phone" />
                                            <button
                                                class="btn btn-sm btn-primary  d-flex mb-1 align-items-center">Verify</button>

                                        </div>

                                    </div>
                                    <div class="col-12 mt-75">
                                        <div class="alert alert-warning mb-50" role="alert">

                                            <div class="alert-body">
                                                <a>Your phone number is not verified. Please verify
                                                    to enable payments.</a>
                                            </div>
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
    </div>
</section>
<!-- / account setting page -->
<!-- BEGIN: Page JS-->
<script src="<?php echo base_url('assets/js/scripts/pages/page-account-settings.js') ?>"></script>
<!-- END: Page JS-->

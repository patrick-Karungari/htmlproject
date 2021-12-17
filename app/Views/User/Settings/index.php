<?php
/***
 * Created by Bennito254
 *
 * Github: https://github.com/bennito254
 * E-Mail: bennito254@gmail.com
 */
?>
<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Update Profile</h4>
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Profile Pic</label>
                        <input type="file" class="form-control-file" accept="image/*" name="avatar" />
                    </div>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="fname" value="<?php echo old('fname', $current_user->first_name) ?>" required />
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="lname" value="<?php echo old('lname', $current_user->last_name) ?>" required />
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Change Password</h4>
                <form method="post" action="<?php echo site_url('user/settings/password') ?>">
                    <div class="form-group">
                        <label>Current Password</label>
                        <input type="password" class="form-control" name="password" value="<?php echo old('password') ?>" required />
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" class="form-control" name="new_password" value="<?php echo old('new_password') ?>" required />
                    </div>
                    <div class="form-group">
                        <label>Confirm New Password</label>
                        <input type="password" class="form-control" name="confirm_new_password" value="<?php echo old('confirm_new_password') ?>" required />
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

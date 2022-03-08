<?php //dd($user['email']);
?>
<!DOCTYPE html>
<!--
Template Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
Author: PixInvent
Website: http://www.pixinvent.com/
Contact: hello@pixinvent.com
Follow: www.twitter.com/pixinvents
Like: www.facebook.com/pixinvents
Purchase: https://1.envato.market/vuexy_admin
Renew Support: https://1.envato.market/vuexy_admin
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.

-->
<html class="loading dark-layout" lang="en" data-layout="dark-layout" data-textdirection="ltr">
    <!-- BEGIN: Head-->

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
        <meta name="description"
            content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
        <meta name="keywords"
            content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="PIXINVENT">
        <title>Ken Coin - Please Verify Your Email</title>

        <link
            href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
            rel="stylesheet">



    </head>
    <!-- END: Head-->
    <!-- Forgot Password v1 -->
    <script>
    document.getElementById('myImage').src =
        '<?php echo site_url('assets/images/pages/forgot-password-v2-dark.svg') ?>';
    </script>

    <h4 class="card-title mb-1">Verify your Email 🔒</h4>
    <p class="card-text mb-2">We've sent a verification code to
        <strong class="text-warning"><?php echo sprintf($user['email']) ?>
        </strong>.
    </p>
    <p class="card-text mb-2">Please look out for the activation link in your spam if you don't find it in your inbox.
    </p>

    <form class=" auth-forgot-password-form mt-2" action="<?php echo base_url('auth/mail_verify') ?>" method="post">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <input class="form-control" id="email" value="<?php echo sprintf($user['email'])  ?>" name="email" hidden />

            <input class="form-control" id="id" value="<?php echo sprintf($user['id'])  ?>" name="id" hidden />

        </div>
        <button class="btn btn-primary btn-block" tabindex="2">Resend Activation
            link</button>
    </form>
    <p class="text-center mt-2"><a href="<?php echo site_url('auth') ?>"><span class="iconify"
                data-icon="feather-chevron-left" data-inline="false"></span> Back to
            login</a></p>


    <!-- /Forgot Password v1 -->

</html>

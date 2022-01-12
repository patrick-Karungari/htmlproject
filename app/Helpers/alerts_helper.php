<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

function system_alerts($dismissible = true)
{
    if (get_option('bootstrap_alerts_enabled', '1') == '1') {
        bootstrap_alerts($dismissible);
    }

//    TODO: Fix this when messages are an array
   if (get_option('toastr_alerts_enabled', '1') == '1') { 
        toastr_alerts($_SESSION);
  }
}

function bootstrap_alerts($dismissible = true)
{
    $session = \Config\Services::session();

    $errors = $session->getFlashdata('error');
    if ($errors) {
        if (is_array($errors)) {
            foreach ($errors as $error) {
                ?>
<div class="<?php echo $dismissible ? 'dismissible' : ''; ?> alert alert-danger py-1 pl-1">
    <?php echo $error; ?>
</div>
<?php
}
        } else {
            ?>
<div class="<?php echo $dismissible ? 'dismissible' : ''; ?> alert alert-danger py-1 pl-1">
    <?php echo $errors; ?>
</div>
<?php
}
    }

    $infos = $session->getFlashdata('info');
    if ($infos) {
        if (is_array($infos)) {
            foreach ($infos as $info) {
                ?>
<div class="<?php echo $dismissible ? 'dismissible' : ''; ?> alert alert-info py-1 pl-1">
    <?php echo $info; ?>
</div>
<?php
}
        } else {
            ?>
<div class="<?php echo $dismissible ? 'dismissible' : ''; ?> alert alert-info py-1 pl-1">
    <?php echo $infos; ?>
</div>
<?php
}
    }
    $infos = $session->getFlashdata('message');
    if ($infos) {
        if (is_array($infos)) {
            foreach ($infos as $info) {
                ?>
<div class="<?php echo $dismissible ? 'dismissible' : ''; ?> alert alert-info py-1 pl-1">
    <?php echo $info; ?>
</div>
<?php
}
        } else {
            ?>
<div class="<?php echo $dismissible ? 'dismissible' : ''; ?> alert alert-info py-1 pl-1">
    <?php echo $infos; ?>
</div>
<?php
}
    }

    $infos = $session->getFlashdata('success');
    if ($infos) {
        if (is_array($infos)) {
            foreach ($infos as $info) {
                ?>
<div class="<?php echo $dismissible ? 'dismissible' : ''; ?> alert alert-success py-1 pl-1">
    <?php echo $info; ?>
</div>
<?php
}
        } else {
            ?>
<div class="<?php echo $dismissible ? 'dismissible' : ''; ?> alert alert-success py-1 pl-1">
    <?php echo $infos; ?>
</div>
<?php
}
    }
}

function toastr_alerts($session)
{
    if ($msg = $session->getFlashData('error')) {
        if (is_array($msg)) {

        } else {
            ?>
<script>
toast('Error', '<?php echo $msg; ?>', 'error');
</script>
<?php
}
    } else if ($msg = $session->getFlashData('success')) {
        


        if (is_array($msg)) {

        } else {

            ?>
<script>
var isRtl = $('html').attr('data-textdirection') === 'rtl';
var $name = document.querySelector('#user_name_d').innerHTML;
toastr['success'](
    'You have successfully logged in to Ken Coin. Now you can start to explore!',
    '👋 Welcome ' + $name + '!', {
        closeButton: true,
        tapToDismiss: true,
        rtl: isRtl
    }
);
</script>
<?php
}
    } else if ($msg = $session->getFlashData('message')) {
        if (is_array($msg)) {

        } else {
            ?>
<script>
toast('Information', '<?php echo $msg; ?>', 'info');
</script>
<?php
}
    }
}

<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

$session = \Config\Services::session();
//dd($session->getFlashdata());


?>
<!-- BEGIN: Vendor CSS-->

<link rel="stylesheet" type="text/css" href="../../../assets/vendors/css/pickers/pickadate/pickadate.css">
<link rel="stylesheet" type="text/css" href="../../../assets/vendors/css/pickers/flatpickr/flatpickr.min.css">

<link rel="stylesheet" type="text/css"
    href="../../../assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css"
    href="../../../assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="../../../assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
<!-- END: Vendor CSS-->
<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="../../../assets/css/plugins/forms/pickers/form-flat-pickr.css">
<link rel="stylesheet" type="text/css" href="../../../assets/css/plugins/forms/pickers/form-pickadate.css">
<!-- END: Page CSS-->
<div class="card">
    <div class="card-body justify-content-center text-center">
        <div class="d-flex align-items-start justify-content-between">
            <p class="card-title flex-grow">Day's Investments</p>
        </div>
        <div class="d-flex  justify-content-center">
            <input type="text" id="fp-range" class="form-control flatpickr-range"
                placeholder="DD, MM YYYY to DD, MM YYYY" />
        </div>
        <h4 id="heading" class="text-white mt-3 mb-3">
        </h4>
        <h1 id="subheading" class="font-weight-medium mb-0 pt-3 mr-2 text-center"></h1>
    </div>
</div>

<!-- User Invoice Starts-->
<div class="row invoice-list-wrapper">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-2">My Investments</h4>
            </div>
            <div class="card-datatable table-responsive pl-1 pr-1 pb-1">
                <table class="investments-list-table table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Plan</th>
                            <th>Amount</th>
                            <th>Returns</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Date Created</th>
                            <th>Settlement Date</th>

                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /User Invoice Ends-->

<script>
id = '<?php echo $current_user->id ?>';
document.getElementById("my-investments").className += " active";
</script>
<!-- BEGIN: Page Vendor JS-->
<script src="../../../assets/vendors/js/pickers/pickadate/picker.js"></script>
<script src="../../../assets/vendors/js/pickers/pickadate/picker.date.js"></script>
<script src="../../../assets/vendors/js/pickers/pickadate/picker.time.js"></script>
<script src="../../../assets/vendors/js/pickers/pickadate/legacy.js"></script>
<script src="../../../assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="../../../assets/vendors/js/extensions/moment.min.js"></script>
<script src="../../../assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
<script src="../../../assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
<script src="../../../assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
<script src="../../../assets/vendors/js/tables/datatable/responsive.bootstrap4.js"></script>
<script src="../../../assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
<script src="../../../assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Page JS-->
<script src="../../../assets/js/scripts/forms/pickers/user-inv.js"></script>
<!-- END: Page JS-->

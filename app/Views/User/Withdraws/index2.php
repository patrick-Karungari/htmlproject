<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

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
    <h5 class="card-header">Search Filter</h5>
    <div class="d-flex justify-content-between align-items-center mx-50 row pt-0 pb-2">
        <div class="col-md-4 investment_status"></div>

    </div>
</div>
<!-- User Invoice Starts-->
<div class="row invoice-list-wrapper">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-2">My Withdrawals</h4>
            </div>
            <div class="card-datatable table-responsive pb-1">
                <table class="investments-list-table table p-1">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Transaction ID</th>
                            <th>Amount</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Description</th>
                            <th>Date</th>

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
document.getElementById("withdrawals").className += " active";
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
<script src="../../../assets/js/scripts/forms/pickers/user-with.js"></script>
<!-- END: Page JS-->

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
<div class="row d-flex ">

    <!-- Statistics Card -->
    <div class="flex-fill ml-1 mr-1">
        <div style="cursor:pointer" class="card h-card text-center">
            <div class="card-body d-flex flex-column">
                <div class="d-flex justify-content-center px-1 mb-1">
                    <img style="height: 48px; padding-top: 8px; padding-bottom: 8px;"
                        src="https://img.icons8.com/external-tal-revivo-shadow-tal-revivo/48/000000/external-btc-bitcoin-cryptocurrency-electronic-cash-logotype-layout-logo-shadow-tal-revivo.png" />

                    <img style="height: 48px; padding-top: 8px; padding-bottom: 8px;"
                        src="https://img.icons8.com/fluency/96/000000/ethereum.png" />
                </div>
                <h2 class="font-weight-bolder">Deposit via BTC</h2>

            </div>
        </div>
    </div>
    <div class="flex-fill ml-1 mr-1">
        <div style="cursor:pointer" class=" card h-card text-center">
            <div class="card-body d-flex flex-column">
                <div class=" px-1 mb-1">
                    <img style="height: 48px;!important" src="https://img.icons8.com/color/48/000000/mastercard.png" />
                    <img style="height: 48px;!important" src="https://img.icons8.com/color/48/000000/visa.png" />
                    <img style="height: 48px;!important" src="https://img.icons8.com/fluency/48/000000/amex.png" />
                    <img style="height: 48px;!important" src="https://img.icons8.com/color/48/000000/maestro.png" />

                    <img style="height: 48px; padding-top: 4px; padding-bottom: 4px;"
                        src="https://img.icons8.com/color/48/000000/zelle.png" />
                    <img style="height: 48px; padding-top: 8px; padding-bottom: 8px;"
                        src="https://img.icons8.com/external-tal-revivo-shadow-tal-revivo/48/000000/external-cashapp-instantly-send-money-between-friends-or-accept-card-payments-for-your-business-logo-shadow-tal-revivo.png" />
                </div>
                <h2 class="font-weight-bolder">
                    Deposit via Card</h2>

            </div>
        </div>
    </div>
    <!--/ Statistics Card -->
</div>


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
                <h4 class="card-title mb-2">My Deposits</h4>
            </div>
            <div class="card-datatable table-responsive pb-1">
                <table class="referrals-list-table table p-1">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>First Deposit</th>
                            <th>My Commission</th>
                            <th>My Bonus</th>
                            <th>Status</th>
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
$('#referrals').addClass('active');
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
<script src="../../../assets/vendors/js/tables/datatable/jquery.dataTables.min.js">
</script>
<script src="../../../assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js">
</script>
<script src="../../../assets/vendors/js/tables/datatable/dataTables.responsive.min.js">
</script>
<script src="../../../assets/vendors/js/tables/datatable/responsive.bootstrap4.js">
</script>
<script src="../../../assets/vendors/js/tables/datatable/datatables.buttons.min.js">
</script>
<script src="../../../assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js">
</script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Page JS-->
<script src="../../../assets/js/scripts/forms/pickers/user-referrals.js"></script>
<!-- END: Page JS-->

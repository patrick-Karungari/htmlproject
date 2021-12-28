<link rel="stylesheet" type="text/css"
    href="../../../assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css"
    href="../../../assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="../../../assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
<!-- User Invoice Starts-->
<div class="card">
    <h5 class="card-header">Search Filter</h5>
    <div class="d-flex justify-content-between align-items-center mx-50 row pt-0 pb-2">
        <div class="col-md-4 user_status"></div>

    </div>
</div>
<div class="row invoice-list-wrapper">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-2">Investment Plans</h4>
            </div>
            <div class="card-datatable table-responsive pb-1">
                <table class="plans-list-table table table-hover-animation">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Title</th>
                            <th>Days</th>
                            <th>Returns %</th>
                            <th>Status</th>
                            <th>Description</th>
                            <th>Date Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /User Invoice Ends-->
<script>
document.getElementById("plans").className += " active";
</script>
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
<script src="../../../assets/js/scripts/pages/page-plans.js"></script>
<!-- END: Page JS-->

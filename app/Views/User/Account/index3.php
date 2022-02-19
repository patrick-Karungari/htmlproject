<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
    rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendors/css/charts/apexcharts.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/plugins/charts/chart-apex.css')?>">
<link rel="stylesheet" type="text/css"
    href="<?php echo base_url('assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css"
    href="<?php echo base_url('assets/vendors/css/tables/datatable/responsive.bootstrap.min.css')?>">



<section class="pt-0 pb-0" id="dashboard-analytics">
    <!-- Stats Vertical Card -->
    <div class="row match-width">
        <div class=" col-xl-2 col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <h2 class="font-weight-bolder">Balance Overview</h2>
                    <div class="avatar bg-light-info p-50 mb-1">
                        <div class="avatar-content">
                            <i data-feather="dollar-sign" class="font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="font-weight-bolder">36.9k</h2>
                    <p class="card-text">KSH</p>
                </div>
            </div>
        </div>
    </div>
    <!--/ Stats Vertical Card -->
    <!-- Miscellaneous Charts -->
    <div class="row match-height">
        <div class="col-lg-8 col-12">
            <div class="card card-statistics">
                <div class="card-header">
                    <h4 class="card-title">Statistics</h4>
                    <div class="d-flex align-items-center">
                        <p class="card-text mr-25 mb-0">Updated 1 month ago</p>
                    </div>
                </div>
                <div class="card-body statistics-body">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                            <div class="media">
                                <div class="avatar bg-light-primary mr-2">
                                    <div class="avatar-content">
                                        <i data-feather="trending-up" class="avatar-icon"></i>
                                    </div>
                                </div>
                                <div class="media-body my-auto">
                                    <h4 class="font-weight-bolder mb-0">230k</h4>
                                    <p class="card-text font-small-3 mb-0">Sales</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                            <div class="media">
                                <div class="avatar bg-light-info mr-2">
                                    <div class="avatar-content">
                                        <i data-feather="user" class="avatar-icon"></i>
                                    </div>
                                </div>
                                <div class="media-body my-auto">
                                    <h4 class="font-weight-bolder mb-0">8.549k</h4>
                                    <p class="card-text font-small-3 mb-0">Customers</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12 mb-2 mb-sm-0">
                            <div class="media">
                                <div class="avatar bg-light-danger mr-2">
                                    <div class="avatar-content">
                                        <i data-feather="box" class="avatar-icon"></i>
                                    </div>
                                </div>
                                <div class="media-body my-auto">
                                    <h4 class="font-weight-bolder mb-0">1.423k</h4>
                                    <p class="card-text font-small-3 mb-0">Products</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="media">
                                <div class="avatar bg-light-success mr-2">
                                    <div class="avatar-content">
                                        <i data-feather="dollar-sign" class="avatar-icon"></i>
                                    </div>
                                </div>
                                <div class="media-body my-auto">
                                    <h4 class="font-weight-bolder mb-0">$9745</h4>
                                    <p class="card-text font-small-3 mb-0">Revenue</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Miscellaneous Charts -->
    <!-- Bar Chart -Orders -->
    <div class="row">
        <div class="col-lg-2 col-6">
            <div class="card">
                <div class="card-body pb-50">
                    <h6>Orders</h6>
                    <h2 class="font-weight-bolder mb-1">2,76k</h2>
                    <div id="statistics-bar-chart"></div>
                </div>
            </div>
        </div>

        <!--/ Bar Chart -->

        <!-- Line Chart - Profit -->

        <div class="col-lg-2 col-6">
            <div class="card card-tiny-line-stats">
                <div class="card-body pb-50">
                    <h6>Profit</h6>
                    <h2 class="font-weight-bolder mb-1">6,24k</h2>
                    <div id="statistics-line-chart"></div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Line Chart -->

</section>

<script>
document.getElementById("dashboard").className += " active";
</script>

<!-- BEGIN: Page Vendor JS-->
<script src="<?php echo base_url('assets/vendors/js/charts/apexcharts.min.js')?>">
</script>
<script src="<?php echo base_url('assets/vendors/js/extensions/toastr.min.js')?>">
</script>
<script src="<?php echo base_url('assets/vendors/js/extensions/moment.min.js')?>">
</script>
<script src="<?php echo base_url('assets/vendors/js/tables/datatable/datatables.min.js')?>">
</script>
<script src="<?php echo base_url('assets/vendors/js/tables/datatable/datatables.buttons.min.js')?>">
</script>
<script src="<?php echo base_url('assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')?>">
</script>
<script src="<?php echo base_url('assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>">
</script>
<script src="<?php echo base_url('assets/vendors/js/tables/datatable/responsive.bootstrap.min.js')?>">
</script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Page JS-->
<script src="<?php echo base_url('assets/js/scripts/cards/card-statistics.js')?>">
</script>

<!-- END: Page JS-->

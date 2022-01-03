  <link rel="stylesheet" type="text/css"
      href="../../../assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">
  <link rel="stylesheet" type="text/css"
      href="../../../assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css"
      href="../../../assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="../../../assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
  <!-- BEGIN: Custom CSS-->
  <link rel="stylesheet" type="text/css"
      href="<?php echo base_url('assets/css/plugins/forms/form-number-input.css');?>">
  <!-- END: Custom CSS-->
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
  <!-- Modal to add new user starts-->
  <div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
      <div class="modal-dialog">
          <form class="add-new-plan modal-content pt-0" method="POST" action="plans/create">

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
              <div class="modal-header mb-1">
                  <h5 class="modal-title" id="exampleModalLabel">New Plan</h5>
              </div>
              <div class="modal-body flex-grow-1">
                  <div class="form-group">
                      <label class="form-label" for="basic-icon-default-fullname">Title</label>
                      <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname"
                          placeholder="" name="title" aria-label="John Doe"
                          aria-describedby="basic-icon-default-fullname2" />
                  </div>
                  <div class="form-group">
                      <label class="form-label" for="basic-icon-default-uname">Days</label>
                      <input type="number" class="form-control dt-full-name" id="basic-icon-default-fullname"
                          placeholder="" name="days" aria-label="John Doe"
                          aria-describedby="basic-icon-default-fullname2" />
                  </div>
                  <div class="form-group">
                      <label class="form-label" for="basic-icon-default-email">Returns</label>
                      <input type="number" id="basic-icon-default-email" class="form-control dt-email" placeholder=""
                          aria-label="john.doe@example.com" aria-describedby="basic-icon-default-email2"
                          name="returns" />

                  </div>
                  <div class="form-group">
                      <label class="form-label" for="user-role">Plan Status</label>
                      <select id="user-role" name="active" class=" form-control">
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>

                      </select>
                  </div>
                  <!-- Counter Textarea start -->

                  <div class="form-group mb-2">
                      <label class="form-label" for="user-plan">Description</label>
                      <div class="form-label-group mt-2 mb-0">
                          <textarea data-length="200" class="form-control char-textarea" name="description"
                              id="textarea-counter" rows="5" placeholder="Plan Description"></textarea>
                          <label for="textarea-counter">Plan Description</label>
                      </div>
                      <small class="textarea-counter-value float-right"><span class="char-count">0</span> / 200
                      </small>
                  </div>

                  <!-- Counter Textarea end -->

                  <button type="submit" class="btn btn-primary mr-1 data-submit">Submit</button>
                  <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
              </div>
          </form>
      </div>
  </div>
  <!-- Modal to add new user Ends-->
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
  <!-- BEGIN: Page Vendor JS-->
  <script src="../../../assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js"></script>
  <!-- END: Page Vendor JS-->
  <!-- BEGIN: Page JS-->
  <script src="../../../assets/js/scripts/pages/page-plans.js"></script>
  <!-- END: Page JS-->

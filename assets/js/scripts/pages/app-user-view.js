/*=========================================================================================
    File Name: app-user-view.js
    Description: User View page
    --------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(function () {
  'use strict';

  
  var dtDepositsTable = $('.deposit-list-table'),
    statusObj = {
            0: {title: 'Completed', class: 'badge-light-success'},
            1: { title: 'Pending', class: 'badge-light-info' },
            2: { title: 'Failed', class: 'badge-light-danger' }
        },
    dtInvestmentsTable = $('.investments-list-table'),
    assetPath = '../../../assets/',
    invoicePreview = 'app-invoice-preview.html',
     userAvatar = $('.user-avatar'),
    invoiceAdd = 'app-invoice-add.html',
    invoiceEdit = 'app-invoice-edit.html';

  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
    invoicePreview = assetPath + 'app/invoice/preview';
    invoiceAdd = assetPath + 'app/invoice/add';
    invoiceEdit = assetPath + 'app/invoice/edit';
  }

  // Plan Expiry Year
  $('.nextYear').text(new Date().getFullYear() + 1);

 // Change user profile picture
 // console.log(userAvatar.length);
  if (avatar.length < 1) {
    userAvatar.attr('src', 'https://api.multiavatar.com/' + U_name + '.svg');
    console.log('https://api.multiavatar.com/' + U_name + '.png');
  }
  // User View datatable
  // datatable
  var idObject = {"id":id};
  if (dtDepositsTable.length) {
    var dtDeposits = dtDepositsTable.DataTable({
      "ajax": {
        "url": "../gtrx",
        "type": "POST",
        "data": idObject
      },
      "language": {
        "emptyTable": "User has not made any Transactions yet"
      },
      headers: { 'X-Requested-With': 'XMLHttpRequest' }, // JSON file to add data
      autoWidth: false,
      columns: [
        // columns according to JSON
        { data: 'id' },
        { data: 'trx' },
        { data: 'amount' },
        { data: 'date' },
        { data: 'type' },
        { data: 'status' },
        { data: 'description' },
        { data: '' }
      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
         
          targets: 0
        },
        {
        // Invoice ID
          targets: 1,
          responsivePriority: 2,
          width: '24px',
          render: function (data, type, full, meta) {
             //console.log(data);
            var $invoiceId = full['trx'];
            // Creates full output for row
            var $rowOutput = '<a class="font-weight-bold" href="' + invoicePreview + '"> #' + $invoiceId + '</a>';
            return $rowOutput;
          }
        },
       
       
        {
          // Total Invoice Amount
          targets: 2,
          responsivePriority: 3,
          width: '24px',
          render: function (data, type, full, meta) {
            var $total = full['amount'];
            return '<span class="d-none">Ksh ' +  Intl.NumberFormat('en-US').format ($total) + '</span>Ksh ' +  Intl.NumberFormat('en-US').format ($total);
          }
        },
        {
          // Due Date
          targets: 3,
          width: '76px',
          render: function (data, type, full, meta) {
            //console.log(full['date']);
            var $dueDate = new Date(full['date']);
            // Creates full output for row
            var $rowOutput =
              '<span class="d-none">' +
              moment($dueDate).format('YYYYMMDD') +
              '</span>' +
              moment($dueDate).format('ddd HH:mm DD MMM YYYY');
            $dueDate;
            return $rowOutput;
          }
        },
        {
          //Invoice Type
          targets: 4,
          width: '72px',
          render: function (data, type, full, meta) {
            var $type = full['type'];
            return '  <option class="text-capitalize"> <span class="d-none" >' + $type + '</span></option> ';
          }
        },
         {
          // Invoice status
          targets: 5,
          width: '130px',
          render: function (data, type, full, meta) {
            var $invoiceStatus = full['status'],
              roleObj = {                
                completed: { class: 'bg-light-success', icon: 'check-circle', title: 'Completed' },                
                pending: { class: 'bg-light-info', icon: 'refresh-ccw', title: 'Pending' },
                failed: { class: 'bg-light-danger', icon: 'info', title: 'Failed' }
              };
           
            return (

              '<div> <div class="avatar avatar-status ' +
              roleObj[$invoiceStatus].class +
              '">' +
              '<span class="avatar-content">' +
              feather.icons[roleObj[$invoiceStatus].icon].toSvg({ class: 'avatar-icon' }) +
              '</span> </div>' +
              '<span data-search =' + roleObj[$invoiceStatus].title + ' class="badge badge-pill ml-1 ' + roleObj[$invoiceStatus].class + '" text-uppercase>' + roleObj[$invoiceStatus].title + '</span>' +
              ' </div>'
    
            );
          }
        },
        {
          // Invoice Description
          targets: 6,
          width: '180px',
          render: function (data, type, full, meta) {
            var $total = full['description'];
            return '<div class="col-2 text-truncate"> <span class="d-none text-wrap text-truncate">' + $total + '</span> </div>'+ $total ;
          }
        },
       
        {
          // Actions
          targets: 7,
          title: 'Actions',
          width: '76px',
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="d-flex align-items-center col-actions">' +
              '<a class="mr-1" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Send Mail">' +
              feather.icons['send'].toSvg({ class: 'font-medium-1' }) +
              '</a>' +
              '<a class="mr-1" href="' +
              invoicePreview +
              '" data-toggle="tooltip" data-placement="top" title="Preview Invoice">' +
              feather.icons['eye'].toSvg({ class: 'font-medium-1' }) +
              '</a>' +
              '<div class="dropdown">' +
              '<a class="btn btn-sm btn-icon px-0" data-toggle="dropdown">' +
              feather.icons['more-vertical'].toSvg({ class: 'font-medium-1' }) +
              '</a>' +
              '<div class="dropdown-menu dropdown-menu-right">' +
              '<a href="javascript:void(0);" class="dropdown-item">' +
              feather.icons['download'].toSvg({ class: 'font-small-4 mr-50' }) +
              'Download</a>' +
              '<a href="' +
              invoiceEdit +
              '" class="dropdown-item">' +
              feather.icons['edit'].toSvg({ class: 'font-small-4 mr-50' }) +
              'Edit</a>' +
              '<a href="javascript:void(0);" class="dropdown-item">' +
              feather.icons['trash'].toSvg({ class: 'font-small-4 mr-50' }) +
              'Delete</a>' +
              '<a href="javascript:void(0);" class="dropdown-item">' +
              feather.icons['copy'].toSvg({ class: 'font-small-4 mr-50' }) +
              'Duplicate</a>' +
              '</div>' +
              '</div>' +
              '</div>'
            );
          }
        }
      ],
      order: [[1, 'desc']],
      dom:
        '<"row d-flex justify-content-between align-items-center m-1"' +        
        '<"d-flex justify-content-between align-items-center mx-50 row pt-0 pb-2"f<"invoice_status ml-2"><"invoice_type ml-2">>' +
        '<"col-lg-6 d-flex align-items-center"l<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left "B>>' +
        '>t' +
        '<"d-flex justify-content-between mx-2 row"' +
        '<"col-sm-12 col-md-6"i>' +
        '<"col-sm-12 col-md-6"p>' +
        '>',
      language: {
        sLengthMenu: 'Show _MENU_',
        search: 'Search',
        searchPlaceholder: 'Search Invoice',
        paginate: {
          // remove previous & next text from pagination
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      },
      // Buttons with Dropdown
      buttons: [
        {
          text: 'Add Record',
          className: 'btn btn-primary btn-add-record ml-2',
          attr: {
            'disabled': true
            },
          action: function (e, dt, button, config) {
            window.location = invoiceAdd;
          },
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
          }
        }
      ],
      // For responsive popup
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Details of ' + data['client_name'];
            }
          }),
          type: 'column',
          renderer: $.fn.dataTable.Responsive.renderer.tableAll({
            tableClass: 'table',
            columnDefs: [
              {
                targets: 2,
                visible: false
              },
              {
                targets: 3,
                visible: false
              }
            ]
          })
        }
      },
      initComplete: function () {
        // $('.dataTables_filter').find('.form-control-sm').removeClass('form-control-sm');
        // $('.dataTables_length .custom-select').removeClass('custom-select-sm').removeClass('form-control-sm');
        $(document).find('[data-toggle="tooltip"]').tooltip();
        // Adding role filter once table initialized
        this.api()
          .columns(5)
          
          .every(function () {
            var column = this;
            var select = $(
              '<select id="InvoiceStatus" class="form-control ml-50 text-capitalize"><option value=""> Select Invoice Status </option></select>'
            )
              .appendTo('.invoice_status')
              .on('change', function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                column.search(val, true, false).draw();
              });

            column
              .data()
              .unique()
              .sort()
              .each(function (d, j) {
                //console.log( d );
                select.append('<option value="' + d + '" class="text-capitalize">' + d + '</option>');
              });
          });
        this.api()
          .columns(4)
          
          .every(function () {
            var column = this;
            var select = $(
              '<select id="InvoiceType" class="form-control ml-50 text-capitalize"><option value=""> Select Invoice Type </option></select>'
            )
              .appendTo('.invoice_type')
              .on('change', function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                column.search(val, true, false).draw();
              });

            column
              .data()
              .unique()
              .sort()
              .each(function (d, j) {
                //console.log( d );
                select.append('<option value="' + d + '" class="text-capitalize">' + d + '</option>');
              });
          });
      },
      
      drawCallback: function () {
        $(document).find('[data-toggle="tooltip"]').tooltip();
      }
    });
  }

if (dtInvestmentsTable.length) {
    var dtInvestments = dtInvestmentsTable.DataTable({
      "ajax": {
        "url": "../ginv",
        "type": "POST",
        "data": idObject
      },
      "language": {
        "emptyTable": "User has not made any Transactions yet"
      },
      headers: { 'X-Requested-With': 'XMLHttpRequest' }, // JSON file to add data
      autoWidth: false,
      columns: [
        // columns according to JSON
        { data: 'id' },
        { data: 'plan' },
        { data: 'amount' },
        { data: 'return' },
        { data: 'total' },
        { data: 'status' },        
        { data: 'created_at' },
        { data: 'end_time' },
        { data: '' }
      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
         
          targets: 0
        },
        {
        // Plan
          targets: 1,
          responsivePriority: 2,
          width: '24px',
          render: function (data, type, full, meta) {
             
            var $Plan = full['plan'];
           // console.log($Plan.title);
            // Creates full output for row
            var $rowOutput = '<a class="font-weight-bold" href="' + invoicePreview + '"> ' + $Plan.title + '</a>';
            return $rowOutput;
          }
        },
       
       
        {
          // Total Investment Amount
          targets: 2,
          responsivePriority: 3,
          width: '24px',
          render: function (data, type, full, meta) {
            var $total = full['amount'];
            return '<span class="d-none">Ksh ' + Intl.NumberFormat('en-US').format ($total) + '</span>Ksh ' +  Intl.NumberFormat('en-US').format ($total);
          }
        },
        
        {
          // Total Return
          targets: 3,
          width: '24px',
          render: function (data, type, full, meta) {
            var $total = full['return'];
            return '<span class="d-none">Ksh ' +  Intl.NumberFormat('en-US').format ($total) + '</span>Ksh ' + Intl.NumberFormat('en-US').format ($total);
          }
        },
        {
          // Total Amount
          targets: 4,
          responsivePriority: 3,
          width: '24px',
          render: function (data, type, full, meta) {
            var $total = full['total'];
            return '<span class="d-none">Ksh ' +  Intl.NumberFormat('en-US').format ($total) + '</span>Ksh ' +  Intl.NumberFormat('en-US').format ($total);
          }
        },
       
         {
          // Investment status
          targets: 5,
          width: '130px',
          render: function (data, type, full, meta) {
            var $invoiceStatus = full['status'],
              roleObj = {                
                completed: { class: 'bg-light-success', icon: 'check-circle', title: 'Completed' },                
                pending: { class: 'bg-light-info', icon: 'refresh-ccw', title: 'Pending' },
                cancelled: { class: 'bg-light-primary', icon: 'refresh-ccw', title: 'Cancelled' },
                failed: { class: 'bg-light-danger', icon: 'info', title: 'Failed' }
              };
           
            return (

              '<div> <div class="avatar avatar-status ' +
              roleObj[$invoiceStatus].class +
              '">' +
              '<span class="avatar-content">' +
              feather.icons[roleObj[$invoiceStatus].icon].toSvg({ class: 'avatar-icon' }) +
              '</span> </div>' +
              '<span data-search =' + roleObj[$invoiceStatus].title + ' class="badge badge-pill ml-1 ' + roleObj[$invoiceStatus].class + '" text-uppercase>' + roleObj[$invoiceStatus].title + '</span>' +
              ' </div>'
    
            );
          }
        },
        {
          // Creation Date
          targets: 6,
          width: '76px',
          render: function (data, type, full, meta) {
           
            var $dueDate = new Date(full['created_at'].date);
            //console.log($dueDate);
            // Creates full output for row
            var $rowOutput =
              '<span class="d-none">' +
              moment($dueDate).format('YYYYMMDD') +
              '</span>' +
              moment($dueDate).format(' ddd DD-MM-YYYY HH:mm');
            
            return $rowOutput;
          }
        },
         {
          // Due Date
          targets: 7,
          width: '76px',
          render: function (data, type, full, meta) {
            var $dueDate = new Date(full['end_time']*1000);
            // Creates full output for row
            var $rowOutput =
              '<span class="d-none">' +
              moment($dueDate).format('YYYYMMDD') +
              '</span>' +
              moment($dueDate).format(' ddd DD-MM-YYYY HH:mm ');
            
            return $rowOutput;
          }
        },
       
        {
          // Actions
          targets: 8,
          title: 'Actions',
          width: '76px',
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="d-flex align-items-center col-actions">' +
              '<a class="mr-1" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Send Mail">' +
              feather.icons['send'].toSvg({ class: 'font-medium-1' }) +
              '</a>' +
              '<a class="mr-1" href="' +
              invoicePreview +
              '" data-toggle="tooltip" data-placement="top" title="Preview Invoice">' +
              feather.icons['eye'].toSvg({ class: 'font-medium-1' }) +
              '</a>' +
              '<div class="dropdown">' +
              '<a class="btn btn-sm btn-icon px-0" data-toggle="dropdown">' +
              feather.icons['more-vertical'].toSvg({ class: 'font-medium-1' }) +
              '</a>' +
              '<div class="dropdown-menu dropdown-menu-right">' +
              '<a href="javascript:void(0);" class="dropdown-item">' +
              feather.icons['download'].toSvg({ class: 'font-small-4 mr-50' }) +
              'Download</a>' +
              '<a href="' +
              invoiceEdit +
              '" class="dropdown-item">' +
              feather.icons['edit'].toSvg({ class: 'font-small-4 mr-50' }) +
              'Edit</a>' +
              '<a href="javascript:void(0);" class="dropdown-item">' +
              feather.icons['trash'].toSvg({ class: 'font-small-4 mr-50' }) +
              'Delete</a>' +
              '<a href="javascript:void(0);" class="dropdown-item">' +
              feather.icons['copy'].toSvg({ class: 'font-small-4 mr-50' }) +
              'Duplicate</a>' +
              '</div>' +
              '</div>' +
              '</div>'
            );
          }
        }
      ],
      order: [[1, 'desc']],
      dom:
        '<"row d-flex justify-content-between align-items-center m-1"' +        
        '<"d-flex justify-content-between align-items-center mx-50 row pt-0 pb-2"f<"investment_status ml-2"><"investment_type ml-2">>' +
        '<"col-lg-6 d-flex align-items-center"l<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left "B>>' +
        '>t' +
        '<"d-flex justify-content-between mx-2 row"' +
        '<"col-sm-12 col-md-6"i>' +
        '<"col-sm-12 col-md-6"p>' +
        '>',
      language: {
        sLengthMenu: 'Show _MENU_',
        search: 'Search',
        searchPlaceholder: 'Search Invoice',
        paginate: {
          // remove previous & next text from pagination
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      },
      // Buttons with Dropdown
      buttons: [
        {
          text: 'Add Record',
          className: 'btn btn-primary btn-add-record ml-2',
          attr: {
            'disabled': true
            },
          action: function (e, dt, button, config) {
            window.location = invoiceAdd;
          },
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
          }
        }
      ],
      // For responsive popup
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Details of ' + data['client_name'];
            }
          }),
          type: 'column',
          renderer: $.fn.dataTable.Responsive.renderer.tableAll({
            tableClass: 'table',
            columnDefs: [
              {
                targets: 2,
                visible: false
              },
              {
                targets: 3,
                visible: false
              }
            ]
          })
        }
      },
      initComplete: function () {
        // $('.dataTables_filter').find('.form-control-sm').removeClass('form-control-sm');
        // $('.dataTables_length .custom-select').removeClass('custom-select-sm').removeClass('form-control-sm');
        $(document).find('[data-toggle="tooltip"]').tooltip();
        // Adding role filter once table initialized
        this.api()
          .columns(5)
          
          .every(function () {
            var column = this;
            var select = $(
              '<select id="IvestmentStatus" class="form-control ml-50 text-capitalize"><option value=""> Select Investment Status </option></select>'
            )
              .appendTo('.investment_status')
              .on('change', function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                column.search(val, true, false).draw();
              });

            column
              .data()
              .unique()
              .sort()
              .each(function (d, j) {
               // console.log( d );
                select.append('<option value="' + d + '" class="text-capitalize">' + d + '</option>');
              });
          });
        this.api()
          .columns(1)
          
          .every(function () {
            var column = this;
            var select = $(
              '<select id="IvestmentType" class="form-control ml-50 text-capitalize"><option value=""> Select Investment Type </option></select>'
            )
              .appendTo('.investment_type')
              .on('change', function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                column.search(val, true, false).draw();
              });

            column
              .data()
              .unique()
              .sort()
              .each(function (d , j) {
                //console.log( d );
                select.append('<option value="' + d.title + '" class="text-capitalize">' + d.title + '</option>');
              });
          });
      },
      
      drawCallback: function () {
        $(document).find('[data-toggle="tooltip"]').tooltip();
      }
    });
  }



});

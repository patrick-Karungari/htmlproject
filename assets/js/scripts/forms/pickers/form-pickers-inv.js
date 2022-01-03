/*=========================================================================================
    File Name: pickers.js
    Description: Pick a date/time Picker, Date Range Picker JS
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: Pixinvent
    Author URL: hhttp://www.themeforest.net/user/pixinvent
==========================================================================================*/
(function (window, document, $) {
  'use strict';
  var today = new Date();
  const month = ["January","February","March","April","May","June","July","August","September","October","November","December"];
  var dd = String(today.getDate()).padStart(2, '0');
  var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
  var mmm = month[today.getMonth()]; //January is 0!
  var yyyy = today.getFullYear();

  var todayDate = yyyy + '-' + mm + '-' + dd;
 
  /*******  Flatpickr  *****/
  var rangePickr = $('.flatpickr-range');


// Range
  if (rangePickr.length) {
    rangePickr.flatpickr({
      mode: 'range',
      dateFormat: 'M, d Y',
      altFormat: 'M, d Y',
      onClose: function (selectedDates, dateStr, instance) {
        var dateStart = instance.formatDate(selectedDates[0], "Y-m-d");
        var dateEnd = instance.formatDate(selectedDates[1], "Y-m-d");

        $.ajax({
            url: "admin/investments/getTotalInvestment",
            data: {"start": dateStart, "end": dateEnd},
            type: 'GET',
            success: function (resp) {
              var Start = instance.formatDate(selectedDates[0], "M, d Y");
              var End = instance.formatDate(selectedDates[1], "M, d Y");
              if (resp != null) {
                if (dateEnd == dateStart) {
                  document.getElementById("heading").innerHTML = "Payouts for  " + Start;
                } else {
                  document.getElementById("heading").innerHTML = "Payouts for  " + Start + " to "+ End;
                }
              // document.getElementById("heading").innerHTML = "Payouts for  " + Intl.NumberFormat('en-US').format(resp);
                document.getElementById("subheading").innerHTML = "Ksh " + Intl.NumberFormat('en-US').format(resp);
                //alert('Success');
              // rangePickr.flatpickr.close();
              }            
            },
            error: function(e) {
              alert('Error: '+e);
            }  
        });
      }
    });
   
  }

  // Default 
  $.ajax({
            url: "admin/investments/getTotalInvestment",
            data: {"start": todayDate, "end": todayDate},
            type: 'GET',
            success: function (resp) {
           
              if (resp != null) {
                document.getElementById("heading").innerHTML = "Payouts for  " + mmm
                  + ", " + dd + " " + yyyy;
                document.getElementById("subheading").innerHTML = "Ksh " + Intl.NumberFormat('en-US').format(resp);
               
              }            
            },
            error: function(e) {
              alert('Error: '+e.getMessage());
            }  
  });

  var statusObj = {
    0: { title: 'Completed', class: 'badge-light-success' },
    1: { title: 'Pending', class: 'badge-light-info' },
    2: { title: 'Failed', class: 'badge-light-danger' }
    },
    invoicePreview = 'app-invoice-preview.html',    
    invoiceAdd = 'app-invoice-add.html',
    invoiceEdit = 'app-invoice-edit.html',
    dtInvestmentsTable = $('.investments-list-table');
   var assetPath = '../assets/',
        userView = '../view/',
        userEdit = '../edit/';

if (dtInvestmentsTable.length) {
    var dtInvestments = dtInvestmentsTable.DataTable({
      "ajax": {
        "url": "admin/investments/ginv",
        "type": "GET",     
      },
      "language": {
        "emptyTable": "User has not made any Transactions yet"
      },
      headers: { 'X-Requested-With': 'XMLHttpRequest' }, // JSON file to add data
      autoWidth: false,
      columns: [
        // columns according to JSON
        { data: 'id' },
        { data: 'user' },
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
                    // User full name and username
                    targets: 1,
                    responsivePriority: 2,
                    className: 'all',
                    render: function (data, type, full, meta) {
                       
                        var $first_name = full['user'].first_name,
                            $last_name = full['user'].last_name,
                            $uname = full['user'].username,
                            $image = full['user'].avatar,
                            $name = $first_name + ' ' +  $last_name;
                        if (full['user'].avatar) {
                            // For Avatar image
                            var $output =
                                '<img src="' + assetPath + 'uploads/avatars/' + $image + '" alt="Avatar" height="32" width="32">';
                        } else {
                            // For Avatar badge
                            var stateNum = Math.floor(Math.random() * 6) + 1;
                            var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
                            var $state = states[stateNum],
                                $initials = $name.match(/\b\w/g) || [];
                            $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
                            $output = '<span class="avatar-content">' + $initials + '</span>';
                        }
                        var colorClass = $image === null ? ' bg-light-' + $state + ' ' : '';
                        // Creates full output for row
                        var $row_output =
                            '<div class="d-flex justify-content-left align-items-center">' +
                            '<div class="avatar-wrapper">' +
                            '<div class="avatar ' +
                            colorClass +
                            ' mr-1">' +
                            $output +
                            '</div>' +
                            '</div>' +
                            '<div class="d-flex flex-column">' +
                            '<a href="' +
                            userView + full['user'].username +
                            '" class="user_name text-truncate"><span class="font-weight-bold">' +
                            $name +
                            '</span></a>' +
                            '<small class="emp_post text-muted">@' +
                            $uname +
                            '</small>' +
                            '</div>' +
                            '</div>';
                        return $row_output;
                    }
                },
        {
        // Plan
          targets: 2,
          responsivePriority: 3,
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
          targets: 3,
          responsivePriority: 4,
          className: 'all',
          width: '24px',
          render: function (data, type, full, meta) {
            var $total = full['amount'];
            return '<span class="d-none">Ksh ' + Intl.NumberFormat('en-US').format ($total) + '</span>Ksh ' +  Intl.NumberFormat('en-US').format ($total);
          }
        },
        
        {
          // Total Return
          targets: 4,
          width: '24px',
          render: function (data, type, full, meta) {
            var $total = full['return'];
            return '<span class="d-none">Ksh ' +  Intl.NumberFormat('en-US').format ($total) + '</span>Ksh ' + Intl.NumberFormat('en-US').format ($total);
          }
        },
        {
          // Total Amount
          targets: 5,
          responsivePriority: 5,
          width: '24px',
          render: function (data, type, full, meta) {
            var $total = full['total'];
            return '<span class="d-none">Ksh ' +  Intl.NumberFormat('en-US').format ($total) + '</span>Ksh ' +  Intl.NumberFormat('en-US').format ($total);
          }
        },
       
         {
          // Investment status
          targets: 6,
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
          targets: 7,
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
          targets: 8,
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
          targets: 9,
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
        searchPlaceholder: 'Search Investment',
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
             // console.log(data);
              return 'Details of ' + data['user'].first_name + ' ' + data['user'].last_name;
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
        var status = [];
        var uniqueChars = [];
        let n = 0;
        // Adding role filter once table initialized
        this.api()
          .columns(6)
          
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
                //console.log(d);
                
                select.append('<option value="' + d + '" class="text-capitalize">' + d + '</option>');
              });
          });
        this.api()
          .columns(2)
          
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
                n++
                status[n] = d.title;
                uniqueChars = status.filter((c, index) => {
                    return status.indexOf(c) === index;
                });
                //console.log(uniqueChars);
                //select.append('<option value="' + d.title + '" class="text-capitalize">' + d.title + '</option>');
              });
            for (let i = 0; i < uniqueChars.length; i++){
              console.log(uniqueChars[i]);
              select.append('<option value="' + uniqueChars[i] + '" class="text-capitalize">' + uniqueChars[i] + '</option>');
            }
            
          });
      },
      
      drawCallback: function () {
        $(document).find('[data-toggle="tooltip"]').tooltip();
      }
    });
  }
  // Close on a user action
  $('.pickatime-close-action').pickatime({
    closeOnSelect: true,
    closeOnClear: true
  });
})(window, document, jQuery);

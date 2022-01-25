 
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
 
var statusObj = {
    0: { title: 'Completed', class: 'badge-light-success' },
    1: { title: 'Pending', class: 'badge-light-info' },
    2: { title: 'Failed', class: 'badge-light-danger' }
    },
    invoicePreview = '',    
    invoiceAdd = '',
    invoiceEdit = '',
    dtInvestmentsTable = $('.referrals-list-table');
   var assetPath = '../assets/',
        userView = '/../view/',
        userEdit = '/../edit/';

if (dtInvestmentsTable.length) {
    var dtInvestments = dtInvestmentsTable.DataTable({
      "ajax": {
        "url": "referrals/getRef/" + id,
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
        { data: 'ref' },
        { data: 'first_amount' },
        { data: 'bonus' },        
        { data: 'commission' },        
        { data: 'status' },
        { data: 'date' }
      ],
      columnDefs: [
        {
        // For Responsive
        className: 'control',
        orderable: false,
        responsivePriority: 1,
        targets: 0,
        render: function (date, type, full, meta) {
                  return " ";
              }
        },        
       
       {
        // User full name and username
        targets: 1,
            className: 'all',
        width: "84px",
        responsivePriority: 1,
        render: function (data, type, full, meta) {
            
            var $first_name = full['ref'].first_name,
                $last_name = full['ref'].last_name,
                $uname = full['ref'].username,
                $image = full['ref'].avatar,
                $name = $first_name + ' ' + $last_name;
            if (full['avatar']) {
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
                '<div class="control"></div>' +
                '<div class="avatar-wrapper">' +
                '<div class="avatar ' +
                colorClass +
                ' mr-1">' +
                $output +
                '</div>' +
                '</div>' +
                '<div class="d-flex flex-column">' +
                '<a  class="user_name text-truncate"><span class="font-weight-bold">' +
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
          // First Deposit
          targets: 2,
          responsivePriority: 3,
          className: 'all',
          width: '48px',
          render: function (data, type, full, meta) { var $total = full['first_amount'];   return '<span class="d-none">' + currency + ' ' + Intl.NumberFormat('en-US').format ($total) + '</span>' + currency + ' ' +  Intl.NumberFormat('en-US').format ($total);}
        },
        
        {
          // My commission
          targets: 3,
          responsivePriority: 3,
          className: 'all',
          width: '48px',
          render: function (data, type, full, meta) { var $total = full['commission'];   return '<span class="d-none">' + currency + ' ' + Intl.NumberFormat('en-US').format ($total) + '</span>' + currency + ' '+  Intl.NumberFormat('en-US').format ($total);}
        },
        {
          // My Bonus
          targets: 4,
          responsivePriority: 3,
          className: 'all',
          width: '48px',
          render: function (data, type, full, meta) { var $total = full['bonus'];   return '<span class="d-none">' + currency + ' ' + Intl.NumberFormat('en-US').format ($total) + '</span>' + currency + ' ' +  Intl.NumberFormat('en-US').format ($total);}
        },
       
        {
            // Status
            targets: 5, 
            className: 'all',
            width: '160px',
            responsivePriority: 5,
            render: function (data, type, full, meta) {
                var $invoiceStatus = full['status'],
                    roleObj = {                
                    completed: { class: 'bg-light-success', icon: 'check-circle', title: 'Completed' },                
                    pending: { class: 'bg-light-info', icon: 'refresh-ccw', title: 'Pending' },
                    cancelled: { class: 'bg-light-primary', icon: 'refresh-ccw', title: 'Cancelled' },
                    failed: { class: 'bg-light-danger', icon: 'info', title: 'Failed' }
                    };
                
                return (

                    '<div> <div class="avatar d-lg-inline-flex avatar-status ' +
                    roleObj[$invoiceStatus].class +
                    '">' +
                    '<span class="d-sm-none d-md-inline-flex avatar-content">' +
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
           width: '380px',
          render: function (data, type, full, meta) {
           
            var $dueDate = new Date(full['date'].date);
            //console.log($dueDate);
            // Creates full output for row
            var $rowOutput =
              '<span class="d-none">' +
              moment($dueDate).format('YYYYMMDD') +
              '</span>' +
              moment($dueDate).format(' ddd DD-MM-YYYY HH:mm');
            
            return $rowOutput;
          }
        }
      ],
      order: [[0, 'desc']],
      dom:
         '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
                '<"d-flex justify-content-between" l>' +
                '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row mb-1"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
      language: {
        sLengthMenu: 'Show _MENU_',
        search: 'Search',
        searchPlaceholder: 'Search Referral',
        paginate: {
          // remove previous & next text from pagination
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      },
      // Buttons with Dropdown
      buttons: [
      ],
      // For responsive popup
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
             // console.log(data);
              return 'Details of ' + data['ref'].first_name + ' ' + data['ref'].last_name;
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
          .columns(5)
          
          .every(function () {
            var column = this;
            var select = $(
              '<select id="IvestmentStatus" class="form-control ml-50 text-capitalize"><option value=""> Select Referral Status </option></select>'
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
       
      },
      
      drawCallback: function () {
        $(document).find('[data-toggle="tooltip"]').tooltip();
      }
    });
    }
 
})(window, document, jQuery);

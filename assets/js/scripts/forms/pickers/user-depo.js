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
            url: "deposits/getTotalDeposits",
            data: {"start": dateStart, "end": dateEnd},
            type: 'GET',
            success: function (resp) {
              var Start = instance.formatDate(selectedDates[0], "M, d Y");
              var End = instance.formatDate(selectedDates[1], "M, d Y");
              if (resp != null) {
                if (dateEnd == dateStart) {
                  document.getElementById("heading").innerHTML = "Deposits for  " + Start;
                } else {
                  document.getElementById("heading").innerHTML = "Deposits for  " + Start + " to "+ End;
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
            url: "deposits/getTotalDeposits",
            data: {"start": todayDate, "end": todayDate},
            type: 'GET',
            success: function (resp) {
           
              if (resp != null) {
                document.getElementById("heading").innerHTML = "Deposits for  " + mmm
                  + ", " + dd + " " + yyyy;
                document.getElementById("subheading").innerHTML = "Ksh " + Intl.NumberFormat('en-US').format(resp);
               
              }            
            },
      error: function (e) {
          console.log(e);
             // alert('Error: '+e);
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
        userView = '/../view/',
        userEdit = '/../edit/';

if (dtInvestmentsTable.length) {
    var dtInvestments = dtInvestmentsTable.DataTable({
      "ajax": {
        "url": "deposits/getDepo/" + id,
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
        { data: 'trx_id' },
        { data: 'amount' },
        { data: 'phone' },        
        { data: 'status' },        
        { data: 'description' },
        { data: 'date' }
      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          orderable: false,
          responsivePriority: 1,
              targets: 0,
              render: {
              
          }
        },        
       
       {
          //Invoice ID
           targets: 1,
           width: '24px',
           className: 'all',
          render: function (data, type, full, meta) {
             //console.log(data);
            var $invoiceId = full['trx_id'];
            // Creates full output for row
            var $rowOutput = '<a class="font-weight-bold" href="' + invoicePreview + '"> #' + $invoiceId + '</a>';
            return $rowOutput;
          }
        },
        {
          // Total Amount
          targets: 2,
          responsivePriority: 3,
          className: 'all',
          width: '24px',
          render: function (data, type, full, meta) { var $total = full['amount'];   return '<span class="d-none">Ksh ' + Intl.NumberFormat('en-US').format ($total) + '</span>Ksh ' +  Intl.NumberFormat('en-US').format ($total);}
        },
        
        
        
       
         {
          // Status
             targets: 4, 
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
          targets: 5,
          responsivePriority: 4,
          width: '380px',
          render: function (data, type, full, meta) {
            var $total = full['description'];
            return '<div class="col-2 text-truncate"> <span class="d-none text-wrap text-truncate">' + $total + '</span> </div>'+ $total ;
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
      order: [[1, 'desc']],
      dom:
         '<"d-flex justify-content-start align-items-center header-actions mx-1 row mt-75"' +
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
        searchPlaceholder: 'Search Deposit',
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
          .columns(4)
          
          .every(function () {
            var column = this;
            var select = $(
              '<select id="IvestmentStatus" class="form-control ml-50 text-capitalize"><option value=""> Select Deposit Status </option></select>'
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
  // Close on a user action
  $('.pickatime-close-action').pickatime({
    closeOnSelect: true,
    closeOnClear: true
  });
})(window, document, jQuery);

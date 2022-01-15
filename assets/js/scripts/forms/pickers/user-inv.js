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
            url: "invest/getTotalInvestments/" + id,
            data: {"start": dateStart, "end": dateEnd},
            type: 'GET',
            success: function (resp) {
              var Start = instance.formatDate(selectedDates[0], "M, d Y");
              var End = instance.formatDate(selectedDates[1], "M, d Y");
              if (resp != null) {
                if (dateEnd == dateStart) {
                  document.getElementById("heading").innerHTML = "Investments for  " + Start;
                } else {
                  document.getElementById("heading").innerHTML = "Investments for  " + Start + " to "+ End;
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
            url: "invest/getTotalInvestments/" + id,
            data: {"start": todayDate, "end": todayDate},
            type: 'GET',
            success: function (resp) {
           
              if (resp != null) {
                document.getElementById("heading").innerHTML = "Investments for  " + mmm
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
    invoicePreview = '',    
    invoiceAdd = '',
    invoiceEdit = '',
    dtInvestmentsTable = $('.investments-list-table');
   var assetPath = '../assets/',
        userView = '/../view/',
        userEdit = '/../edit/';

if (dtInvestmentsTable.length) {
    var dtInvestments = dtInvestmentsTable.DataTable({
      "ajax": {
        "url": "invest/getInv/" + id,
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
        { data: 'plan' },
        { data: 'amount' },
        { data: 'return' },
        { data: 'total' },
        { data: 'status' },        
        { data: 'created_at' },
        { data: 'end_time' },
        
        ],
      
      columnDefs: [
        {
        // For Responsive
        className: 'control',
        //orderable: true,
        responsivePriority: 1,
        targets: 0,
        render: function (date, type, full, meta) {
                  return " ";
        }              
          
        }, {
        // Plan
          targets: 1,
              responsivePriority: 3,
          className: 'all',
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
            targets: 3,
            className: 'all',
          width: '24px',
          render: function (data, type, full, meta) {
            var $total = full['return'];
            return '<span class="d-none">Ksh ' +  Intl.NumberFormat('en-US').format ($total) + '</span>Ksh ' + Intl.NumberFormat('en-US').format ($total);
          }
        },
        {
          // Total Amount
          targets: 4,
            responsivePriority: 5,
          className: 'all',
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
          className: 'all',
          render: function (data, type, full, meta) {
            var $invoiceStatus = full['status'],
              roleObj = {                
                completed: { class: 'bg-light-success', icon: 'check-circle', title: 'Completed' },                
                pending: { class: 'bg-light-info', icon: 'refresh-ccw', title: 'Pending' },
                cancelled: { class: 'bg-light-primary', icon: 'refresh-ccw', title: 'Cancelled' },
                failed: { class: 'bg-light-danger', icon: 'info', title: 'Failed' }
              };
           
            return (

              '<div> <div class="avatar d-none d-lg-inline-flex  avatar-status ' +
              roleObj[$invoiceStatus].class +
              '">' +
              '<span class=" avatar-content">' +
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
          className: 'all',
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
        }
       
      ],
      order: [[0, 'desc']],
      dom:
        '<"row d-flex justify-content-between align-items-center m-1"' +        
        '<"d-flex justify-content-between align-items-center mx-50 row pt-0 pb-2"f<"investment_status mt-1 ml-2"><"investment_type mt-1 ml-2">>' +
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
      ],
      // For responsive popup
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
             // console.log(data);
              return 'Details of ' + data['plan'].title;
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


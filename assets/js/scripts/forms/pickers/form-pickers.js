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
            url: "investments/getTotalInvestment",
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
            url: "investments/getTotalInvestment",
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



  // Close on a user action
  $('.pickatime-close-action').pickatime({
    closeOnSelect: true,
    closeOnClear: true
  });
})(window, document, jQuery);

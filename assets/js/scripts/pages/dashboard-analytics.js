/*=========================================================================================
    File Name: dashboard-analytics.js
    Description: dashboard analytics page content with Apexchart Examples
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
import { CountUp } from '/assets/vendors/countup/dist/countUp.js';
$(window).on('load', function () {
  'use strict';

  var isRtl = $('html').attr('data-textdirection') === 'rtl';






  var $ri = document.querySelector('#ri');
  var $tp = document.querySelector('#tp');
  var $ar = document.querySelector('#ar');
  var $tb = document.querySelector('#tb');
  

  const options = {
    decimalPlaces: 2,
    prefix: 'KES ',
  };
 
  let ri = new CountUp($ri, $ri.innerHTML, options);
  let tp = new CountUp($tp, $tp.innerHTML, options);
  let ar = new CountUp($ar, $ar.innerHTML);
  let tb = new CountUp($tb, $tb.innerHTML, options);
  
  ri.start();
  tp.start();
  ar.start();
  tb.start();

  // On load Toast
  setTimeout(function () {
    var $name = document.querySelector('#user_name_d').innerHTML;
    toastr['success'](
        'You have successfully logged in to Vuexy. Now you can start to explore!',
        '👋 Welcome ' + $name+'!',
        {
          closeButton: true,
          tapToDismiss: true,
          rtl: isRtl
        }
    );
  }, 1000);

  // Subscribed Gained Chart
  // ----------------------------------

});

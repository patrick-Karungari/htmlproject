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
  var $html = $('html');






  var $ri = document.querySelector('#ri');
  var $tp = document.querySelector('#tp');
  var $ar = document.querySelector('#ar');
  var $tb = document.querySelector('#tb');
  var time;

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
  $.ajax({
            url: "account/getStat",
            data: {"id":id, "timezone":Intl.DateTimeFormat().resolvedOptions().timeZone},
            type: 'GET',
            success: function (resp) {
             
              if (resp != null) {
                var resp = JSON.parse(resp);
                time = resp.date;
                console.log(moment(resp.date,moment.defaultFormat).fromNow());
                //block_ele.unblock();
              } else {
                //block_ele.unblock();
                console.log('api response null');
              }            
            },
            error: function(e) {
              //block_ele.unblock();
              console.log('api error');
            }  
        });
  if (window.location.pathname === '/user/account') {
    setInterval(function () {
      document.getElementById("timer").innerHTML = "Updated " + moment(time, moment.defaultFormat).fromNow();
    }, 1000);
  }

 // Reload Card
    $('a[data-action="reload"]').on('click', function () {
      var block_ele = $(this).closest('.card');
      var reloadActionOverlay;
      if ($html.hasClass('dark-layout')) {
        var reloadActionOverlay = '#10163a';
      } else {
        var reloadActionOverlay = '#fff';
      }
      // Block Element
      block_ele.block({
        message: feather.icons['refresh-cw'].toSvg({ class: 'font-medium-1 spinner text-primary' }),
        //timeout: 2000, //unblock after 2 seconds
        overlayCSS: {
          backgroundColor: reloadActionOverlay,
          cursor: 'wait'
        },
        css: {
          border: 0,
          padding: 0,
          backgroundColor: 'none'
        }
      });
      if (window.location.pathname === '/user/account') {
        $.ajax({
            url: "account/getStat",
            data: {"id":id, "timezone":Intl.DateTimeFormat().resolvedOptions().timeZone},
            type: 'GET',
            success: function (resp) {
             
              if (resp != null) {
                var resp = JSON.parse(resp);
                time = resp.date;
                console.log(moment(resp.date,moment.defaultFormat).fromNow());
                block_ele.unblock();
                document.getElementById("timer").innerHTML = "Updated " + moment(time, moment.defaultFormat).fromNow();

              } else {
                block_ele.unblock();
                console.log('api response null');
              }            
            },
            error: function(e) {
              block_ele.unblock();
              console.log('api error');
            }  
        });
      } else {
        block_ele.unblock();
        console.log('url mismatch');
      }
      
    });
});

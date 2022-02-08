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
    prefix: (currency + ' '),
  };
 
  let ri = new CountUp($ri, $ri.innerHTML, options);
  let tp = new CountUp($tp, $tp.innerHTML, options);
  let ar = new CountUp($ar, $ar.innerHTML);
  let tb = new CountUp($tb, $tb.innerHTML, options);
  //console.log(ri);
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
          try {
            var resp = JSON.parse(resp);
            time = resp.date;
            console.log(moment(resp.date, moment.defaultFormat).fromNow());
            //block_ele.unblock();
          } catch {
            //block_ele.unblock();
            console.log('api error');
          }
          
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
                try {
                  var resp = JSON.parse(resp);
                  time = resp.date;
                  console.log(moment(resp.date,moment.defaultFormat).fromNow());
                  block_ele.unblock();
                  document.getElementById("timer").innerHTML = "Updated " + moment(time, moment.defaultFormat).fromNow();
                  
                  const options = {
                    decimalPlaces: 2,
                    prefix: 'KES ',
                  };
                  $('#ri').html(resp.investment);
                 // console.log($ri);
                  let ri = new CountUp( $ri, resp.investment, options);
                  let tp = new CountUp($tp, resp.profit, options);
                  let ar = new CountUp($ar, resp.refferrals);
                  let tb = new CountUp($tb,  resp.bonus, options);
                  //console.log(ri);
                  ri.start();
                  tp.start();
                  ar.start();
                  tb.start();
                  //console.log(ri);

                } catch {
                  block_ele.unblock();
                  console.log('api response null');
                }
                
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

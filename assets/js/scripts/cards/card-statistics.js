/*=========================================================================================
    File Name: card-statistics.js
    Description: Card-statistics page content with Apexchart Examples
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(window).on('load', function () {
  'use strict';

  var $barColor = '#f3f3f3';
  var $trackBgColor = '#EBEBEB';
  var $primary_light = '#A9A2F6';
  var $success_light = '#55DD92';
  var $warning_light = '#ffc085';

  var statisticsBarChartOptions;
  var statisticsLineChartOptions;
  var gainedChartOptions;
  var revenueChartOptions;
  var salesChartOptions;
  var orderChartOptions;
  var trafficChartOptions;
  var userChartOptions;
  var newsletterChartOptions;

  var statisticsBarChart = document.querySelector('#statistics-bar-chart');
  var statisticsLineChart = document.querySelector('#statistics-line-chart');


  var statisticsBar;
  var statisticsLine;


  //------------ Statistics Bar Chart ------------
  //----------------------------------------------

  statisticsBarChartOptions = {
    chart: {
      height: 70,
      type: 'bar',
      stacked: true,
      toolbar: {
        show: false
      }
    },
    grid: {
      show: false,
      padding: {
        left: 0,
        right: 0,
        top: -15,
        bottom: -15
      }
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: '20%',
        startingShape: 'rounded',
        colors: {
          backgroundBarColors: [$barColor, $barColor, $barColor, $barColor, $barColor],
          backgroundBarRadius: 5
        }
      }
    },
    legend: {
      show: false
    },
    dataLabels: {
      enabled: false
    },
    colors: [window.colors.solid.warning],
    series: [
      {
        name: '2020',
        data: [45, 85, 65, 45, 65]
      }
    ],
    xaxis: {
      labels: {
        show: false
      },
      axisBorder: {
        show: false
      },
      axisTicks: {
        show: false
      }
    },
    yaxis: {
      show: false
    },
    tooltip: {
      x: {
        show: false
      }
    }
  };

  statisticsBar = new ApexCharts(statisticsBarChart, statisticsBarChartOptions);
  statisticsBar.render();

  //------------ Statistics Line Chart ------------
  //-----------------------------------------------

  statisticsLineChartOptions = {
    chart: {
      height: 70,
      type: 'line',
      toolbar: {
        show: false
      },
      zoom: {
        enabled: false
      }
    },
    grid: {
      borderColor: $trackBgColor,
      strokeDashArray: 5,
      xaxis: {
        lines: {
          show: true
        }
      },
      yaxis: {
        lines: {
          show: false
        }
      },
      padding: {
        top: -30,
        bottom: -10
      }
    },
    stroke: {
      width: 3
    },
    colors: [window.colors.solid.info],
    series: [
      {
        data: [0, 20, 5, 30, 15, 45]
      }
    ],
    markers: {
      size: 2,
      colors: window.colors.solid.info,
      strokeColors: window.colors.solid.info,
      strokeWidth: 2,
      strokeOpacity: 1,
      strokeDashArray: 0,
      fillOpacity: 1,
      discrete: [
        {
          seriesIndex: 0,
          dataPointIndex: 5,
          fillColor: '#ffffff',
          strokeColor: window.colors.solid.info,
          size: 5
        }
      ],
      shape: 'circle',
      radius: 2,
      hover: {
        size: 3
      }
    },
    xaxis: {
      labels: {
        show: true,
        style: {
          fontSize: '0px'
        }
      },
      axisBorder: {
        show: false
      },
      axisTicks: {
        show: false
      }
    },
    yaxis: {
      show: false
    },
    tooltip: {
      x: {
        show: false
      }
    }
  };

  statisticsLine = new ApexCharts(statisticsLineChart, statisticsLineChartOptions);
  statisticsLine.render();

  
});

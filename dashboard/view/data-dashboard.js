
  /* global Chart:false */

$(function () {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode = 'index'
  var intersect = true

// var $salesChart = $('#sales-chart')
//   var $salesChart = document.getElementById('sales-chart')
// //   eslint-disable-next-line no-unused-vars
//   var salesChart = new Chart($salesChart, {
//     type: 'bar',
//     data: {
//       labels: ['JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'],
//       datasets: [
//         {
//           backgroundColor: '#622c5e',
//           borderColor: '#007bff',
//           data: [1000, 2000, 3000, 2500, 2700, 2500, 3000]
//         },
//         {
//           backgroundColor: '#ced4da',
//           borderColor: '#ced4da',
//           data: [700, 1700, 2700, 2000, 1800, 1500, 2000]
//         }
//       ]
//     },
//     options: {
//       maintainAspectRatio: false,
//       tooltips: {
//         mode: mode,
//         intersect: intersect
//       },
//       hover: {
//         mode: mode,
//         intersect: intersect
//       },
//       legend: {
//         display: false
//       },
//       scales: {
//         yAxes: [{
//           // display: false,
//           gridLines: {
//             display: true,
//             lineWidth: '4px',
//             color: 'rgba(0, 0, 0, .2)',
//             zeroLineColor: 'transparent'
//           },
//           ticks: $.extend({
//             beginAtZero: true,

//             // Include a dollar sign in the ticks
//             callback: function (value) {
//               if (value >= 1000) {
//                 value /= 1000
//                 value += 'k'
//               }

//               return '$' + value
//             }
//           }, ticksStyle)
//         }],
//         xAxes: [{
//           display: true,
//           gridLines: {
//             display: false
//           },
//           ticks: ticksStyle
//         }]
//       }
//     }
//   })

var $salesChart = document.getElementById('sales-chart');

fetch('get_data_empresa.php')
  .then(response => response.json())
  .then(data => {
    var labels = data.labels;

    // Crear arrays de datos para Chart.js
    var currentYearData = data.datasets[0].data;
    var previousYearData = data.datasets[1].data;

    // Crear el gráfico
    var salesChart = new Chart($salesChart, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [
          {
            label: 'Año Actual',
            backgroundColor: '#622c5e',
            borderColor: '#007bff',
            data: currentYearData
          },
          {
            label: 'Año Anterior',
            backgroundColor: '#ccc',
            borderColor: '#ced4da',
            data: previousYearData
          }
        ]
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          mode: 'index',
          intersect: true
        },
        hover: {
          mode: 'index',
          intersect: true
        },
        legend: {
          display: true
        },
        scales: {
          yAxes: [{
            position: 'left',
            gridLines: {
              display: true,
              lineWidth: '4px',
              color: 'rgba(0, 0, 0, .9)',
              zeroLineColor: 'transparent'
            },
            ticks: {
              beginAtZero: true,
              callback: function (value) {
                if (value >= 1000) {
                  value /= 1000;
                  value += 'k';
                }
                return '' + value;
              }
            }
          }],
          yAxes: [{
            position: 'right',
            gridLines: {
              display: true
            },
            ticks: {
              beginAtZero: true,
              callback: function (value) {
                if (value >= 1000) {
                  value /= 1000;
                  value += 'k';
                }
                return '' + value;
              }
            }
          }],
          xAxes: [{
            display: true,
            gridLines: {
              display: false
            },
            ticks: {}
          }]
        }
      }
    });
  })
  .catch(error => console.error('Error:', error));
  
//   cierra empresas >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

var $visitorsChart = document.getElementById('visitors-chart');

fetch('get_data_candidato.php')
.then(response => response.json())
.then(data => {
  var labels = data.labels;

  // Crear arrays de datos para Chart.js
  var currentYearData = data.datasets[0].data;
  var previousYearData = data.datasets[1].data;

  // Crear el gráfico
  var visitorsChart = new Chart($visitorsChart, {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [
        {
          label: 'Año Actual',
          backgroundColor: '#622c5e',
          borderColor: '#007bff',
          data: currentYearData
        },
        {
          label: 'Año Anterior',
          backgroundColor: '#ccc',
          borderColor: '#622c5e',
          data: previousYearData
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: 'index',
        intersect: true
      },
      hover: {
        mode: 'index',
        intersect: true
      },
      legend: {
        display: true
      },
      scales: {
        yAxes: [{
          position: 'left',
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'solid'
          },
          ticks: {
            beginAtZero: true,
            callback: function (value) {
              if (value >= 1000) {
                value /= 1000;
                value += 'k';
              }
              return '' + value;
            }
          }
        }],
        yAxes: [{
          position: 'right',
          gridLines: {
            display: true,
          },
          ticks: {
            beginAtZero: true,
            callback: function (value) {
              if (value >= 1000) {
                value /= 1000;
                value += 'k';
              }
              return '' + value;
            }
          }
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: {}
        }]
      }
    }
  });
})
.catch(error => console.error('Error:', error));

  // // var $visitorsChart = $('#visitors-chart')
  // // eslint-disable-next-line no-unused-vars
  // var visitorsChart = new Chart($visitorsChart, {
  //   data: {
  //     labels: ['18th', '20th', '22nd', '24th', '26th', '28th', '30th'],
  //     datasets: [{
  //       type: 'line',
  //       data: [100, 120, 170, 167, 180, 177, 160],
  //       backgroundColor: 'transparent',
  //       borderColor: '#007bff',
  //       pointBorderColor: '#007bff',
  //       pointBackgroundColor: '#007bff',
  //       fill: false
  //       // pointHoverBackgroundColor: '#007bff',
  //       // pointHoverBorderColor    : '#007bff'
  //     },
  //     {
  //       type: 'line',
  //       data: [60, 80, 70, 67, 80, 77, 100],
  //       backgroundColor: 'tansparent',
  //       borderColor: '#ced4da',
  //       pointBorderColor: '#ced4da',
  //       pointBackgroundColor: '#ced4da',
  //       fill: false
  //       // pointHoverBackgroundColor: '#ced4da',
  //       // pointHoverBorderColor    : '#ced4da'
  //     }]
  //   },
  //   options: {
  //     maintainAspectRatio: false,
  //     tooltips: {
  //       mode: mode,
  //       intersect: intersect
  //     },
  //     hover: {
  //       mode: mode,
  //       intersect: intersect
  //     },
  //     legend: {
  //       display: false
  //     },
  //     scales: {
  //       yAxes: [{
  //         // display: false,
  //         gridLines: {
  //           display: true,
  //           lineWidth: '4px',
  //           color: 'rgba(0, 0, 0, .2)',
  //           zeroLineColor: 'transparent'
  //         },
  //         ticks: $.extend({
  //           beginAtZero: true,
  //           suggestedMax: 200
  //         }, ticksStyle)
  //       }],
  //       xAxes: [{
  //         display: true,
  //         gridLines: {
  //           display: false
  //         },
  //         ticks: ticksStyle
  //       }]
  //     }
  //   }
  // })
})

// lgtm [js/unused-local-variable]

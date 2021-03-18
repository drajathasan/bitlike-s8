/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2020-08-21 23:56:48
 * @modify date 2020-08-21 23:56:48
 * @desc javascript ui
 */

'use strict';

// Counter
$('.count').each(function () {
    let obj = $(this);
    let idx = obj.data('src');
    $.getJSON(awb+'?chart=num', function(res){
        obj.prop('Counter',0).animate({
            Counter: res[idx]
        }, {
            duration: 1000,
            easing: 'swing',
            step: function (now) {
                let num = Number(now);
                $(this).text(num.toFixed(0).replace('.', '.').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'));
            }
        }); 

        setTimeout(() => {
            //console.info('Tunggu 3 detik, biar gak lama');
        }, 3000);
    })
});

// chart 1 : bar
function c1(widthdiv, prop)
{
    $.getJSON(awb+'?chart=barchart', (res) => {

        var container = document.getElementById('chart-c1');
        var data = {
            categories: res[0],
            series: [
                {
                    name: prop[1],
                    data: res[1]
                },
                {
                    name: prop[2],
                    data: res[2]
                },
                {
                    name: prop[3],
                    data: res[0]
                },
            ]
        };
        var options = {
            chart: {
                width: widthdiv,
                height: 450,
                title: prop[0],
                format: '1,000'
            },
            yAxis: {
                title: 'Jumlah',
            },
            xAxis: {
                title: 'Tanggal'
            },
            legend: {
                align: 'top'
            }
        };
        var theme = {
            series: {
                colors: [
                    '#83b14e', '#458a3f', '#295ba0', '#2a4175', '#289399',
                    '#289399', '#617178', '#8a9a9a', '#516f7d', '#dddddd'
                ]
            }
        };
        // For apply theme
        // tui.chart.registerTheme('myTheme', theme);
        // options.theme = 'myTheme';
        tui.chart.columnChart(container, data, options);
    });
}

// chart 2 : pie
function c2(widthdiv, prop)
{
    $.getJSON(awb+'?chart=doughchart', (res) => {
        var container = document.getElementById('chart-c2');
        var data = {
            categories: [],
            series: [
                {
                    name: prop[1],
                    data: res[0]
                },
                {
                    name: prop[2],
                    data: res[1]
                },
                {
                    name: prop[3],
                    data: res[2]
                },
                {
                    name: prop[4],
                    data: res[3]
                },
                {
                    name: prop[5],
                    data: res[4]
                }
            ]
        };
        var options = {
            chart: {
                width: widthdiv,
                height: widthdiv,
                title: prop[0],
                format: function(value, chartType, areaType, valuetype, legendName) {
                    return value;
                }
            },
            series: {
                radiusRange: ['20%', '100%'],
                showLabel: true,
                borderWidth: 5
            },
            tooltip: {
                suffix: ''
            },
            legend: {
                align: 'bottom'
            }
        };
        var theme = {
            series: {
                series: {
                    colors: [
                        '#83b14e', '#458a3f', '#295ba0', '#2a4175', '#289399',
                        '#289399', '#617178', '#8a9a9a', '#516f7d', '#dddddd'
                    ]
                },
                label: {
                    color: '#fff',
                    fontFamily: 'arial'
                }
            }
        };

        // For apply theme

        tui.chart.registerTheme('myTheme', theme);
        options.theme = 'myTheme';

        tui.chart.pieChart(container, data, options);
    });
}

// call function after document is ready
$(document).ready(function(){
    c1($('.c1')[0].offsetWidth, barchart);
    c2($('.c2')[0].offsetWidth, doughchart);
});
var myChart = echarts.init(document.getElementById('myAreaChart-main-1'));
var srr = String($("#student").text()).split(',');
var arr = String($("#marks").text()).split(',');

var myChart_2 = echarts.init(document.getElementById('myAreaChart-main-2'));
console.log('Hello');
var srr_1 = String($("#qno").text()).split(',');
var arr_1 = String($("#avg").text()).split(',');
myChart_2.setOption(option = {
    title: {
        text: 'Average Time'
    },
    tooltip: {
        trigger: 'axis'
    },
    xAxis: {
        data: srr_1,
    },
    yAxis: {
        splitLine: {
            show: false
        }
    },
    toolbox: {
        left: 'center',
        feature: {
            // dataZoom: {
            //     yAxisIndex: 'none'
            // },
            restore: {},
            saveAsImage: {}
        }
    },
    // dataZoom: [{
    //     // startValue: '2014-06-01'
    //     startValue: ''
    // }, {
    //     type: 'inside'
    // }],
    visualMap: {
        top: 10,
        right: 10,
        pieces: [{
            gt: 0,
            lte: 50,
            color: '#096'
        }, {
            gt: 50,
            lte: 100,
            color: '#ffde33'
        }, {
            gt: 100,
            lte: 150,
            color: '#ff9933'
        }, {
            gt: 150,
            lte: 200,
            color: '#cc0033'
        }, {
            gt: 200,
            lte: 300,
            color: '#660099'
        }, {
            gt: 300,
            color: '#7e0023'
        }],
        outOfRange: {
            color: '#999'
        }
    },
    series: {
        name: 'Avg. Time',
        type: 'line',
        data: arr_1,
        markLine: {
            silent: true,
            data: [{
                yAxis: 50
            }, {
                yAxis: 100
            }, {
                yAxis: 150
            }, {
                yAxis: 200
            }, {
                yAxis: 300
            }]
        }
    }
});



myChart.setOption(option = {
    title: {
        text: 'Test Result'
    },
    tooltip: {
        trigger: 'axis'
    },
    xAxis: {
        data: srr,
    },
    yAxis: {
        splitLine: {
            show: false
        }
    },
    toolbox: {
        left: 'center',
        feature: {
            // dataZoom: {
            //     yAxisIndex: 'none'
            // },
            restore: {},
            saveAsImage: {}
        }
    },
    // dataZoom: [{
    //     // startValue: '2014-06-01'
    //     startValue: ''
    // }, {
    //     type: 'inside'
    // }],
    visualMap: {
        top: 10,
        right: 10,
        pieces: [{
            gt: 0,
            lte: 50,
            color: '#096'
        }, {
            gt: 50,
            lte: 100,
            color: '#ffde33'
        }, {
            gt: 100,
            lte: 150,
            color: '#ff9933'
        }, {
            gt: 150,
            lte: 200,
            color: '#cc0033'
        }, {
            gt: 200,
            lte: 300,
            color: '#660099'
        }, {
            gt: 300,
            color: '#7e0023'
        }],
        outOfRange: {
            color: '#999'
        }
    },
    series: {
        name: 'Result',
        type: 'line',
        data: arr,
        markLine: {
            silent: true,
            data: [{
                yAxis: 50
            }, {
                yAxis: 100
            }, {
                yAxis: 150
            }, {
                yAxis: 200
            }, {
                yAxis: 300
            }]
        }
    }
});


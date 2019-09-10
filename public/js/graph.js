
var xAxisData = [];
var data1 = [];
var data2 = [];

var myChart = echarts.init(document.getElementById('main'));

function graph(data) {

console.log(JSON.parse(data));

for (var i = 0; i < 100; i++) {
    xAxisData.push('Q' + i);
    data1.push((Math.sin(i / 5) * (i / 5 -10) + i / 6) * 5);
    data2.push((Math.cos(i / 5) * (i / 5 -10) + i / 6) * 5);
}




option = {
    title: {
        text: 'Questions Vs Time Graph'
    },
    legend: {
        data: ['Your Response', 'Rank 1 Response'],
        align: 'left'
    },
    toolbox: {
        // y: 'bottom',
        feature: {
            magicType: {
                type: ['stack', 'tiled']
            },
            dataView: {},
            saveAsImage: {
                pixelRatio: 2
            }
        }
    },
    tooltip: {},
    xAxis: {
        data: xAxisData,
        silent: false,
        splitLine: {
            show: false
        }
    },
    yAxis: {
    },
    dataZoom: [
        {
            type: 'slider',
            start: 00,
            end: 100
        },
        {
            type: 'inside',
            start: 00,
            end: 100
        }
    ],

    series: [{
        name: 'Your Response',
        type: 'bar',
        data: data1,
        animationDelay: function (idx) {
            return idx * 10;
        }
    }, {
        name: 'Rank 1 Response',
        type: 'bar',
        data: data2,
        animationDelay: function (idx) {
            return idx * 10 + 100;
        }
    }],
    animationEasing: 'elasticOut',
    animationDelayUpdate: function (idx) {
        return idx * 5;
    }
};

myChart.setOption(option);

}

myChart.on('click', function (params) {
    console.log(params);
    window.open('https://www.smrtbook.in/student/question/' + encodeURIComponent(params.name));
});

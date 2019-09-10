@extends('events.dash')

@section('sidebar')
    <li class="mt">
        <a href="/student/dashboard">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="sub-menu">
        <a href="/student/performance" class="active">
            <i class="fas fa-chart-pie"></i>
            <span>Performance Record</span>
        </a>
    </li>
    <li class="sub-menu">
        <a href="/student/records" class="" >
            <i class="fa fa-tasks"></i>
            <span>Previous Exams</span>
        </a>
    </li>

    <li class="sub-menu">
        <a href="/student/important" >
            <i class="fa fa-book"></i>
            <span>Important Question</span>
        </a>
    </li>

    <li class="sub-menu">
        <a href="/student/updateInfo" >
            <i class="far fa-edit"></i>
            <span>Update Info</span>
        </a>
    </li>

    <li class="logout">
        <a href="/student/logout" >
            <i class="fa fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </li>
@endsection
@section('mainContent')

          <section class="wrapper" style="color: #424a5d;">
              @if(empty(!$records))
              <h3 style="color: #424a5d;font-weight: bold">Exam Wise Overall Performance (Percentage Scores)</h3>

              <p><b>Exam Code:</b> Represent the code of Exam</p>

              <p><b>Y-axis:</b> Represent percentage marks obtained.</p>
              <p><b>Note:</b> Hovering any point, will show your marks and topper's marks. </p>
              <!-- page start-->
              <div class="col-lg-12">
                  <div id="main" style="width: 100%;height: 400px;color: #424a5d;"></div>
              </div>
              <div class="col-lg-12" style="margin-top: 24px;">
                  <h3 style="color: #424a5d;font-weight: bold">Subject Wise Overall Performance <i style="font-size: 50%">(Click any one below)</i></h3>
                  <p><b>Note:</b> Click on any subjects below to have an insight of that subject.</p>
                  <div class="row">
                      @foreach(array_keys($records->totalQ) as $kk=>$kt)
                          <button class="btnE" onclick="showGraph(dataSeries{{$kt}},dataSeries2{{$kt}})">| {{$infoSet[$kt]}} |</button>
                      @endforeach
                          <p>Hover on colored boxes to see more information</p>
                          <p><b>Graph One:</b> Shows question wise analysis in each subject.</p>
                          <p><b>Graph Two:</b> Shows Exam marks wise analysis in each subject.</p>
                  </div>
                  <div class="row">
                      <div class="col-sm-6" id="main1" style="height: 400px;color: #424a5d;"></div>

                      <div class="col-sm-6" id="main2" style="height: 400px;color: #424a5d;"></div>
                  </div>
              </div>
                  <p id="dataNames" style="display: none">{{$gData['dataNames']}}</p>
                  <p id="dataMe" style="display: none">{{$gData['dataMe']}}</p>
                  <p id="dataAvg" style="display: none">{{$gData['dataAvg']}}</p>
                  <p id="dataTop" style="display: none">{{$gData['dataTop']}}</p>
              @else
                  <h3 style="color: #424a5d;font-weight: bold">Exam Wise Overall Performance (Percentage Scores)</h3>
              @endif

          </section>



@endsection
@section('scripts')

    {{--<script src="http://echarts.baidu.com/build/dist/echarts.js"></script>--}}
    @if(!empty($records))
    <script src="/js/echarts2.min.js"></script>
    <script>
        // configure for module loader
        var dataN = document.getElementById('dataNames').innerHTML;
        dataNames = JSON.parse(dataN);
        var dataMe0 = document.getElementById('dataMe').innerHTML;
        dataMe = JSON.parse(dataMe0);
        var dataAvg0 = document.getElementById('dataAvg').innerHTML;
        dataAvg = JSON.parse(dataAvg0);
        var dataTop0 = document.getElementById('dataTop').innerHTML;
        dataTop = JSON.parse(dataTop0);
        require.config({
            paths: {
                echarts: 'http://echarts.baidu.com/build/dist'
            }
        });

        // use
        require(
            [
                'echarts',
                'echarts/chart/line',
                'echarts/chart/bar' // require the specific chart type
            ],
            function (ec) {
                // Initialize after dom ready
                var myChart = ec.init(document.getElementById('main'),'macarons');

                option = {
                    title : {
                        text: '',
                    },
                    tooltip : {
                        trigger: 'axis'
                    },
                    legend: {
                        x: 'left',
                        data:['You','Topper']
                    },
                    toolbox: {
                        show : true,
                        x: 'right',
                        feature : {
                            mark : {show: false},
                            dataView : {show: false, readOnly: false},
                            magicType : {show: true, type: ['bar', 'line']},
                            restore : {show: true},
                            saveAsImage : {show: true}
                        }
                    },
                    dataZoom : {
                        show : true,
                        realtime: true,
                        start : 0,
                        end : 100
                    },
                    calculable : true,
                    xAxis : [
                        {
                            type : 'category',
                            //             boundaryGap : false,
                            data : dataNames
                        }
                    ],
                    yAxis : [
                        {
                            type : 'value'
                        }
                    ],
                    series : [
                        {
                            name:'You',
                            type:'line',
                            data:dataMe,
                        },
                        {
                            name:'Topper',
                            type:'line',
                            data:dataTop,
                        }
                    ]
                };
                myChart.setOption(option);
                myChart.on('click', function (params) {
                    window.open('http://www.smrtbook.in/solutions/' + encodeURIComponent(params.name));
                });
            }
        );
</script>

    <script>
        require.config({
            paths: {
                echarts: 'http://echarts.baidu.com/build/dist'
            }
        });

var questionType = ['Single_Correct','Multiple_Correct','Integer_Correct'];
@foreach(array_keys($records->totalQ) as $subject)
var dataSeries{{$subject}} = [
    @foreach(array_keys($records->totalQ[$subject]) as $qType)
    {
        name:'{{$infoSet[$qType]}}',
        type:'bar',
        tooltip : {trigger: 'item'},
        stack: 'A',
        data:[{{$records->totalQ[$subject][$qType]}},
            {{$records->totalAttempted[$subject][$qType]}},
            {{$records->totalCorrect[$subject][$qType]}}
        ]
    },
    @endforeach
];

var dataSeries2{{$subject}} = [
        @foreach(array_keys($records->totalQ[$subject]) as $qType)
    {
        name:'{{$infoSet[$qType]}}',
        type:'bar',
        tooltip : {trigger: 'item'},
        stack: 'A',
        data:[{{$records->examMarks[$subject][$qType]}},
            {{$records->totalMarks[$subject][$qType]}},
            {{$records->totalMarks[$subject][$qType]}}
        ]
    },
    @endforeach
];


@endforeach


        function showGraph(sub,sub2){
            require(
                [
                    'echarts',
                    'echarts/chart/pie',
                    // require the specific chart type
                ],
                function (ec) {
                    var myChart1 = ec.init(document.getElementById('main1'),'macarons');
                    option1 = {
                        tooltip : {
                            trigger: 'axis',
                        },
                        toolbox: {
                            show : true,
                            y: 'bottom',
                            feature : {
                                mark : {show: false},
                                dataView : {show: false, readOnly: false},
                                magicType : {show: true, type: ['bar', 'line']},
                                restore : {show: true},
                                saveAsImage : {show: true}
                            }
                        },
                        calculable : true,
                        legend: {
                            data:questionType
                        },
                        xAxis : [
                            {
                                type : 'category',
                                splitLine : {show : false},
                                data : ['Total Question','Attempted','Corrected']
                            }
                        ],
                        yAxis : [
                            {
                                type : 'value',
                                position: 'left'
                            }
                        ],
                        series : sub
                    };

                    myChart1.setOption(option1);
                }
            );

    showGraph2(sub2);

        };


        function showGraph2(sub){
            require(
                [
                    'echarts',
                    'echarts/chart/pie',
                    // require the specific chart type
                ],
                function (ec) {
                    var myChart1 = ec.init(document.getElementById('main2'));
                    option1 = {
                        tooltip : {
                            trigger: 'axis'
                        },
                        toolbox: {
                            show : true,
                            y: 'bottom',
                            feature : {
                                mark : {show: false},
                                dataView : {show: false, readOnly: false},
                                magicType : {show: true, type: ['line', 'bar']},
                                restore : {show: true},
                                saveAsImage : {show: true}
                            }
                        },
                        calculable : true,
                        legend: {
                            data:questionType
                        },
                        xAxis : [
                            {
                                type : 'category',
                                splitLine : {show : false},
                                data : ['Total Marks','Attempted','Scored']
                            }
                        ],
                        yAxis : [
                            {
                                type : 'value',
                                position: 'left'
                            }
                        ],
                        series : sub
                    };

                    myChart1.setOption(option1);
                }
            );

        };
    </script>
    @endif
@endsection
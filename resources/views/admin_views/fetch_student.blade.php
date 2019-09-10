@extends('layouts.frame')

@section('inside')

    <li class="breadcrumb-item active">View Student Information</li>
    </ol>
    <br>
    <div class='row'>
        <div class="col-sm-3">Student Roll No:</div>
        <div class="col-sm-9">{{$roll}}</div>
    </div><hr>
    <div class="container">           <h3 style="color: #424a5d;font-weight: bold">Exam Wise Overall Performance (Percentage Scores)</h3>
        <p><b>Exam Code:</b> Represent the code of Exam</p>

        <p><b>Y-axis:</b> Represent percentage marks obtained.</p>
        <p><b>Note:</b> Hovering any point, will show your marks and topper's marks. </p>
        <!-- page start-->
        {{--<div class="col-lg-1"></div>--}}
        <div class="col-lg-12">
            <div id="main" style="width: 100%;height: 400px;color: #424a5d;"></div>
        </div>


        <div class="col-lg-12" style="margin-top: 24px;">
            <h3 style="color: #424a5d;font-weight: bold">Subject Wise Overall Performance <i style="font-size: 50%">(Click any one below)</i></h3>


            <p><b>Note:</b> Click on any subjects below to have an insight of that subject.</p>


            <div class="container">
                @foreach(array_keys($records->totalQ) as $kk=>$kt)
                    <button class="btnE" onclick="showGraph(dataSeries{{$kt}},dataSeries2{{$kt}})">| {{$infoSet[$kt]}} |</button>
                @endforeach
                <br>
                    <p>Click on colored boxes to see more information</p>
                    <p><b>Graph One:</b> Shows question wise analysis in each subject.</p>
                    <p><b>Graph Two:</b> Shows Exam marks wise analysis in each subject.</p>



            </div>
            <div class="row">
                <div class="col-sm-6" id="main1" style="height: 400px;color: #424a5d;"></div>

                <div class="col-sm-6" id="main2" style="height: 400px;color: #424a5d;"></div>
            </div>


        </div>


    {{--<div class="col-lg-1"></div>--}}
    {{--<div class="tab-pane" style="margin-top: 40px;">--}}


    {{--@foreach($exams as $key=>$result)--}}
    {{--@if($result->ifAttempted)--}}
    {{--<div class="row mt" >--}}
    {{--<h3 style="padding-left: 40px;color: #424a5d;font-weight: bold" class="col-sm-6">{{$result->test_name}}</h3>--}}
    {{--<h3 class="col-sm-6" style="text-align: right;color: #424a5d;font-weight: bold">Exam Date: {{$result->created_at}}</h3>--}}
    {{--<div class="" >--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-3 col-sm-3 box0">--}}
    {{--<div class="box1">--}}
    {{--<h1 style="font-size: 42px;">--}}
    {{--@if(empty($result->examRank)) NULL--}}
    {{--@else {{$result->examRank}}--}}
    {{--@endif--}}
    {{--</h1>--}}
    {{--<h3><i>Rank </i></h3>--}}
    {{--</div>--}}
    {{--<p>--}}
    {{--Total Questions: {{array_sum(explode(",",$result->result->totalQ))}},--}}
    {{--Questions attempted:{{array_sum(explode(",",$result->result->totalQ)) - array_sum(explode(",",$result->result->totalNotAttempted))}}--}}
    {{--</p>--}}
    {{--</div>--}}
    {{--<div class="col-md-3 col-sm-3 box0">--}}
    {{--<div class="box1">--}}
    {{--<h1 style="font-size: 42px">{{substr(array_sum(explode(",",$result->result->totalMarks))*100/array_sum(explode(",",$result->result->examMarks)),0,4)}} %</h1>--}}
    {{--<h3>Percentage</h3>--}}
    {{--</div>--}}
    {{--<p>You have scored <i>{{array_sum(explode(",",$result->result->totalMarks))}}</i>--}}
    {{--Marks out of {{array_sum(explode(",",$result->result->examMarks))}} in this exam. Congratulations </p>--}}
    {{--</div>--}}
    {{--<div class="col-md-3 col-sm-3 box0">--}}
    {{--<div class="box1">--}}

    {{--<h1 style="font-size: 42px">--}}
    {{--@if(empty($result->percentile)) NULL--}}
    {{--@else {{$result->percentile}}--}}
    {{--@endif--}}
    {{--</h1>--}}
    {{--<h3>--}}
    {{--Percentile--}}
    {{--</h3>--}}
    {{--<p>--}}
    {{--@if(empty($result->percentile)) Wait for Results Declarations.--}}
    {{--@else You have achieved {{$result->percentile}} percentile Marks in this test.--}}
    {{--@endif--}}
    {{--</p>--}}
    {{--</div>--}}
    {{--<p></p>--}}
    {{--</div>--}}
    {{--<div class="col-md-3 col-sm-3 box0">--}}
    {{--<div class="box1">--}}
    {{--<h1 style="font-size: 42px">--}}
    {{--@if(empty($result->avg)) NULL--}}
    {{--@else {{$result->avg}}--}}
    {{--@endif--}}
    {{--</h1>--}}
    {{--<h3>Average Score</h3>--}}
    {{--</div>--}}
    {{--<p>This was the average score of this test.</p>--}}
    {{--</div>--}}
    {{--</div><!-- /row mt -->--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--@endif--}}
    {{--@endforeach--}}



    {{--@foreach($public_exams as $key=>$result)--}}
    {{--<div class="row mt" >--}}
    {{--<h3 style="padding-left: 40px;" class="col-sm-6">{{$result->test_name}}</h3>--}}
    {{--<h3 class="col-sm-6" style="text-align: right">Exam Date: {{$result->created_at}}</h3>--}}
    {{--<div class="" >--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-3 col-sm-3 box0">--}}
    {{--<div class="box1">--}}
    {{--<h1 style="font-size: 42px;">--}}
    {{--@if(empty($result->examRank)) NULL--}}
    {{--@else {{$result->examRank}}--}}
    {{--@endif--}}
    {{--</h1>--}}
    {{--<h3><i>Rank - {{$result->examRank}}</i></h3>--}}
    {{--</div>--}}
    {{--<p>--}}
    {{--Total Questions: {{array_sum(explode(",",$result->result->totalQ))}},--}}
    {{--Questions attempted:{{array_sum(explode(",",$result->result->totalQ)) - array_sum(explode(",",$result->result->totalNotAttempted))}}--}}
    {{--</p>--}}
    {{--</div>--}}
    {{--<div class="col-md-3 col-sm-3 box0">--}}
    {{--<div class="box1">--}}
    {{--<h1 style="font-size: 42px">{{substr(array_sum(explode(",",$result->result->totalMarks))*100/array_sum(explode(",",$result->result->examMarks)),0,4)}} %</h1>--}}
    {{--<h3>Percentage</h3>--}}
    {{--</div>--}}
    {{--<p>You have scored <i>{{array_sum(explode(",",$result->result->totalMarks))}}</i>--}}
    {{--Marks out of {{array_sum(explode(",",$result->result->examMarks))}}in this exam. Congratulations </p>--}}
    {{--</div>--}}
    {{--<div class="col-md-3 col-sm-3 box0">--}}
    {{--<div class="box1">--}}
    {{--<h1 style="font-size: 42px">82%</h1>--}}
    {{--<h3>--}}
    {{--Percentile--}}
    {{--</h3>--}}
    {{--<p>You have achieved 82 percentile Marks in this test.</p>--}}
    {{--</div>--}}
    {{--<p></p>--}}
    {{--</div>--}}
    {{--<div class="col-md-3 col-sm-3 box0">--}}
    {{--<div class="box1">--}}
    {{--<h1 style="font-size: 42px">42%</h1>--}}
    {{--<h3>Average Score</h3>--}}
    {{--</div>--}}
    {{--<p>This was the average score of this test.</p>--}}
    {{--</div>--}}
    {{--</div><!-- /row mt -->--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--@endforeach--}}


    {{--</div>--}}
    <!-- page end-->
    </div>
    <p id="dataNames" style="display: none">{{$gData['dataNames']}}</p>
    <p id="dataMe" style="display: none">{{$gData['dataMe']}}</p>
    <p id="dataAvg" style="display: none">{{$gData['dataAvg']}}</p>
    <p id="dataTop" style="display: none">{{$gData['dataTop']}}</p>
@endsection

@section('scripts')
    {{--<script src="http://echarts.baidu.com/build/dist/echarts.js"></script>--}}
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
                // myChart.on('click', function (params) {
                //     window.open('http://www.smrtbook.in/solutions/' + encodeURIComponent(params.name));
                // });
            }
        );
    </script>

    <script>
        require.config({
            paths: {
                echarts: 'http://echarts.baidu.com/build/dist'
            }
        });


        // var single_correct={normal:{color:"#b6a2de",label:{show:!1},labelLine:{show:!1}},emphasis:{color:"#b6a2de"}};
        // var multiple_correct={normal:{color:"#B00020",label:{show:!1},labelLine:{show:!1}},emphasis:{color:"#B00020"}};
        // var int_correct={normal:{color:"#57b2de",label:{show:!1},labelLine:{show:!1}},emphasis:{color:"#57b2de"}};
        // var dataStyle={normal:{label:{show:!1},labelLine:{show:!1}}};
        // var placeHolderStyle={normal:{color:"rgba(0,0,0,0)",label:{show:!1},labelLine:{show:!1}},emphasis:{color:"rgba(0,0,0,0)"}};


                {{--@foreach($piSets as $kty=>$pSets)--}}
                {{--@foreach($pSets as $k=>$piSet)--}}
                {{--{{$kty.$k}}= [--}}
                {{--@foreach($piSet as $kt=>$set)--}}
                {{--{--}}
                {{--value:{{$set['value']}},--}}
                {{--name:'{{$set['name']}}',--}}
                {{--itemStyle:{{$set['itemStyle']}}--}}
                {{--},--}}
                {{--@endforeach--}}
                {{--];--}}
                {{--@endforeach--}}
                {{--@endforeach--}}


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

@endsection


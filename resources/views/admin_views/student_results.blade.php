@extends('layouts.frame')
@section('header')
    {{--<style>--}}
        {{--.flip-card {--}}
            {{--margin: 20px auto;--}}
            {{--margin-top: 50px;--}}
            {{--width: 100%;--}}
            {{--perspective: 10000px;--}}
        {{--}--}}
        {{--.card {--}}
            {{--transition: transform 0.6s;--}}
            {{--transform-style: preserve-3d;--}}
            {{--cursor: pointer;--}}
        {{--}--}}
        {{--.front, .back {--}}
            {{--position: absolute;--}}
            {{--display: flex;--}}
            {{--flex-direction: column;--}}
            {{--justify-content: center;--}}
            {{--align-items: center;--}}
            {{--backface-visibility: hidden;--}}
            {{--width: 100%;height: 100%;--}}
            {{--background: white;--}}
        {{--}--}}
        {{--.back {--}}
            {{--transform: rotateY(180deg);--}}
        {{--}--}}
        {{--label{--}}
            {{--display: inline;--}}
            {{--padding-left: 20px;--}}
            {{--padding-right: 20px;--}}
            {{--font-size: 18px;--}}
            {{--cursor: pointer;--}}
        {{--}--}}

    {{--</style>--}}
@endsection
@section('inside')
    <li class="breadcrumb-item active">View Student Result</li>
    </ol>  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="display: none;"></table>


            <div class="col-sm-8" style="border: 1px solid transparent;margin-top: 40px;">
                <div class="row" style="border: 0.5px solid white;box-shadow: 5px 5px 25px 0 rgba(46,61,73,.2);
                background: white;border-radius: 5px;">
                    <?php
                    $wrong = array_sum(explode(",",$inExam->totalQ)) - array_sum(explode(",",$inExam->totalNotAttempted))-array_sum(explode(",",$inExam->totalCorrect));
                    $correct = array_sum(explode(",",$inExam->totalCorrect));
                    $t = ['Question','Attempted','Right','Wrong','Accuracy','Time(M)'];
                    $tt = [array_sum(explode(",",$inExam->totalQ)),$wrong+$correct,$correct,$wrong,substr($correct/($correct+$wrong+1),0,4),substr((array_sum(explode(",",$inExam->totalTime))/60),0,4)];
                    $clr = [];
                    ?>
                    @for ($i =0;$i<=5;$i++)
                        @if($i == 5) <div style="border-right: 1px solid transparent;" class="col-xs-4 col-sm-2" >
                            @else <div style="border-right: 1px solid lightgray;" class="col-xs-4 col-sm-2" >
                                @endif
                                <div style="padding: 4px;text-align: center;margin: auto">
                                    @if($i == 1) <h3 style="margin-bottom: 1px;margin-top:5px;color: #00c557 ">{{$tt[$i]}}</h3>
                                    @elseif($i == 2) <h3 style="margin-bottom: 1px;margin-top:5px;color: #fa4b4f ">{{$tt[$i]}}</h3>
                                    @else <h3 style="margin-bottom: 1px;margin-top:5px;">{{$tt[$i]}}</h3>
                                    @endif
                                    <p style="font-size: 120%">{{ $t[$i]}}</p>
                                </div>
                            </div>
                            @endfor
                        </div>
                        <br>
                </div>
 

                            <div class="card mb-3">

                                <div class="card-header">
                                    <i class="fa fa-table"></i> Student Result <b style="width: 50%; margin: 0 auto; text-align: left"></b> </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                            <tr>
                                                <th>Marks For</th>
                                                <th>Total</th>
                                                
                                                <th>Attempted</th>
                                                <th>Accuracy</th>
                                                <th>Score</th>



                                            </tr>
                                            </thead>
                                            {{--<tfoot>--}}
                                            {{--<tr>--}}
                                                {{--<th>Marks For</th>--}}
                                                {{--<th>Total</th>--}}

                                                {{--<th>Attempted</th>--}}
                                                {{--<th>Accuracy</th>--}}
                                                {{--<th>Score</th>--}}
                                            {{--</tr>--}}
                                            {{--</tfoot>--}}
                                            <tbody>
                                            @foreach($subjects as $key=>$sub)
                                                <tr>
                                                    <td>{{$sub}}</td>
                                                    {{--<td>{{$ss[substr($sub,0,1)][0]}}</td>--}}
                                                    <td>{{array_sum($records->examMarks[substr($sub,0,1)])}}</td>
                                                    <td>{{array_sum($records->totalMarks[substr($sub,0,1)])}}</td>
                                                    <td>{{array_sum($records->totalCorrect[substr($sub,0,1)])/(array_sum($records->totalAttempted[substr($sub,0,1)])+1) }}</td>
                                                    <td>{{array_sum($records->totalMarks[substr($sub,0,1)])}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{--<div class="card-footer small text-muted"><solid style='color: red'>!! Any item cannot be updated if test running or after the is over.!!</solid></div>--}}
                                </div>



                            </div>


                            <div class="card mb-3">

                                <div class="card-header">
                                    <i class="fa fa-table"></i> Student Result <b style="width: 50%; margin: 0 auto; text-align: left"></b> </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                            <tr>
                                                <th>Time for</th>
                                                <th>Correct Attempt</th>
                                                <th>Wrong Attempt</th>
                                                <th>Total</th>
                                                <th>Score</th>


                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <th>Time for</th>
                                                <th>Correct Attempt</th>
                                                <th>Wrong Attempt</th>
                                                <th>Total</th>
                                                <th>Score</th>
                                            </tr>
                                            </tfoot>
                                            <tbody>
                                            @foreach($subjects as $key=>$sub)


                                                    <tr>
                                                        <td>{{$sub}}</td>
                                                        <td>{{$ssTime[substr($sub,0,1)][0]}}</td>
                                                        <td>{{$ssTime[substr($sub,0,1)][1]}}</td>
                                                        <td>{{$ssTime[substr($sub,0,1)][2]}}</td>
                                                        <td>{{$subjectObs['marks'][substr($sub,0,1)]}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{--<div class="card-footer small text-muted"><solid style='color: red'>!! Any item cannot be updated if test running or after the is over.!!</solid></div>--}}
                                </div>



                            </div>
















        {{--<div>--}}
        {{--Marks Scale: <br>--}}
        {{--Marks; 45 |--}}
        {{--Avg. Marks : 30 | Topper Marks: 90--}}
        {{--</div>--}}








        {{--<h5>Above Y->0 shows correct attempt.</h5> <h5>(Negative values show wrong attempt)</h5>--}}
        {{--<h5>Click on any point to see that question and Correct answer.</h5>--}}

    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-area-chart"></i>Question Response Time Graph</div>
        <div class="card-body khh">
            <div class="kd" id="main" style="height: 400px;"></div>
        </div>
        <div class="card-footer small text-muted">Updated</div>
    </div>

                <div class="card mb-3">

                    <div class="card-header">
                        <i class="fa fa-table"></i> Student Result <b style="width: 50%; margin: 0 auto; text-align: left"></b> </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Total Question</th>
                                    <th>Questions Attempted</th>
                                    <th>Correct Attempts</th>
                                    <th>Section Marks</th>
                                    <th>Marks Scored</th>
                                    <th>Time Spent(sec)</th>
                                </tr>
                                </thead>
                                {{--<tfoot>--}}
                                {{--<tr>--}}
                                    {{--<th>#</th>--}}
                                    {{--<th>Total Question</th>--}}
                                    {{--<th>Questions Attempted</th>--}}
                                    {{--<th>Correct Attempts</th>--}}
                                    {{--<th>Section Marks</th>--}}
                                    {{--<th>Marks Scored</th>--}}
                                    {{--<th>Time Spent(sec)</th>--}}
                                {{--</tr>--}}
                                {{--</tfoot>--}}
                                <tbody>
                                <?php
                                $tt = explode(",",$inExam->totalQ);
                                ?>
                                @foreach($tt as $key=>$totalQ)
                                    <tr>

                                        <td>{{$key+1}}</td>
                                        <td>{{explode(",",$inExam->totalQ)[$key]}}</td>
                                        <td>{{explode(",",$inExam->totalQ)[$key] - explode(",",$inExam->totalNotAttempted)[$key]}}</td>
                                        <td>{{explode(",",$inExam->totalCorrect)[$key]}}</td>
                                        <td>{{explode(",",$inExam->examMarks)[$key]}}</td>
                                        <td>{{explode(",",$inExam->totalMarks)[$key]}}</td>
                                        <td>{{explode(",",$inExam->totalTime)[$key]}}</td>
                                    </tr>
                                @endforeach
                                <th>Total</th>
                                <th>{{array_sum(explode(",",$inExam->totalQ))}}</th>
                                <th>{{array_sum(explode(",",$inExam->totalQ)) - array_sum(explode(",",$inExam->totalNotAttempted))}}</th>
                                <th>{{array_sum(explode(",",$inExam->totalCorrect))}}</th>
                                <th>{{array_sum(explode(",",$inExam->examMarks))}}</th>
                                <th>{{array_sum(explode(",",$inExam->totalMarks))}}</th>
                                <th>{{array_sum(explode(",",$inExam->totalTime))}}</th>
                                </tbody>
                            </table>
                        </div>
                        {{--<div class="card-footer small text-muted"><solid style='color: red'>!! Any item cannot be updated if test running or after the is over.!!</solid></div>--}}
                    </div>



                </div>



            </div>


    <p id="times" style="display: none;">{{$gData[0]['times']}}</p>
    <p id="keys" style="display: none;">{{$gData[0]['keys']}}</p>

    <p id="times1" style="display: none;">{{$gData[1]['times']}}</p>
    <p id="keys1" style="display: none;">{{$gData[1]['keys']}}</p>
    <p id="pieTimes" style="display: none;">{{$inExam->totalMarks}}</p>


    <p id="subs" style="display: none"> {{json_encode($subjects)}}</p>
    <p id="subsTime" style="display: none"></p>

    {{--<p id="dataNames" style="display: none">{{$gData['dataNames']}}</p>--}}
    {{--<p id="dataMe" style="display: none">{{$gData['dataMe']}}</p>--}}
    {{--<p id="dataAvg" style="display: none">{{$gData['dataAvg']}}</p>0--}}
    {{--<p id="dataTop" style="display: none">{{$gData['dataTop']}}</p>--}}

@endsection
@section('scripts')

    <script>
        //card flips
        function flip(x){
            var element = document.getElementsByClassName('card')[x];
            // var element = event.currentTarget;
            // if (element.className === "card") {
            if(element.style.transform == "rotateY(180deg)") {
                element.style.transform = "rotateY(0deg)";
            }
            else {
                element.style.transform = "rotateY(180deg)";
            }
            // }
        };
    </script>
    {{--<script src="/js/echarts.min.js"></script>--}}
    <script src="/js/echarts2.min.js"></script>


    <script>
        // var dataNames = [''];
        // var dd = {P:"Physics",C:"Chemistry", M:'Maths'};

        {{--@foreach($sub as $sect)--}}
        {{--dataNames.push(dd[$sect[0]]);--}}
        {{--@@endforeach--}}
        // dataNames[] = dd[];
                {{--var dataNames = [{{$sub}}];--}}


        var t = document.getElementById('subs').innerHTML;
        var dataNames = JSON.parse(t);
        // console.log(dataNames);
        // var dataNames = ['Physics','Chemistry','Maths'];
        // var dataSets = [[22,11,10],[10,11,12],[11,22,11]];
        var dataSets = [];
                @foreach( $ss as $key=>$s)
        var ele = [{{$s[0]}},{{$s[1]}},{{$s[2]}}];
        dataSets.push(ele);
        @endforeach
        // console.log(dataSets);
        var dataSet =dataSets[0];
        var dataName = dataNames[0]
        require.config({
            paths: {
                echarts: 'http://echarts.baidu.com/build/dist'
            }
        });
        generate();
        // onclick="segmentChange(P)"
        function segmentChange(subject){
            dataName = dataNames[subject];
            dataSet = dataSets[subject];
            // alert();
            generate();
        };
        // use
        function generate(){
            require(
                [
                    'echarts',
                    'echarts/chart/line',
                    'echarts/chart/bar' // require the specific chart type
                ],
                function (ec) {
                    // Initialize after dom ready
                    var myChart2P = ec.init(document.getElementById('question-wiseP'),'macarons');
                    // var myChart2C = ec.init(document.getElementById('question-wiseC'));
                    // var myChart2M = ec.init(document.getElementById('question-wiseM'));

                    option = {
                        title: {
                            x: 'center',
                            text:dataName

                        },
                        tooltip: {
                            trigger: 'item'
                        },
                        toolbox: {
                            show: true,
                            feature: {
                                dataView: {show: false, readOnly: false},
                                restore: {show: true},
                                saveAsImage: {show: true}
                            }
                        },
                        calculable: true,
                        grid: {
                            borderWidth: 0,
                            y: 80,
                            y2: 60
                        },
                        xAxis: [
                            {
                                type: 'category',
                                show: false,
                                data: ['Total Question', 'Correct', 'Wrong']
                            }
                        ],
                        yAxis: [
                            {
                                type: 'value',
                                show: false
                            }
                        ],
                        series: [
                            {
                                name: dataName,
                                type: 'bar',
                                itemStyle: {
                                    normal: {
                                        color: function(params) {
                                            // build a color map as your need.
                                            var colorList = [
                                                '#9aaeb3','#1dce68','#fc6360'
                                            ];
                                            return colorList[params.dataIndex]
                                        },
                                        label: {
                                            show: true,
                                            position: 'top',
                                            formatter: '{b}\n{c}'
                                        }
                                    }
                                },
                                data: dataSet,
                                markPoint: {
                                    tooltip: {
                                        trigger: 'item',
                                        backgroundColor: 'rgba(0,0,0,0)'
                                    },
                                    data: [
                                    ]
                                }
                            }
                        ]
                    };

                    myChart2P.setOption(option);
                    // myChart2C.setOption(option);
                    // myChart2M.setOption(option);
                }
            );
        };
    </script>






    <script>

        // var dNames = ['Physics','Chemistry','Maths'];
        // var ttime = document.getElementById('subsTime').innerHTML;
        // var dataNames = JSON.parse(ttime);
        // console.log(ttime);
        var dSets = [];
        {{--@foreach( $ss as $key=>$s)--}}
        {{--var ele = [{{$s[0]}},{{$s[1]}},{{$s[2]}}];--}}
        {{--dSets.push(ele);--}}
        @foreach($subjects as $key=>$sub)
        dSets.push({{$subjectObs['time'][substr($sub,0,1)]}})
        @endforeach
        // var dSets = JSON.parse(ttime);

        require.config({
            paths: {
                echarts: 'http://echarts.baidu.com/build/dist'
            }
        });
        require(
            [
                'echarts',
                'echarts/chart/bar' // require the specific chart type
            ],
            function (ec) {
                // Initialize after dom ready
                var myChart2T = ec.init(document.getElementById('time-wiseP'),'macarons');
                // var myChart2C = ec.init(document.getElementById('question-wiseC'));
                // var myChart2M = ec.init(document.getElementById('question-wiseM'));

                option1 = {
                    title: {
                        x: 'center',
                        text:'Time Graph'

                    },
                    tooltip: {
                        trigger: 'item'
                    },
                    toolbox: {
                        show: true,
                        feature: {
                            dataView: {show: false, readOnly: false},
                            restore: {show: true},
                            saveAsImage: {show: true}
                        }
                    },
                    calculable: true,
                    grid: {
                        borderWidth: 0,
                        y: 80,
                        y2: 60
                    },
                    xAxis: [
                        {
                            type: 'category',
                            show: true,
                            data: dataNames
                        }
                    ],
                    yAxis: [
                        {
                            type: 'value',
                            show: false
                        }
                    ],
                    series: [
                        {
                            name: 'Time Taken',
                            type: 'bar',
                            itemStyle: {
                                normal: {
                                    color: function(params) {
                                        // build a color map as your need.
                                        var colorList = [
                                            '#6f30ca','#ff4a80','#37b6c4'
                                        ];
                                        return colorList[params.dataIndex]
                                    },
                                    label: {
                                        show: true,
                                        position: 'top',
                                        formatter: '{c}'
                                    }
                                }
                            },
                            data: dSets,
                            markPoint: {
                                tooltip: {
                                    trigger: 'item',
                                    backgroundColor: 'rgba(0,0,0,0)'
                                },
                                data: [
                                ]
                            }
                        }
                    ]
                };

                myChart2T.setOption(option1);
                // myChart2C.setOption(option);
                // myChart2M.setOption(option);
            }
        );
    </script>






    <script>

        data = document.getElementById('times').innerHTML;
        dataT = data.split(",");
        data1 = document.getElementById('times1').innerHTML;
        dataT1 = data1.split(",");

        dataKeys = document.getElementById('keys').innerHTML;
        dataKeys = dataKeys.split(",");

        require.config({
            paths: {
                echarts: 'http://echarts.baidu.com/build/dist'
            }
        });
        require(
            [
                'echarts',
                'echarts/chart/line',
                'echarts/chart/bar' // require the specific chart type
            ],
            function (ec) {
                // Initialize after dom ready
                var myChart = ec.init(document.getElementById('main'),'macarons');
                // var myChart2C = ec.init(document.getElementById('question-wiseC'));
                // var myChart2M = ec.init(document.getElementById('question-wiseM'));

                optionL = {
                    title: {

                    },
                    tooltip: {
                        trigger: "item",
                        formatter: "{a} <br/>{b} : {c}"
                    },
                    legend: {
                        x: 'left',
                        data: ['Your Time','Topper Time']
                    },

                    xAxis: [
                        {
                            type: "category",
                            name: "x",
                            splitLine: {show: false},
                            data: dataKeys
                        }
                    ],
                    yAxis: [
                        {
                            type: "value",
                            name: "y"
                        }
                    ],
                    toolbox: {
                        show: true,
                        feature: {
                            mark: {
                                show: false
                            },
                            magicType : {show: true, type: ['line', 'bar']},
                            dataView: {
                                show: false,
                                readOnly: true
                            },
                            restore: {
                                show: true
                            },
                            saveAsImage: {
                                show: true
                            }
                        }
                    },
                    dataZoom : {
                        show : true,
                        realtime: true,
                        start : 0,
                        end : 100
                    },
                    calculable: true,
                    series: [
                        {
                            name: "Your Time",
                            type: "line",
                            data: dataT

                        },
                        {
                            name: "Topper Time",
                            type: "line",
                            data: dataT1
                        }
                    ]
                };
                myChart.setOption(optionL);
            }
        );
        // myChart.on('click', function (params) {
        //     console.log(params);
        //     window.open('/student/stud/' + encodeURIComponent(params.name));
        // });
    </script>
@endsection





@extends('events.dash')
@section('sidebar')
    <style>
        .flip-card {
            margin: 20px auto;
            margin-top: 50px;
            width: 100%;
            perspective: 10000px;
        }
        .card {
            transition: transform 0.6s;
            transform-style: preserve-3d;
            cursor: pointer;
        }
        .front, .back {
            position: absolute;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            backface-visibility: hidden;
            width: 100%;height: 100%;
            background: white;
        }
        .back {
            transform: rotateY(180deg);
        }
        label{
            display: inline;
            padding-left: 20px;
            padding-right: 20px;
            font-size: 18px;
            cursor: pointer;
        }

    </style>
    <li class="mt">
        <a href="/student/dashboard">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="sub-menu">
        <a href="/student/performance" class="">
            <i class="fas fa-chart-pie"></i>
            <span>Performance Record</span>
        </a>
    </li>
    <li class="sub-menu">
        <a href="/student/records" class="active" >
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
        <div class="border-head" style="">
            <h3 style="text-align: center;color:#4c5f99;margin-bottom:0"> {{$inExam->examName}}</h3>
            <p style="text-align: center;color:#4c5f99;">{{$inExam->examDate}}</p>
        </div>

        <div class="row">
            <div class="col-sm-4" style="text-align: center">
                <h1 style="display: inline;">{{$inExam->totalM}}</h1> <h4 style="display: inline">Marks / {{array_sum(explode(",",$inExam->examMarks))}} ({{intdiv($inExam->totalM*100,array_sum(explode(",",$inExam->examMarks)))}}%)</h4>
            </div>

            <div class="col-sm-4" style="text-align: center">
               <h1 style="display: inline;">{{$data->percentile}}</h1> <h4 style="display: inline">Percentile</h4>
            </div>

            <div class="col-sm-4" style="text-align: center">
                <h4 style="display: inline">Overall Rank: <h1 style="display:inline;">{{$data->examRank}} </h1> / {{$data->all_responses}}</h4>
             </div>

        </div>




        {{--<br>--}}
        {{--<p style="text-align: center"><b>Note:</b> Analysis based on all students attempted this exam till now </p>--}}


        <div class="col-lg-12">
            <div id="main_overall" style="width: 100%;height: 400px;color: #424a5d;"></div>
        </div>
        <p style="float: left"><b>X-Axis:</b> Represents Percentage Marks Scored</p>
        <p style="float: right;"><b>Y-axis:</b> Represents Percentage of students scoring that much marks</p>
    </section>






    <section class="wrapper site-min-height" style="background: white;color: #231C69;">

        <div class="row" style="border: 1px solid transparent;">
            <div class="col-sm-2" style="border: 1px solid transparent;">
                #marks bealer
            </div>
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
                                    @if($i == 2) <h3 style="margin-bottom: 1px;margin-top:5px;color: #00c557 ">{{$tt[$i]}}</h3>
                                    @elseif($i == 3) <h3 style="margin-bottom: 1px;margin-top:5px;color: #fa4b4f ">{{$tt[$i]}}</h3>
                                    @else <h3 style="margin-bottom: 1px;margin-top:5px;">{{$tt[$i]}}</h3>
                                    @endif
                                    <p style="font-size: 120%">{{ $t[$i]}}</p>
                                </div>
                    </div>
                    @endfor
            </div>
                <div class="flip-card">
                    <div class="card" >
                        <div class="front" style="overflow: auto">
                            <p style="width: 100%;text-align: center;">
                                @foreach($subjects as $key=>$s)
                                    <label onclick="segmentChange({{$key}})">| {{$s}}|</label>
                                @endforeach
                                 {{--<label onclick="segmentChange(1)">| Chemistry |</label>--}}
                                {{--<label onclick="segmentChange(2)">| Maths |</label>--}}
                            </p>
                            <div id="question-wiseP" style="width: 80%;height: 100%;"></div>
                            <div style="width: 10%;height: 10%;position: absolute;right: 2px;top: 2px;"
                                 onclick="flip(0)">
                                <img src="https://png.icons8.com/nolan/50/000000/3d-rotate.png" style="width: 30px;margin-left:10px;margin-top: -4px;">
                            </div>
                        </div>
                        <div class="back" style="border: 1px solid transparent;height: 100%;">
                            <div style="width: 10%;height: 10%;position: absolute;right: 2px;
                                top: 2px;border: 2px solid transparent;" onclick="flip(0)">
                                <img alt="Flip" title="Flip" src="https://png.icons8.com/nolan/50/000000/3d-rotate.png" style="width: 30px;margin-left:10px;margin-top: -4px;">
                            </div>
                            <div class="table-responsive" style="width: 100%;">
                                <table class="table"><thead ><style>.info th{background:#fc6360 !important;color:white }</style>
                                    <tr class="info"><th>Marks for</th><th>Total</th><th>Attempted</th><th>Accuracy</th><th>Score</th></tr></thead>
                                    <tbody>
                                    @foreach($subjects as $key=>$sub)
                                    <tr>
                                        <td>{{$sub}}</td>
                                        {{--<td>{{$ss[substr($sub,0,1)][0]}}</td>--}}
                                        <td>{{array_sum($records->examMarks[substr($sub,0,1)])}}</td>
                                        <td>{{array_sum($records->totalMarks[substr($sub,0,1)])}}</td>
                                        <td>{{array_sum($records->totalCorrect[substr($sub,0,1)])*100/ 1+array_sum($records->totalAttempted[substr($sub,0,1)]) }}</td>
                                        <td>{{array_sum($records->totalMarks[substr($sub,0,1)])}}</td>
                                    </tr>
                                    @endforeach

                                    {{--<tr><td>Chemisrty</td><td>444</td><td>45</td><td>11</td><td>20</td></tr><tr><td>Maths</td><td>444</td><td>45</td><td>11</td><td>20</td></tr>--}}
                                    </tbody></table></div>
                        </div>
                    </div>
                </div>
                <div class="flip-card" style="margin-top: 20px;">
                    <div class="card" >
                        <div class="front" style="overflow: auto">

                            <div id="time-wiseP" style="width: 80%;height: 100%;"></div>
                            {{--<p> THis is the  formnt</p>--}}
                            {{--<h3>This is bsome bacl s[[ds for jte frms t</h3>--}}
                            <div style="width: 10%;height: 10%;position: absolute;right: 2px;top: 2px;"
                                 onclick="flip(1)">
                                <img src="https://png.icons8.com/nolan/50/000000/3d-rotate.png" style="width: 30px;margin-left:10px;margin-top: -4px;">
                            </div>
                        </div>
                        <div class="back" style="border: 1px solid transparent;height: 100%;">
                            <div style="width: 10%;height: 10%;position: absolute;right: 2px;
                        top: 2px;border: 2px solid transparent;" onclick="flip(1)">
                                <img alt="Flip" title="Flip" src="https://png.icons8.com/nolan/50/000000/3d-rotate.png" style="width: 30px;margin-left:10px;margin-top: -4px;">
                            </div>
                            <div class="table-responsive" style="width: 100%;">
                                <table class="table">
                                    <thead>
                                    <tr class="info">
                                        <th>Time for</th>
                                        <th>Correct Attempt</th>
                                        <th>Wrong Attempt</th>
                                        <th>Total</th>
                                        <th>Score</th>
                                    </tr>
                                    </thead>
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
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-sm-2" style="border: 1px solid transparent;">
                #rank ladder
            </div>
        </div>




        {{--<div>--}}
            {{--Marks Scale: <br>--}}
            {{--Marks; 45 |--}}
            {{--Avg. Marks : 30 | Topper Marks: 90--}}
        {{--</div>--}}








            {{--<h5>Above Y->0 shows correct attempt.</h5> <h5>(Negative values show wrong attempt)</h5>--}}
            {{--<h5>Click on any point to see that question and Correct answer.</h5>--}}
        <div class="row mt">
            <div class="col-lg-12">
                <! -- Blog Panel -->
                <h4 style="width: 100%;color: #B00020;text-align: center">
                    Questions Response Time Graph
                </h4>
                <div id="main" style="width: 100%;height:400px;"></div>

            </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr class="info">
                    <th>Section</th>
                    <th>Total Question</th>
                    <th>Questions Attempted</th>
                    <th>Correct Attempts</th>
                    <th>Section Marks</th>
                    <th>Marks Scored</th>
                    <th>Time Spent(sec)</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $tt = explode(",",$inExam->totalQ);
                ?>
                @foreach($tt as $key=>$totalQ)
                    <tr>
                        {{--explode(",",$inExam->sections)[$key]--}}
                        {{--<td>{{$key+1}}</td>--}}
                        <td> {{$subT[substr(explode(",",$inExam->sections)[$key],0,1)]}} {{$subT[substr(explode(",",$inExam->sections)[$key],1,1)]}}</td>
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

        <div class="border-head" style="text-align: center">

            <h3 style="text-align: center;color:#4c5f99;margin-bottom:0">
                <a href="/solutions_v2/{{$data->examId}}">
                    Get Question wise Exam Analytics
                <i class="fa fa-angle-double-right" style="font-size: 150%;vertical-align: middle;color: #fc6360;"></i>
                </a>
            </h3>

            {{--<p style="text-align: center;color:#4c5f99;">{{$inExam->examDate}}</p>--}}
        </div>


    </section>
    <p id="times" style="display: none;">{{$gData[0]['times']}}</p>
    <p id="keys" style="display: none;">{{$gData[0]['keys']}}</p>

    <p id="times1" style="display: none;">{{$gData[1]['times']}}</p>
    <p id="keys1" style="display: none;">{{$gData[1]['keys']}}</p>
    <p id="pieTimes" style="display: none;">{{$inExam->totalMarks}}</p>


    <p id="subs" style="display: none"> {{json_encode($subjects)}}</p>
    <p id="subsTime" style="display: none"></p>

    {{--<p id="dataNames" style="display: none">{{$gData['dataNames']}}</p>--}}
    {{--<p id="dataMe" style="display: none">{{$gData['dataMe']}}</p>--}}
    <p id="dataOne" style="display: none">{{$gData_one}}</p>0
    <p id="dataTwo" style="display: none">{{$gData_latest}}</p>

@endsection
@section('scripts')

    <script src="/js/echarts2.min.js"></script>
    {{--<script src="/js/echarts2.min.js"></script>--}}
    <script>
        // configure for module loader
        var dataOne= document.getElementById('dataOne').innerHTML;
        dataOne = JSON.parse(dataOne);
        var dataTwo = document.getElementById('dataTwo').innerHTML;
        dataTwo = JSON.parse(dataTwo);
        // var dataAvg0 = document.getElementById('dataAvg').innerHTML;
        // dataAvg = JSON.parse(dataAvg0);
        // var dataTop0 = document.getElementById('dataTop').innerHTML;
        // dataTop = JSON.parse(dataTop0);
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
                var myChart_overall = ec.init(document.getElementById('main_overall'),'macarons');

                option = {
                    title : {
                        text: 'Overall Students Performance'
                    },
                    tooltip : {
                        trigger: 'axis'
                    },
                    legend: {
                        data:['Percentage Students']
                    },
                    toolbox: {
                        show : true,
                        feature : {
                            magicType : {show: true, type: ['line', 'bar']},
                            restore : {show: true},
                            saveAsImage : {show: true}
                        }
                    },
                    calculable : true,
                    xAxis : [
                        {
                            type : 'category',
                            boundaryGap : false,
                            data : dataOne,
                            name: 'Percentage Marks',
                            nameLocation: 'end',
                            nameGap: 500
                        }
                    ],
                    yAxis : [
                        {
                            type : 'value',
                            name: 'Percentage Students',
                        }
                    ],
                    series : [
                        {
                            name:'Percentage Students',
                            type:'line',
                            smooth:true,
                            itemStyle: {normal: {areaStyle: {type: 'default'}}},
                            data:dataTwo
                        }
                    ]
                };
                myChart_overall.setOption(option);
            }
        );
    </script>



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
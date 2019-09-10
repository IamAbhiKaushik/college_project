@extends('layouts.frame')
@section('header')
<style>
    .nn {
        font-weight: bold;
        box-shadow: 0px 0px 10px #d1d1d1;
        font-size: 15px;
        padding: 30px;

    }
    .nn:hover{
        box-shadow: 0px 0px 20px #b2aeae
    }
    .kd {
        overflow-x:scroll !important;
        width: 1024px;
    }

    .khh {
        overflow-x:scroll !important;
    }
</style>
@endsection
@section('inside')
    <li class="breadcrumb-item active">Result</li>
    </ol>


    <div class="card mb-3"><br>
        <div class="card-header">
            <i class="fa fa-table"></i> {{$exam->test_name}} <b style="width: 50%; margin: 0 auto; text-align: left"></b> </div>
        <div class="card-body">
        <div class="row" style="margin-left:0px;margin-right: 5px">

        <div class="col-sm-3 text-center nn">Maximum Marks<br>{{$test_details[0]}}</div>
        <div class="col-sm-3 text-center nn">Topper's Marks<br>{{$test_details[1]}}</div>
        <div class="col-sm-3 text-center nn">Lowest Marks<br>{{$test_details[2]}}</div>
        <div class="col-sm-3 text-center nn">Average Marks<br> {{$test_details[3]}}</div>
        
        </div></div></div>
    <div class="card mb-3">

        <div class="card-header">
            <i class="fa fa-table"></i> Student Result <b style="width: 50%; margin: 0 auto; text-align: left"></b> </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Roll No</th>
                        <th>Batch</th>
                        <th>Total Attempted</th>
                        <th>Total Correct</th>
                        <th>Total Marks</th>
                        <th>Student Rank</th>


                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Roll No</th>
                        <th>Batch</th>
                        <th>Total Attempted</th>
                        <th>Total Correct</th>
                        <th>Total Marks</th>
                        <th>Student Rank</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($response as $result)
                        <tr>


                            <td><a href="/admin_views/student_results/{{$result->id}}">{{ json_decode($result->result)->name}}</a></td>
                            <td>{{ json_decode($result->result)->roll_no}}</td>
                            <td>{{ json_decode($result->result)->batch}}</td>
                            <td>{{ array_sum(explode(",",json_decode($result->result)->totalQ))-array_sum(explode(",",json_decode($result->result)->totalNotAttempted)) }}</td>
                            <td>{{ array_sum(explode(",",json_decode($result->result)->totalCorrect)) }}</td>
                            <td>{{ array_sum(explode(",",json_decode($result->result)->totalM)) }}</td>
                            {{--<td>{{ json_decode($result->result)->totalCorrect}}</td>--}}
                            {{--<td>{{ json_decode($result->result)->totalMarks }}</td>--}}
                            <td>{{ $result->examRank}}</td>

                            {{--                            <td>{{ json_decode($result->$result)->totalAttempt}}</td>--}}
                            {{--                            <td>{{json_decode($result->$result)->totalCorrect}}</td>--}}

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{--<div class="card-footer small text-muted"><solid style='color: red'>!! Any item cannot be updated if test running or after the is over.!!</solid></div>--}}
        </div>



    </div>


    <div id="student" style="display: none">{{$srr}}</div>
    <div id="marks" style="display: none">{{$arr}}</div>
    <div id="avg" style="display: none">{{$avg}}</div>
    <div id="qno" style="display: none">{{$qno}}</div>
    <div id="total_correct" style="display: none">{{$question_details[0]}}</div>
    <div id="total_attempt" style="display: none">{{$question_details[2]}}</div>
    <div id="total_not_attempted" style="display: none">{{$question_details[3]}}</div>
    <div id="total_incorrect" style="display: none">{{$question_details[1]}}</div>

    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-area-chart"></i>Trend in total marks Rank wise</div>
        <div class="card-body khh">
            <div class="kd" id="myAreaChart-main-1" style="height: 400px;"></div>
        </div>
        <div class="card-footer small text-muted">Updated</div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-area-chart"></i>Average time per question</div>
        <div class="card-body khh">
            <div class="kd" id="myAreaChart-main-2" style="height: 400px;"></div>
        </div>
        <div class="card-footer small text-muted">Updated</div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-area-chart"></i>Total Correct / Incorrect Question</div>
        <div class="card-body khh">
            <div class="kd" id="myAreaChart-main-3" style="height: 400px;"></div>
        </div>
        <div class="card-footer small text-muted">Updated</div>
    </div>

    <button onclick="location.href = '/admin_views/download_result/{{$exam_code}}';" type="button" class="btn btn-primary">Download Result</button>


    <hr>
   @section('scripts')
       <script src="/js/echarts2.min.js"></script>
       <script>
           var tc = String($("#total_correct").text()).split(',');
           var tna = String($("#total_not_attempted").text()).split(',');
           var ta = String($("#total_attempt").text()).split(',');
           var tic = String($("#total_incorrect").text()).split(',');
           var qno = String($("#qno").text()).split(',');

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
               var myChart_123 = ec.init(document.getElementById('myAreaChart-main-3'), 'sakura');

               option = {
                   title : {
                       text: 'Question Statiscs',
                      // subtext: '纯属虚构'
                   },
                   tooltip : {
                       trigger: 'axis'
                   },
                    legend: {
                        data:['Total Correct','Total Not Attempted','Total Attempted','Total Incorrect']
                   },
                   toolbox: {
                       show : true,
                       feature : {
                           mark : {show: true},
                           dataView : {show: true, readOnly: false},
                           magicType : {show: true, type: ['line', 'bar']},
                           restore : {show: true},
                           saveAsImage : {show: true}
                       }
                   },
                   calculable : true,
                   xAxis : [
                       {
                           name: '',
                           type : 'category',
                           boundaryGap : false,
                           data : qno,
                       }
                   ],
                   yAxis : [
                       {
                           name:'Number of Students',
                           type : 'value',
                           axisLabel : {
                               formatter: '{value} '
                           }
                       }
                   ],
                   series : [
                       {
                           name: 'Total Correct',
                           type: 'line',
                           data: tc,
                           // markPoint : {
                           //     data : [
                           //         {type : 'max', name: '最大值'},
                           //         {type : 'min', name: '最小值'}
                           //     ]
                           //},
                           //     markLine : {
                           //         data : [
                           //             {type : 'average', name: '平均值'}
                           //         ]
                           //     }
                           // },
                       },
                       {
                           name: 'Total Not Attempted',
                           type: 'line',
                           data: tna,
                           // markPoint : {
                           //     data : [
                           //         {type : 'max', name: '最大值'},
                           //         {type : 'min', name: '最小值'}
                           //     ]
                           //},
                           //     markLine : {
                           //         data : [
                           //             {type : 'average', name: '平均值'}
                           //         ]
                           //     }
                           // },
                       },
                       {
                           name: 'Total Attempted',
                           type: 'line',
                           data: ta,
                           // markPoint : {
                           //     data : [
                           //         {type : 'max', name: '最大值'} ,
                           //         {type : 'min', name: '最小值'}
                           //     ]
                           //},
                           //     markLine : {
                           //         data : [
                           //             {type : 'average', name: '平均值'}
                           //         ]
                           //     }
                           // },
                       },{
                           name: 'Total Incorrect',
                           type: 'line',
                           data: tic,
                           // markPoint : {
                           //     data : [
                           //         {type : 'max', name: '最大值'},
                           //         {type : 'min', name: '最小值'}
                           //     ]
                           //},
                           //     markLine : {
                           //         data : [
                           //             {type : 'average', name: '平均值'}
                           //         ]
                           //     }
                           // },
                       },
                   ]
               };
               myChart_123.setOption(option);
           }

           );
       </script>
   @endsection

@endsection
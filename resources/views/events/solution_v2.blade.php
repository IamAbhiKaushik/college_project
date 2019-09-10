@extends('events.dash')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style type="text/css">
    #page-loader,#pdf-loader{height:100px;line-height:100px;display:none;color:#999}#page-loader,#pdf-loader{font-size:13px;text-align:center}#pdf-main-container{margin:20px auto;text-align:center}#pdf-contents{display:none;width:100%;overflow-y:scroll;padding-bottom:20px}#pdf-meta{overflow:hidden;margin:0 0 20px}#pdf-current-page,#pdf-total-pages{display:inline}#pdf-canvas{border:1px solid rgba(0,0,0,.2);box-sizing:border-box}#download-image{color: white;}
    #page-loader2,#pdf-loader2{height:100px;line-height:100px;display:none;color:#999}#page-loader2,#pdf-loader2{font-size:13px;text-align:center}#pdf-main-container2{margin:20px auto;text-align:center}
    #pdf-contents2{display:none;width:100%;overflow-y:scroll;padding-bottom:20px}
    #pdf-canvas2{border:1px solid rgba(0,0,0,.2);box-sizing:border-box}
    #page-count-container{font-size:100%}
    @media (min-width: 768px) {
        #page-count-container{font-size:180%}
    }
    /*#answer{display: none;}*/
    #pdf-prev{
        background: white;
        border: 1px solid #4c5f99;
        color: #4c5f99;
    }

    #pdf-prev:hover{
        background: #4c5f99;
        border: 1px solid #4c5f99;
        color: white;
    }

    #pdf-next{
        background: white;
        border: 1px solid #4c5f99;
        color: #4c5f99;
    }

    #pdf-next:hover{
        background: #4c5f99;
        border: 1px solid #4c5f99;
        color: white;
    }
    .info th{
        background-color: #4c5f99 !IMPORTANT;
        color: white;
        cursor: pointer;
    }
    .cardIcon_r{
        padding: 4px;
        border: 1px solid #b92a08;
        /*background: #b92a08;*/
        border-radius: 10%;
        color: #b92a08;
    }
    .cardIcon_g{
        padding: 4px;
        border: 1px solid #79d01e;
        /*background: #79d01e;*/
        border-radius: 10%;
        color: #79d01e;
    }


</style>
@section('sidebar')
    <li class="mt">
        <a href="/student/dashboard">
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="sub-menu">
        <a href="/student/performance" class="">
            <i class="fa fa-book"></i>
            <span>Performance Record</span>
        </a>
    </li>
    <li class="sub-menu">
        <a href="/student/records" class="active">
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

    {{--<li class="sub-menu">--}}
    {{--<a href="/student/public-exams" >--}}
    {{--<i class="fa fa-book"></i>--}}
    {{--<span>Public Exams</span>--}}
    {{--</a>--}}
    {{--</li>--}}

    <li class="sub-menu">
        <a href="/student/updateInfo" >
            <i class="fa fa-book"></i>
            <span>Update Info</span>
        </a>
    </li>


@endsection

@section('mainContent')
    <section class="wrapper ">
        <h3 style="text-align: center;margin-bottom: 0;">{{$examInfo->test_name}}</h3>
        <p style="margin-bottom: 20px;text-align: center"> Click on Question no to see that Question</p>










        <div class="table-responsive" >
            <table class="table" style="font-size: 100%">
                <thead>
                <tr class="info">
                    <th>Question No</th>
                    <th>Question Type</th>
                    {{--<th>Result</th>--}}
                    <th>Response(Your | Correct)</th>

                    <th>Time Taken(Sec)</th>
                    <th title="For attempting the question correct, i.e correct attempt time/correct attempts">Avg. Time(Sec)</th>
                    <th title="Marks for attempting the question right or wrong">Marks(R/W)</th>

                    <th title="Correct Attempts made vs Total attempts(right plus wrong)">Attempts(C|T)</th>
                </tr>
                </thead>
                <tbody>
                @foreach($res as $key=>$response)
                    @if($key !=0)

                        <tr style="@if($response->answer == $response->correct)
                                color:#79d01e;
                        @elseif(!empty($response->answer))
                                color:#b92a08;
                        @else
                                color:#4c5f99;
                        @endif
                        ;">
                            <td onclick="question({{$key}})" style="cursor: pointer;user-select: none;-moz-user-select: none;"> {{$key}}</td>

                        <td id="this-subject" title="Subject | Question Type">{{$response->qType}}</td>
                        {{----}}
                                {{--<td>Correct Attemptd</td>--}}
                        {{--@elseif(!empty($response->answer))--}}
                                {{--<td>False Attempt</td>--}}
                        {{--@endif--}}
                            @if(is_array($response->answer))

                        @if(sizeof($response->answer) == 0)
                                <td>NA | {{$response->correct}}</td>
                        @else
                                <td>{{implode(',',$response->answer)}} | {{$response->correct}}</td>
                        @endif

                        <!-- <td>{{var_dump(implode(',',$response->answer))}} | {{$response->correct}}</td> -->
                        @else
                        @if($response->answer == NULL)
                                <td>NA | {{$response->correct}}</td>
                        @else
                                <td>{{$response->answer}} | {{$response->correct}}</td>
                        @endif
                            @endif
                        <td>{{$response->time}}
                            {{--@if($response->time>$response->avgTime)<i class="fa fa-frown-o cardIcon_r"></i>--}}
                            {{--@else <i class="fa fa-smile-o cardIcon_g"></i>--}}
                            {{--@endif--}}
                        </td>
                        <td>{{$response->avgTime}}</td>
                        <td title="correct attempt marks | wrong attempt marks">{{$response->MaxMarks}} / {{$response->negative}}</td>
                        <td title="correct attempts | Total attempts">{{$response->attempt}}</td>
                        {{--<td></td>--}}

<!-- implode(',', $original_array) -->
                    </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="questionModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="background: #4c5f99">
                        <button class="btn btn-default col-sm-2 col-xs-4" data-dismiss="modal">Close</button>
                        {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                        {{--<h4 class="modal-title">Question Paper</h4>--}}
                        <div id="pdf-buttons" class="row" style="width: 100%;margin-left: auto;margin-right: auto">
                            {{--<div class="col-lg-1"></div>--}}
                            <div id="page-count-container" class="col-sm-6 col-xs-4" style="color: white;text-align: center">
                                <a id="download-image" href="#" style="color:#fff;">
                                    Question <div id="pdf-current-page"></div> of <div id="pdf-total-pages"></div>
                                </a>
                            </div>
                            {{--Download</a>--}}
                            <i class="fa fa-star" id='impo-one' style="font-size:25px;color: white;cursor: pointer;float: right" onclick="mark()"></i>
                            {{--<button id="pdf-prev" class="btn btn-default col-sm-2 col-xs-4">Previous</button>--}}
                            <button id="pdf-next" class="btn btn-default col-sm-2 col-xs-4">Next</button>
                        </div>

                    </div>
                    <div class="modal-body" style="padding-top: 0;padding-bottom: 0">




                        <div class="row">
                            <div class="col-lg-12">
                                <! -- Blog Panel -->
                                <div class="row">
                                    <div id="pdf-main-container">
                                        <div id="pdf-loader">Loading document ...</div>
                                        <div id="pdf-meta">

                                        </div>
                                        <div id="pdf-contents" >
                                            <canvas id="pdf-canvas" width="800"></canvas>
                                            <div id="page-loader">Loading page ...</div>
                                        </div>
                                        {{--<h4 style="text-align: left;padding: 10px;display: inline">Your Response:  <label  id="response"></label></h4>--}}
                                        {{--<h4 style="text-align: left;padding: 10px;display: inline">Correct Response:  <label  id="answer"></label></h4>--}}
                                        {{--<lable id="this-subject" style=""></lable>--}}
                                        {{--<br>--}}
                                        <style>
                                            th, td {
                                                text-align: center !important;
                                            }
                                        </style>
                                        <div class="table-responsive" style="width: 95%;margin-right: 2%;margin-left: 2%;">
                                            <table class="table">
                                                <style>
                                                    .table tbody tr th{
                                                        border-top: none !IMPORTANT;
                                                    }
                                                </style>
                                                <tbody>
                                                <tr>
                                                    {{--<th title="Mark Important" rowspan="2">--}}
                                                        {{--<i class="fa fa-star" id='impo-one' style="font-size:40px;color: #4c5f99;cursor: pointer;" onclick="mark()"></i>--}}
                                                    {{--</th>--}}
                                                    {{--<th style="text-align: center">Marks(Correct/Wrong)</th>--}}
                                                    {{--<th rowspan="2" title="Download">--}}
                                                        {{--<a id="download-image" href="#">--}}
                                                            {{--<img src="https://png.icons8.com/ios-glyphs/40/000000/downloading-updates.png">--}}
                                                        {{--</a>--}}
                                                    {{--</th>--}}
                                                    {{--<th colspan="2" style="text-align: center !IMPORTANT">Time</th>--}}
                                                </tr>
                                                {{--<tr>--}}
                                                    {{--<td style="border-top: none"> <lable id="marks-distro"></lable></td>--}}
                                                    {{--<td style="text-align: right !important;padding-right: 2px;border-top: none">My: <lable id="user-time"></lable> Sec </td>--}}
                                                    {{--<td style="text-align: left !important;padding-left: 2px;border-top: none;display: none"> Avg: <lable id="avg-time"></lable> Sec</td>--}}
                                                {{--</tr>--}}
                                                </tbody></table></div>
                                    </div>
                                </div>
                            </div>
                        </div>






                    </div>
                    {{--<div class="modal-footer">--}}
                        {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                    {{--</div>--}}
                </div>

            </div>
        </div>







    </section>





    <section class="wrapper" style="margin-top: 0; display: none">
        <div class="row mt">
            <div class="col-lg-12">
                <! -- Blog Panel -->
                <p style="text-align: center">Solution for above Question</p>
                <div class="row">
                    <div id="pdf-main-container2">
                        <div id="pdf-loader2">Loading document ...</div>

                        <div id="pdf-contents2" >
                            <canvas id="pdf-canvas2" width="800"></canvas>
                            <div id="page-loader2">Loading page ...</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <script>
        function mark(){
            var subJ = document.getElementById('this-subject').innerHTML;
            $.ajax({
                url: '/student/markImpo',
                type: "POST",
                data:{_token:'{{csrf_token() }}',question: (__CURRENT_PAGE-1),paper:'{{$examInfo->test_name}}',examID:'{{$examInfo->exam_code}}',subject:subJ},
                dataType: "text",
                success: function (data) {
                    var zz = document.getElementById('impo-one');
                    if (zz.style.color == '#25bd25'){
                        document.getElementById('impo-one').style.color= '#fff';
                    }
                    else {
                        document.getElementById('impo-one').style.color= '#25bd25';
                    }
                    alert(data);
                },
                fail: function (error) {
                    alert(error);
                    alert('You encountered an error, Please Check Internet connection.');
                }
            });
        }
    </script>
@endsection

@section('scripts')
    <script src="/js/New/pdf.js"></script>
    <script src ="/js/solution.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
            @if(session('q_no')){

            console.log('Request made from Graph or Important Marked sections...');
            @if (empty($examInfo->solution))
            fetchResponse('/student/pdf/{{$examInfo->exam_code}}','/student/pdf/{{$examInfo->exam_code}}','{{$examInfo->id}}',{{session('q_no')}});
            @else
            fetchResponse('/student/pdf/{{$examInfo->exam_code}}','/student/solution/{{$examInfo->exam_code}}','{{$examInfo->id}}',{{session('q_no')}});
            @endif
        }
        @else
        @if (empty($examInfo->solution))
        fetchResponse('/student/pdf/{{$examInfo->exam_code}}','/student/pdf/{{$examInfo->exam_code}}','{{$examInfo->id}}',1);
        @else
        fetchResponse('/student/pdf/{{$examInfo->exam_code}}','/student/solution/{{$examInfo->exam_code}}','{{$examInfo->id}}',1);
        @endif
        @endif
    </script>
@endsection
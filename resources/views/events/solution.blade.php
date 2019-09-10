@extends('events.dash')
<style type="text/css">
    #page-loader,#pdf-loader{height:100px;line-height:100px;display:none;color:#999}#download-image,#page-loader,#pdf-loader{font-size:13px;text-align:center}#pdf-main-container{margin:20px auto;text-align:center}#pdf-contents{display:none;width:100%;overflow-y:scroll;padding-bottom:20px}#pdf-meta{overflow:hidden;margin:0 0 20px}#pdf-current-page,#pdf-total-pages{display:inline}#pdf-canvas{border:1px solid rgba(0,0,0,.2);box-sizing:border-box}#download-image{display:block;margin:10px auto 0}
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
        border: 1px solid #ac3b61;
        color: #ac3b61;
    }

    #pdf-prev:hover{
        background: #ac3b61;
        border: 1px solid #ac3b61;
        color: white;
    }

    #pdf-next{
        background: white;
        border: 1px solid #ac3b61;
        color: #ac3b61;
    }

    #pdf-next:hover{
        background: #ac3b61;
        border: 1px solid #ac3b61;
        color: white;
    }


</style>
@section('sidebar')
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
    <section class="wrapper ">

        <h4 style="text-align: right"><a href="/solutions_v2/{{$examInfo->exam_code}}">*Check Updates*</a></h4>

        <h3 style="text-align: center">{{$examInfo->test_name}}</h3>
        <div class="row mt">
            <div class="col-lg-12">
                <! -- Blog Panel -->
                <div class="row">
                        <div id="pdf-main-container">
                            <div id="pdf-loader">Loading document ...</div>
                            <div id="pdf-meta">
                                <div id="pdf-buttons" class="row" style="width: 100%;margin-left: auto;margin-right: auto">
                                    <button id="pdf-prev" class="btn btn-default col-sm-2 col-xs-4">Previous</button>
                                    <div CLASS="col-lg-1"></div>
                                    <div id="page-count-container" class="col-sm-6 col-xs-4">
                                        Question <div id="pdf-current-page"></div> of <div id="pdf-total-pages"></div>
                                    </div>
                                    <div class="col-sm-1"></div>
                                    <button id="pdf-next" class="btn btn-default col-sm-2 col-xs-4">Next</button>
                                </div>
                            </div>
                            <div id="pdf-contents" >
                                <canvas id="pdf-canvas" width="800"></canvas>
                                <div id="page-loader">Loading page ...</div>
                            </div>
                            {{--<p id="successID" style="width: 100%;text-align: center;display: none">Your Issue has been submitted.</p>--}}

                            <h4 style="text-align: left;padding: 10px;display: inline">Your Response:  <label  id="response"></label></h4>
                            <h4 style="text-align: left;padding: 10px;display: inline">Correct Response:  <label  id="answer"></label></h4>
                            
                            <lable id="this-subject" style=""></lable>
                            <br>

                            <style>
                                th, td {
                                    text-align: center !important;
                                }
                                #impo-two{
                                    cursor: pointer;
                                }
                            </style>



                            <div class="table-responsive" style="width: 95%;margin-right: 2%;margin-left: 2%;">
                                <table class="table">
                                    {{--<thead ><style>.info th{background:#fc6360 !important;color:white }</style>--}}
                                    {{--</thead>--}}
                                    <style>
                                        .table tbody tr th{
                                            border-top: none !IMPORTANT;
                                        }
                                    </style>
                                    <tbody>
                                    <tr>
                                        <th title="Mark Important" rowspan="2">
                                            <i class="fa fa-star" id='impo-one' style="font-size:40px;color: #4c5f99;cursor: pointer;" onclick="mark()"></i>
                                            {{--<img style="position: relative;display: none;right: -40px;" onclick="Unmark()" id='impo-one' src="https://png.icons8.com/ios/40/f1c40f/star-filled.png">--}}
                                            {{--<img style="position: relative" onclick="mark()" id='impo-two' src="https://png.icons8.com/ios/40/000000/star.png">--}}
                                        </th>
                                        {{--<th rowspan="2" title="Solution">--}}
                                            {{--<img src="https://png.icons8.com/plasticine/40/000000/idea.png" >--}}
                                        {{--</th>--}}
                                        <th style="text-align: center">Marks(Correct/Wrong)</th>
                                        <th rowspan="2" title="Download">
                                            <a id="download-image" href="#">
                                                <img src="https://png.icons8.com/ios-glyphs/40/000000/downloading-updates.png">
                                            </a>
                                        </th>
                                        <th colspan="2" style="text-align: center !IMPORTANT">Time</th>

                                    </tr>

                                    <tr>
                                        <td style="border-top: none"> <lable id="marks-distro"></lable></td>
                                        <td style="text-align: right !important;padding-right: 2px;border-top: none">My: <lable id="user-time"></lable> Sec </td>
                                        <td style="text-align: left !important;padding-left: 2px;border-top: none;display: none"> Avg: <lable id="avg-time"></lable> Sec</td>
                                    </tr>

                                    </tbody></table></div>

                            {{--<div style="padding: 4px;">--}}
                                {{--<table style="margin: 20px auto;width: 75%">--}}
                                    {{--<tr>--}}
                                        {{--<th rowspan="2" title="Mark Important" >--}}
                                            {{--<img style="position: relative;display: none;right: -40px;" onclick="Unmark()" id='impo-one' src="https://png.icons8.com/ios/40/f1c40f/star-filled.png">--}}
                                            {{--<img style="position: relative" onclick="mark()" id='impo-two' src="https://png.icons8.com/ios/40/000000/star.png">--}}
                                        {{--</th>--}}
                                        {{--<th rowspan="2" title="Solution">--}}
                                            {{--<img src="https://png.icons8.com/plasticine/40/000000/idea.png" >--}}
                                        {{--</th>--}}
                                        {{--<th style="text-align: center">--}}
                                            {{--Marks(Correct/Wrong)--}}
                                        {{--</th>--}}
                                        {{--<th colspan="2" style="text-align: center">Time</th>--}}
                                        {{--<th rowspan="2" title="Download">--}}
                                            {{--<a id="download-image" href="#">--}}
                                            {{--<img src="https://png.icons8.com/ios-glyphs/40/000000/downloading-updates.png">--}}
                                            {{--</a>--}}
                                        {{--</th>--}}
                                    {{--</tr>--}}



                                    {{--<tr>--}}
                                        {{--<td> <lable id="marks-distro"></lable></td>--}}
                                        {{--<td style="text-align: right !important;padding-right: 2px">My: <lable id="user-time"></lable> Sec | </td>--}}
                                        {{--<td style="text-align: left !important;padding-left: 2px"> Avg: <lable id="avg-time"></lable> Sec</td>--}}
                                    {{--</tr>--}}
                                {{--</table>--}}

                            {{--</div>--}}
                            {{--<p style="border-bottom: 1px dashed #ccc;margin-top: 20px"></p>--}}


                            {{--<div class="row">--}}
                                {{--<div class="col-sm-4"><button class="btn btn-success" onclick="showAnswer()"> Show answer</button></div>--}}
                                {{--<div class="col-sm-8"><h4>Correct answer is <label id="answer">This</label></h4> </div>--}}
                            {{--</div>--}}
                            {{--<button class="btn btn-default" data-toggle="modal" data-target="#myModal">Report This Question</button>--}}

                            {{--<a >Download This Question Offline</a>--}}
                        </div>
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
                        document.getElementById('impo-one').style.color= '#4c5f99';
                    }
                    else {
                        document.getElementById('impo-one').style.color= '#25bd25';
                    }

                    // document.getElementById('impo-one').style.display = 'block';
                    alert(data);
                },
                fail: function (error) {
                    alert(error);
                    alert('You encountered an error, Please Check Internet connection.');
                }
            });
        }
    </script>



    {{--<div class="modal fade" id="myModal" role="dialog">--}}
        {{--<div class="modal-dialog">--}}

            {{--<!-- Modal content-->--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                    {{--<h4 class="modal-title">Write your comments Below</h4>--}}
                {{--</div>--}}
                {{--<div class="modal-body">--}}
                    {{--<p>This feature is not for asking doubts, If you think the question is wrong, please submit your issue below.</p>--}}
                    {{--<textarea placeholder="Write your issues here" id="issue" style="width: 100%;height: 100px;"></textarea>--}}
                {{--</div>--}}
                {{--<div class="modal-footer">--}}
                    {{--<button type="button" class="btn btn-default" onclick="issue({{$examInfo->id}})" data-dismiss="modal">Submit Issue</button>--}}
                    {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

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
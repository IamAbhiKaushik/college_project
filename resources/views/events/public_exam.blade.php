@extends('events.dash')
@section('sidebar')
    <li class="mt">
        <a class="" href="/student/dashboard">
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="sub-menu">
        <a href="/student/performance" >
            <i class="fa fa-book"></i>
            <span>Performance Record</span>
        </a>
    </li>
    <li class="sub-menu">
        <a href="/student/records" >
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
        <a href="/student/public-exams" class="active">
            <i class="fa fa-book"></i>
            <span>Public Exams</span>
        </a>
    </li>

    <li class="sub-menu">
        <a href="/student/updateInfo" >
            <i class="fa fa-book"></i>
            <span>Update Info</span>
        </a>
    </li>
    {{--<li class="sub-menu">--}}
    {{--<a href="/student/exams" >--}}
    {{--<i class="fa fa-th" ></i>--}}
    {{--<span>Available Exams</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--<li class="sub-menu">--}}
    {{--<a href="/student/updateInfo">--}}
    {{--<i class=" fa fa-bar-chart-o"></i>--}}
    {{--<span>Update Info</span>--}}
    {{--</a>--}}
    {{--</li>--}}
@endsection


@section('mainContent')
    <section class="wrapper" style="min-height: 600px;">
        <div class="row">

            @if($data->coaching_batch == NULL)
                <div class="text-center" style="z-index: 1;width: 100%;color: white;padding: 10px;font-size: 20px;
                  background: #424a5d;border: 1px solid white;box-shadow: rgba(0,0,0,0.2) 0 2px 6px 0;">
                    <a href="/student/updateInfo">Click Here</a> to Update your Coaching Institute Information to access your all your examinations.
                </div>
            @endif

            <div class="col-lg-9 main-chart">
                <div class="border-head">
                    <h3 style="color: #4c5f99">Available Public Exams</h3>
                    <p style="color: #4c5f99">These are extra Practice exam papers for your practice. Attempt the exams before its expiry date.</p>
                </div>
                <div class="row">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                <!-- TWITTER PANEL -->

                    @if(!empty($exams))
                        @foreach($exams as $key=>$exam)
                            <div class="col-xs-12 col-md-5 mb cardE" >
                                <div class="row">
                                    <div class="col-sm-12">
                                        <img src="http://www.iitianspectrum.com/images/logo.png">
                                    </div>
                                    <div class="col-sm-12" style="color: #4c5f99;">
                                        <p style="margin-top: 0;color:#4c5f99;font-size: 16px;margin-bottom: 0px;font-weight: 600">Hosted By: {{$exam->coachingName}}</p>
                                        {{--<p style="color: #4c5f99;"></p>--}}
                                        <p style="margin-top: 0;color:#4c5f99;font-size: 14px;margin-bottom: 0px;font-weight: 400">Exam : {{$exam->test_name}} | Jee {{$exam->type}}</p>
                                        <p style="color: #4c5f99;font-size: 95%">Duration: {{$exam->duration}} H <br>Available Till:  {{date("H:i",strtotime($exam->livetime)+600)}} <br> Exam Code:<b> {{$exam->exam_code}}</b> </p>
                                        <p style="color: #4c5f99;font-size: 95%"><b>Syllabus</b>: {{$exam->topics}}</p>
                                        @if($exam->attempted ==1)
                                            <a href="/examInfo/{{$exam->exam_code}}" ><button class="btnE">Take Exam</button>
                                            </a>
                                        @else($exam->attempted ==0)
                                            <a href="/student/records">
                                                <button class="btnE">Already Attempted | View</button>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else <p style="color: #4c5f99;"> No public exams available right now.</p>
                @endif
                <!-- <div class="col-md-4 col-sm-4 mb">
              <div class="darkblue-panel pn">
                <div class="darkblue-header">
                  <h5>REVENUE</h5>
                </div>
                <div class="chart mt">
                  <div class="sparkline"
                    data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1"
                    data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff"
                    data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,464,655]"></div>
                </div>
                <p class="mt"><b>$ 17,980</b><br/>Month Income</p>
              </div>
            </div>
             --><!-- /col-md-4 -->

                </div><!-- /row -->





            {{--<div class="row mt">--}}
            {{--<!--CUSTOM CHART START -->--}}
            {{--<div class="border-head">--}}
            {{--<h3>Exams Performances </h3>--}}
            {{--</div>--}}
            {{--<div class="custom-bar-chart">--}}
            {{--<ul class="y-axis">--}}
            {{--<li><span>10.000</span></li>--}}
            {{--<li><span>8.000</span></li>--}}
            {{--<li><span>6.000</span></li>--}}
            {{--<li><span>4.000</span></li>--}}
            {{--<li><span>2.000</span></li>--}}
            {{--<li><span>0</span></li>--}}
            {{--</ul>--}}
            {{--<div class="bar">--}}
            {{--<div class="title">JAN</div>--}}
            {{--<div class="value tooltips" data-original-title="8.500" data-toggle="tooltip" data-placement="top">85%</div>--}}
            {{--</div>--}}
            {{--<div class="bar ">--}}
            {{--<div class="title">FEB</div>--}}
            {{--<div class="value tooltips" data-original-title="5.000" data-toggle="tooltip" data-placement="top">50%</div>--}}
            {{--</div>--}}
            {{--<div class="bar ">--}}
            {{--<div class="title">MAR</div>--}}
            {{--<div class="value tooltips" data-original-title="6.000" data-toggle="tooltip" data-placement="top">60%</div>--}}
            {{--</div>--}}
            {{--<div class="bar ">--}}
            {{--<div class="title">APR</div>--}}
            {{--<div class="value tooltips" data-original-title="4.500" data-toggle="tooltip" data-placement="top">45%</div>--}}
            {{--</div>--}}
            {{--<div class="bar">--}}
            {{--<div class="title">MAY</div>--}}
            {{--<div class="value tooltips" data-original-title="3.200" data-toggle="tooltip" data-placement="top">32%</div>--}}
            {{--</div>--}}
            {{--<div class="bar ">--}}
            {{--<div class="title">JUN</div>--}}
            {{--<div class="value tooltips" data-original-title="6.200" data-toggle="tooltip" data-placement="top">62%</div>--}}
            {{--</div>--}}
            {{--<div class="bar">--}}
            {{--<div class="title">JUL</div>--}}
            {{--<div class="value tooltips" data-original-title="7.500" data-toggle="tooltip" data-placement="top">75%</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<!--custom chart end-->--}}
            {{--</div>--}}



            {{--//this part will be commented out--}}


            <!-- /row -->
            </div>

            <!-- /col-lg-9 END SECTION MIDDLE -->


            <!-- **********************************************************************************************************************************************************
            RIGHT SIDEBAR CONTENT
            *********************************************************************************************************************************************************** -->

            <div class="col-lg-3 ds" style="background: transparent;">
                <!--COMPLETED ACTIONS DONUTS CHART-->
                <h3 style="color: #4c5f99;border: 2px solid #4c5f99;background: transparent;">PUBLIC NOTIFICATIONS</h3>
                <div class="desc" style="background: #ffffff66">
                    <div class="details" style="margin-left: 20px;">
                        <p style="font-size: 13px;color: #4c5f99;">
                            <muted style="font-size: 10px;">{{date("M d",time())}}</muted><br/>
                            This is your Message board. All important informations will be displayed here.
                        </p>
                    </div>
                </div>

            @if(!empty($infos))
                @foreach($infos as $key=>$info)
                    <!-- First Action -->
                        <div class="desc" style="background: #ffffff66">
                            <div class="details" style="margin-left: 20px;">
                                <p style="font-size: 13px;color: #4c5f99;">
                                    <muted style="font-size: 10px;">{{date("M d",$info->time)}}</muted><br/>
                                    {{$info->message}}
                                </p>
                            </div>
                        </div>
                    @endforeach
                @endif


            </div><!-- /col-lg-3 -->
        </div><! --/row -->
    </section>




@endsection

@section('scripts')
    {{--<script src="/assets/js/sparkline-chart.js"></script>--}}
    {{--<script src="/assets/js/zabuto_calendar.js"></script>--}}
@endsection
@extends('events.dash')
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
        <a href="/student/records" >
            <i class="fa fa-tasks"></i>
            <span>Previous Exams</span>
        </a>
    </li>

    <li class="sub-menu">
        <a href="/student/important" class="active">
            <i class="fa fa-book"></i>
            <span>Important Question</span>
        </a>
    </li>
    {{--<li><a class="logout" style="color: #4c5f99;--}}
    {{--background: none;--}}
    {{--font-size: 18px;--}}
    {{--border: none !IMPORTANT;--}}
    {{--padding: initial;" href="/student/logout">Logout</a></li>--}}
    {{--<li class="sub-menu">--}}
    {{--<a href="/student/public-exams" >--}}
    {{--<i class="fa fa-book"></i>--}}
    {{--<span>Public Exams</span>--}}
    {{--</a>--}}
    {{--</li>--}}

    <li class="sub-menu">
        <a href="/student/updateInfo" >
            <i class="far fa-edit"></i>
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

    <li class="logout">
        <a href="/student/logout" >
            <i class="fa fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </li>
@endsection
@section('mainContent')
    <section class="wrapper site-min-height">
        <div class="row mt">
            <div class="col-lg-12">
                <! -- Blog Panel -->
                @foreach($marked as $key=>$mark)
                {{--so for each exam--}}
                    <div class="col-xs-12 col-md-4 mb cardE" style="box-shadow: none;font-weight: 600;font-size: 120%;">
                        <p style="color: #B00020;text-align: center">Exam Paper: | {{$mark->exam}}</p>
                        @foreach($subject[$key] as $k=>$sections)
                        <div class="row">
                            <div class="col-xs-4 col-sm-3">
                                <div class="btnE">{{$k}}</div>
                            </div>
                            {{--<div class="col-sm-1"></div>--}}
                            <div class="col-xs-7 col-sm-8" style="margin: 5px;padding: 5px;color: #231C69">

                                    {{--<div class="col-sm-12" style="color: #231C69">--}}
                                        @foreach(array_unique($sections) as $q)
                                        <a href="/student/stud/{{$mark->exam_id}}/{{$q}}" target="_blank" style="padding-left: 2px;padding-right: 2px;text-decoration: underline">{{$q}}</a>
                                        @endforeach
                                    {{--</div>--}}

                            </div>
                        </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
@section('scripts')
@endsection
@extends('events.dash')
@section('sidebar')
          <li class="mt">
                      <a class="active" href="/student/dashboard">
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
                      <a href="/student/important" >
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
                          <h3 style="color: #4c5f99">Available Exams</h3>
                      </div>
          <div class="row">
              @if (session('status'))
                  <div class="alert alert-success">
                      {{ session('status') }}
                  </div>
              @endif
            @if($data->coaching == 'akash703')
                  <div class="alert alert-success">
                      <p style="font-size: 125%;">Please give Demo test to make sure that your system is compatible with platform</p>
                      <br>Second phase exam will be live on 23rd Nov from 11::59 AM to 08::00 PM.
                      <br>Results for all phases will be announced on 2nd December, here only.
                  </div>
             @endif


            <!-- TWITTER PANEL -->
          @if($exams)
            @foreach($exams as $key=>$exam)
            <div class="col-xs-12 col-md-5 mb cardE" >
                    <div class="row">
                        <div class="col-sm-3">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="60" height="60" viewBox="0 0 50 50" style="fill:#4c5f99;margin-top: 30px;"><g id="surface1"><path style=" " d="M 25 0 C 23.152344 0 21.640625 1.289063 21.1875 3 L 9 3 C 7.355469 3 6 4.355469 6 6 L 6 45 C 6 46.644531 7.355469 48 9 48 L 41 48 C 42.644531 48 44 46.644531 44 45 L 44 6 C 44 4.355469 42.644531 3 41 3 L 32.0625 3 C 32.042969 3 32.019531 3 32 3 L 28.8125 3 C 28.359375 1.289063 26.847656 0 25 0 Z M 25 2 C 26.117188 2 27 2.882813 27 4 C 27 4.550781 27.449219 5 28 5 L 31 5 L 31 7 L 19 7 L 19 5 L 22 5 C 22.550781 5 23 4.550781 23 4 C 23 2.882813 23.882813 2 25 2 Z M 9 5 L 17 5 L 17 8 C 17 8.550781 17.449219 9 18 9 L 32 9 C 32.550781 9 33 8.550781 33 8 L 33 5 L 41 5 C 41.566406 5 42 5.433594 42 6 L 42 45 C 42 45.566406 41.566406 46 41 46 L 9 46 C 8.433594 46 8 45.566406 8 45 L 8 6 C 8 5.433594 8.433594 5 9 5 Z M 36 16.9375 C 35.945313 16.945313 35.894531 16.953125 35.84375 16.96875 C 35.824219 16.976563 35.800781 16.988281 35.78125 17 C 35.523438 17.058594 35.296875 17.214844 35.15625 17.4375 L 31.84375 22.40625 L 29.71875 20.28125 C 29.511719 20.058594 29.210938 19.945313 28.90625 19.96875 C 28.863281 19.976563 28.820313 19.988281 28.78125 20 C 28.40625 20.066406 28.105469 20.339844 28 20.703125 C 27.894531 21.070313 28.003906 21.460938 28.28125 21.71875 L 31.15625 24.59375 C 31.175781 24.617188 31.195313 24.636719 31.21875 24.65625 L 31.28125 24.71875 C 31.292969 24.730469 31.300781 24.738281 31.3125 24.75 C 31.324219 24.761719 31.332031 24.769531 31.34375 24.78125 C 31.355469 24.792969 31.363281 24.800781 31.375 24.8125 C 31.414063 24.835938 31.457031 24.855469 31.5 24.875 C 31.519531 24.886719 31.542969 24.898438 31.5625 24.90625 C 31.582031 24.917969 31.605469 24.929688 31.625 24.9375 C 31.636719 24.9375 31.644531 24.9375 31.65625 24.9375 C 31.675781 24.949219 31.699219 24.960938 31.71875 24.96875 C 31.730469 24.96875 31.738281 24.96875 31.75 24.96875 C 31.769531 24.980469 31.792969 24.992188 31.8125 25 C 31.824219 25 31.832031 25 31.84375 25 C 31.863281 25 31.886719 25 31.90625 25 C 31.917969 25 31.925781 25 31.9375 25 C 32 25.003906 32.0625 25.003906 32.125 25 C 32.136719 25 32.144531 25 32.15625 25 C 32.230469 24.988281 32.304688 24.964844 32.375 24.9375 C 32.394531 24.929688 32.417969 24.917969 32.4375 24.90625 C 32.46875 24.898438 32.5 24.886719 32.53125 24.875 C 32.554688 24.855469 32.574219 24.835938 32.59375 24.8125 C 32.613281 24.804688 32.636719 24.792969 32.65625 24.78125 C 32.691406 24.753906 32.722656 24.722656 32.75 24.6875 C 32.773438 24.65625 32.792969 24.625 32.8125 24.59375 C 32.824219 24.582031 32.832031 24.574219 32.84375 24.5625 L 32.875 24.53125 C 32.886719 24.5 32.898438 24.46875 32.90625 24.4375 L 36.84375 18.5625 C 37.09375 18.253906 37.136719 17.828125 36.953125 17.476563 C 36.769531 17.121094 36.394531 16.910156 36 16.9375 Z M 13.71875 20 C 13.167969 20.078125 12.78125 20.589844 12.859375 21.140625 C 12.9375 21.691406 13.449219 22.078125 14 22 L 24 22 C 24.359375 22.003906 24.695313 21.816406 24.878906 21.503906 C 25.058594 21.191406 25.058594 20.808594 24.878906 20.496094 C 24.695313 20.183594 24.359375 19.996094 24 20 L 14 20 C 13.96875 20 13.9375 20 13.90625 20 C 13.875 20 13.84375 20 13.8125 20 C 13.78125 20 13.75 20 13.71875 20 Z M 36 29.9375 C 35.945313 29.945313 35.894531 29.953125 35.84375 29.96875 C 35.824219 29.976563 35.800781 29.988281 35.78125 30 C 35.523438 30.058594 35.296875 30.214844 35.15625 30.4375 L 31.84375 35.40625 L 29.71875 33.28125 C 29.511719 33.058594 29.210938 32.945313 28.90625 32.96875 C 28.863281 32.976563 28.820313 32.988281 28.78125 33 C 28.40625 33.066406 28.105469 33.339844 28 33.703125 C 27.894531 34.070313 28.003906 34.460938 28.28125 34.71875 L 31.15625 37.59375 C 31.175781 37.617188 31.195313 37.636719 31.21875 37.65625 L 31.28125 37.71875 C 31.292969 37.730469 31.300781 37.738281 31.3125 37.75 C 31.324219 37.761719 31.332031 37.769531 31.34375 37.78125 C 31.355469 37.792969 31.363281 37.800781 31.375 37.8125 C 31.414063 37.835938 31.457031 37.855469 31.5 37.875 C 31.519531 37.886719 31.542969 37.898438 31.5625 37.90625 C 31.582031 37.917969 31.605469 37.929688 31.625 37.9375 C 31.636719 37.9375 31.644531 37.9375 31.65625 37.9375 C 31.675781 37.949219 31.699219 37.960938 31.71875 37.96875 C 31.730469 37.96875 31.738281 37.96875 31.75 37.96875 C 31.769531 37.980469 31.792969 37.992188 31.8125 38 C 31.824219 38 31.832031 38 31.84375 38 C 31.863281 38 31.886719 38 31.90625 38 C 31.917969 38 31.925781 38 31.9375 38 C 32 38.003906 32.0625 38.003906 32.125 38 C 32.136719 38 32.144531 38 32.15625 38 C 32.230469 37.988281 32.304688 37.964844 32.375 37.9375 C 32.394531 37.929688 32.417969 37.917969 32.4375 37.90625 C 32.46875 37.898438 32.5 37.886719 32.53125 37.875 C 32.554688 37.855469 32.574219 37.835938 32.59375 37.8125 C 32.613281 37.804688 32.636719 37.792969 32.65625 37.78125 C 32.691406 37.753906 32.722656 37.722656 32.75 37.6875 C 32.773438 37.65625 32.792969 37.625 32.8125 37.59375 C 32.824219 37.582031 32.832031 37.574219 32.84375 37.5625 L 32.875 37.53125 C 32.886719 37.5 32.898438 37.46875 32.90625 37.4375 L 36.84375 31.5625 C 37.09375 31.253906 37.136719 30.828125 36.953125 30.476563 C 36.769531 30.121094 36.394531 29.910156 36 29.9375 Z M 13.71875 33 C 13.167969 33.078125 12.78125 33.589844 12.859375 34.140625 C 12.9375 34.691406 13.449219 35.078125 14 35 L 24 35 C 24.359375 35.003906 24.695313 34.816406 24.878906 34.503906 C 25.058594 34.191406 25.058594 33.808594 24.878906 33.496094 C 24.695313 33.183594 24.359375 32.996094 24 33 L 14 33 C 13.96875 33 13.9375 33 13.90625 33 C 13.875 33 13.84375 33 13.8125 33 C 13.78125 33 13.75 33 13.71875 33 Z "></path></g></svg>
                        </div>
                        <div class="col-sm-9" style="color: #4c5f99;">
                            <p style="color: #4c5f99;">{{$exam->type}}</p>
                            <p style="margin-top: 0;color:#4c5f99;font-size: 16px;margin-bottom: 0px;font-weight: 600">{{$exam->test_name}}</p>
                            <p style="color: #4c5f99;font-size: 95%">Exam Duration: {{$exam->duration}} M<br>Exam Started At:  {{date("H:i j-M Y ",strtotime($exam->livetime)+0)}} <br> Exam Code:<b> {{$exam->exam_code}}</b> </p>
                            @if($exam->attempted ==0)
                                <a href="/examInfo/{{$exam->exam_code}}" ><button class="btnE">Take Exam</button>
                                </a>
                            @else($exam->attempted ==1)
                                <a href="/student/records">
                                    <button class="btnE">Already Attempted | View</button>
                                </a>
                            @endif
                        </div>
                    </div>
            </div>
            @endforeach
                  @else
                        <div style="margin-left: 15px">

                            <div class="border-head">
                                <h3 style="color: #4c5f99">No Live Exams Available</h3>
                            </div>

                          <p style="color: #4c5f99;margin-left: 15px;">Visit Previous Exams to access your previous Exams.</p>
                        </div>
              @endif


                  @if($data->coaching == 'akash')
                      <div class="col-xs-12 col-md-5 mb cardE" >
                          {{--TF_An0006-08-z-000--}}
                          <div class="row">
                              <div class="col-sm-3">
                                  <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="60" height="60" viewBox="0 0 50 50" style="fill:#4c5f99;margin-top: 30px;"><g id="surface1"><path style=" " d="M 25 0 C 23.152344 0 21.640625 1.289063 21.1875 3 L 9 3 C 7.355469 3 6 4.355469 6 6 L 6 45 C 6 46.644531 7.355469 48 9 48 L 41 48 C 42.644531 48 44 46.644531 44 45 L 44 6 C 44 4.355469 42.644531 3 41 3 L 32.0625 3 C 32.042969 3 32.019531 3 32 3 L 28.8125 3 C 28.359375 1.289063 26.847656 0 25 0 Z M 25 2 C 26.117188 2 27 2.882813 27 4 C 27 4.550781 27.449219 5 28 5 L 31 5 L 31 7 L 19 7 L 19 5 L 22 5 C 22.550781 5 23 4.550781 23 4 C 23 2.882813 23.882813 2 25 2 Z M 9 5 L 17 5 L 17 8 C 17 8.550781 17.449219 9 18 9 L 32 9 C 32.550781 9 33 8.550781 33 8 L 33 5 L 41 5 C 41.566406 5 42 5.433594 42 6 L 42 45 C 42 45.566406 41.566406 46 41 46 L 9 46 C 8.433594 46 8 45.566406 8 45 L 8 6 C 8 5.433594 8.433594 5 9 5 Z M 36 16.9375 C 35.945313 16.945313 35.894531 16.953125 35.84375 16.96875 C 35.824219 16.976563 35.800781 16.988281 35.78125 17 C 35.523438 17.058594 35.296875 17.214844 35.15625 17.4375 L 31.84375 22.40625 L 29.71875 20.28125 C 29.511719 20.058594 29.210938 19.945313 28.90625 19.96875 C 28.863281 19.976563 28.820313 19.988281 28.78125 20 C 28.40625 20.066406 28.105469 20.339844 28 20.703125 C 27.894531 21.070313 28.003906 21.460938 28.28125 21.71875 L 31.15625 24.59375 C 31.175781 24.617188 31.195313 24.636719 31.21875 24.65625 L 31.28125 24.71875 C 31.292969 24.730469 31.300781 24.738281 31.3125 24.75 C 31.324219 24.761719 31.332031 24.769531 31.34375 24.78125 C 31.355469 24.792969 31.363281 24.800781 31.375 24.8125 C 31.414063 24.835938 31.457031 24.855469 31.5 24.875 C 31.519531 24.886719 31.542969 24.898438 31.5625 24.90625 C 31.582031 24.917969 31.605469 24.929688 31.625 24.9375 C 31.636719 24.9375 31.644531 24.9375 31.65625 24.9375 C 31.675781 24.949219 31.699219 24.960938 31.71875 24.96875 C 31.730469 24.96875 31.738281 24.96875 31.75 24.96875 C 31.769531 24.980469 31.792969 24.992188 31.8125 25 C 31.824219 25 31.832031 25 31.84375 25 C 31.863281 25 31.886719 25 31.90625 25 C 31.917969 25 31.925781 25 31.9375 25 C 32 25.003906 32.0625 25.003906 32.125 25 C 32.136719 25 32.144531 25 32.15625 25 C 32.230469 24.988281 32.304688 24.964844 32.375 24.9375 C 32.394531 24.929688 32.417969 24.917969 32.4375 24.90625 C 32.46875 24.898438 32.5 24.886719 32.53125 24.875 C 32.554688 24.855469 32.574219 24.835938 32.59375 24.8125 C 32.613281 24.804688 32.636719 24.792969 32.65625 24.78125 C 32.691406 24.753906 32.722656 24.722656 32.75 24.6875 C 32.773438 24.65625 32.792969 24.625 32.8125 24.59375 C 32.824219 24.582031 32.832031 24.574219 32.84375 24.5625 L 32.875 24.53125 C 32.886719 24.5 32.898438 24.46875 32.90625 24.4375 L 36.84375 18.5625 C 37.09375 18.253906 37.136719 17.828125 36.953125 17.476563 C 36.769531 17.121094 36.394531 16.910156 36 16.9375 Z M 13.71875 20 C 13.167969 20.078125 12.78125 20.589844 12.859375 21.140625 C 12.9375 21.691406 13.449219 22.078125 14 22 L 24 22 C 24.359375 22.003906 24.695313 21.816406 24.878906 21.503906 C 25.058594 21.191406 25.058594 20.808594 24.878906 20.496094 C 24.695313 20.183594 24.359375 19.996094 24 20 L 14 20 C 13.96875 20 13.9375 20 13.90625 20 C 13.875 20 13.84375 20 13.8125 20 C 13.78125 20 13.75 20 13.71875 20 Z M 36 29.9375 C 35.945313 29.945313 35.894531 29.953125 35.84375 29.96875 C 35.824219 29.976563 35.800781 29.988281 35.78125 30 C 35.523438 30.058594 35.296875 30.214844 35.15625 30.4375 L 31.84375 35.40625 L 29.71875 33.28125 C 29.511719 33.058594 29.210938 32.945313 28.90625 32.96875 C 28.863281 32.976563 28.820313 32.988281 28.78125 33 C 28.40625 33.066406 28.105469 33.339844 28 33.703125 C 27.894531 34.070313 28.003906 34.460938 28.28125 34.71875 L 31.15625 37.59375 C 31.175781 37.617188 31.195313 37.636719 31.21875 37.65625 L 31.28125 37.71875 C 31.292969 37.730469 31.300781 37.738281 31.3125 37.75 C 31.324219 37.761719 31.332031 37.769531 31.34375 37.78125 C 31.355469 37.792969 31.363281 37.800781 31.375 37.8125 C 31.414063 37.835938 31.457031 37.855469 31.5 37.875 C 31.519531 37.886719 31.542969 37.898438 31.5625 37.90625 C 31.582031 37.917969 31.605469 37.929688 31.625 37.9375 C 31.636719 37.9375 31.644531 37.9375 31.65625 37.9375 C 31.675781 37.949219 31.699219 37.960938 31.71875 37.96875 C 31.730469 37.96875 31.738281 37.96875 31.75 37.96875 C 31.769531 37.980469 31.792969 37.992188 31.8125 38 C 31.824219 38 31.832031 38 31.84375 38 C 31.863281 38 31.886719 38 31.90625 38 C 31.917969 38 31.925781 38 31.9375 38 C 32 38.003906 32.0625 38.003906 32.125 38 C 32.136719 38 32.144531 38 32.15625 38 C 32.230469 37.988281 32.304688 37.964844 32.375 37.9375 C 32.394531 37.929688 32.417969 37.917969 32.4375 37.90625 C 32.46875 37.898438 32.5 37.886719 32.53125 37.875 C 32.554688 37.855469 32.574219 37.835938 32.59375 37.8125 C 32.613281 37.804688 32.636719 37.792969 32.65625 37.78125 C 32.691406 37.753906 32.722656 37.722656 32.75 37.6875 C 32.773438 37.65625 32.792969 37.625 32.8125 37.59375 C 32.824219 37.582031 32.832031 37.574219 32.84375 37.5625 L 32.875 37.53125 C 32.886719 37.5 32.898438 37.46875 32.90625 37.4375 L 36.84375 31.5625 C 37.09375 31.253906 37.136719 30.828125 36.953125 30.476563 C 36.769531 30.121094 36.394531 29.910156 36 29.9375 Z M 13.71875 33 C 13.167969 33.078125 12.78125 33.589844 12.859375 34.140625 C 12.9375 34.691406 13.449219 35.078125 14 35 L 24 35 C 24.359375 35.003906 24.695313 34.816406 24.878906 34.503906 C 25.058594 34.191406 25.058594 33.808594 24.878906 33.496094 C 24.695313 33.183594 24.359375 32.996094 24 33 L 14 33 C 13.96875 33 13.9375 33 13.90625 33 C 13.875 33 13.84375 33 13.8125 33 C 13.78125 33 13.75 33 13.71875 33 Z "></path></g></svg>
                              </div>
                              <div class="col-sm-9" style="color: #4c5f99;">
                                  <p style="color: #4c5f99;">Subjective Question</p>
                                  <p style="margin-top: 0;color:#4c5f99;font-size: 16px;margin-bottom: 0px;font-weight: 600">Techfest Innovation Subjective Question</p>
                                  <p style="color: #4c5f99;font-size: 95%">Exam Duration: 30 M</p>
                                  <p style="color: #4c5f99;font-size: 95%">Attempt this after attempting objective exam</p>
                                  <a href="/exam/techfest" ><button class="btnE">Take Exam</button>
                                  </a>
                              </div>
                          </div>
                      </div>
                  @endif


          </div><!-- /row -->


@if(!empty($dataMe))
    <section class="wrapper" style="color: #424a5d;">
        <div class="border-head">
            <h3 style="margin-left:0;color: #4c5f99">Exam Wise Overall Performance (Percentage Scores)</h3>
        </div>

        <p><b>Exam Code:</b> Represent the code of Exam</p>
        <p><b>Y-axis:</b> Represent percentage marks obtained.</p>
        <p><b>Note:</b> Hovering any point, will show your marks and topper's marks. </p>

        <div class="col-lg-12">
            <div id="main" style="width: 100%;height: 400px;color: #424a5d;"></div>
        </div>

    </section>
@endif

    {{--<section class="wrapper" style="color: #424a5d;">--}}
        {{--<div class="border-head">--}}
            {{--<h3 style="margin-left:0;color: #4c5f99">Exam Wise Rank Trends</h3>--}}
        {{--</div>--}}

        {{--<p><b>Exam Code:</b> Represent the code of Exam</p>--}}
        {{--<p><b>Y-axis:</b> Represent percentage marks obtained.</p>--}}
        {{--<p><b>Note:</b> Hovering any point, will show your marks and topper's marks. </p>--}}

        {{--<div class="col-lg-12">--}}
            {{--<div id="main_rank" style="width: 100%;height: 400px;color: #424a5d;"></div>--}}
        {{--</div>--}}

    {{--</section>--}}



</div>

      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->
                  <div class="col-lg-3 ds" style="background: transparent;">
                    <!--COMPLETED ACTIONS DONUTS CHART-->
            <h3 style="color: #4c5f99;border: 2px solid #4c5f99;background: transparent;">NOTIFICATIONS</h3>
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



          <p id="dataNames" style="display: none">{{$gData['dataNames']}}</p>
          <p id="dataMe" style="display: none">{{$gData['dataMe']}}</p>
          <p id="dataAvg" style="display: none">{{$gData['dataAvg']}}</p>
          <p id="dataTop" style="display: none">{{$gData['dataTop']}}</p>


@endsection
@section('scripts')
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
                        data:['You','Avg','Topper']
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
                            type:'bar',
                            data:dataMe,
                        },
                        {
                            name:'Avg',
                            type:'bar',
                            data:dataAvg,
                        },
                        {
                            name:'Topper',
                            type:'bar',
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
  {{--<script src="/assets/js/sparkline-chart.js"></script>--}}
  {{--<script src="/assets/js/zabuto_calendar.js"></script>--}}
@endsection
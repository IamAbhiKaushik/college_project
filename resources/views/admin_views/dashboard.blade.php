@extends('layouts.frame')

      @section('inside')

        <li class="breadcrumb-item active">Home</li>
      </ol>
      <!-- Icon Cards-->

      <div class="row">
       <!--  <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-comments"></i>
              </div>
              <div class="mr-5">26 New Messages!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div> -->
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-warning o-hidden h-100" style="background-color: #ffae0c!important;
    border: none;box-shadow: 5px 5px 25px 0 rgba(46,61,73,.2);">
              <a href="/admin_views/create_test" style="color: white;text-decoration: none">
                  <div class="card-body" style="border-bottom: 1px solid white;">
                      <div class="card-body-icon">
                        <i class="fa fa-fw fa-plus "></i>
                      </div>
                      <div class="mr-5">Create New Test</div>
                  </div>
              </a>
            <a class="card-footer text-white clearfix small z-1" href="#dataTable">
              <span class="float-left">Manage Tests</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
         <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100" style="    background-color: #ff5483!important;
    border: none;box-shadow: 5px 5px 25px 0 rgba(46,61,73,.2);">
              <a href="/admin_views/show_public" style="color: white;text-decoration: none">
                  <div class="card-body" style="border-bottom: 1px solid white;">
                      <div class="card-body-icon">
                        <i class="fa fa-fw fa-pencil-square-o"></i>
                      </div>
                      <div class="mr-5">Create Public Exams</div>
                  </div></a>
            <a class="card-footer text-white clearfix small z-1" href="#dataTable">
              <span class="float-left">Manage Public Exams</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100" style="background-color: #15c26b!important;
    border: none;
    box-shadow: 5px 5px 25px 0 rgba(46,61,73,.2);
">
              <a href="/admin_views/manage_students" style="color: white;text-decoration: none">
                <div class="card-body" style="border-bottom: 1px solid white;">
                  <div class="card-body-icon">
                    <i class="fa fa-fw fa-line-chart "></i>
                  </div>
                  <div class="mr-5">Student's Analytics</div>
                </div>
              </a>
            <a class="card-footer text-white clearfix small z-1" href="/admin_views/manage_students">
              <span class="float-left">Add/Update Students</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
      </div>
      <!-- Area Chart Example-->
    <!--   <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-area-chart"></i> Area Chart Example</div>
        <div class="card-body">
          <canvas id="myAreaChart" width="100%" height="30"></canvas>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div> -->
     <div class="row">
        <div class="col-lg-8">

          {{--<div class="card mb-3">--}}
            {{--<div class="card-header">--}}
              {{--<i class="fa fa-user-o"></i> Your Institute Information </div>--}}
            {{--<div class="card-body">--}}
              {{--<div class="row">--}}
                {{--<div class="col-sm-8 my-auto">--}}
                 {{--<div class="row">--}}
                   {{--<div class="col-sm-4">Name:</div><hr>--}}
                   {{--<div class="col-sm-8">{{Auth::user()->name}}</div><hr> --}}
                   {{--<div class="col-sm-4">Coaching Name:</div><hr>--}}
                   {{--<div class="col-sm-8">{{Auth::user()->coachingName}}</div><hr> --}}
                   {{--<div class="col-sm-4">Email:</div><hr>--}}
                   {{--<div class="col-sm-8">{{Auth::user()->email}}</div><hr>--}}
                   {{--<div class="col-sm-4">User Name:</div><hr>--}}
                   {{--<div class="col-sm-8">{{Auth::user()->user_name}}</div><hr> --}}
                 {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-sm-4 text-center my-auto">--}}
                  {{--<div class="h4 mb-0 text-primary" style="color: #02b3e4!important;">{{$noss}}/{{Auth::user()->nos}}</div>--}}
                  {{--<div class="small text-muted">Number of Students</div>--}}
                  {{--<hr>--}}
                  {{--<div class="h4 mb-0 text-warning">{{$test->count()}}</div>--}}
                  {{--<div class="small text-muted">Number of test</div>--}}
                  {{--<hr>--}}
                {{----}}
                {{--</div>--}}
              {{--</div>--}}
              {{--<div class="w3-container">--}}
 {{----}}

  {{--<blockquote class="w3-panel w3-leftbar w3-light-grey">--}}
    {{--<p class="w3-large" style="border-left: 5px solid #02b3e4; padding-left: 10px;background: none"><i> {{Auth::user()->cdescription}}</i></p>--}}
    {{--<p>{{Auth::user()->name}}</p>--}}
  {{--</blockquote> --}}
{{--</div>--}}
            {{--</div>--}}
            {{--<div class="card-footer small text-muted">User Information</div>--}}
          {{--</div> --}}
          <!-- Card Columns Example Social Feed-->
<!--           <div class="mb-0 mt-4">
            <i class="fa fa-newspaper-o"></i> News Feed</div>
          <hr class="mt-2">
          <div class="card-columns">

            <div class="card mb-3">
              <a href="#">
                <img class="card-img-top img-fluid w-100" src="https://unsplash.it/700/450?image=610" alt="">
              </a>
              <div class="card-body">
                <h6 class="card-title mb-1"><a href="#">David Miller</a></h6>
                <p class="card-text small">These waves are looking pretty good today!
                  <a href="#">#surfsup</a>
                </p>
              </div>
              <hr class="my-0">
              <div class="card-body py-2 small">
                <a class="mr-3 d-inline-block" href="#">
                  <i class="fa fa-fw fa-thumbs-up"></i>Like</a>
                <a class="mr-3 d-inline-block" href="#">
                  <i class="fa fa-fw fa-comment"></i>Comment</a>
                <a class="d-inline-block" href="#">
                  <i class="fa fa-fw fa-share"></i>Share</a>
              </div>
              <hr class="my-0">
              <div class="card-body small bg-faded">
                <div class="media">
                  <img class="d-flex mr-3" src="http://placehold.it/45x45" alt="">
                  <div class="media-body">
                    <h6 class="mt-0 mb-1"><a href="#">John Smith</a></h6>Very nice! I wish I was there! That looks amazing!
                    <ul class="list-inline mb-0">
                      <li class="list-inline-item">
                        <a href="#">Like</a>
                      </li>
                      <li class="list-inline-item">·</li>
                      <li class="list-inline-item">
                        <a href="#">Reply</a>
                      </li>
                    </ul>
                    <div class="media mt-3">
                      <a class="d-flex pr-3" href="#">
                        <img src="http://placehold.it/45x45" alt="">
                      </a>
                      <div class="media-body">
                        <h6 class="mt-0 mb-1"><a href="#">David Miller</a></h6>Next time for sure!
                        <ul class="list-inline mb-0">
                          <li class="list-inline-item">
                            <a href="#">Like</a>
                          </li>
                          <li class="list-inline-item">·</li>
                          <li class="list-inline-item">
                            <a href="#">Reply</a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer small text-muted">Posted 32 mins ago</div>
            </div>

            <div class="card mb-3">
              <a href="#">
                <img class="card-img-top img-fluid w-100" src="https://unsplash.it/700/450?image=180" alt="">
              </a>
              <div class="card-body">
                <h6 class="card-title mb-1"><a href="#">John Smith</a></h6>
                <p class="card-text small">Another day at the office...
                  <a href="#">#workinghardorhardlyworking</a>
                </p>
              </div>
              <hr class="my-0">
              <div class="card-body py-2 small">
                <a class="mr-3 d-inline-block" href="#">
                  <i class="fa fa-fw fa-thumbs-up"></i>Like</a>
                <a class="mr-3 d-inline-block" href="#">
                  <i class="fa fa-fw fa-comment"></i>Comment</a>
                <a class="d-inline-block" href="#">
                  <i class="fa fa-fw fa-share"></i>Share</a>
              </div>
              <hr class="my-0">
              <div class="card-body small bg-faded">
                <div class="media">
                  <img class="d-flex mr-3" src="http://placehold.it/45x45" alt="">
                  <div class="media-body">
                    <h6 class="mt-0 mb-1"><a href="#">Jessy Lucas</a></h6>Where did you get that camera?! I want one!
                    <ul class="list-inline mb-0">
                      <li class="list-inline-item">
                        <a href="#">Like</a>
                      </li>
                      <li class="list-inline-item">·</li>
                      <li class="list-inline-item">
                        <a href="#">Reply</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="card-footer small text-muted">Posted 46 mins ago</div>
            </div>

            <div class="card mb-3">
              <a href="#">
                <img class="card-img-top img-fluid w-100" src="https://unsplash.it/700/450?image=281" alt="">
              </a>
              <div class="card-body">
                <h6 class="card-title mb-1"><a href="#">Jeffery Wellings</a></h6>
                <p class="card-text small">Nice shot from the skate park!
                  <a href="#">#kickflip</a>
                  <a href="#">#holdmybeer</a>
                  <a href="#">#igotthis</a>
                </p>
              </div>
              <hr class="my-0">
              <div class="card-body py-2 small">
                <a class="mr-3 d-inline-block" href="#">
                  <i class="fa fa-fw fa-thumbs-up"></i>Like</a>
                <a class="mr-3 d-inline-block" href="#">
                  <i class="fa fa-fw fa-comment"></i>Comment</a>
                <a class="d-inline-block" href="#">
                  <i class="fa fa-fw fa-share"></i>Share</a>
              </div>
              <div class="card-footer small text-muted">Posted 1 hr ago</div>
            </div>

            <div class="card mb-3">
              <a href="#">
                <img class="card-img-top img-fluid w-100" src="https://unsplash.it/700/450?image=185" alt="">
              </a>
              <div class="card-body">
                <h6 class="card-title mb-1"><a href="#">David Miller</a></h6>
                <p class="card-text small">It's hot, and I might be lost...
                  <a href="#">#desert</a>
                  <a href="#">#water</a>
                  <a href="#">#anyonehavesomewater</a>
                  <a href="#">#noreally</a>
                  <a href="#">#thirsty</a>
                  <a href="#">#dehydration</a>
                </p>
              </div>
              <hr class="my-0">
              <div class="card-body py-2 small">
                <a class="mr-3 d-inline-block" href="#">
                  <i class="fa fa-fw fa-thumbs-up"></i>Like</a>
                <a class="mr-3 d-inline-block" href="#">
                  <i class="fa fa-fw fa-comment"></i>Comment</a>
                <a class="d-inline-block" href="#">
                  <i class="fa fa-fw fa-share"></i>Share</a>
              </div>
              <hr class="my-0">
              <div class="card-body small bg-faded">
                <div class="media">
                  <img class="d-flex mr-3" src="http://placehold.it/45x45" alt="">
                  <div class="media-body">
                    <h6 class="mt-0 mb-1"><a href="#">John Smith</a></h6>The oasis is a mile that way, or is that just a mirage?
                    <ul class="list-inline mb-0">
                      <li class="list-inline-item">
                        <a href="#">Like</a>
                      </li>
                      <li class="list-inline-item">·</li>
                      <li class="list-inline-item">
                        <a href="#">Reply</a>
                      </li>
                    </ul>
                    <div class="media mt-3">
                      <a class="d-flex pr-3" href="#">
                        <img src="http://placehold.it/45x45" alt="">
                      </a>
                      <div class="media-body">
                        <h6 class="mt-0 mb-1"><a href="#">David Miller</a></h6>
                        <img class="img-fluid w-100 mb-1" src="https://unsplash.it/700/450?image=789" alt="">I'm saved, I found a cactus. How do I open this thing?
                        <ul class="list-inline mb-0">
                          <li class="list-inline-item">
                            <a href="#">Like</a>
                          </li>
                          <li class="list-inline-item">·</li>
                          <li class="list-inline-item">
                            <a href="#">Reply</a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer small text-muted">Posted yesterday</div>
            </div>
          </div>

        </div> -->
    <!--     <div class="col-lg-4">

          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-pie-chart"></i> Pie Chart Example</div>
            <div class="card-body">
              <canvas id="myPieChart" width="100%" height="100"></canvas>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>

          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-bell-o"></i> Feed Example</div>
            <div class="list-group list-group-flush small">
              <a class="list-group-item list-group-item-action" href="#">
                <div class="media">
                  <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/45x45" alt="">
                  <div class="media-body">
                    <strong>David Miller</strong>posted a new article to
                    <strong>David Miller Website</strong>.
                    <div class="text-muted smaller">Today at 5:43 PM - 5m ago</div>
                  </div>
                </div>
              </a>
              <a class="list-group-item list-group-item-action" href="#">
                <div class="media">
                  <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/45x45" alt="">
                  <div class="media-body">
                    <strong>Samantha King</strong>sent you a new message!
                    <div class="text-muted smaller">Today at 4:37 PM - 1hr ago</div>
                  </div>
                </div>
              </a>
              <a class="list-group-item list-group-item-action" href="#">
                <div class="media">
                  <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/45x45" alt="">
                  <div class="media-body">
                    <strong>Jeffery Wellings</strong>added a new photo to the album
                    <strong>Beach</strong>.
                    <div class="text-muted smaller">Today at 4:31 PM - 1hr ago</div>
                  </div>
                </div>
              </a>
              <a class="list-group-item list-group-item-action" href="#">
                <div class="media">
                  <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/45x45" alt="">
                  <div class="media-body">
                    <i class="fa fa-code-fork"></i>
                    <strong>Monica Dennis</strong>forked the
                    <strong>startbootstrap-sb-admin</strong>repository on
                    <strong>GitHub</strong>.
                    <div class="text-muted smaller">Today at 3:54 PM - 2hrs ago</div>
                  </div>
                </div>
              </a>
              <a class="list-group-item list-group-item-action" href="#">View all activity...</a>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>
        </div> -->
      </div></div>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> <b>List of Exams </b></div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                   <th>Exam Name</th>
                  <th>Start Time</th>
                  <th>Duration</th>
                    <th>Live for</th>
                  <th>Exam Code</th>
                  <th>Status</th>

                  <th>Result</th>
                    <th>Progress</th>

                  <th>Update</th>
                </tr>
              </thead>
              {{--<tfoot>--}}
                {{--<tr>--}}
                    {{--<th>Name</th>--}}
                  {{--<th>Starting Time</th>--}}
                  {{--<th>Duration</th>--}}
                  {{--<th>Exam Code</th>--}}
                  {{--<th>Status</th>--}}
                  {{----}}
                  {{--<th>Result</th>--}}
                  {{--<th>Update</th>--}}
                {{--</tr> --}}
              {{--</tfoot>--}}
              <tbody>
                @foreach($test as $testk)
                <?php
                 $f = $testk->duration;
                 $ex = $testk->time_live;
                 $ex = (int)$ex*60;
                 $f = (int)$f*60+$ex;
                 $date = new DateTime($testk->livetime,new DateTimeZone('Asia/Kolkata'));
                 $pre = $date->getTimestamp();
                 $teler = $pre - time();
                 $c11 = '';
                $c21 = "href=/admin_views/progress/{$testk->id}";
                 if( $teler > 0 ){
                  $k='Not Active';
                  $c='#ffff00';
                 }
                 elseif($teler>-1*$f && $teler < 0){
                  $k = 'Active';
                  $c= '#00ff00';
                  }
                 if($teler< -1*$f){
                  $c ='#ff0000';
                  $k='Over';
                  $c11 = "href=/admin_views/get_results/{$testk->exam_code}";
                 }
                ?>
              <tr>
                <td><a href="/admin_views/see/{{$testk->id}}" style="color: #02b3e4">{{$testk->test_name}}</a></td>
                  <td>{{substr($testk->livetime,2)}}</td>
                  <td>{{$testk->duration}} Min</td>
                  <td>{{$testk->time_live}} Min</td>
                  <td>{{$testk->exam_code}}</td>

                  <td style=" border-bottom: 5px solid <?=$c?>; ">{{$k}}</td>

                  <td><a {{$c11}}>Results </a> </td>
                  <td><a {{$c21}}>Progresss </a> </td>
                  <td><a href="/admin_views/update_test/{{$testk->id}}">Update</a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
            <div class="card-footer small text-muted" style="background: none"><solid style='color: #000'>*Exams cannot be updated if they are currently running completed or over. <br>

                </solid></div>
        </div>
          <br><br>
          <!-- Example DataTables Card-->
          <div class="card mb-3">
              <div class="card-header">
                  <i class="fa fa-table"></i> <b>List of Public Exams </b></div>

              <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                          <thead>
                          <tr>
                              <th>Exam Name</th>

                              <th>Duration</th>
                              <th>Exam Code</th>
                              <th>Result</th>

                          </tr>
                          </thead>
                          {{--<tfoot>--}}
                          {{--<tr>--}}
                          {{--<th>Name</th>--}}
                          {{--<th>Starting Time</th>--}}
                          {{--<th>Duration</th>--}}
                          {{--<th>Exam Code</th>--}}
                          {{--<th>Status</th>--}}
                          {{----}}
                          {{--<th>Result</th>--}}
                          {{--<th>Update</th>--}}
                          {{--</tr> --}}
                          {{--</tfoot>--}}
                          <tbody>
                          @foreach($exam as $testk)

                              <tr>
                                  <td><a href="/admin_views/see/{{$testk->id}}" style="color: #02b3e4">{{$testk->test_name}}</a></td>

                                  <td>{{$testk->duration}} h</td>
                                  <td>{{$testk->exam_code}}</td>



                                  <td><a href="/admin_views/get_results/{{$testk->exam_code}}">Results </a> </td>


                              </tr>
                          @endforeach
                          </tbody>
                      </table>
                  </div>
                  {{--<div class="card-footer small text-muted" style="background: none"><solid style='color: #ff5483'>!! Exams cannot be updated if they are currently running completed or Over.!!<br>--}}
                          {{--!!You can fetch exam's information by clicking on its Name.!!</solid></div>--}}
              </div>

     @endsection

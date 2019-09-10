@extends('layouts.frame')

      @section('inside')
      <li class="breadcrumb-item active">View All Exams </li>
      </ol>

     <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> <b>List of Exams </b> </div>

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
                  {{--<th>Start Time</th>--}}
                  {{--<th>Duration</th>--}}
                  {{--<th>Exam Code</th>--}}
                  {{--<th>Status</th>--}}
                {{----}}
                  {{--<th>Get Result</th>--}}
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
                 $c11='';
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
                $c21 = "href=/admin_views/progress/{$testk->id}";
                ?>
              <tr>
                <td><a href="/admin_views/see/{{$testk->id}}" style="color: #02b3e4">{{$testk->test_name}}</a></td>
                  <td>{{substr($testk->livetime,2)}}</td>
                  <td>{{$testk->duration}} Min</td>
                  <td>{{$testk->time_live}} Min</td>
                  <td>{{$testk->exam_code}}</td>
              
                  <td style=" border-bottom: 5px solid <?=$c?>; ">{{$k}}</td>
                 
                  <td><a {{$c11}}>Results</a></td>
                  <td><a {{$c21}}>Progress</a></td>
                  <td><a href="/admin_views/update_test/{{$testk->id}}">Update</a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
            <div class="card-footer small text-muted" style="background: none"><solid style='color: #000'>*Exams cannot be updated if they are currently running completed or Over.</solid></div>
            {{--<div class="card-footer small text-muted"><solid style='color: red'>!! Any item cannot be updated if test running or after the is over.!!</solid></div>--}}
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
                         {{--<th>Start Time</th>--}}
                         {{--<th>Duration</th>--}}
                         {{--<th>Exam Code</th>--}}
                         {{--<th>Status</th>--}}
                         {{----}}
                         {{--<th>Get Result</th>--}}
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

 </div>
       

      @endsection      
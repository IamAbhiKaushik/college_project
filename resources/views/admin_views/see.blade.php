@extends('layouts.frame')

      @section('inside')

        <li class="breadcrumb-item active">View {{$testk->test_name}} </li>

      </ol>
        @if($new!=null)
            <h4>New test Created with number of question : {{$new}}</h4><br><hr>
        @endif
      <div class='row'>
        <div class="col-sm-3">Exam Name:</div>
        <div class="col-sm-9">{{$testk->test_name}}</div>
      </div><hr>
      <div class='row'>
        <div class="col-sm-3">Exam Code:</div>
        <div class="col-sm-9">{{$testk->exam_code}}</div>
      </div><hr>
      <div class='row'>
        <div class="col-sm-3">Exam StartTime:</div>
        <div class="col-sm-9">{{$testk->livetime}}</div>
      </div><hr>
      <div class='row'>
        <div class="col-sm-3">Exam Duration:</div>
        <div class="col-sm-9">{{$testk->duration}}</div>
      </div><hr>
        <div class='row'>
            <div class="col-sm-3">Batch</div>
            <div class="col-sm-9">{{$testk->tag}}</div>
        </div><hr>
      <div class='row'>
        <div class="col-sm-3">Exam PDF:</div>
        <div class="col-sm-9"><a href="{{$testk->id}}/pdf">HERE</a></div>
                      </div><hr>
      <div class='row'>
        <div class="col-sm-3">Question Details:</div>
        <div class="col-sm-9"><a href="/admin_views/question_details/{{$testk->id}}">HERE</a></div>
      </div><hr>
        <div class='row'>
            <div class="col-sm-3">Solutions:</div>
            <div class="col-sm-9"><a href="{{$testk->id}}/solution">HERE</a></div>
        </div><hr>
        @if($testk->public_exam==1)
            <div class='row'>
                <div class="col-sm-3">Topics:</div>
                <div class="col-sm-9">{{$testk->topics}}</div>
            </div><hr>
        @endif
       <div class='row'>
        <div class="col-sm-3">Exam Admin:</div>
        <div class="col-sm-9">{{$testk->coach_id}}</div>
      </div><hr><hr>
        <div class='row'>
            <div class="col-sm-1" style="margin-bottom: 10px">
                <button class="btn btn-primary" onclick="showInfo('{{$testk->exam_code}}')">Preview</button>
            </div>
            <div class="col-sm-1" style="margin-bottom: 10px" >
      <button onclick="location.href = '/admin_views/update_test/{{$testk->id}}';" type="button" class="btn btn-primary">Update</button></div>
      {{--<div class="col-sm-1" >--}}
       {{--<form method='POST' action="/admin_views/delete" >--}}
           {{--{{ csrf_field() }}--}}
         {{--<input type="hidden" value="{{$testk->id}}" name="id" />--}}
          {{--<button type="submit" class="btn btn-danger">Delete</button>--}}
     {{--</form>    </div>--}}

        </div>
     
      </div>


       <script>
           function showInfo(id){
               var url = '/easylrnx/'+id;
               window.open(url,"myWindow",
                   "width=1820,height=1500,menubar=no,status=no,location=no");
               myWindow.focus();                                     // Assures that the new window gets focus
           }
       </script>

      @endsection      
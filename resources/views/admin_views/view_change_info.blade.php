@extends('layouts.frame')

      @section('inside')

        <li class="breadcrumb-item active">Update User Information</li>
      </ol>

        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-user-o"></i> Your Institute Information </div>
            <div class="card-body">
                @if(session("val"))
                    <div class="alert alert-info" style="text-align: center">
                        <strong>{{session("val")}}</strong>
                    </div>
                @endif
                <div class="row">
                    <div class="col-sm-8 my-auto">
                        <div class="row">
                            <div class="col-sm-4">Name:</div><hr>
                            <div class="col-sm-8">{{Auth::user()->name}}</div><hr>
                            <div class="col-sm-4">Coaching Name:</div><hr>
                            <div class="col-sm-8">{{Auth::user()->coachingName}}</div><hr>
                            <div class="col-sm-4">Email:</div><hr>
                            <div class="col-sm-8">{{Auth::user()->email}}</div><hr>
                            <div class="col-sm-4">User Name:</div><hr>
                            <div class="col-sm-8">{{Auth::user()->user_name}}</div><hr>
                        </div>
                    </div>
                    <div class="col-sm-4 text-center my-auto">
                        <div class="h4 mb-0 text-primary" style="color: #02b3e4!important;">{{$noss+5}}/{{Auth::user()->nos}}+<span style="color: red">5</span></div>
                        <div class="small text-muted">Number of Students</div>
                        <hr>
                        <div class="h4 mb-0 text-warning">{{$test->count()}}</div>
                        <div class="small text-muted">Number of test</div>
                        <hr>

                    </div>
                </div>
                <div class="w3-container">


                    <blockquote class="w3-panel w3-leftbar w3-light-grey">
                        <p class="w3-large" style="border-left: 5px solid #02b3e4; padding-left: 10px;background: none"><i> {{Auth::user()->cdescription}}</i></p>
                        <p>{{Auth::user()->name}}</p>
                    </blockquote>
                </div>
            </div>
            {{--<div class="card-footer small text-muted">User Information</div>--}}
        </div>

        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-user-o"></i> Update Information </div>
            <div class="card-body">
                @if(session("val"))
                <div class="alert alert-info" style="text-align: center">
                    <strong>{{session("val")}}</strong>
                </div>
                @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif<hr>
                    <form method='POST' action="/admin_views/change_info"  enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="test_name">User Name:</label>
                            <input type="text" class="form-control" id="user" value="{{Auth::user()->name}}" placeholder="{{Auth::user()->name}}" name="name" >

                        </div>


                        <div class="form-group">
                            <label for="excel">E-mail:</label>
                            <input type="email" class="form-control" id="email" value="{{Auth::user()->email}}" placeholder="{{Auth::user()->email}}" name="email">

                        </div>

                        <div class="form-group">
                            <label for="excel">Coaching Name:</label>
                            <input type="text" class="form-control" id="coachingName" value="{{Auth::user()->coachingName}}" placeholder="{{Auth::user()->coachingName}}" name="coachingName">

                        </div>
                        <div class="form-group">
                            <label for="excel">Coaching Descrption:</label>
                            <textarea class="form-control" id="cdescription" value="{{Auth::user()->cdescription}}" placeholder="{{Auth::user()->cdescription}}" name="cdescription">{{Auth::user()->cdescription}}</textarea>

                        </div>
                        <div class="form-group">
                            <label for="logo">Coaching Logo:</label>
                            <input class="form-control" type="file" name="logo" accept="image/*">
                        </div>

                        <button type="submit" class="btn btn-primary" style="background-color: #02b3e4;
    border-color: #02b3e4;">Submit your updates</button>
                    </form>

                {{--<div class="w3-container">--}}


                    {{--<blockquote class="w3-panel w3-leftbar w3-light-grey">--}}
                        {{--<p class="w3-large" style="border-left: 5px solid #02b3e4; padding-left: 10px;background: none"><i> {{Auth::user()->cdescription}}</i></p>--}}
                        {{--<p>{{Auth::user()->name}}</p>--}}
                    {{--</blockquote>--}}
                {{--</div>--}}
            </div>
            {{--<div class="card-footer small text-muted">User Information</div>--}}
        </div>

  {{--<div class="container">--}}
 	 {{--<h2>Update Your Information ({{Auth::user()->user_name}})</h2>--}}
 	  {{--@if ($errors->any())--}}
    {{--<div class="alert alert-danger">--}}
        {{--<ul>--}}
            {{--@foreach ($errors->all() as $error)--}}
                {{--<li>{{ $error }}</li>--}}
            {{--@endforeach--}}
        {{--</ul>--}}
    {{--</div>--}}
{{--@endif<hr>--}}
  		{{--<form method='POST' action="/admin_views/change_info"  enctype="multipart/form-data">--}}
            {{--{{ csrf_field() }}--}}
    		{{--<div class="form-group">--}}
      			{{--<label for="test_name">User Name:</label>--}}
      		{{--<input type="text" class="form-control" id="user" value="{{Auth::user()->name}}" placeholder="{{Auth::user()->name}}" name="name" >--}}
      			{{----}}
    		{{--</div>--}}
    		{{----}}

    		{{--<div class="form-group">--}}
      			{{--<label for="excel">E-mail:</label>--}}
     			{{--<input type="email" class="form-control" id="email" value="{{Auth::user()->email}}" placeholder="{{Auth::user()->email}}" name="email">--}}
     		{{----}}
    		{{--</div>--}}

          {{--<div class="form-group">--}}
            {{--<label for="excel">Coaching Name:</label>--}}
          {{--<input type="text" class="form-control" id="coachingName" value="{{Auth::user()->coachingName}}" placeholder="{{Auth::user()->coachingName}}" name="coachingName">--}}
        {{----}}
        {{--</div>--}}
         {{--<div class="form-group">--}}
            {{--<label for="excel">Coaching Descrption:</label>--}}
          {{--<textarea class="form-control" id="cdescription" value="{{Auth::user()->cdescription}}" placeholder="{{Auth::user()->cdescription}}" name="cdescription">{{Auth::user()->cdescription}}</textarea>--}}
        {{----}}
        {{--</div>--}}
            {{--<div class="form-group">--}}
                {{--<label for="logo">Coaching Logo:</label>--}}
                {{--<input class="form-control" type="file" name="logo" accept="image/*">--}}
            {{--</div>--}}

    			{{--<button type="submit" class="btn btn-primary" style="background-color: #02b3e4;--}}
    {{--border-color: #02b3e4;">Submit your updates</button>--}}
 		 {{--</form>--}}

 		{{----}}
 {{--</div>--}}
       

      @endsection      
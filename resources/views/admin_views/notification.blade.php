@extends('layouts.frame')

@section('inside')

    <li class="breadcrumb-item active">Notification </li>
    </ol>

    {{--<h1>Notification for batch {{$st_id}}</h1><br><hr><br>--}}
    <div class="container">
        {{--<h3>Notifications</h3><br>--}}
    <?php date_default_timezone_set('Asia/Kolkata'); ?>
    @foreach($notif as $t)
    <div class="panel panel-info col-sm-7" style="background:#42f4df;padding: 10px;border-radius:5px ">
        <form id="formal" action="/admin_views/delete_notif" method="POST">
            {{@csrf_field()}}
            <input type="hidden" name="iid" value="{{$t->id}}" />
        </form>
        <div class="panel-body">{{$t->message}} <span class="badge"  style="background: red;color: white"><a href="/admin_views/delete_notif" onclick="event.preventDefault();document.getElementById('formal').submit();">Delete</a></span></div>
        <div class="panel-footer"><p style="color:red;font-size:13px">{{date("Y-m-d H:i:s", $t->time)}}</p></div>
    </div><hr>
    @endforeach
    <form method="POST" action="/admin_views/add_notification">
        {{@csrf_field()}}
        <div class="form-group col-sm-6">
            <label for="comment"><b>Send new notification to this batch:</b></label><br><br>
            <textarea class="form-control" onclick="myFunction()" id="comment" name="message">Enter new notification for {{$st_id}}</textarea>
            <input type="hidden" value="{{$st_id}}" name="st_id">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    </div>
   @section('scripts')
   <script>
       x=0;
       function myFunction() {
           if(x==0) {
               document.getElementById("comment").innerHTML = "";
           }
       }
   </script>
   @endsection
@endsection

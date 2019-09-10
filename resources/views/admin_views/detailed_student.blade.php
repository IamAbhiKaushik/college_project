@extends('layouts.frame')

@section('inside')
    <li class="breadcrumb-item active">View All Students in batch <strong>{{$batch}}</strong></li>
    </ol>


    <div class="card mb-3">

        <div class="card-header">
            <i class="fa fa-table"></i> Student Details <b style="width: 50%; margin: 0 auto; text-align: left"></b> </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Roll No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Performance</th>
                        <th>Status</th>


                    </tr>
                    </thead>
                    <tfoot>
                    {{--<tr>--}}
                        {{--<th>Roll No</th>--}}
                        {{--<th>Name</th>--}}
                        {{--<th>Fetch Info</th>--}}


                    {{--</tr>--}}
                    </tfoot>
                    <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{$student->coaching_rollno}}</td>
                            <td>{{$student->name}}</td>
                            <td>{{$student->email}}</td>
                            <td><a href="/admin_views/fetch_student/{{$student->username}}">{{$student->username}}</a></td>
                            @if($student->status == 1)
                                <td>Inactive / <a href="/admin_views/manage_students/{{$student->id}}">Re-activate</a></td>
                            @else<td>Active</td>
                            @endif

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{--<div class="card-footer small text-muted"><solid style='color: red'>!! Any item cannot be updated if test running or after the is over.!!</solid></div>--}}



 <br><br>

    <div class="row" >
        {{--<div class="col-sm-1" style="margin-bottom: 10px">--}}
            {{--<button onclick="location.href = '/admin_views/delete_students';" type="button" class="btn btn-danger">Delete</button>--}}
        {{--</div>--}}
        {{--<div class="col-sm-3" style="margin-bottom: 10px;margin-right: -40px">--}}
            {{--<button onclick="location.href='/admin_views/notification/{{$batch}}';" type="button" class="btn btn-primary">Send Notification to Batch</button>--}}
        {{--</div>--}}
            <div class="col-sm-1">
                <button onclick="location.href='/admin_views/download_students/{{$batch}}';" type="button" class="btn btn-primary">Download</button>
            </div>
    </div>
    </div>
    </div>
@endsection
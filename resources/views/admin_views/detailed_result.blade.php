@extends('layouts.frame')

@section('inside')
    <li class="breadcrumb-item active">Result for Your Exam <strong>Exam Name</strong></li>
    </ol>


    <div class="card mb-3">

        <div class="card-header">
            <i class="fa fa-table"></i> Student Details (Registered students will be shown with there names)<b style="width: 50%; margin: 0 auto; text-align: left"></b> </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Roll No</th>
                        <th>total Attempt</th>
                        <th>total Correct</th>
                        <th>Total Marks</th>
                        <th>Student Rank</th>


                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Roll No</th>
                        <th>total Attempt</th>
                        <th>total Correct</th>
                        <th>Total Marks</th>
                        <th>Student Rank</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($results as $result)
                        <tr>

                           
                            <td><a href="/admin_views/student_results/{{$result->id}}">{{ json_decode($result->result)->name}}</a></td>
                            <td>{{ json_decode($result->result)->roll_no}}</td>
                            <td>{{ array_sum(explode(",",json_decode($result->result)->totalQ))-array_sum(explode(",",json_decode($result->result)->totalNotAttempted)) }}</td>
                            <td>{{ array_sum(explode(",",json_decode($result->result)->totalCorrect)) }}</td>
                            <td>{{ array_sum(explode(",",json_decode($result->result)->totalM)) }}</td>
                            {{--<td>{{ json_decode($result->result)->totalCorrect}}</td>--}}
                            {{--<td>{{ json_decode($result->result)->totalMarks }}</td>--}}
                            <td>{{ $result->examRank}}</td>

                            {{--                            <td>{{ json_decode($result->$result)->totalAttempt}}</td>--}}
{{--                            <td>{{json_decode($result->$result)->totalCorrect}}</td>--}}

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer small text-muted"><solid style='color: red'>!! Any item cannot be updated if test running or after the is over.!!</solid></div>
        </div>



    </div>
    <div id="student" style="display: none">{{$srr}}</div>
    <div id="marks" style="display: none">{{$arr}}</div>
    <div id="avg" style="display: none">{{$avg}}</div>
    <div id="qno" style="display: none">{{$qno}}</div>

    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-area-chart"></i>Trend in total marks Rank wise</div>
        <div class="card-body">
            <div id="myAreaChart-main-1" style="width:100%;height: 400px;"></div>
        </div>
        <div class="card-footer small text-muted">Updated</div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-area-chart"></i>Average time per question</div>
        <div class="card-body">
            <div id="myAreaChart-main-2" style="width:100%;height: 400px;"></div>
        </div>
        <div class="card-footer small text-muted">Updated</div>
    </div>


    <button onclick="location.href = '/admin_views/download_result/{{$exam_code}}';" type="button" class="btn btn-primary">Download Result</button>


    <hr>


@endsection
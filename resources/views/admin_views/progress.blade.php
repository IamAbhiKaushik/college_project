@extends('layouts.frame')
@section('inside')
    <li class="breadcrumb-item active">View All Batches </li>
    </ol>
    <br>

    <div class="card mb-3">

        <div class="card-header">
            <i class="fa fa-table"></i> List of students who Attempted the exam {{$exam->test_name}}<b style="width: 50%; margin: 0 auto; text-align: left"></b> </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Roll No</th>
                        <th>Batch</th>



                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Roll No</th>
                        <th>Batch</th>

                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($data as $result)
                        <tr>


                            <td>{{$result->name}}</td>
                            <td>{{$result->coaching_rollno}}</td>
                            <td>{{$result->coaching_batch}}</td>
                            {{--<td>{{ json_decode($result->result)->totalCorrect}}</td>--}}
                            {{--<td>{{ json_decode($result->result)->totalMarks }}</td>--}}


                            {{--                            <td>{{ json_decode($result->$result)->totalAttempt}}</td>--}}
                            {{--                            <td>{{json_decode($result->$result)->totalCorrect}}</td>--}}

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{--<div class="card-footer small text-muted"><solid style='color: red'>!! Any item cannot be updated if test running or after the is over.!!</solid></div>--}}
        </div>



    </div>


@endsection
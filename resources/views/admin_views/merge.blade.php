@extends('layouts.frame')

@section('inside')

    <li class="breadcrumb-item active">Merge Test</li>
    </ol>
    <div class="container">
    <form method='POST' action="/admin_views/make_merge" >
        {{@csrf_field()}}


        <div class="form-group col-sm-6">
            <label>Select First Exam</label>
            <select class="form-control" id="type" name="one" required>
                @foreach($exam as $e)
                <option value="{{$e->id}}">{{$e->test_name}}</option>
                @endforeach

                {{--<option>First batch</option>--}}
            </select>
            {{--<input type="text" class="form-control" id="student_tag" placeholder="Add Batch" name="student_tag" value="null">--}}

        </div>
   <br>
        <div class="form-group col-sm-6">
            <label>Select Second Exam</label>
            <select class="form-control" id="type" name="two" required>
                @foreach($exam as $e)
                    <option value="{{$e->id}}">{{$e->test_name}}</option>
                @endforeach

                {{--<option>First batch</option>--}}
            </select>
            {{--<input type="text" class="form-control" id="student_tag" placeholder="Add Batch" name="student_tag" value="null">--}}

        </div>
<br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>


    </div>
    </div>

@endsection
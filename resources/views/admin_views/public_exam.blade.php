@extends('layouts.frame')
@section('header')
    <style>
        label {
            font-weight: bold;
        }
    </style>
@endsection
@section('inside')

    <li class="breadcrumb-item active">Create New Public Exam </li>
    </ol>

    <div class="container">
        <h2>Create New Public Exam</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif<hr>
        <form method='POST' action="/admin_views/store_public"  enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group row">
                <label class="col-sm-6" for="test_name">Exam Name: </label>
                <input type="text" class="form-control col-sm-6" id="test name" placeholder="Enter test name" name="test_name" required>

            </div><hr>
            <div class="form-group row">
                <label class="col-sm-6">Select Exam Type</label>
                <select class="form-control col-sm-6" id="type" name="type" required>
                    <option value="ADVANCE">JEE ADVANCE</option>

                    <option value="MAINS">JEE MAINS</option>

                    <option value="OTHER">OTHER</option>
                    {{--<option>First batch</option>--}}
                </select>
                {{--<input type="text" class="form-control col-sm-6" id="student_tag" placeholder="Add Batch" name="student_tag" value="null">--}}

            </div>
    <hr>
    <div class="form-group row">
        <label class="col-sm-6" for="max_marks">Maximum Marks of Exam</label>
        <input type="number" class="form-control col-sm-6" id="max_marks" placeholder="Maximum Marks" name="max_marks" min="0" oninput="validity.valid||(value='');" required>

    </div>
    <hr>
    <div class="form-group row">
        <label class="col-sm-6" for="duration">Exam Duration in hours</label>
        <input type="number" class="form-control col-sm-6" id="duration" placeholder="Exam Duration" name="duration" min="0" oninput="validity.valid||(value='');" required>

    </div>
    <hr>
            <div class="form-group row">
                <label class="col-sm-6" for="pdf">Choose Question Paper PDF (Statement Size Page) (<a href="https://goo.gl/FUHZXM" target="_blank">Download sample  File</a>)</label>
                <input type="file" accept="application/pdf" class="form-control col-sm-6" id="pdf" placeholder="Choose PDF" name="pdf" required>

            </div><hr>
            <div class="form-group row">
                <label class="col-sm-6" for="excel">Choose Answer Sheet (only .xlsx) (<a href="http://bit.ly/2LAVnZl" target="_blank">Download sample Format Here</a>)</label>
                <input type="file" accept="application/xlsx" class="form-control col-sm-6" id="excel" placeholder="Choose Excel" name="excel" required>

            </div><hr>





            <div class="form-group row">
                <label class="col-sm-6" for="solution">Choose PDF for solution (<a href="https://goo.gl/FUHZXM" target="_blank">Download sample File</a>)</label>
                <input type="file" accept="application/pdf" class="form-control col-sm-6" id="solution" placeholder="Choose PDF" name="solution">

            </div>
<hr>
            <div class="form-group row">
                <label class="col-sm-6" for="solution">Add multiple topics seperated by ","</label>
                <input type="text" class="form-control col-sm-6" id="solution" placeholder="Add Topic" name="topic">

            </div>
<hr>

    <div class="form-group row">
        <label class="col-sm-6">Select Level [1(Easiest)-5(Hardest)]</label>
        <select class="form-control col-sm-6" id="type" name="difficulty" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>


            {{--<option>First batch</option>--}}
        </select>
        {{--<input type="text" class="form-control col-sm-6" id="student_tag" placeholder="Add Batch" name="student_tag" value="null">--}}

    </div><hr>
    <?php
    date_default_timezone_set('Asia/Kolkata');
    $now = date('Y-m-d h:i', time());

    ?>
    <input type='hidden' id='livetime' class="form-control col-sm-6" name="livetime" value="{{$now}}" required/>
    <input type='hidden' id='livetime' class="form-control col-sm-6" name="student_tag" value="{{null}}" required/>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>


    </div>


@endsection
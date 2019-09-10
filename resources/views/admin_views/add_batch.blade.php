@extends('layouts.frame')

@section('inside')

    <li class="breadcrumb-item active">Add a New Batch </li>
    </ol>


    <div class="container">
        <h2>Add Batch</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif<hr>
        <form method='POST' action="/admin_views/added_batch" >
            {{ csrf_field() }}
            <div class="form-group">
                <label for="student_tag"><b style="color: red"><i>Batch</i></b> (to filter Students ex. Ranker batch,11th,12th,Drop etc etc if your excel sheet have only 12th students you may like to give it a Batch likewise)</label>
                <input type="text" class="form-control" id="student_tag" placeholder="Add Batch" name="student_tag" required>

            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <p>Current Batches </p>
        <ul>
            @foreach($batches as $key=>$batch)
                <li>{{$batch->student_tag}}</li>
            @endforeach
        </ul>


    </div>


@endsection
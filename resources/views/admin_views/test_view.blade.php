@extends('layouts.frame')

@section('inside')
    <li class="breadcrumb-item active">View All Batches </li>
    </ol>

    <form method='POST' action="/admin_views/jtt" enctype="multipart/form-data">

        {{ csrf_field() }}
        <div class="form-group" >

            <input type="file" name="fileToUpload" id="fileToUpload">
        </div>


        <button type="submit" class="btn btn-danger">T</button>
    </form>

@endsection
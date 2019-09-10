@extends('layouts.frame')

@section('inside')

    <li class="breadcrumb-item active">Question Bank </li>
    </ol>

    <div class="container">
        <h2>Upload Questions</h2><br><br>
        <form class="form-horizontal" action="/topic_add" method="POST"  enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="form-group row">
                <label class="col-sm-6" for="excel">Choose Answer Sheet (only .xlsx)</label>
                <input type="file" accept="application/xlsx" class="form-control col-sm-6" id="excel" placeholder="Choose Excel" name="excel" required>

            </div><hr>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection

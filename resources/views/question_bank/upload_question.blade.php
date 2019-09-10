@extends('layouts.frame')

@section('inside')

    <li class="breadcrumb-item active">Question Bank </li>
    </ol>

<div class="container">
    <h2>Upload Questions</h2><br><br>
    <form class="form-horizontal" action="/process" method="POST"  enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label class="control-label col-sm-2" for="folder">Folder</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="folder" placeholder="Upload Folder" name="folder[]" multiple="" directory="" webkitdirectory="" mozdirectory="">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="folder">Folder solution</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="folder" placeholder="Upload Folder" name="solution[]" multiple="" directory="" webkitdirectory="" mozdirectory="">
            </div>
        </div>
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

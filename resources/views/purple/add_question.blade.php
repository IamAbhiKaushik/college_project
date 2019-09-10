<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.ckeditor.com/ckeditor5/10.0.1/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="/js/compress.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script> -->
    <title>Question bank Editor</title>
    <style type="text/css">
        body {
            padding: 30px;
        }
        .container {
            max-width: 500px;
        }
        .col-sm-6{padding-bottom: 10px; }
    </style>
</head>
<body>
@if(session('key'))
    <div class="alert alert-success">
        <strong>{{session('key')}}</strong>
    </div>

@endif



<div class="container">
    <h2><label for="editor1">Create New Question Here</label></h2>

    {{--action="/purple/add"--}}
    <form action="/purple/add" class="form-inline" id="upload_question" enctype="multipart/form-data" role="form" method="POST">
        {!! csrf_field() !!}
        <div class="form-group row" style="width: 100%;">
            <div class="col-sm-4">
                <label for="sel1">Select Subject</label>
                <select name="subject" class="form-control" required>
                    @if($req->s)
                        <option value="{{$req->s}}">{{$req->s}}</option>
                    @endif
                    <option value="">Choose subject</option>
                    <option value="P">Physics</option>
                    <option value="C">Chemistry</option>
                    <option value="M">Mathamatics</option>
                    <option value="B">Bio</option>
                </select>
            </div>
            <div class="col-sm-4">
                <label for="sel1">Select Catogery :</label>
                <select name="cat" class="form-control" required>
                    @if($req->c)
                        <option value="{{$req->c}}">{{$req->c}}</option>
                    @endif
                    <option value="0">Choose Catagory</option>
                    <option value="0">Single Correct</option>
                    <option value="1">Multiple correct</option>
                    <option value="2">Integer</option>
                    <option value="3">Integer Range</option>
                </select>
            </div>

            <div class="col-sm-4">
                <label for="sel1">Select Class(one):</label>
                <select name="class" class="form-control" required>
                    @if($req->class)
                        <option value="{{$req->class}}">{{$req->class}}</option>
                    @endif
                    <option value="">Choose Class</option>
                    <option value="11">11 Th</option>
                    <option value="12">12 Th</option>
                    <option value="10">10 Th </option>
                    <option value="9">9 Th</option>
                </select>
            </div>

            <div class="col-sm-6">
                <label for="sel1">Select SubTopic (any):</label>
                <select name="sub_cat" class="form-control" required>
                    {{--<option value="">Sub topic</option>--}}
                    <option value="{{$topics[1]->id}}">{{$topics[1]->sub_topic}}</option>
                    @foreach($topics as $topic)
                        <option value="{{$topic->id}}">{{$topic->sub_topic}}</option>
                    @endforeach
                    {{--<option value="0">Single Correct</option>--}}
                </select>
            </div>
            <div class="col-sm-6">
                <label for="sel1">Correct Answer:</label>
                <input type="text" name="answer" class="form-control" required>
            </div>

            <div class="col-sm-6">
                <label for="sel1">Correct Marks:</label>
                <input type="number" name="marks" class="form-control" required value="4">
            </div>

            <div class="col-sm-6">
                <label for="sel1">Penulty:</label>
                <input type="number" name="penulty" class="form-control" required value="0">
            </div>

            <div style="padding-bottom: 20px;">
<textarea name="question" id="editor">
    <p>Here goes the Questions.</p>
</textarea>
            </div>

            <div style="padding-bottom: 20px;">
<textarea name="solution" id="editor1">
    <p>Here goes the Solution.</p>
</textarea>
            </div>
            <div class="col-sm-6">
                <label for="sel1">Question Image</label>
                <input type="file"  class="form-control" name="question_image" accept="image/*">
            </div>

            <div class="col-sm-6">
                <label for="sel1">Solution Image:</label>
                <input type="file" class="form-control" name="solution_image" accept="image/*">
            </div>

            {{--<div>--}}
                {{--<input type="text" name="question_text" class="form-control" id="question_text" style="display: none;">--}}
                {{--<input type="text" name="solution_text" class="form-control" id="solution_text" style="display: none;">--}}
                {{--<p id="question"></p>--}}
            {{--</div>--}}

            <div class="col-sm-12">
                <input type="submit" name="submit" class="form-control col-sm-12" value="Submit new question">
            </div>

        </div>
    </form>

    {{--<div class="col-sm-12">--}}
        {{--<p id="status"></p>--}}
        {{--<button id="addQuestion" class="form-control"> Submit New Question </button>--}}
    {{--</div>--}}

    <div>
        <img src="" alt="" id="preview">
        {{--<p id="output"></p>--}}
    </div>

</div>



{{--<script>--}}
    {{--$(document).ready(function(){--}}
        {{--$("#addQuestion").click(function(){--}}
            {{--console.log('cliced, processing');--}}
            {{--$.ajax({--}}
                {{--headers: {--}}
                    {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
                {{--},--}}
                {{--url: '/purple/add',--}}
                {{--type: 'POST',--}}
                {{--data:{$dd:'Hello'},--}}
                {{--// data:{$dd : new FormData($("#upload_question"))},--}}
                {{--dataType: 'JSON',--}}
                {{--processData: false,--}}
                {{--contentType: false,--}}
                {{--success: function (data) {--}}
                    {{--$("#status").append(data.msg);--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}
    {{--});--}}
{{--</script>--}}
{{--// for compressing the uploaded file to upto 50%--}}
{{--<script type="text/javascript">--}}
    {{--const compress = new Compress()--}}
    {{--const preview = document.getElementById('preview')--}}

    {{--const question_image = document.getElementById('question_image')--}}
    {{--// const solution_image = document.getElementById('solution_image')--}}
    {{--const question_text = document.getElementById('question_text')--}}
    {{--question_image.addEventListener('change', (evt) => {--}}
        {{--const files = [...evt.target.files]--}}
        {{--compress.compress(files, {--}}
            {{--size: 1, // the max size in MB, defaults to 2MB--}}
            {{--quality: 0.40, // the quality of the image, max is 1,--}}
            {{--maxWidth: 1920, // the max width of the output image, defaults to 1920px--}}
            {{--maxHeight: 1920, // the max height of the output image, defaults to 1920px--}}
            {{--resize: true // defaults to true, set false if you do not want to resize the image width and height--}}
        {{--}).then((images) => {--}}
            {{--const img = images[0]--}}
            {{--preview.src = `${img.prefix}${img.data}`--}}
            {{--var t = `${img.prefix}${img.data}`--}}
            {{--question_text.value = t--}}
        {{--})--}}
    {{--}, false)--}}
{{--</script>--}}

{{--<script type="text/javascript">--}}
    {{--// const compress2 = new Compress()--}}
    {{--// const preview = document.getElementById('preview')--}}
    {{--const solution_image = document.getElementById('solution_image')--}}
    {{--const solution_text = document.getElementById('solution_text')--}}
    {{--solution_image.addEventListener('change', (evt) => {--}}
        {{--const files = [...evt.target.files]--}}
        {{--compress.compress(files, {--}}
            {{--size: 1, // the max size in MB, defaults to 2MB--}}
            {{--quality: 0.50, // the quality of the image, max is 1,--}}
            {{--maxWidth: 1920, // the max width of the output image, defaults to 1920px--}}
            {{--maxHeight: 1920, // the max height of the output image, defaults to 1920px--}}
            {{--resize: true // defaults to true, set false if you do not want to resize the image width and height--}}
        {{--}).then((images) => {--}}
            {{--const img = images[0]--}}
            {{--preview.src = `${img.prefix}${img.data}`--}}
            {{--var t = `${img.prefix}${img.data}`--}}
            {{--solution_text.value = t--}}
        {{--})--}}
    {{--}, false)--}}
{{--</script>--}}



<script type="text/javascript">
    ClassicEditor
        .create( document.querySelector( '#editor' ),
            {

                ckfinder: {
                    uploadUrl: '/api'
                }
            } )
        .then( editor => {
            console.log( editor );
        } )
        .catch( error => {
            console.error( error );
        } );
</script>



<script type="text/javascript">
    ClassicEditor
        .create( document.querySelector( '#editor1' ),
            {

                ckfinder: {
                    uploadUrl: '/api'
                }
            } )
        .then( editor => {
            console.log( editor );
        } )
        .catch( error => {
            console.error( error );
        } );
</script>
</body>
</html>
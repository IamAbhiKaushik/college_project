@extends('events.dash')

@section('sidebar')
    <li class="mt">
        <a href="/student/dashboard">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="sub-menu">
        <a href="/student/performance" class="">
            <i class="fas fa-chart-pie"></i>
            <span>Performance Record</span>
        </a>
    </li>
    <li class="sub-menu">
        <a href="/student/records" class="active">
            <i class="fa fa-tasks"></i>
            <span>Subjective Exam</span>
        </a>
    </li>

    <li class="sub-menu">
        <a href="/student/important" >
            <i class="fa fa-book"></i>
            <span>Important Question</span>
        </a>
    </li>


    <li class="sub-menu">
        <a href="/student/updateInfo" >
            <i class="far fa-edit"></i>
            <span>Update Info</span>
        </a>
    </li>

    <li class="logout">
        <a href="/student/logout" >
            <i class="fa fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </li>
@endsection


@section('mainContent')
    <script src="https://cdn.ckeditor.com/ckeditor5/11.1.1/decoupled-document/ckeditor.js"></script>
    <style>
        .btnSubmit{
            padding: 10px;margin: auto;border: 2px solid #4c5f99;color: white;cursor: pointer;
            background: #4c5f99;
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
            margin-top: 10px;
        }
        .btnSubmit:hover{
            background-color: #fff;
            color: #4c5f99;
            /*border-color: #4c5f99;*/
        }
    </style>
    <section class="wrapper" style="min-height: 600px;">
        {{--<div style="padding: 4px">--}}
            <a style="text-decoration: none;padding: 4px;color: red;" href="http://www.sofworld.org/sof-techfest-iit-bombay-innovation-challenge" target="_blank"> Click here to View Sample answer</a>
<h3 style="color:#4c5f99;">Fill your Answer is the format provided below. (Follow the word count)</h3>

        <div class="row" style="font-family: 'Nunito Sans', Verdana, Helvetica, sans-serif;">
            {{--<div class="col-sm-1"></div>--}}
            <div class="col-sm-10" id="toolbar-container" style="margin-left: 20px;max-width: 90%;"></div>
            {{--<div class="col-sm-1"></div>--}}
            {{--<div class="col-sm-1"></div>--}}
            <div class="col-sm-10" id="editor" style="color: black;margin-left: 20px;max-width: 90%;font-family: 'Nunito Sans', Verdana, Helvetica, sans-serif;">
                @if($data->submission == '1')
                <h2 style="text-align: left">Title: </h2>
                <p style="text-align: center;"><span style="color: #007ac9;">(Max 20 Words)</span></p>
                <p><b>Problem Statement (max 50 words):</b></p>
                <p></p><p></p><p></p>
                <p><b>Proposed Solution to the problem (in 100-150 words):</b></p>
                <p></p><p></p><p></p>
                <p><b>Expectation and Conclusion (in about 50 words): </b></p>
                <p></p><p></p><p></p>
                <blockquote>
                    <p>EDIT THIS: Some Important facts about the problem you have identified can be highlighted here.</p>
                    <p>Reference Name or source name</p>
                </blockquote>
                <p>Please submit this before 8 PM on your due date.</p>
                <p>We Hope you loved the experience, if so please spread the words.</p>
                <p><strong>Your Name</strong><br/><strong>NSO Roll No</strong><br/><strong>Class of studies</strong><br/><strong>City</strong></p>
                @else
                    {!! $data->submission !!}
                @endif
            </div>
            {{--<div class="col-sm-1"></div>--}}
        </div>



            <script>
                DecoupledEditor
                    .create( document.querySelector( '#editor' ) )
                    .then( editor => {
                        const toolbarContainer = document.querySelector( '#toolbar-container' );

                        toolbarContainer.appendChild( editor.ui.view.toolbar.element );
                    } )
                    .catch( error => {
                        console.error( error );
                    } );
            </script>


        </div>
        <div class="row" style="text-align: center">
            <div class="col-sm-4"></div>
            <div class="btnSubmit col-sm-4" onclick="submitEntry()">
                <h3 style="margin-top: 0;margin-bottom: 0;">Submit Now</h3>
            </div>
            <div class="col-sm-4"></div>
        </div>

    </section>
@endsection
@section('scripts')
    <script>
        function submitEntry() {
            var data = document.getElementById('editor').innerHTML;
            $.ajax({
                url: '/exam/techfest',
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "data": data
                },
                dataType: "text",
                success: function (data) {
                    alert(data);
                    alert('Now you can go to Dashboard and attempt objective exam if not yet attempted.');
                    // alert('Submitted successfully.');
                    // document.getElementById("successID").innerHTML = data;
                },
                fail: function () {
                    console.log("Encountered an error");
                    // document.getElementById("successID").innerHTML ='Encountered an error, Please try again';
                }
            });
        }

    </script>

@endsection
@extends('layouts.frame')

@section('inside')


    <li class="breadcrumb-item active">Manage Students / Show Batchs</li>
    </ol>
<br>
    <div class="container">
    <div class="row">
        <div class="col-sm-9" style="overflow: auto">
      <div class="row">
          @foreach($student as $testk)
          <div class="col-sm-6" style="margin-bottom: 30px">
              <div class="card" style="background:#fff;box-shadow: 0px 0px 20px #dedede;border-radius: 6px;margin-top: 10px">
                  <div class="row">
                      <div class="col-sm-3">

                          <img style="margin: 25px 0px 0px 15px;" src="data:image/png;base64,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">
                      </div>
                      <div class="col-sm-9">
                  <div class="card-body">
                      <h5 class="card-title">{{$testk->student_tag}}</h5>
                      <p style="font-size: 13px">Created  On : {{substr($testk->created_at,0,11)}}<br>Total Students : {{$count[$testk->student_tag]}}</p>
                      <div class="row" style="margin-left:.5px"><div class="col-*-*" style="margin-bottom:7px;margin-right:5px">  <a href="/admin_views/detailed_student/{{$testk->student_tag}}" class="btn-sm" style="background:#02b3e4;height:auto;font-size:13px;color: #fff;">Show Students</a></div>
                      <div class="col-*-*"> <a href="/admin_views/notification/{{$testk->student_tag}}" class="btn-sm" style="font-size: 13px;background:#02b3e4;;color:white">Send Notification</a></div></div>
                  </div>
                  </div>
                  </div>
              </div>
          </div>
          @endforeach
      </div>
        </div>
        <div class="col-sm-3">
            <div class="container" style="height:100%;padding:10px;border-radius: 5px">
                <br><br>
                <button  type="button" class="btn " data-toggle="modal" data-target="#myModal" style="color:white;background:#02b3e4;box-shadow: 0px 0px 10px #02b3e4;width: 100%;">Add Student</button><br><br>
                <button type="button" class="btn" data-toggle="modal" data-target="#myModal_2" style="color:white;background:#02b3e4;box-shadow: 0px 0px 10px #02b3e4;width: 100%;">Add Batch</button><br><br>
                <button type="button" class="btn" data-toggle="modal" data-target="#myModal_1" style="color:white;background:#02b3e4;box-shadow: 0px 0px 10px #02b3e4;width: 100%;">Import Batch</button><br><br>

                    <button onclick="location.href = '/admin_views/delete_students';" type="button" style="color:white;background:red;width: 100%;" class="btn btn-danger">Delete Student/Batch</button>



                <!-- Modal -->
                <div class="modal fade" id="myModal_2" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h4 class="modal-title">Add Batch</h4>
                            </div>
                            <div class="alert alert-info" style="text-align: center">
                                <strong id="result_2"></strong>
                            </div>
                            <div class="modal-body">
                                <form id="form_three">
                                    {{ csrf_field() }}
                                    <h5>Add Batch</h5>
                                    <div class="form-group">
                                        <label for="student_tag">Batch</label>
                                        <input type="text" class="form-control" id="student_tag" placeholder="Add Batch" name="student_tag" required>

                                    </div>




                                {{--<p>Current Batches </p>--}}
                                {{--<ul>--}}
                                    {{--@foreach($student as $key=>$batch)--}}
                                        {{--<li>{{$batch->student_tag}}</li>--}}
                                    {{--@endforeach--}}
                                {{--</ul>--}}
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>



                <!--MODAL START-->
                <div class="modal fade" id="myModal_1" role="dialog">
                    <div class="modal-dialog modal-lg">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                                <h4 class="modal-title">Add Students</h4>

                            </div>
                            <div class="alert alert-info" style="text-align: center">
                                <strong id="result_1" ></strong>
                            </div>
                            <div class="modal-body">
                                <form id ='form_two' enctype="multipart/form-data">
                                    {{--<form method="POST" action="/admin_views/added_student" enctype="multipart/form-data">--}}
                                    {{ csrf_field() }}
                                    <h5>Step 1</h5>
                                    <p><a href="https://docs.google.com/spreadsheets/d/1PkAQqgDJmBYR0APfkZ67eLrsn5rRQJpxlWEM80Atdd8/edit?usp=sharing" target="_blank">Download sample file</a></p>
                                    <hr  />
                                    <h5>Step 2</h5>
                                    <p>Fill the sample file (keep row 1 as it is).</p>
                                    <hr  />
                                    <h5>Step 3</h5>
                                    <div class="form-group">
                                        <label for="student_excel">Upload Excel Sheet (only .xlsx)</label>
                                        <input type="file" accept="application/xlsx" class="form-control col-sm-6" id="student_excel_data" placeholder="Choose Excel" name="student_excel" required>
                                    </div>
                                    <hr />
                                    <h5>Step 4</h5>
                                    <div class="form-group">
                                        <label for="student_tag_1">Select batch</label>

                                        <select class="form-control col-sm-6" id="student_tag_1" name="student_tag_1" required>

                                            @foreach($student as $batch)
                                                <option value="{{$batch->student_tag}}">{{$batch->student_tag}}</option>
                                            @endforeach
                                            {{--<option>First batch</option>--}}
                                        </select>
                                        {{--<input type="text" class="form-control" id="student_tag" placeholder="Add Batch" name="student_tag" value="null">--}}

                                    </div><hr/>

                                    <div class="form-group col-sm-6">
                                        <label for="" style="margin-left: -11px">Add New Batch</label>
                                        <div class="row">
                                            <textarea type="text" style="height: 38px;margin-right: 8px;margin-top: 5px" class="form-control col-sm-6" id="new_batch_1" placeholder="Add Batch"  name="new_batch"></textarea>

                                        <div class="co-sm-6" ><button onclick="myfuc()" style="margin-top: 5px" type="button" id = "new_batch" class="btn btn-primary">Add</button></div>
                                    </div>

                                    </div>



                                {{--<input type="submit" class="form-control" value="submit">--}}


                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <!--MODAL SED-->
                <!--MODAL START-->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                            <div class="modal-header">
                                <h4 class="modal-title">Add New Student</h4>
                            </div>
                            <div class="modal-body">

                                {{--@if ($errors->any())--}}
                                    {{--<div class="alert alert-danger">--}}
                                        {{--<ul>--}}
                                            {{--@foreach ($errors->all() as $error)--}}
                                                {{--<li>{{ $error }}</li>--}}
                                            {{--@endforeach--}}
                                        {{--</ul>--}}
                                    {{--</div>--}}
                                {{--@endif--}}
                                <div class="alert alert-info" style="text-align: center">
                                    <strong id="result"></strong>
                                </div>
                                <div class="container" style="padding-bottom: 20px;">


                                    <form id="form_one">
                                        {{--<form method="POST" action="/admin_views/added_students_update">--}}
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-2" style="margin-right: -20px;padding-top: 5px">
                                                    <label for="student_excel"><b>Name</b></label>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input  type="text" class="form-control" name="name" required/>
                                                </div>
                                            </div>
                                        </div>
                                        {{--<div class="form-group">--}}
                                            {{--<div class="row">--}}
                                                {{--<div class="col-sm-2" style="margin-right: -20px;padding-top: 5px">--}}
                                                    {{--<label for="student_excel"><b>Date of Birth</b></label>--}}
                                                {{--</div>--}}
                                                {{--<div class="col-sm-6">--}}
                                                    {{--<input  type="text" placeholder="dd/mm/yyyy" class="form-control" name="dob" required/>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        <div class="form-group">
                                            <div class="row">
                                            <div class="col-sm-2" style="margin-right: -20px;padding-top: 5px">
                                            <label for="student_excel"><b>Roll No.</b></label>
                                            </div>
                                                <div class="col-sm-6">
                                                <input  type="text" class="form-control" name="roll_nos" required/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-2" style="margin-right: -20px;padding-top: 5px">
                                                    <label for="student_excel"><b>Batch</b></label>
                                                </div>
                                                <div class="col-sm-6">
                                                    <select class="form-control col-sm-6" id="student_tag" name="student_tag" required>

                                                        @foreach($student as $batch)
                                                            <option value="{{$batch->student_tag}}">{{$batch->student_tag}}</option>
                                                        @endforeach
                                                        {{--<option>First batch</option>--}}
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-2" style="margin-right: -20px;padding-top: 5px">
                                                    <label for="student_excel"><b>E-mail</b></label>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input  type="text" class="form-control" name="email"/>
                                                </div>
                                            </div>
                                        </div>

                                        {{--<button type="submit" name="submit">Submit </button>--}}
                                        {{--<div class="form-group">--}}
                                            {{--<div class="row">--}}
                                                {{--<div class="col-sm-2" style="margin-right: -20px;padding-top: 5px">--}}
                                                    {{--<label for="student_excel"><b>Phone No.</b></label>--}}
                                                {{--</div>--}}
                                                {{--<div class="col-sm-6">--}}
                                                    {{--<input  type="text" class="form-control" name="phone"/>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="form-group">--}}

                                            {{--<select class="form-control col-sm-6" id="student_tag" name="student_tag" required>--}}

                                                {{--@foreach($student as $batch)--}}
                                                    {{--<option value="{{$batch->student_tag}}">{{$batch->student_tag}}</option>--}}
                                                {{--@endforeach--}}
                                                {{--<option>First batch</option>--}}
                                            {{--</select>--}}
                                            {{--<input type="text" class="form-control" id="student_tag" placeholder="Add Batch" name="student_tag" value="null">--}}

                                        {{--</div>--}}



                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Add</button>
                               
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                <!--MODAL CLOSE-->
            </div>
        </div>
    </div>
    </div>
    </div>
    @section('scripts')
        <script>
           //  $( document ).ready(function(){
           // ot = document.getElementById('new_batch').offsetHeight;
           // });
           //  if(ot !== 0){
           //  document.getElementById('new_batch_1').style.height = 38+'px';}

        $(function(){

        $('#form_one').on('submit',function(e){
        e.preventDefault(e);

            document.getElementById("result").innerHTML = 'Processing... Please Wait';

        $.ajax({
        type:"POST",
        url:'/admin_views/added_students_update',
        data:$(this).serialize(),
        dataType: 'text',
        success: function(data){
            document.getElementById("result").innerHTML = data;
            document.getElementById("form_one").reset();
        },
        error: function(data){
                alert(data);
        }
        })
        });
           // excelData = document.getElementById('student_excel_data').files[0];

            $("#form_two").on('submit',function(e){
                e.preventDefault(e);
                document.getElementById("result_1").innerHTML = 'Processing... Please Wait';
                formData = new FormData($(this)[0]);
                $.ajax({
                    type:"POST",
                    method: 'POST',
                    mimeType: "multipart/form-data",
                    url:'/admin_views/added_student',
                    processData:false,
                    cache:false,
                    contentType: false,
                    data:formData,
                    // data:new FormData($(this)[0]),
                    dataType: 'text',
                    success: function(data){
                        document.getElementById("result_1").innerHTML = data;
                        document.getElementById("form_two").reset();
                    },
                    error: function(data){
                        console.log(data);
                    },

                });
            });

            $('#form_three').on('submit',function(e){
                e.preventDefault(e);
                $.ajax({

                    type:"POST",
                    url:'/admin_views/added_batch',
                    data:$(this).serialize(),
                    dataType: 'text',
                    success: function(data){
                        document.getElementById("result_2").innerHTML = data;
                        document.getElementById("form_three").reset();
                    },
                    error: function(data){
                        alert('Unsuccessful');
                    }
                })
            });
        });
        $('#myModal').on('hide.bs.modal', function () {
            document.getElementById("result").innerHTML = '';
        });
        $('#myModal_1').on('hide.bs.modal', function () {
            document.getElementById("result_1").innerHTML = '';
            location.reload();


        });
        $('#myModal_2').on('hide.bs.modal', function () {
            document.getElementById("result_2").innerHTML = '';
            location.reload();
        });

        function myfuc() {
             text = $('textarea').val();
             if(text !== ''){
                 // document.getElementById("student_tag_1").value = String(text);
                 // document.getElementById("student_tag_1").innerHTML = String(text);
                 $('#student_tag_1')
                     .append($("<option></option>")
                         .attr("value",text)
                         .text(text));
                 $('select>option:last-child').attr('selected', true);
             }


        }

        </script>
    @endsection
@endsection

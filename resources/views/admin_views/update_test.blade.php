@extends('layouts.frame')
@section('header')
    <style>
        label {
            font-weight: bold;
        }
    </style>
@endsection
      @section('inside')

        <li class="breadcrumb-item active">Update Exam </li>
      </ol>
     <br>
       <?php
       $string = $testk->livetime;
      list($d, $t) = explode(' ', trim($string));


        ?>
  <div class="container">
 	 <h2>Update Exam</h2><br>
 	  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif<hr>
  		<form method='POST' action="/admin_views/update"  enctype="multipart/form-data">
            {{ csrf_field() }}
    		<div class="form-group row">
      			<label class="col-sm-6" for="test_name">Exam Name:</label>
      		<input type="text" class="form-control col-sm-6" id="test name" value="{{$testk->test_name}}" placeholder="{{$testk->test_name}}" name="test_name" >
      			
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

            </div><hr>
            <div class="form-group row">
                <label class="col-sm-6" for="max_marks">Maximum Marks of Exam</label>
                <input type="number" class="form-control col-sm-6" id="max_marks" value="{{$testk->max_marks}}" placeholder="{{$testk->max_marks}}" name="max_marks" min="0" oninput="validity.valid||(value='');" required>

            </div><hr>

            <div class="form-group row">
                <label class="col-sm-6" for="duration">Exam Duration in minutes</label>
                <input type="number" class="form-control col-sm-6" id="duration" value="{{$testk->duration}}" placeholder="{{$testk->duration}}" name="duration" min="0" oninput="validity.valid||(value='');" >

            </div><hr>



            <div class='form-group row'>
                <label class="col-sm-6" for="livedate">Start Date </label>
                <input type='date' id='livedate' class="form-control col-sm-6" value="{{$d}}" name="livedate"  />

            </div><hr>

    		 <div class="form-group row">
    		 	<label class="col-sm-6" for="livetime">Start Time (24h)</label>
          
                <input type='time' id='livetime' class="form-control col-sm-6" value="{{$t}}" name="livetime" name="livetime" />
             

           </div><hr>
            <div class="form-group row">
                <label class="col-sm-6" for="livetime">Live Time (h)</label>

                <input type='number' id='time_live' class="form-control col-sm-6" value="{{$testk->time_live}}"  name="time_live" />


            </div><hr>

            <div class="form-group row">
                <label class="col-sm-6" for="pdf">Choose Question Paper PDF (Statement Size Page) <b>(Leave blank if not want to update)</b></label>
                <input type="file" accept="application/pdf" class="form-control col-sm-6" id="pdf" placeholder="Choose PDF" name="pdf" >

            </div><hr>
            <div class="form-group row">
                <label class="col-sm-6" for="excel">Choose Answer Sheet (only .xlsx) <b>(Leave blank if not want to update)</b></label>
                <input type="file" accept="application/xlsx" class="form-control col-sm-6" id="excel" placeholder="Choose Excel" name="excel" >


            </div><hr>
            <div class="form-group row">
                <label class="col-sm-6" for="solution">Choose PDF for solution (<a href="https://goo.gl/FUHZXM" target="_blank">Download sample Doc File</a>)</label>
                <input type="file" accept="application/pdf" class="form-control col-sm-6" id="solution" placeholder="Choose PDF" name="solution">

            </div><hr>




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

            <div class="form-group row">
                <label class="col-sm-6">Select Batch<br>Press Ctrl(windows)/Command(Mac) to select multiple options</label>
                <select multiple class="form-control col-sm-6" id="student_tag[]" name="student_tag[]" required>

                    @foreach($batches as $batch)
                        <option >{{$batch->student_tag}}</option>
                    @endforeach
                    {{--<option>First batch</option>--}}
                </select>
                {{--<input type="text" class="form-control col-sm-6" id="student_tag" placeholder="Add Batch" name="student_tag" value="null">--}}

            </div><hr>

            <input type="hidden" value="{{$testk->id}}" name="id" />
        </div>
    			<button type="submit" class="btn btn-primary">Submit your updates</button>
 		 </form>
 		
 </div>
       

      @endsection      
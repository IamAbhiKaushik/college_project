@extends('layouts.frame')

      @section('inside')

        <li class="breadcrumb-item active">Add Students </li>
      </ol>

      
  <div class="container">
 	 <h2>Add Students</h2>
 	  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif<hr>
  		<form method='POST' action="/admin_views/added_students"  enctype="multipart/form-data">
        {{ csrf_field() }}
            <div class="form-group">
      			<label for="student_excel">Choose Excel Sheet (only .xlsx)</label>
     			<input type="file" accept="application/xlsx" class="form-control col-sm-6" id="student_excel" placeholder="Choose Excel" name="student_excel" required>
     		
    		</div>
             <div class="form-group">
                 <label for="student_tag"><b style="color: red"><i>Batch</i></b> (to filter Students ex. Ranker batch,11th,12th,Drop etc etc if your excel sheet have only 12th students you may like to give it a Batch likewise)<br> Default Null<br>
                     <b>Ensure there is no empty row till your last student in excel</b></label>

                 <b>This way if you reupload a list for a batch, if will be completely replaced.</b>
                 <select class="form-control col-sm-6" id="student_tag" name="student_tag" required>

                     @foreach($batches as $batch)
                         <option value="{{$batch->student_tag}}">{{$batch->student_tag}}</option>
                     @endforeach
                     {{--<option>First batch</option>--}}
                 </select>
                 {{--<input type="text" class="form-control" id="student_tag" placeholder="Add Batch" name="student_tag" value="null">--}}
        
        </div>
   
    			<button type="submit" class="btn btn-primary">Submit</button>
 		 </form>

    <hr><hr>
      <div class="container" style="padding-bottom: 20px;">

          <h3>To add a few roll Nos to an existing batch list, Fill them below.</h3>
          <form method='POST' action="/admin_views/added_students_update" >
              {{ csrf_field() }}
              <div class="form-group">
                  <label for="student_excel"><b>Fill Roll No to add to an existing batch</b></label>
                  <textarea class="form-control col-sm-6" name="roll_nos" required></textarea>
              </div>
              <div class="form-group">

                  <select class="form-control col-sm-6" id="student_tag" name="student_tag" required>

                      @foreach($batches as $batch)
                          <option value="{{$batch->student_tag}}">{{$batch->student_tag}}</option>
                      @endforeach
                      {{--<option>First batch</option>--}}
                  </select>
                  {{--<input type="text" class="form-control" id="student_tag" placeholder="Add Batch" name="student_tag" value="null">--}}

              </div>

              <button type="submit" class="btn btn-primary">Submit</button>
          </form>
      </div>

 		

 </div>
       

      @endsection      
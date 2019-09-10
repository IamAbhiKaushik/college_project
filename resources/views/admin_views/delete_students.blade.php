@extends('layouts.frame')

      @section('inside')

        <li class="breadcrumb-item active">Delete Students </li>
      </ol>

      
  <div class="container">
 	 <h2>Delete Batch</h2>
 	  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif<hr>
  		<form method='POST' action="/admin_views/deleted_one" >
        {{ csrf_field() }}
            <div class="form-group">

                <select class="form-control col-sm-6" id="student_tag" name="student_tag" required>
                    <option value="">Select A Batch</option>
                    @foreach($batches as $batch)
                        <option value="{{$batch->id}}">{{$batch->student_tag}}</option>
                    @endforeach

                </select>


            </div>


    			<button type="submit" class="btn btn-danger">Delete</button>
 		 </form>
      <br><hr><br>
      <h2>Delete Single Student</h2><br>
      @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif<hr>
      <form method='POST' action="/admin_views/deleted_students" >
          {{csrf_field()}}
          <h4>Select a batch</h4>
          <select class="form-control col-sm-6" id="student_tag" name="student_tag" required>
              <option value="">Select A Batch</option>
              @foreach($batches as $batch)
                  <option value="{{$batch->student_tag}}">{{$batch->student_tag}}</option>
              @endforeach
              {{--<option>First batch</option>--}}
          </select>
          <br>
          <h4>Student Roll No [Case Sensitive]</h4>
          <input class="form-control col-sm-6" name="roll" type="text" placeholder="Input Roll No of Student" required><br>
          <button type="submit" class="btn btn-danger">Delete</button>
      </form>

 </div>
       

      @endsection      
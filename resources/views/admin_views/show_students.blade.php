@extends('layouts.frame')

      @section('inside')
      <li class="breadcrumb-item active">View All Batches </li>
      </ol>
     
   
     <div class="card mb-3">
      
        <div class="card-header">
          <i class="fa fa-table"></i>Batch Details<b style="width: 50%; margin: 0 auto; text-align: left"></b> </div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                   <th>Batch</th>
                   <th>Notification</th>

                
                </tr>
              </thead>
              <tfoot>
                <tr>
                    <th>Batch</th>
                    <th>Notification</th>
                
                </tr> 
              </tfoot>
              <tbody>
          @foreach($student as $testk)
              <tr>

                  <td><a href="/admin_views/detailed_student/{{$testk->student_tag}}">{{$testk->student_tag}}</a></td>
                  <td><a href="/admin_views/notification/{{$testk->student_tag}}">Notification for this batch</a></td>
                 
 
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

      

 </div>
        <button onclick="location.href = '/admin_views/delete_students';" type="button" class="btn btn-danger">Delete</button>

      @endsection      
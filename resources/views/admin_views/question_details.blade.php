@extends('layouts.frame')

      @section('inside')
      <li class="breadcrumb-item active">View All Question </li>
      </ol>
      <p><div class='row'><div class='col-sm-4'>Question Type<ul>
     		<li>0 : Single Correct</li>
     		<li>1 : Multiple Correct</li>
     		<li>2 : Integer Type</li>
     	</ul></div>
        <div class='col-sm-4'>Stream<ul>
        	<li>P : Physics</li>
        	<li>C : Chemistry</li>
        	<li>M : Mathematics</li>
            <li>B : Biology</li>
        </ul></div>
        <div class='col-sm-4'><ul>Level
        	<li>E : Easy</li>
        	<li>H : Hard</li>
        	<li>M : Medium</li>
        </ul></div></div>
        </p>
     <div class="card mb-3">
     	
        <div class="card-header">
          <i class="fa fa-table"></i>Question Details<b style="width: 50%; margin: 0 auto; text-align: left"></b> </div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                   <th>Question No.</th>
                  <th>Type</th>
                  <th>Stream</th>
                  <th>Level</th>
                  <th>Correct Answer</th>
                
                  <th>Marks</th>
                  <th>Negative Marks</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                    <th>Question No.</th>
                  <th>Type</th>
                  <th>Stream</th>
                  <th>Level</th>
                  <th>Correct Answer</th>
                
                  <th>Marks</th>
                  <th>Negative Marks</th>
                </tr> 
              </tfoot>
              <tbody>
          @foreach($test as $testk)
              <tr>
                <td>{{$testk->question_number}}</td>
                  <td>{{$testk->question_type}}</td>
                  <td>{{$testk->subject}}</td>
                  <td>{{$testk->level}}</td>
                   <td>{{$testk->correct_answer}}</td>
                    <td>{{$testk->marks}}</td>
                 <td>-{{$testk->negative}}</td>        
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
            <div class="card-footer small text-muted"><solid style='color: red'>!! Any item cannot be updated if test running or after the is over.!!</solid></div>
        </div>
      

 </div>
       

      @endsection      
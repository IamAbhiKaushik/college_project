@extends('layouts.frame')

      @section('inside')

        <li class="breadcrumb-item active">Check your Excel(Warning) ^_^);</li>
      </ol>
     
     <h3>Your questions have been uploaded </h3>.<br>
     <p>Check Your Number of Question you uploaded in excel it's a possibility you have a <b>empty row</b> in betweeen your excel sheet or <b>wrong</b> value in <b>question number' column </b> .<br><b>IGNORE THIS WARNING</b> if your quetion list is  uploaded <b>correctly</b>. </p>
     <a href='/admin_views/question_details/{{$tesid}}'>Question for the recently uploaded test</a>
      

 </div>
       

      @endsection      
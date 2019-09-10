@extends('layouts.frame')

      @section('inside')

        <li class="breadcrumb-item active">Previous CRUD details</li>
      </ol>
     
     <h3>CRUD Details</h3>.<br>
     <p>{{$msg}}</p>
     <a href="{{ url('/admin_views/dashboard') }}">To Dashboard</a>
      

 </div>
       

      @endsection      
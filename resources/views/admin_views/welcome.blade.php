@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-success">
                <div class="panel-heading">Dashboard</div><hr>

                    @if(Auth::check())
                      <!-- Table -->
                      <a href="{{ url('/admin_views/dashboard') }}">To You Dashboard</a>
                    @endif


            </div>
            @if(Auth::guest())
              <a href="/login" class="btn btn-info">To continue to DashBoard You need to login  >> </a>
            @endif
        </div>
    </div>
</div>
@endsection
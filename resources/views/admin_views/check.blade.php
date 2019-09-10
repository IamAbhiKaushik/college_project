@extends('layouts.frame')

@section('inside')

    <li class="breadcrumb-item active">Add a New Batch </li>
    </ol>
<div class="container">
<div class="row">
    @foreach($details as $h)
    <div class="col-sm-6"><img src="{{ URL::to('/') }}/question/{{$h->image_name}}.jpg" class="img-responsive" style="height: 300px;width: 300px" alt="Cinque Terre">
    </div>
        <div class="col-sm-6"><img src="{{ URL::to('/') }}/solution/{{$h->image_name}}.jpg" style="height: 300px;width: 300px" class="img-responsive" alt="Cinque Terre"></div>
        <p>{{$h->subject}}||{{$h->topic}}</p>
        <hr><hr>
    @endforeach
</div>
</div>


@endsection
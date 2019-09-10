@extends('layouts.frame')

@section('inside')
    <li class="breadcrumb-item active">Test Details </li>
    </ol>

    <div class="container">
        <h2>Physics Topics</h2>
       
        <form>
            <div class="checkbox">
                <label><input type="checkbox" value="">Option 1</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" value="">Option 2</label>
            </div>
            <div class="checkbox disabled">
                <label><input type="checkbox" value="">Option 3</label>
            </div>
        </form>
    </div><br>
    <div class="container">
        <h2>Chemistry Topics</h2>
       
        <form>
            <div class="checkbox">
                <label><input type="checkbox" value="">Option 1</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" value="">Option 2</label>
            </div>
            <div class="checkbox disabled">
                <label><input type="checkbox" value="">Option 3</label>
            </div>
        </form>
    </div><br>
    <div class="container">
        <h2>Maths Topics</h2>
       
        <form>
            <div class="checkbox">
                <label><input type="checkbox" value="">Option 1</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" value="">Option 2</label>
            </div>
            <div class="checkbox disabled">
                <label><input type="checkbox" value="">Option 3</label>
            </div>
        </form>
    </div>
@endsection
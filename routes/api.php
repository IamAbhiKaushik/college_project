<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/add','publicController@post_question');

Route::post('/student/addIssue','studentController@addIssue');


Route::get('/student', function () {
    if (session('username')) return redirect('student/dashboard');
    else return view('material.register');

});

Route::get('/check', function () {
    return 1;

});

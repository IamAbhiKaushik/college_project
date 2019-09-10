<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Http\Request;


Route::get('/', function () {
	$website = $_SERVER['HTTP_HOST'];
	if (session('username')) return redirect('student/dashboard');
	
	else if ($website == 'easylrn.com' or $website == 'www.easylrn.com') {
	    return view('material.easylrn');
	}
	else{
	return redirect('/student/register');
	}

    // else return view('material.login');

	// return redirect('/student/login');
    // return view('welcome');
});
#abhinav Commands



Route::get('/student/login', function (Request $req) {
//    return $req->start;
    if (session('username')) return redirect('student/dashboard');
    else return view('material.login');
});

Route::get('/admin/check/{id}', function ($id) {
$data =    DB::table('master_students')->where('email',$id)->first();
    return var_dump($data);
});



#payment routes
# Call Route
Route::get('payment', ['as' => 'payment', 'uses' => 'studentController@payment']);

# Status Route
Route::get('payment/status', ['as' => 'payment.status', 'uses' => 'studentController@status']);



Route::get('/student','studentController@student');
Route::get('/student/register','studentController@getRegister');
Route::post('/student/register','studentController@postRegister');

Route::get('/student/register/{id}','studentController@getRegisterId');

Route::get('/student/techfest','studentController@techfest');

//Route::get('/student/passport','studentController@passport_tf');

Route::post('/student/register/{id}','studentController@postRegisterId');
Route::post('/student/techfest','studentController@postTechfest');

Route::get('/exam/techfest','studentController@examTechfest');
Route::post('/exam/techfest','studentController@exam_postTechfest');

Route::post('/student/dashboard','studentController@dashboard');
Route::get('/student/dashboard','studentController@getDashboard');
Route::get('/student/performance','studentController@performance');
Route::get('/student/records','studentController@records');
Route::get('/student/exams','studentController@exams');

Route::post('/student/markImpo','studentController@markImpo');

Route::get('/student/important','studentController@showImportant');

Route::get('/student/updateInfo','studentController@updateInfo');
Route::post('/student/updateInfo','studentController@updateInfo_post');
Route::get('/student/logout','studentController@logout');

Route::get('/student/public-exams','studentController@publicExam');
Route::get('/free-exams','studentController@freeExam');

Route::get('/student/graphical/{id}','studentController@graphical');
Route::get('/student/graphicalApi/{id}','studentController@graphicalApi');


Route::get('/examInfo/{id}','studentController@exam0');
Route::get('/examStart/{id}','studentController@exam1');

Route::get('akadesign','studentController@design');

Route::get('design/{id}','studentController@design_x')->name('design');

Route::get('student/pdf/{id}','studentController@pdf_x');
Route::get('student/solution/{id}','studentController@pdf_x_sol');

Route::get('easylrnx/{id}','HomeController@easylrn_xx');

Route::get('easylrn/{id}','studentController@easylrn_x');

Route::post('submitExam/{id}','studentController@submitExam');

Route::post('submitEasy/{id}','studentController@submitEasy');
//Route::get('results/{id}','studentController@examResult');
Route::get('fetchData','studentController@fetchData');

Route::get('solutions/{id}','studentController@solution');

Route::get('solutions_v2/{id}','studentController@solution_v2');

Route::get('solutionApi/{id}','studentController@solutionApi');

Route::get('solutionApiDemo/{id}','studentController@solutionApiDemo');


Route::get('student/stud/{paper}/{id}','studentController@studGraph');



#public profies of coaching
Route::get('institutes/{id}','studentController@institute');



//about payment pages
//Route::get('payment','studentController@payment');

#abhinav Commands Ends





#Aman Commands
Auth::routes();
Route::get('/check','HomeController@check_upload');

Route::post('/process','HomeController@process');
Route::post('/admin_views/store_public','HomeController@store_public');

Route::get('/admin_views/show_public','HomeController@show_public');

Route::get('/admin_views/rule_book','HomeController@rule_book');

Route::post('/admin_views/delete_notif','HomeController@delete_notif');

Route::post('/contact_us','publicController@contact_us');


Route::get('/htmls/charts','HomeController@charts');

Route::post('/admin_views/add_notification','HomeController@add_notification');

Route::get('/admin_views/notification/{st_tg}','HomeController@notification');

Route::get('/admin_views/download_result/{exam_code}','HomeController@download_result');

Route::get('results/{id}','HomeController@examResult');
Route::get('/admin_views/detailed_student/{batch}','HomeController@detailed_student');

Route::post('/admin_views/added_batch','HomeController@added_batch');

Route::get('/admin_views/add_batch','HomeController@add_batch');

Route::get('/admin_views/show_students','HomeController@show_students');

Route::get('/admin_views/delete_students','HomeController@delete_students');

Route::post('/admin_views/deleted_students','HomeController@deleted_students');

Route::post('/admin_views/added_student','HomeController@added_student');

Route::post('/admin_views/added_students_update','HomeController@added_students_update');

Route::get('/admin_views/manage_students/{id}','HomeController@activate_student');
///admin_views/added_students_update

Route::get('/admin_views/see/{test_id}/solution','HomeController@seesolution');


Route::get('/admin_views/add_students','HomeController@add_students');

Route::post('/admin_views/change_info','HomeController@change_info');

Route::get('/admin_views/view_change_info','HomeController@view_change_info');

Route::post('/admin_views/delete','HomeController@delete');

Route::get('/admin_views/see_all','HomeController@see_all');

Route::post('/admin_views/deleted_one','HomeController@deleted_one');

Route::get('/admin_views/question_details/{test_id}','HomeController@question_details');

Route::get('/admin_views/update_test/{test_id}','HomeController@update_test');

Route::get('/admin_views/see/{test_id}','HomeController@see');

Route::get('/admin_views/see/{test_id}/pdf','HomeController@seepdf');

Route::post('/admin_views/update',['as'=>'update.update','uses'=>'HomeController@update']);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin_views/dashboard','HomeController@dashboard');

Route::post('/admin_views/create',['as'=>'create.store','uses'=>'HomeController@store']);

Route::get('/admin_views/create_test','HomeController@show');


Route::get('/admin_views/student_results/{id}','HomeController@student_results');

Route::get('/admin_views/merge','HomeController@merge');

Route::post('/admin_views/make_merge','HomeController@make_merge');

Route::get('/admin_views/fetch_student/{student}','HomeController@fetch_student');

Route::get('/admin_views/smrttest','HomeController@smart_test');
// Route::get('/dashboard/navbar',['as'=>'dashboard.navbar','uses'=>'HomeController@navbar']);

// Route::get('/dashboard/cards',['as'=>'dashboard.cards','uses'=>'HomeController@cards']);

##New Admin Purple Commands...
Route::get('purple','publicController@purple');

Route::get('/admin_views/manage_students','HomeController@manage_students');

Route::get('/admin_views/download_students/{batch}','HomeController@download_students');


Route::get('/admin_views/{test_id}/pdf','HomeController@seepdf');

Route::get('/admin_views/{test_id}/solution','HomeController@seesolution');


Route::get('purple/add','publicController@add_question');

Route::post('purple/add','publicController@post_question');

Route::post('/admin_views/delete_one','HomeController@delete_one');

Route::get('/admin_views/get_results/{exam_code}','HomeController@get_results');

Route::get('/admin_views/test_view','HomeController@test_sel');
Route::post('/admin_views/jtt','HomeController@test_l');

Route::get('/upload_question','HomeController@upload_question');
Route::post('/topic_add','HomeController@topic_add');
Route::get('/topic','HomeController@topic');
Route::get('/admin_views/progress/{test_id}','HomeController@progress');


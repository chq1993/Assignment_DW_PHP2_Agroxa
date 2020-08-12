<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return view('layouts.admin');
});


Route::get('user/layouts', function () {
	return view('layouts.user');
});

Route::get('page', function () {
    return view('page');
});



Route::get('login', 'Controller@login');

//Route login
Route::get('/login', 'UserController@show_login')->name('user.login');
Route::post('/login','UserController@login')->name('user.check_login');

//-------------------------GROUP CHECK_AUTH----------------------------
Route::group(['middleware'=>'check_auth'], function(){
// Route của user
Route::get('/logout', 'UserController@logout')->name('user.logout');
Route::get('/dashboard', 'UserController@show_dashboard');
// public
//copy k sửa a
Route::resource('peer-assessment', 'PeerAssessmentController');
// Route::resource('subordinate-assessment', 'ConfigQuestionController');
// Route::resource('superior-assessment', 'ConfigQuestionController');

Route::get('/', function () {
    return view('layouts.admin');
});

	//-------------------------GROUP CHECK_USERTYPE----------------------------
	Route::group(['middleware'=>'check_usertype'], function(){
		Route::get('user/changeStatus', 'UserController@changeStatus')->name('user.changeStatus');
		
		//Route của Quản lý câu hỏi
		Route::resource('question-manage', 'QuestionManageController');
		//Route của Quản lý form
		Route::resource('form-manage', 'FormManageController');
		Route::resource('answer-manage', 'AnswerManageController');
		Route::resource('division-manage', 'DivisionManageController');
		Route::resource('position-manage', 'PositionManageController');
		Route::resource('plan-manage', 'PlanManageController');
		Route::resource('role-manage', 'RoleController');
		Route::resource('config-fq', 'ConfigFormController');
		Route::resource('config-aq', 'ConfigQuestionController');
		

		Route::get('/', function () {
			return view('layouts.admin');
		});
	});

});
Route::resource('user', 'UserController');

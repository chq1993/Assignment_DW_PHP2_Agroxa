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



Route::get('page',function(){
	return view('page');
});

Route::get('testpage',function(){
	return view('testpage');
});
Route::get('dashboard','Controller@show_dashboard');


//Route login
Route::get('/login', 'UserController@show_login')->name('user.login');
Route::post('/login','UserController@login')->name('user.check_login');

Route::group(['middleware'=>'check_auth'], function(){
// Route của user
Route::get('user/changeStatus', 'UserController@changeStatus')->name('user.changeStatus');
Route::resource('user', 'UserController');

Route::get('/dashboard', 'UserController@show_dashboard');
Route::get('/logout', 'UserController@logout')->name('user.logout');

Route::get('/', function () {
    return view('layouts.admin');
});
});

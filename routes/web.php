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

Route::get('page',function(){
	return view('page');
});

Route::get('testpage',function(){
	return view('testpage');
});


Route::get('login','Controller@login');

Route::get('dashboard','Controller@show_dashboard');

// Route của user
Route::get('user/changeStatus', 'UserController@changeStatus')->name('user.changeStatus');
Route::post('user/ajax-update', 'UserController@ajax_update')->name('user.ajax_update');
Route::resource('user', 'UserController');

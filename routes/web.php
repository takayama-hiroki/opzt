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

Route::get('login','App\Http\Controllers\OpztController@login');
Route::get('index','App\Http\Controllers\OpztController@getAuth');

Route::get('diary','App\Http\Controllers\OpztController@diary');
Route::post('diary','App\Http\Controllers\OpztController@diary_create');

Route::get('view','App\Http\Controllers\OpztController@view');
Route::get('my_view','App\Http\Controllers\OpztController@my_view');
Route::post('edit','App\Http\Controllers\OpztController@edit');
Route::post('del','App\Http\Controllers\OpztController@del');

Route::get('post','App\Http\Controllers\OpztController@post')->name('posts.index');
Route::post('post','App\Http\Controllers\OpztController@tweet');
Route::post('post_del','App\Http\Controllers\OpztController@post_del');

Route::post('comment','App\Http\Controllers\OpztController@comment');

Route::get('comment_rep','App\Http\Controllers\OpztController@comment_rep');
Route::post('comment_rep','App\Http\Controllers\OpztController@comment_rep');

Route::get('detail','App\Http\Controllers\OpztController@detail');
Route::post('detail','App\Http\Controllers\OpztController@detail');

Route::get('account','App\Http\Controllers\OpztController@account');
Route::get('staff','App\Http\Controllers\OpztController@staff');
Route::post('staff_add','App\Http\Controllers\OpztController@staff_add');
Route::post('staff_edit','App\Http\Controllers\OpztController@staff_edit');
Route::post('staff_del','App\Http\Controllers\OpztController@staff_del');

Route::post('name_edit','App\Http\Controllers\OpztController@name_edit');
Route::post('password_edit','App\Http\Controllers\OpztController@password_edit');

Route::get('auth','App\Http\Controllers\OpztController@getAuth');
Route::post('auth','App\Http\Controllers\OpztController@postAuth');

Route::post('/like','App\Http\Controllers\OpztController@like');
Route::get('/like','App\Http\Controllers\OpztController@like');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

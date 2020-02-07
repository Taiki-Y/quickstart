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

use App\Task;
use Illuminate\Http\Request;

// タスク一覧
Route::get('/tasks', 'TaskController@index');

// タスクの保存
Route::post('/task','TaskController@store');

// タスク削除
Route::delete('/task/{task}','TaskController@destroy');

//タスクの編集
Route::get('/task/{task}/edit','TaskController@edit');

// タスクの更新
Route::put('/task/{task}','TaskController@update');

// マイページ表示
Route::get('/task/user/{user}','UserController@show');

// ユーザー情報ページ
Route::get('/user/{user}','UserController@detail');

// ユーザー情報
Route::get('/user/{user}/edit','UserController@edit');

Route::post('/user/{user}','UserController@update');

// // タスク削除
// Route::delete('/task/{task}','UserController@destroy');

// //タスクの編集
// Route::get('/user/{user}/task/{task}/edit','UserController@edit');

// // タスクの更新
// Route::put('/user/{user}/task/{task}','UserController@update');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


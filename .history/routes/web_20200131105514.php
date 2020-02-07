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

Route::put('/task/{task}/edit','TaskController@edit');

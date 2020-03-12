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

//タスク絞り込み
Route::get('/task/filter/{status}','TaskController@filter');

// マイページ表示
Route::get('/task/user/{user}','UserController@show');

// ユーザー情報ページ
Route::get('/user/{user}','UserController@detail');

// ユーザー情報変更
Route::get('/user/{user}/edit','UserController@edit');

Route::put('/user/{user}','UserController@update');

//ユーザー名変更
Route::get('/user/{user_id}/username/edit','UserController@editname');
Route::put('/user/{user_id}/username/edit','UserController@updatename');

//メールアドレス変更
Route::get('/user/{user_id}/mailaddress/edit','UserController@editmailaddress');
Route::put('/user/{user_id}/mailaddress/edit','UserController@updatemailaddress');

//メールアドレス仮変更
Route::post('/user/{user_id}/mailaddress/preupdate','ChangeaddressController@preupdate');
Route::get('/settings/authorizeMail/{token?}','ChangeaddressController@authorizeMail');

//パスワード変更
Route::get('/user/{user_id}/password/reset','UserController@showresetform');
Route::post('/user/{user_id}/password/reset','UserController@resetpassword');

// タスク検索機能
Route::get('/task/search', 'TaskController@search');

// 自分のタスクのみ表示
Route::get('/tasks/user/{user_id}','TaskController@mytasks');

Route::get('/tasks/sort/username','TaskController@sortusername');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
  return view('welcome');
});




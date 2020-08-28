<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::group(['middleware' => 'auth'], function() {
    //ホーム画面表示
    Route::get('/', 'HomeController@index')->name('home');

    //タスク一覧ページ表示
    Route::get('/folders/{folder}/tasks', 'TaskController@index')->name('tasks.index');

    //フォルダ作成ページ表示
    Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
    //フォルダ作成処理実効
    Route::post('/folders/create', 'FolderController@create');

    //タスク作成ページ表示
    Route::get('/folders/{folder}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
    //タスク作成処理実効
    Route::post('/folders/{folder}/tasks/create', 'TaskController@create');

    //タスク編集ページ表示
    Route::get('/folders/{folder}/tasks/{task}/edit', 'TaskController@showEditForm')->name('tasks.edit');
    //タスク編集処理実効
    Route::post('/folders/{folder}/tasks/{task}/edit', 'TaskController@edit');
});

//会員登録
Auth::routes();

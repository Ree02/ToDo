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
    return view('welcome');
});

Route::get('folders/{id}/tasks', 'TaskController@index')->name('tasks.index'); 
/* 
/ /folders/{id}/tasksにリクエストが来たらTaskControllerのindexメソッドを呼び出す
/　tasks.indexはこのルートの名前でアプリケーションの中でURLを参照する際にはこの名前を利用
*/
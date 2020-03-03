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

Route::get('/', 'FrontController@index');

Route::get('/news', 'FrontController@news');

Route::get('/login', function () {
    return view('auth/login');
});

Auth::routes();



Route::group(['middleware' => ['auth'],'prefix' => 'home'], function (){
    // 首頁
    Route::get('/', 'HomeController@index');

    // 最新消息管理 (CRUD)
    // Read
    Route::get('/news', 'NewsController@index');
    // Create
    Route::get('/news/create', 'NewsController@create');
    Route::post('/news/store', 'NewsController@store');
    // Update
    Route::get('/news/edit/{id}', 'NewsController@edit');
    Route::post('/news/update/{id}', 'NewsController@update');
    // Delete
    Route::post('/news/delete/{id}', 'NewsController@delete');
});








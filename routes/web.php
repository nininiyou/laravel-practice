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
Route::get('/news/{id}', 'FrontController@news_detail');

Route::get('/login', function () {
    return view('auth/login');
});

// 產品購物車
Route::get('/product', 'FrontController@product'); //產品介面
Route::get('/product/{product_id}', 'FrontController@product_detail'); //產品資訊購買頁
Route::get('/product_order', 'FrontController@test_product_detail'); //cart結帳頁

// 加入購物車
Route::post('/add_cart/{product_id}', 'FrontController@add_cart'); //cart 加入購物車
Route::post('/update_cart/{product_id}', 'FrontController@update_cart'); //cart 更新購物車數量
Route::get('/delete_cart/{product_id}', 'FrontController@delete_cart'); //cart 刪除購物車中的商品
Route::get('/cart', 'FrontController@cart_total'); //cart 總覽



Route::get('/contact', 'FrontController@contact');
Route::post('/contact/store', 'FrontController@contact_store');



Auth::routes();



Route::group(['middleware' => ['auth'],'prefix' => 'home'], function (){
    // 首頁
    Route::get('/', 'HomeController@index');

    // ---最新消息管理 (CRUD)---
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

    // ajax 多張圖裡可直接在畫面作用刪除
    Route::post('ajax_delete_news_imgs', 'NewsController@ajax_delete_news_imgs');
    Route::post('ajax_post_sort', 'NewsController@ajax_post_sort');


    // ---產品管理頁 (CRUD)---
    // Read
    Route::get('product', 'ProductController@index');
    // Create
    Route::get('product/create', 'ProductController@create');
    Route::post('product/store', 'ProductController@store');
    // Update
    Route::get('product/edit/{id}', 'ProductController@edit');
    Route::post('product/update/{id}', 'ProductController@update');
    // Delete
    Route::post('product/delete/{id}', 'ProductController@delete');


      // ---產品類型管理 (CRUD)---
    // Read
    Route::get('productType', 'ProductTypeController@index');
    // Create
    Route::get('productType/create', 'ProductTypeController@create');
    Route::post('productType/store', 'ProductTypeController@store');
    // Update
    Route::get('productType/edit/{id}', 'ProductTypeController@edit');
    Route::post('productType/update/{id}', 'ProductTypeController@update');
    // Delete
    Route::post('productType/delete/{id}', 'ProductTypeController@delete');



    // 讓summernote裡面的檔案也能儲存和刪除
    Route::post('ajax_upload_img', 'UpLoadImageController@ajax_upload_img');
    Route::post('ajax_delete_img', 'UpLoadImageController@ajax_delete_img');


});









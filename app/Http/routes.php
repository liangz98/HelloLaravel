<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});*/

/*
 * 基本的 HTTP 操作分别为
 * GET 常用于页面读取
 * POST 常用于数据提交
 * PATCH 常用于数据更新
 * DELETE 常用于数据删除
 * PATCH 和 DELETE 是不被浏览器所支持的, 可以在表单中通过添加隐藏域的方式来欺骗服务器。
 */
Route::get('/default', function () {
    return view('welcome');
});
Route::get('/', 'StaticPagesController@home')->name('home');
Route::get('/help', 'StaticPagesController@help')->name('help');
Route::get('/about', 'StaticPagesController@about')->name('about');

Route::get('/signup', 'UsersController@addUser')->name('signup');
Route::get('/login', 'UsersController@login')->name('login');

Route::resource('user', 'UsersController');
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
Route::get('/contact', 'StaticPagesController@contact')->name('contact');

// 用户
Route::get('/signup', 'UsersController@addUser')->name('signup');
Route::resource('user', 'UsersController');
Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');

// 登录 退出
Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');

// 重置密码
Route::get('password/email', 'Auth\PasswordController@getEmail')->name('password.reset');   // 跳转忘记密码页
Route::post('password/email', 'Auth\PasswordController@postEmail')->name('password.reset'); // 提交
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset')->name('password.edit');
Route::post('password/reset', 'Auth\PasswordController@postReset')->name('password.update');

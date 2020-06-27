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

Route::get('/', function () {
    phpinfo();
    return view('welcome');
});

Route::get('/test/hello','TestController@hello');


Route::get('/user/reg','User\IndexController@reg');//前台用户注册
Route::post('/user/regDo','User\IndexController@regDo');//后台用户注册

Route::get('/user/login','User\IndexController@login');//前台用户登录
Route::post('/user/loginDo','User\IndexController@loginDo');//后台用户登录

Route::get('/user/center','User\IndexController@center');//用户中心


//API

Route::post('api/user/reg','Api\UserController@reg');//注册
<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can regist er all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
//首页
Route::get('/','IndexController@index');
	//关于我们
Route::get('index/abouts','IndexController@about');
	//我要租房
Route::get('index/wants','IndexController@want');
	//组前须知
Route::get('index/notices','IndexController@notice');
	//房东加盟
Route::get('index/fang_join','IndexController@join');
		//装修风格
Route::get('index/style','IndexController@styles');
		//加盟邻京
Route::get('index/linjing','IndexController@joinLin');
		//业务详情
Route::get('index/message','IndexController@message');
	//联系我们
Route::get('index/talk','IndexController@talk');
//登录页
Route::get('login','LoginController@login');
//注册
Route::get('register','LoginController@register');
//详情页
Route::get('index/details','IndexController@details');
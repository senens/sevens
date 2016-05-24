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
Route::get('index','IndexController@index');
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


//搜索页面
Route::get('search', 'SearchController@index');
//判断登陆	
Route::any('login/islogin','LoginController@islogin');
//登录页
Route::get('login','LoginController@login');
//判断登陆
Route::any('login/islogin','LoginController@islogin');
//房东用户中心
Route::any('login/user','LoginController@user');
//上传房源
Route::any('user/uhouse','LoginController@uhouse');
//接收房源
Route::any('login/up_house','LoginController@uphouse');
//上传用户头像
Route::any('user/upload_p','LoginController@uploadp');
//房东信息
Route::any('user/tenantmessage','LoginController@tenantmessage');
//售出房源
Route::any('user/sellh','LoginController@sellh');
//在售房源
Route::any('user/sellingh','LoginController@sellingh');
//求组信息
Route::any('tenant/please_zu','LoginController@pleasezu');
Route::any('tenant/wangted_zu','LoginController@wangted_zu');


//注册
Route::get('register','LoginController@register');
//用户注册
Route::any('login/user_register','LoginController@userregister');
//判断用户唯一性
Route::any('login/only_name','LoginController@onlyname');
//退登
Route::any('login/unset','LoginController@uexit');
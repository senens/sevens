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
	//详情页评论
Route::get('index/comments','IndexController@commented');

//搜索页面
Route::get('search', 'SearchController@index');
//多条件搜索
Route::get('search/all', 'SearchController@search');




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
//租出房源
Route::any('user/sellh','LoginController@sellh');
//在租房源
Route::any('user/sellingh','LoginController@sellingh');
//求组信息
Route::any('tenant/please_zu','LoginController@pleasezu');
Route::any('tenant/wangted_zu','LoginController@wangted_zu');
//租客信息
Route::any('tenant/tenantmessage','LoginController@zu_message');


//注册
Route::get('register','LoginController@register');
//用户注册
Route::any('login/user_register','LoginController@userregister');
//判断用户唯一性
Route::any('login/only_name','LoginController@onlyname');
//退登
Route::any('login/unset','LoginController@uexit');






//获取经纬度

//查看地图经纬度
Route::any('user/sel_map','LoginController@selmap');

//接收房源
Route::any('login/up_house','LoginController@uphouse');
//上传用户头像
Route::any('user/upload_p','LoginController@uploadp');
//房东信息
Route::any('user/tenantmessage','LoginController@tenantmessage');
//修改房东信息
Route::any('tenant/town_massage','LoginController@landlordmassage');
//完成修改
Route::any('tenant/finish_lup','LoginController@finishlup');

//邀好友
Route::any('user/intive_friend','LoginController@intivefriend');
//已租修改房源
Route::any('user/update_h','LoginController@updateh');
//已租完成修改
Route::any('user/update_houses','LoginController@updatehouse');
//删除房源
Route::any('user/del_list','LoginController@dellist');
//在租房源修改
Route::any('user/update_selling','LoginController@upselling');
//在租房源修改成功
Route::any('user/update_housesing','LoginController@updatehousesing');
//求组信息
Route::any('tenant/please_zu','LoginController@pleasezu');
//发布求组
Route::any('tenant/wangted_zu','LoginController@wangtedzu');
//求组列表
Route::any('tenant/wangtend_list','LoginController@wangtendlist');
//删除求组
Route::any('user/del_wangtedlist','LoginController@delwangtedlist');


//修改租客信息
Route::any('tenant/own_massage','LoginController@ownmassage');
//完成修改
Route::any('tenant/finish_up','LoginController@finishup');

<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Session;
use lifetime;
header("content-type:text/html;charset=utf-8");
use Validator;
use Input;
//use App\Http\Requests;

/**
 * 邻京有屋   用户登陆注册
 * ============================================================================
 * 版权所有 2005-2012 北京用友技术有限公司
 * 网站地址: http://www.linjing.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author:冯梦颖
 *
 */
	class LoginController extends Controller
	{
		public function index()
		{
			// return view('login');
		}

		 // 登录

		public function login()
		{
			return view('login');
		}

		 // 注册

		public function register()
		{
			return view('register');
		}
        //用户注册
        public function  userregister(Request $request)
        {
            $data = Input::all();
            $filename= $data['myfiles']->getClientOriginalName();
            //检验一下上传的文件是否有效.
            $path = $data['myfiles']-> move('D:\WWW\meng\linjing\laravel\public\uploads',$filename);
            $mtype = $request->input('mtype');
            $name = $request->input('userid');
            $nickname = $request->input('uname');
            $userpwd = $request->input('userpwd');
            $email = $request->input('email');
            $phone = $request->input('phone');
            $address = $request->input('address');

            $sex = $request->input('sex');
            //注册
            DB::table('user')->insert([
                'u_type' => $mtype,
                'u_name' => $name,
                'u_nickname' => $nickname,
                'u_pawd' => $userpwd,
                'u_email' => $email,
                'u_sex' => $sex,
                'u_address' =>$address,
                'u_phone' => $phone,
                'u_header_url'=>$filename,
            ]);
            return view('login');
        }
        //判断用户唯一性
        public function   onlyname(){
            $name=$_GET['name'];
            $users = DB::table('user')->where('u_name',$name)->get();
            // var_dump($users);
            if($users){
                echo 1;
            }
        }

        //判断登陆
        public function islogin(Request $request){
            $name=$request->input('userid');
            $pawd=$request->input('pwd');
            @$keeptime=$_POST['keeptime'];
            //判断时间
            if($keeptime=='month' or $keeptime=='week' or $keeptime=='day'){
            $val=array(
               'name'=>$name,
               'pawd'=>$pawd,
           );
                if($keeptime=='month' ){
                   // echo "月";die;
                    $lifeTime = 24 * 3600*30;  // 保存一天
                    session_set_cookie_params($lifeTime);

                }else if($keeptime=='week'){
                   // echo "周";die;
                    $lifeTime = 24 * 3600*7;  // 保存一天
                    session_set_cookie_params($lifeTime);

                }else if($keeptime=='day'){
                  //  echo "天";die;
                    $lifeTime = 24 * 3600;  // 保存一天
                    session_set_cookie_params($lifeTime);
                }
                Session::put('user_massage', $val);
            }else if($keeptime==0){
                $val=array(
                    'name'=>'',
                    'pawd'=>'',
                );
                Session::put('user_massage', $val);
            }
           $users = DB::table('user')->where('u_name', $name)->get();
            //var_dump($users) ;die;
            @$pawds=$users[0]->u_pawd;
            //var_dump($pawds);
            if($users){
                if($pawds==$pawd){
                    Session::put('name', $name);
                    return   redirect('index');
                }else{
                    echo "密码输入错误";
                }
            }else{
                echo "用户名不存在";
            }
        }
        //退出登陆
        public function uexit(){
            Session::forget('name');
            return redirect('/');
        }

        //用户中心
        public function  user(){
            $value = Session::get('name');
            $user = DB::table('user')->where('u_name', $value)->get();
            $u_type=$user[0]->u_type;
            $u_id=$user[0]->u_id;
            //echo $u_id;die;
            Session::put('u_id',$u_id);
            if($u_type==0){
                //租客
                return view('tenant_zhong');
            }else{
                //房东
                return view('user_zhong');
            }
        }
        //房东用户中心开始*******************************************************************************
        //上传房源
        public function  uhouse(){
            return view('user_up_house');
        }
        //接收房源
        public function  uphouse(Request $request){
           // echo 111;die;
            //$a=   $_REQUEST->post();
          //  var_dump($a);die;
            $data = Input::all();
            $filename= $data['myfiles']->getClientOriginalName();
            $path = $data['myfiles']-> move('D:\WWW\meng\linjing\laravel\public\images',$filename);
          //  echo $filename;die;
            $id=Session::get('u_id');
           $h_rent_type= $request->input('h_rent_type');
            $h_plot_name= $request->input('h_plot_name');
            $h_loc_detail= $request->input('h_loc_detail');
            $h_gender_demand= $request->input('h_gender_demand');
            $h_room_num= $request->input('h_room_num');
            $h_hall_num= $request->input('h_hall_num');
            $h_toilet_num= $request->input('h_toilet_num');
            $h_floor_st= $request->input('h_floor_st');
            $h_floor_all= $request->input('h_floor_all');
            $h_area= $request->input('h_area');
            $h_orientation= $request->input('h_orientation');
            $h_decorate= $request->input('h_decorate');
            $h_type= $request->input('h_type');
            $h_facility= $request->input('h_facility');
            $h_price= $request->input('h_price');
            $h_price_type= $request->input('h_price_type');
            $h_title= $request->input('h_title');
            $h_description= $request->input('h_description');
            $h_photo= $request->input('myfiles');
            $h_contact_name= $request->input('h_contact_name');
            $h_contact_phonenumber= $request->input('h_contact_phonenumber');
            $h_pub_date= $request->input('h_pub_date');
            $h_ischeck= $request->input('h_ischeck');
            $h_issell= $request->input('h_issell');
            $h_timelimit= $request->input('h_timelimit');
            $h_description=$request->input('h_description');
            DB::table('housese')->insert([
                'u_id' => $id,
                'h_rent_type' => $h_rent_type,
                'h_plot_name' => $h_plot_name,
                'h_loc_detail' => $h_loc_detail,
                'h_gender_demand' => $h_gender_demand,
                'h_room_num' => $h_room_num,
                'h_hall_num'=> $h_hall_num,
                'h_toilet_num' => $h_toilet_num,
                'h_floor_st' => $h_floor_st,
                'h_floor_all' => $h_floor_all,
                'h_area' => $h_area,
                'h_orientation' => $h_orientation,
                'h_decorate' => $h_decorate,
                'h_type' => $h_type,
                'h_facility' => $h_facility,
                'h_price' => $h_price,
                'h_price_type' => $h_price_type,
                'h_title' => $h_title,
                'h_description' => $h_description,
                'h_photo' => $h_photo,
                'h_contact_name' => $h_contact_name,
                'h_contact_phonenumber' => $h_contact_phonenumber,
                'h_pub_date' => $h_pub_date,
                'h_ischeck' => $h_ischeck,
                'h_issell' => $h_issell,
                'h_timelimit' => $h_timelimit,
            ]);
           echo "<script>alert('发布房源成功')</script>";
           return redirect('user/sellingh');
        }
        //房东信息
        public function   tenantmessage(){
           // echo 11111;
            $value = Session::get('name');
            $user = DB::table('user')->where('u_name', $value)->get();
            return view('tenant_message',array('valls' => $user));
        }
        //已售房源
        public function  sellh(){
            $houses = DB::table('housese')->where('h_issell', 1)->get();
            return view('sell_h',array('valls' => $houses));
        }
        //在售房源
        public function   sellingh(){
            $houses = DB::table('housese')->where('h_issell',0)->get();
            return view('selling_h',array('valls' => $houses));
        }
        //删除房源
        public function dellist(Request $request){
           // echo 111;die;
            $id=$request->input('id');
           // echo $id;die;
            $dd=DB::table('housese')->where('h_id', $id)->delete();
           if($dd){
               echo 0;
           }else{
               echo 1;
           }
        }
        //批删
        public function pishanlist(Request $request){
            $id=$request->input('id');
            //print_r($id);die;
            $ids=explode(",",$id);
         // print_r($ids);die;
            // echo $id;die;
            $dd=DB::table('housese')->whereIn('h_id',$ids)->delete();
          //  echo $dd;die;
            if($dd){
                echo 0;die;
            }else{
                echo 1;die;
            }
        }
        //修改房源表
        public function  updateh(Request $request){
            $id=$request->input('id');
           // echo $id;die;
            $houses = DB::table('housese')->where('h_id',$id)->get();
            //var_dump($houses);die;
            return view('up_selling_h2',array('valls' => $houses));
        }

        //房东信息结束********************************************************************************************
        //租客用户中心
    public function pleasezu(){
        $name=Session::get('name');
        if($name=='') {

            echo "<script>alert('请先登录');location.href='login'</script>";
        }else{
            return view('wanted_zu');
        }

     }
        //求租
        public function  wangted_zu(Request $request){
            $u_id = Session::get('u_id');
            //echo  $u_id;die;
            $title = $request->input('title');
            $area=$request->input('area');
            $money=$request->input('money');
            $zu_request=$request->input('zu_request');
            $last_time=$request->input('last_time');
            $name=$request->input('name');
            $phone=$request->input('phone');
            $time=date("Y-m-d H:i:s");

            //发布求组
            DB::table('housewanted')->insert([
                'user_id' => $u_id,
                'hw_title' => $title,
                'area_id' => $area,
                'hw_Price' => $money,
                'hw_rooms' => $zu_request,
                'hw_description' => $area,
                'hw_lastdate' => $last_time,
                'hw_contact_name' => $name,
                'hw_contact_phone' => $phone,
                'hw_pub_datetime' => $time,
            ]);
          //  echo "<script>alert('发布成功');location.href='wangtend_list'</script>";
            echo "添加成功";
            return redirect('tenant/wangtend_list');
        }
        //列表请求
        public function wangtend_list(){
            $u_id = Session::get('u_id');
            $houses = DB::table('housewanted')->where('user_id', $u_id)->get();
            //var_dump($houses);die;
            return view('wanted_list',array('valls' => $houses));
        }
        //租客信息
        public function  zu_message(){
            $u_id = Session::get('u_id');
            $valls = DB::table('user')->where('u_id', $u_id)->get();
            //var_dump($valls);die;
            return view('zu_message',array('valls' => $valls));
        }




  }

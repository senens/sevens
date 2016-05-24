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

/*
 *
 *
 * */
	class LoginController extends Controller
	{
		public function index()
		{
			// return view('login');
		}
		/**
		 * 登录
		 *
		 */
		public function login()
		{
			return view('login');
		}
		/**
		 * 注册
		 * 
		 */
		public function register()
		{
			return view('register');
		}
	 //判断登陆
        public function islogin(){

            $name=$_POST['userid'];
            $pawd=$_POST['pwd'];
            @$keeptime=$_POST['keeptime'];
            //判断时间
            if($keeptime=='month' or $keeptime=='week' or $keeptime=='day'){
            $val=array(
               'name'=>$name,
               'pawd'=>$pawd,
           );
                //session_set_cookie_params()
                Session::put('user_massage', $val);
                if($keeptime=='month' ){
                   // echo "月";die;
                    //lifetime(3600*24*30);
                }else if($keeptime=='week'){
                    //echo "周";die;
                    //lifetime(3600*24*7);
                }else if($keeptime=='day'){
                   // echo "天";die;
                   // lifetime(3600*24);
                }

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
        //用户中心
        public function  user(){
            $value = Session::get('name');
            $user = DB::table('user')->where('u_name', $value)->get();
            $u_type=$user[0]->u_type;
            $u_id=$user[0]->u_id;
            //echo $u_id;die;
            Session::put('u_id',$u_id);
           // $id=Session::get('u_id');
           // echo $id;die;
            //echo $u_type;die;
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
        public function  uphouse(){
            echo 111;die;
            //$a=   $_REQUEST->post();
          //  var_dump($a);die;
           /* $h_rent_type= $request->post('h_rent_type');
            $h_plot_name= $request->post('h_plot_name');
            $h_loc_detail= $request->post('h_loc_detail');
            $h_gender_demand= $request->post('h_gender_demand');
            $h_room_num= $request->post('h_room_num');
            $h_hall_num= $request->post('h_hall_num');
            $h_toilet_num= $request->post('h_toilet_num');
            $h_floor_st= $request->post('h_floor_st');
            $h_floor_all= $request->post('h_floor_all');
            $h_area= $request->post('h_area');
            $h_orientation= $request->post('h_orientation');
            $h_decorate= $request->post('h_decorate');
            $h_type= $request->post('h_type');
            $h_facility= $request->post('h_facility');
            $h_price= $request->post('h_price');
            $h_price_type= $request->post('h_price_type');
            $h_title= $request->post('h_title');
            $h_description= $request->post('h_description');
            $h_photo= $request->post('h_photo');
            $h_contact_name= $request->post('h_contact_name');
            $h_contact_phonenumber= $request->post('h_contact_phonenumber');
            $h_pub_date= $request->post('h_pub_date');
            $h_ischeck= $request->post('h_ischeck');
            $h_issell= $request->post('h_issell');
            $h_timelimit= $request->post('h_timelimit');*/


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
        //判断用户唯一性
        public function   onlyname(){
            $name=$_GET['name'];
            $users = DB::table('user')->where('u_name',$name)->get();
           // var_dump($users);
            if($users){
                echo 1;
            }
        }
        //房东信息结束********************************************************************************************
        //租客用户中心
    public function pleasezu(){
        return view('wanted_zu');
     }
        //求租
        public function  wangted_zu(Request $request){
            $u_id = Session::get('u_id');
            $title = $request->input('title');
            $area=$request->input('area');
            $money=$request->input('money');
            $zu_request=$request->input('zu_request');
            $last_time=$request->input('last_time');
            $name=$request->input('name');
            $phone=$request->input('phone');
            $time=date("Y-m-d H;i;s");

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
            echo '发布成功';

        }


         //用户注册
        public function  userregister()
        {
            $data = Input::all();
            $filename= $data['myfiles']->getClientOriginalName();
             //检验一下上传的文件是否有效.
            $path = $data['myfiles']-> move('D:\WWW\fmy\linjing\laravel\public\uploads',$filename);
            //var_dump($path);
            $mtype = $_POST['mtype'];
            $name = $_POST['userid'];
            //  $name = $request->input('name');
            $nickname = $_POST['uname'];
            $userpwd = $_POST['userpwd'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $sex = $_POST['sex'];
            //注册
            DB::table('user')->insert([
                'u_type' => $mtype,
                'u_name' => $name,
                'u_nickname' => $nickname,
                'u_pawd' => $userpwd,
                'u_email' => $email,
                'u_sex' => $phone,
                'u_address' => $sex,
                'u_phone' => $phone,
                'u_header_url'=>$filename,
            ]);
            return view('login');
      //  }

        }
        //退出登陆
     public function uexit(){
         Session::forget('name');
         return redirect('/');
    }


  }

<?php

namespace App\Http\Controllers;
// use Request;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Session;
use lifetime;
use Validator;
use Input;
use Cookie;
//use App\Http\Requests;

/**
 * 邻京有屋   用户登陆注册       个人中心
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

		public function login(Request $request)
		{
            $url = $request->input('UrlVals');
            setcookie('url',$url,time()+20);
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
            $path = $data['myfiles']-> move('C:\server\WWW\linjing\laravel\public\images',$filename);
            $mtype = $request->input('mtype');
            $name = $request->input('userid');
            $nickname = $request->input('uname');
            $userpwd = MD5($request->input('userpwd'));
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
        public function  onlyname(){
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
            $pawd=MD5($request->input('pwd'));
            @$keeptime=$_POST['keeptime'];
            //判断时间
            if($keeptime=='month' or $keeptime=='week' or $keeptime=='day'){
            $val=array(
               'name'=>$name,
               'pawd'=>$pawd,
           );
                if($keeptime=='month' ){
                    $lifeTime = 24 * 3600*30;  // 保存一天
                    session_set_cookie_params($lifeTime);

                }else if($keeptime=='week'){
                    $lifeTime = 24 * 3600*7;  // 保存一天
                    session_set_cookie_params($lifeTime);

                }else if($keeptime=='day'){
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
            @$pawds=$users[0]->u_pawd;
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
            Session::put('u_id',$u_id);
            if($u_type==0){
                //租客
                $u_id = Session::get('u_id');
                $valls = DB::table('user')->where('u_id', $u_id)->get();
                return view('zu_message',array('valls' => $valls));
            }else{
                //房东
                $value = Session::get('name');
                $user = DB::table('user')->where('u_name', $value)->get();
                return view('tenant_message',array('valls' => $user));
            }
        }

        //房东用户中心开始
        //上传房源
        public function  uhouse(){
            return view('user_up_house');
        }
        //接收房源
        public function  uphouse(Request $request){
            $data = Input::file('myfile');
            $str='';
            for($i=0;$i<count($data);$i++){
                $filename= $data[$i]->getClientOriginalName();
                $path = $data[$i]-> move('C:\server\WWW\linjing\laravel\public\images',$filename);
                $str.='|'.$filename;
            }
            $str1 = substr($str,1);
            $id=Session::get('u_id');
            $lng=$request->get('lng');
            $lat=$request->input('lat');
            $jw=$lng.','.$lat;
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
            $h_facilitys=implode('|',$h_facility);
            $h_price= $request->input('h_price');
            $h_price_type= $request->input('h_price_type');
            $h_title= $request->input('h_title');
            $h_description= $request->input('h_description');
            $h_photo= $str1;
            $h_contact_name= $request->input('h_contact_name');
            $h_contact_phonenumber= $request->input('h_contact_phonenumber');
            $h_pub_date= time();
            $h_ischeck= 0;
            $h_issell= $request->input('h_issell');
            $h_timelimit= $request->input('h_timelimit');

            DB::table('housese')->insert(array(
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
                'h_facility' => $h_facilitys,
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

            ));
           echo "<script>alert('发布房源成功')</script>";
           return redirect('user/sellingh');
        }
        //房东信息
        public function   tenantmessage(){
            $value = Session::get('name');
            $user = DB::table('user')->where('u_name', $value)->get();
            return view('tenant_message',array('valls' => $user));
        }
        //修改房东信息
        public function landlordmassage(Request $request){
                $id=$request->input('id');
                Session::set('u_id',$id);
                //查看
                $own_m = DB::table('user')->where('u_id',$id)->get();
                return view('update_lmessage',array('valls'=>$own_m));
            }
            //完成修改
            public function finishlup(Request $request){
                $id=Session::get('u_id');
                $data = Input::file('myfile');
                $filename= $data->getClientOriginalName();
              //  echo $filename;die;
                //检验一下上传的文件是否有效.
                $path = $data-> move('C:\server\WWW\linjing\laravel\public\uploads',$filename);
                $nickname=$request->input('nickname');
                $sex=$request->input('sex');
                $phone=$request->input('phone');
                $u_email=$request->input('u_email');
                //修改数据库
                DB::table('user')
                    ->where('u_id', $id)
                    ->update(array(
                         'u_header_url'=>$filename,
                        'u_nickname' => $nickname ,
                        'u_email' =>$sex,
                        'u_sex' =>$phone,
                        'u_phone' =>$u_email,
                    ));
                return redirect('user/tenantmessage');
            }
       //邀好友
        public function  intivefriend(){
            return view('intivefriend');
        }
        //已租房源
        public function  sellh(){
            $id=Session::get('u_id');
            $houses['house'] = DB::table('housese')->where('h_issell', 1)->where('u_id', $id)->paginate(2);
            return view('sell_h',$houses);
        }
        //在租房源
        public function   sellingh(){
            $id=Session::get('u_id');
            $houses['house'] = DB::table('housese')->where('h_issell',0)->where('u_id', $id)->paginate(2);
            return view('selling_h',$houses);
        }
        //删除房源
        public function dellist(Request $request){
            $id=$request->input('id');
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
            $ids=explode(",",$id);
            $dd=DB::table('housese')->whereIn('h_id',$ids)->delete();
            if($dd){
                echo 0;die;
            }else{
                echo 1;die;
            }
        }
        //修改已租房源表
        public function  updateh(Request $request){
            $id=$request->input('id');
            Session::set('h_id',$id);
            $houses = DB::table('housese')->where('h_id',$id)->get();
            return view('up_sell_h',array('valls' => $houses));
        }
        //已租完成修改
        public function  updatehouse(Request $request){
            $id=Session::get('h_id');
            $h_rent_type= $request->input('h_rent_type');
            $h_plot_name= $request->input('h_plot_name');
            $h_loc_detail= $request->input('h_loc_detail');
            $h_gender_demand= $request->input('h_gender_demand');
            $h_room_num= $request->input('h_room_num');
            $h_hall_num= $request->input('h_hall_num');
            $h_toilet_num= $request->input('h_toilet_num');
            $h_price= $request->input('h_price');
            $h_price_type= $request->input('h_price_type');
            $h_title= $request->input('h_title');
            $h_description= $request->input('h_description');
            $h_contact_name= $request->input('h_contact_name');
            $h_contact_phonenumber= $request->input('h_contact_phonenumber');
            $h_timelimit= $request->input('h_timelimit');
            //修改
            DB::table('housese')
                ->where('h_id', $id)
                ->update(array('h_rent_type' => $h_rent_type,
                    'h_plot_name' => $h_plot_name ,
                    'h_loc_detail' =>$h_loc_detail,
                    'h_gender_demand' =>$h_gender_demand,
                    'h_room_num' =>$h_room_num,
                    'h_hall_num'=>$h_hall_num,
                    'h_toilet_num' =>$h_toilet_num,
                    'h_price' => $h_price,
                    'h_price_type' =>$h_price_type ,
                    'h_title' => $h_title,
                    'h_description' =>$h_description,
                    'h_contact_name' =>$h_contact_name,
                    'h_contact_phonenumber' =>$h_contact_phonenumber,
                    'h_timelimit' =>$h_timelimit ,
                ));

            echo "<script>alert('修改成功')</script>";
            return redirect('user/sellh');

        }
        //在租房源修改
        public function upselling(Request $request){
            $id=$request->input('id');
            Session::set('h_id',$id);
            $houses = DB::table('housese')->where('h_id',$id)->get();
            return view('up_selling_h',array('valls' => $houses));
        }
        //在租房源修改完成
        public function updatehousesing(Request $request){
            $id=Session::get('h_id');
            $h_rent_type= $request->input('h_rent_type');
            $h_plot_name= $request->input('h_plot_name');
            $h_loc_detail= $request->input('h_loc_detail');
            $h_gender_demand= $request->input('h_gender_demand');
            $h_room_num= $request->input('h_room_num');
            $h_hall_num= $request->input('h_hall_num');
            $h_toilet_num= $request->input('h_toilet_num');
            $h_price= $request->input('h_price');
            $h_price_type= $request->input('h_price_type');
            $h_title= $request->input('h_title');
            $h_description= $request->input('h_description');
            $h_contact_name= $request->input('h_contact_name');
            $h_contact_phonenumber= $request->input('h_contact_phonenumber');
            $h_timelimit= $request->input('h_timelimit');
            //修改
            DB::table('housese')
                ->where('h_id', $id)
                ->update(array('h_rent_type' => $h_rent_type,
                    'h_plot_name' => $h_plot_name ,
                    'h_loc_detail' =>$h_loc_detail,
                    'h_gender_demand' =>$h_gender_demand,
                    'h_room_num' =>$h_room_num,
                    'h_hall_num'=>$h_hall_num,
                    'h_toilet_num' =>$h_toilet_num,
                    'h_price' => $h_price,
                    'h_price_type' =>$h_price_type ,
                    'h_title' => $h_title,
                    'h_description' =>$h_description,
                    'h_contact_name' =>$h_contact_name,
                    'h_contact_phonenumber' =>$h_contact_phonenumber,
                    'h_timelimit' =>$h_timelimit ,
                ));
            return redirect('user/sellingh');
        }
        //房东信息结束
        //租客用户中心
    public function pleasezu(){
        $name=Session::get('name');
        if($name=='') {

            echo "<script>alert('请先登录');location.href='login'</script>";
        }else{
            return view('wanted_zu');
        }

     }
      //修改个人资料
        public function ownmassage(Request $request){
             $id=$request->input('id');
            Session::set('u_id',$id);
           //查看
            // echo $id;die;
            $own_m = DB::table('user')->where('u_id',$id)->get();
            //var_dump($own_m);die;
            return view('update_message',array('valls'=>$own_m));
        }
          //完成修改
          public function finishup(Request $request){
              $id=Session::get('u_id');

              $nickname=$request->input('nickname');
              $sex=$request->input('sex');
              $phone=$request->input('phone');
              $u_email=$request->input('u_email');
              //修改数据库
              DB::table('user')
                  ->where('u_id', $id)
                  ->update(array(

                      'u_nickname' => $nickname ,
                      'u_email' =>$sex,
                      'u_sex' =>$phone,
                      'u_phone' =>$u_email,
                  ));
              return redirect('tenant/tenantmessage');
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
            echo "添加成功";
            return redirect('tenant/wangtend_list');
        }
        //列表请求
        public function wangtend_list(){
            $u_id = Session::get('u_id');
            $houses = DB::table('housewanted')->where('user_id', $u_id)->get();
            return view('wanted_list',array('valls' => $houses));
        }
        //删除求租信息
        public function  delwangtedlist(Request $request){
            // echo 111;die;
            $id=$request->input('id');
            $dd=DB::table('housewanted')->where('hw_id', $id)->delete();
           if($dd){
                echo 0;
            }else{
                echo 1;
            }
        }
        //租客信息
        public function  zu_message(){
            $u_id = Session::get('u_id');
            $valls = DB::table('user')->where('u_id', $u_id)->get();
            return view('zu_message',array('valls' => $valls));
        }




  }

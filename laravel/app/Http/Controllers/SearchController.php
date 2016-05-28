<?php

namespace App\Http\Controllers;

use Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Search;

/**
 * 邻京有屋   搜索页面控制器
 * 版权所有 2016-2017 北京用友技术有限公司
 * 网站地址: http://www.linjing.com；
 * 作者:范晓龙
 */
class SearchController extends Controller
{
    /**
     * 跳转搜索页面
     *
     * @return 房源详细信息
     */
    public function index()
    {
        //接首页搜索框的值
        $db = new \App\Search;
        $data = Request::only('searchs');
        if($data){
            //查小区名对应的房源
            $h_data = $db->plotHouses($data['searchs']);
            if($h_data->items()){
                $housedata['house'] = $h_data;
            }else{
                $a_data = $db->areaHouse($data['searchs']);
                if($a_data->items()){
                    $housedata['house'] = $a_data;
                }else{
                    $z_data = $db->zoneHouse($data['searchs']);
                    if($z_data->items()){
                        $housedata['house'] = $z_data;
                    }
                }
            }
            //评论数
            $housedata['comcount'] = $db->comcount($housedata['house']->items());
            //查询区域
            $housedata['zone'] = $db->selectHouse($housedata['house']);
            $housedata['housecount'] = $housedata['house']->total();
        }else{
            $housedata['zone'] = '';
            $housedata['house'] = '';
            $housedata['housecount'] = 0;
        }

        //设置东八区
        date_default_timezone_set('Etc/GMT-8');
        $housedata['time'] = time();
        //查询全部区域
        $housedata['zoneall'] = $db->select('zone');
        //查看全部商圈
        $housedata['areaall'] = $db->select('area');
        $housedata['price'] = '';
        return view('searchs', $housedata);

    }

    /**
     * 多条件搜索
     * @return array
     */
    public function search()
    {
        //
        $db = new \App\Search;
        $data = Request::all();
        //价格
        $price = $data['price'];
        //居室
        $h_type = $data['h_type'];
        //房屋类型
        $types = $data['types'];
        $data['house'] = $db->allHouse($price, $h_type, $types);
        //查看房源数量
        $data['housecount'] = $data['house']->total();
        if($data['housecount']){
            //评论数
            $data['comcount'] = $db->comcount($data['house']->items()); 
            //查询区域
            $data['zone'] = $db->selectHouse($data['house']);
        }else{
            $data['zone'] = '';
        }
        

        //设置东八区
        date_default_timezone_set('Etc/GMT-8');
        $data['time'] = time();
        //查询全部区域
        $data['zoneall'] = $db->select('zone');
        //查看全部商圈
        $data['areaall'] = $db->select('area');
        //dd($data);
        return view('searchs', $data);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       /* $rq = Request::all();//获取所有接收到的数据

        $validator Validator::make($rq, [
            'username' => 'requried|min:4|max:16|unique:users(表名)',//不为空4--16位，唯一（自动到表中查询）或者可以写成'requried|between:4,32'

            'phone' => 'numeric|r equried',//必须数字

            ]);
        if($validator->false())
        {
            return $validator->error();
        }
        return '验证成功';*/
    }
  
}

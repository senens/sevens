<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;


/**
 * 邻京有屋   搜索模型
 * 版权所有 2016-2017 北京用友技术有限公司
 * 网站地址: http://www.linjing.com；
 * 作者:范晓龙
 */
class Search extends Model
{
    /**
     * 查询小区名对应的房源
     * 
     * @return  obj
     */
    public function plotHouses($data){
        $h_data = DB::table('housese')
                    ->join('area', 'housese.area_id', '=', 'area.area_id')
                    ->where('h_plot_name', 'like', '%'.$data.'%')
                    ->Paginate(2);

        return $h_data;
    }

    /**
     * 查询商圈对应的房源
     * 
     * @return  obj
     */
    public function areaHouse($data){
        $a_data = DB::table('housese')
                    ->join('area', 'housese.area_id', '=', 'area.area_id')
                    ->where('area_name', 'like', '%'.$data.'%')
                    ->Paginate(2);
                    
        return $a_data;
    }

    /**
     * 查询区域对应的房源
     * 
     * @return  obj
     */
    public function zoneHouse($data){
        $z_data = DB::table('zone')
                    ->where('z_name', 'like', '%'.$data.'%')
                    ->get();
        if($z_data){
            $zoneid = $z_data[0]->z_id;
            $z_data = DB::table('housese')
                        ->join('area', 'housese.area_id', '=', 'area.area_id')
                        ->where('z_id', $zoneid)
                        ->Paginate(2); 
           return $z_data;
        } 
        return null;
        
    }
	/**
	 * 查询所有
     *
     * @return  obj
	 */
    public function select($table){

    	$zone = DB::table($table);
    	return $zone->get();

    }

    /**
     * 查询区域信息
     *
     * @return  obj
     */
    public function selectHouse($data){
        $arr =array();
        foreach ($data as $key => $value) {
            $arr[] = $value->z_id;
        }
    	
    	$zone = DB::table('zone')
    				->whereIn('z_id', $arr)
    				->get();
    	return $zone[0]->z_name;
        
    }

    /**
     * 有了房源id查询商圈和房源
     */
    public function selectarea($id){
        $zoneId = DB::table('housese')
                    ->join('area', 'housese.area_id', '=', 'area.area_id')
                    ->whereIn('h_id', $id)
                    ->where('h_ischeck', 1)
                    ->paginate(2);
        return $zoneId;
    }

    /**
     * 查询评论数
     *
     * @return  obj
     */
    public function comcount($data){
        foreach ($data as $k => $v) {
            $comcount = DB::table('comment')
                            ->where('ho_id', $v->h_id)
                            ->where('c_status', 1)
                            ->get();
            $count[$k] = count($comcount); 
        }
        
        return $count;
    }

    /**
     * 查询房屋类型为别墅的房源
     *
     * @return  obj
     */
    public function villaHouse(){
        $data = DB::table('housese')
                    ->join('area', 'housese.area_id', '=', 'area.area_id')
                    ->where('h_ischeck', 1)
                    ->where('h_type', 3)
                    ->paginate(2);
        return $data;
    }

    /**
     * 查询价格对应的房源
     *
     * @return  obj
     */
    public function allHouse($price, $h_type, $types, $h_facility, $zone, $area){
        $data = DB::table('housese')
                    ->join('area', 'housese.area_id', '=', 'area.area_id')
                    ->where('h_ischeck', 1);   
        //价格     
        if($price == '500以下'){
            $data = $data->where('h_price', '<=', 500);   
        }elseif($price == '500-1000'){
            $data = $data->where('h_price', '>', 500)
                         ->where('h_price', '<=', 1000);
        }elseif($price == '1000-2000'){
            $data = $data->where('h_price', '>', 1000)
                         ->where('h_price', '<=', 2000);
        }elseif($price == '2000-3000'){
            $data = $data->where('h_price', '>', 2000)
                         ->where('h_price', '<=', 3000);
        }elseif($price == '3000-4000'){
            $data = $data->where('h_price', '>', 3000)
                         ->where('h_price', '<=', 4000);
        }elseif($price == '4000以上'){
            $data = $data->where('h_price', '>', 4000);
        }   
        
        //居室
        if($h_type == '一居'){
            $data = $data->where('h_room_num', 1);   
        }elseif($h_type == '二居'){
            $data = $data->where('h_room_num', 2);
        }elseif($h_type == '三居'){
            $data = $data->where('h_room_num', 3);
        }elseif($h_type == '四居及以上'){
            $data = $data->where('h_room_num', '>', 4);
        } 
        
        //房屋类型
        if($types == '普通住房'){
            $data = $data->where('h_type', 0);   
        }elseif($types == '公寓'){
            $data = $data->where('h_type', 1);
        }elseif($types == '平房'){
            $data = $data->where('h_type', 2);
        }elseif($types == '别墅'){
            $data = $data->where('h_type', 3);
        }elseif($types == '农家乐'){
            $data = $data->where('h_type', 4);
        }

        //设施
        if($h_facility){
            $h_facility = explode(',', $h_facility);
            foreach ($h_facility as $v) {
                $data = $data->where('h_facility', 'like', '%'.$v.'%');
            }
        }

        //行政区
        if($area){
            $data = $data->where('housese.area_id', $area);
        }

            $data = $data->paginate(2);
            return $data;
    }
}

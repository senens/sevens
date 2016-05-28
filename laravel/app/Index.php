<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
/**
 * 邻京有屋   首页模型
 * 版权所有 2016-2017 北京用友技术有限公司
 * 网站地址: http://www.linjing.com；
 * 作者:刘泽学/范晓龙
 */
class Index extends Model
{
	/**
	 * 查询首页六条房源
	 * @return $data
	 */
    public function houses(){
    	$data = DB::table('housese')
    				->take(6)
			        ->get();
		return $data;
    }

    /**
     * 查询详情页房源
     * @return $data
     */
    public function getHouse($id){
		$data = DB::table('housese')
		         ->where('h_id',$id)
		         ->get();
		
		return $data;
    }

    /**
     * 查询轮播图
     * @return $data
     */
    public function getImg(){
    	$data = DB::table('active')
    				->where('act_status', 1)
    				->take(5)
    				->get();
    	return $data;
    }
}

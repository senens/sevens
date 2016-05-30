<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
/**
 * 邻京有屋   详情页评论
 * 版权所有 2016-2017 北京用友技术有限公司
 * 网站地址: http://www.linjing.com；
 * 作者:Liu Zexue
 */
class Comments extends Model
{	
	/**
	 * [CommentInsert description]
	 * @param [type] $XingVal   [description]星值
	 * @param [type] $TextVal   [description]描述
	 * @param [type] $Id        [description]房源id
	 * @param [type] $SessionId [description]登录人id
	 * @param [type] $date      [description]时间
	 */
    public function CommentInsert($XingVal,$TextVals,$Id,$sid,$date)
    {
    	$bool = DB::table('comment')->insert([
		    [
		    	'c_desc' => $TextVals,
		    	'c_value' => $XingVal,
			    'ho_id' => $Id,
			    'u_id' => $sid,
			    'c_time' => $date,
		    ]
		   
		]);
		return $bool;

    }
    /**
     * 
     * @param [type] $SessionId [description]判断用户是否以评论
     */
    public function CommentSelect($SessionId,$id)
    {
    	$str = DB::table('comment')
             ->where('u_id',$SessionId)
             ->where('ho_id',$id)
             ->get();
        return $str;
    }
    /**
     * 评论表 评论表 用户表 三表联查
     * @param [type] $Hid [description]
     */
    public function CommentSelects($Hid)
    {
    	$data = DB::table('comment')
    		 ->join('user', 'comment.u_id', '=', 'user.u_id')
    		 ->join('housese', 'comment.ho_id', '=', 'housese.h_id')
    		 ->where('ho_id',$Hid)
    		 ->orderBy('c_id', 'desc')
             ->paginate(5);
        return $data;
    }
    /**
     * 评论表 评论表 两表联查
     */
    public function CommentTwo()
    {
    	$data = DB::table('comment')
    		 ->join('housese', 'comment.ho_id', '=', 'housese.h_id')
    		 ->get();
        return $data;
    }
    /**
     * 最新房源
     */
    public function NewHouse()
    {
    	$data = DB::table('housese')
    		 ->orderBy('h_id', 'desc')
    		 ->limit(4)
    		 ->get();
        return $data;
    }
    /**
     * 查询房源评价总条数
     * string
     */
    public function NewCount($Hid)
    {
    	$count = DB::table('comment')
    			->select(DB::raw('count(*) as value'))
    			->where('ho_id', $Hid)
    			->get();
    	return $count;
    }
    /**
     * [NewValue description] 返回针对房源评价的所有星值
     * @param [type] $Hid [description]
     */
    public function NewValue($Hid)
    {
    	$str = DB::table('comment')
    			->select('c_value')
    			->where('ho_id', $Hid)
    			->get();
    	return $str;
    }
    /**
     * [HouseUpdaeVal description] 修改房源评价星值
     * @param [type] $id [description]
     */
    public function HouseUpdaeVal($id,$average)
    {
    	$bool = DB::table('housese')
              ->where('h_id', $id)
              ->update(['h_average' => $average]);
         return $bool;
    }
    /**
     * [House description] 房源推荐 根据好评平均值进行判断
     * @param [type] $id [description] 
     */
    public function House()
    {
    	$data = DB::table('housese')
    		 ->where('h_average','>=',3.8)
    		 ->get();
        return $data;
    }
    /**
     * [HousePosition description]  返回房源的经纬度
     * @param [type] $id [description]
     */
     public function HousePosition($id)
    {
    	$data = DB::table('housese')
    	     ->select('h_lng','h_lat')
    		 ->where('h_id',$id)
    		 ->get();
        return $data;
    }
   
}

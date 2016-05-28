<?php 
namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use URL;
use App\Index;
	/**
	 * 邻京有屋   首页控制器
	 * 版权所有 2016-2017 北京用友技术有限公司
	 * 网站地址: http://www.linjing.com；
	 * 作者:刘泽学/范晓龙
	 */
	class IndexController extends Controller
	{
		/**
		 * 跳转首页
		 * 
		 * @return array
		 */
		public function index()
		{
			$db = new Index;
			//推荐房源
			$house['data'] = $db->houses();
			//轮播图广告
			$img = $db->getImg();
			$house['ad'] = $img[0];
			$img = $house['ad']->act_url;
			$house['img'] = explode('|', $img);
			//广告照片路径
			/*$url = dirname(dirname(app_path()));
			$url = str_replace('\\', "/", $url);
			foreach ($house['img'] as $k => $v) {
				$house['url'][$k] = str_replace('/', '\\', 'file:///'.$url.'/uploads/'.$v);
			}*/
			return view('index', $house);
		}
		/**
		 * 关于我们
		 */
		public function about()
		{
			return view('about');
		}
		/**
		 * 我要租房
		 */
		public function want()
		{
			return view('want');
		} 
		/**
		 * 组前须知
		 */
		public function notice()
		{
			return view('notice');
		}
		/**
		 * 房东加盟
		 */
		public function join()
		{
			return view('fang_join');
		}
		/**
		 * 装修风格
		 */
		public function styles()
		{
			return view('styled');
		}
		/**
		 * 加盟邻京
		 */
		public function joinLin()
		{
			return view('join_linjing');
		}
		/**
		 * 业务详情
		 */
		public function message()
		{
			return view('yewu_message');
		}
		/**
		 * 联系我们
		 */
		public function talk()
		{
			return view('talk');
		}

		/**
		 * 详情页
		 */
		public function details()
		{			
			$id = Request::get('id');
			$db = new Index;
			//查询详情房源信息
			$data['arr'] = $db->getHouse($id);
			$data['arr'] = $data['arr'][0];

			//查询商圈对应的房源信息
			
			return view('xiangqing',$data);
		}

	}

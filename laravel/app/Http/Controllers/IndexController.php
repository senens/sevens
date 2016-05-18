<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

	class IndexController extends Controller
	{
		public function index()
		{
			return view('index');
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
				return view('xiangqing');
			}
	}

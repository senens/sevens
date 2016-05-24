<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
header('content-type:text/html;charset=utf8');
	class IndexController extends Controller
	{
		public function index()
		{
			$data = DB::table('houses')
			->get();
			return view('index',['data' => $data]);
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
				// $name = DB::connection()->getDatabaseName();
				$id=isset($_GET['id'])?$_GET['id']:"";
				$arr = DB::table('houses')
				->where('h_id',$id)
				->get();
				$data = DB::table('houses')
				->join('imagess','houses.h_id','=','imagess.h_id')
				->get();
				return view('xiangqing',['arr' => $arr,'data' => $data]);
			}

	}

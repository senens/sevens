<?php 
namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Index;
use App\Comments;
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
		 * @return [array] [data]
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
			$comment = new Comments;
			$data['comment'] = $comment->CommentSelects($id);
			$data['id'] = $id;
 			//查询商圈对应的房源信息
			// print_r($data);die;
			return view('xiangqing',$data);
		}	
			/**
			 * 详情页评论
			 */
			public function commented()
			{
				
				$XingVal = Request::get('XingVal');
				$TextVal = Request::get('TextVal');
				// xss攻击预防
				$TextVals = htmlspecialchars($TextVal);
				$Id = Request::get('Id');
				$Hid = Request::get('Hid');
				$SessionId = Request::get('SessionId');
				$sid = trim($SessionId);
				$date = time();
				$comment = new Comments;
				$str = $comment->CommentSelect($SessionId);
				if($str){
					echo 2;die;
				}else{
					$bool = $comment->CommentInsert($XingVal,$TextVals,$Id,$sid,$date);
					if($bool){
							$data = $comment->CommentSelects($Hid);

							foreach ($data as $k => $v) {
								echo "<tr style='box-sizing: border-box; border-style: none none dashed; border-bottom-width: 1px; border-bottom-color: rgb(221, 221, 221);'>";
								echo "<td class='p_index' style='box-sizing: border-box; padding: 2px 8px 2px 12px; line-height: 30px; vertical-align: top; border-style: none none dashed; border-bottom-color: rgb(221, 221, 221);'>";
								echo "<div style='width:45%;margin-top:20px'>$v->c_desc <br>".Date('Y-m-d',$v->c_time)." </div>";
									
								echo "</td>";
								echo "<td style='box-sizing: border-box; padding: 8px; line-height: 30px; vertical-align: top; border-style: none none dashed; border-bottom-color: rgb(221, 221, 221);''>
					                <div style='width:60%;margin-top:20px'>
					               小区:$v->h_plot_name <br>
					               
					               </div></td>";
					            echo "<td style='box-sizing: border-box; padding: 8px; line-height: 30px; vertical-align: top; border-style: none none dashed; border-bottom-color: rgb(221, 221, 221);'>
                    				&nbsp;</td>";
                    			echo "<td style='box-sizing: border-box; padding: 8px; line-height: 30px; vertical-align: top; border-style: none none dashed; border-bottom-color: rgb(221, 221, 221);'>
                    				&nbsp;</td>";
                    			echo "<td style='box-sizing: border-box; padding: 8px; line-height: 30px; vertical-align: top; border-style: none none dashed; border-bottom-color: rgb(221, 221, 221);'>
                    				&nbsp;</td>";
                    			echo "<td style='box-sizing: border-box; padding: 8px; line-height: 30px; vertical-align: top; border-style: none none dashed; border-bottom-color: rgb(221, 221, 221);'>
                    				&nbsp;</td>";
                    			echo "<td style='box-sizing: border-box; padding: 8px; line-height: 30px; vertical-align: top; border-style: none none dashed; border-bottom-color: rgb(221, 221, 221);'>
                    				&nbsp;</td>";
                    			echo "<td style='box-sizing: border-box; padding: 8px; line-height: 30px; vertical-align: top; border-style: none none dashed; border-bottom-color: rgb(221, 221, 221);'>
                    				&nbsp;</td>";
                    			echo "<td style='box-sizing: border-box; padding: 8px; line-height: 30px; vertical-align: top; border-style: none none dashed; border-bottom-color: rgb(221, 221, 221);'>
				                    <div style='width:80%;margin-top:30px'>                            
				                                $v->u_name                           
				                     </div></td>";
								echo "</tr>";
							}
						}else{
							echo 0;
						}
				}
				
				
			}

	}

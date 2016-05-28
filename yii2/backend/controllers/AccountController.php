<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use backend\models\AdminUser;
use backend\models\AdminDatabase;
use backend\models\UserDatabase;
use backend\models\User;
use backend\models\Handel;
use yii\web\Request; 

class AccountController extends Controller{
	public $enableCsrfValidation = false;

	public $layout = 'main.php';
	/*管理员账号展示*/
	public function actionIndex()
	{

		$query = AdminUser::find();

        $pagination = new Pagination([
            'defaultPageSize' => 2,
            'totalCount' => $query->count(),
        ]);

        $countries = $query->orderBy('u_id DESC')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'data' => $countries,
            'pagination' => $pagination,
        ]);
	
	}
			/**
			 * 验证唯一性
			 */
			public function actionOnlys()
			{				
				$request = Yii::$app->request;
				$names = $request->get('name'); 
				$Handel = new Handel();
				$data = $Handel->GselectedOne($names);
				if($data){
					echo 1;die;
				}else{
					echo 0;die;
				// }
			}
		}
			/*
			 *添加表单
			 */
			public function actionAdd()
			{
				
				return $this->render('add');
			}
			/**添加*/
			public function actionInserts()
			{
				//接收表单数据
				$request = Yii::$app->request;
				$names = $request->post('username'); 
				$pwd = $request->post('pwd'); 
				$sex = $request->post('sex'); 			
				//实例化model层
				$Handel = new Handel;
				$bool = $Handel->Gadd($names,$pwd,$sex);
				if($bool){
					 $this->redirect(array('account/index'));
				}else{
					echo "<script>alert('程序员开小差了，请重新添加');location.href='index.php?r=account/add'</script>";
				}
			}
			/**管理员账号删除*/
			public function actionDels()
			{
				$request = Yii::$app->request;
				$id = $request->get('id'); 
				//实例化model层
				$Handel = new Handel;
				$bool = $Handel->Gdel($id);
				if($bool){
					echo 1;
				}else{
					echo 0;
				}
			}
			/**管理员修改*/
			public function actionEdits()
			{
				$request = Yii::$app->request;
				$id = $request->get('id'); 
				//实例化model层
				$Handel = new Handel;
				$admin_user = $Handel ->Gupdate($id);	
				$data[] = $admin_user;
				return $this->render('update',['data' => $data]);
			}
			/**管理员修改成功*/
			public function actionEdited()
			{
				$request = Yii::$app->request;
				$names = $request->post('username'); 
				$pwd = $request->post('pwd'); 
				$sex = $request->post('sex'); 	
				$id = $request->post('upId'); 
				//实例化model层
				$Handel = new Handel;
				$bool = $Handel ->Gupdated($names,$pwd,$sex,$id);
				if($bool){
					$this->redirect(array('account/index'));
				}else{
					// echo "<script>alert('修改失败')</script>";
					return $this->redirect(array('account/edits'));
				}
			}
	/**
	 * 房东账号列表
	 */
	public function actionLandlord(){
		$query = User::find();

        $pagination = new Pagination([
            'defaultPageSize' => 2,
            'totalCount' => $query->where('u_type = 1')->count(),
        ]);

        $countries = $query->where('u_type = 1')->orderBy('u_id DESC')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('landlord', [
            'data' => $countries,
            'pagination' => $pagination,
        ]);
	}
			/**房东账号修改表单*/
			public function actionFedits()
			{
				$request = Yii::$app->request;
				$id = $request->get('id'); 
				//调用model层
				$UserDatabase = new Handel;
				$UserDatabase = $UserDatabase ->Fdefault($id);
				$data[] = $UserDatabase;
				return $this->render('fadd',['data' => $data]);
			}
			/**
			 * 验证唯一性
			 */
			public function actionFonlys()
			{
				
				//使用请求组件
				$request = Yii::$app->request;
				$names = $request->get('name'); 
				//调用model层
				$UserDatabase = new Handel;
				$data = $UserDatabase ->Fonly($names);
				if($data){
					echo 1;die;
				}else{
					echo 0;die;
				// }
			}
		}
			/**房东账号删除*/
			public function actionFdels()
			{
				$request = Yii::$app->request;
				$id = $request->get('id'); 
				//调用model层
				$UserDatabase = new Handel;
				$bool = $UserDatabase ->Fdel($id);
				if($bool){
					echo 1;
				}else{
					echo 0;
				}
			}
			/**房东账号修改*/
			public function actionFeditd()
			{
				//接收表单数据
				$request = Yii::$app->request;
				$id = $request->post('cid'); 
				$names = $request->post('username'); 
				$pwd = $request->post('pwd'); 
				$sex = $request->post('sex');
				$email = $request->post('email');
				$address = $request->post('address');
				$phone = $request->post('phone');
				$nick = $request->post('nickname');
				//实例化model层
				$UserDatabase = new Handel;
				$bool = $UserDatabase ->Fupdated($id,$names,$pwd,$sex,$email,$address,$phone,$nick);
				if($bool){
					return $this->redirect(array('account/landlord'));
				}else{
					return $this->redirect(array('account/fedits'));
				}
			}

			/**
			 * 房东账号审核
			 */
			public function actionLandlordcheck(){
				$query = User::find();

		        $pagination = new Pagination([
		            'defaultPageSize' => 2,
		            'totalCount' => $query->where('u_type = 1')->count(),
		        ]);

		        $countries = $query->where('u_type = 1')->orderBy('u_id DESC')
		            ->offset($pagination->offset)
		            ->limit($pagination->limit)
		            ->all();

		        return $this->render('landlordcheck', [
		            'data' => $countries,
		            'pagination' => $pagination,
		        ]);
			}	
			/**房东账号未审核变审核*/
			public function actionShen()
			{
				$request = Yii::$app->request;
				$id = $request->get('id');
				//实例化model层
				$UserDatabase = new Handel;
				$bool = $UserDatabase ->Fshen($id);
				if($bool){
					return $this->redirect(array('account/landlordcheck'));
				}else{
					echo "<script>alert('审核提交失败')</script>";
				}
			}

	/**
	 * 租客账号列表
	 */
	public function actionRenter(){
		$query = User::find();

        $pagination = new Pagination([
            'defaultPageSize' => 2,
            'totalCount' => $query->where('u_type = 0')->count(),
        ]);

        $countries = $query->where('u_type = 0')->orderBy('u_id DESC')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('renter', [
            'data' => $countries,
            'pagination' => $pagination,
        ]);
	}

		/**租客删除*/
		public function actionZdels()
			{
				$request = Yii::$app->request;
				$id = $request->get('id'); 
				//实例化model层
				$UserDatabase = new Handel;
				$bool = $UserDatabase ->Zdel($id);
				if($bool){
					echo 1;
				}else{
					echo 0;
				}
			}
		/**租客修改表单*/
		public function actionZedits()
			{
				$request = Yii::$app->request;
				$id = $request->get('id');
				//实例化model层
				$UserDatabase = new Handel;
				$UserDatabase = $UserDatabase ->Zdefault($id);
				$data[] = $UserDatabase;
				return $this->render('zdefault',['data' => $data]);
			}
			/**租客修改*/
			public function actionZeditd()
			{
				//接收表单数据
				$request = Yii::$app->request;
				$id = $request->post('cid'); 
				$names = $request->post('username'); 
				$pwd = $request->post('pwd'); 
				$sex = $request->post('sex');
				$email = $request->post('email');
				$address = $request->post('address');
				$phone = $request->post('phone');
				$nick = $request->post('nickname');
				//实例化model层
				$UserDatabase = new Handel;
				$bool = $UserDatabase ->Zupdate($id,$names,$pwd,$sex,$email,$address,$phone,$nick);				
				if($bool){
					return $this->redirect(array('account/renter'));
				}else{
					return $this->redirect(array('account/zedits'));
				}
			}
	/**
	 * 租客账号审核
	 */
	public function actionRentercheck(){
		$query = User::find();

        $pagination = new Pagination([
            'defaultPageSize' => 2,
            'totalCount' => $query->where('u_type = 0')->count(),
        ]);

        $countries = $query->where('u_type = 0')->orderBy('u_id DESC')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('rentercheck', [
            'data' => $countries,
            'pagination' => $pagination,
        ]);

	}
		/**租客账号未审核变审核*/
			public function actionZshen()
			{
				$request = Yii::$app->request;
				$id = $request->get('id');
				//实例化model层
				$UserDatabase = new Handel;
				$bool = $UserDatabase ->Zshen($id);
				if($bool){
					return $this->redirect(array('account/rentercheck'));
				}else{
					echo "<script>alert('审核提交失败')</script>";
				}
			}

}
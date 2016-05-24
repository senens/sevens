<?php
namespace backend\controllers;

use yii\web\Controller;
use yii\data\Pagination;
use backend\models\AdminUser;
class AccountController extends Controller{

	public $layout = 'main.php';
	public function actionIndex(){
		// //配置连接组件
		// $connection = \Yii::$app->db;
	
		// $command = $connection->createCommand('SELECT * FROM admin_user');
		
		// $data = $command->queryAll();
		// return $this->render('index',['data' => $data]);
		
		$query = AdminUser::find();

        $pagination = new Pagination([
            'defaultPageSize' => 1,
            'totalCount' => $query->count(),
        ]);

        $countries = $query->orderBy('u_id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'data' => $countries,
            'pagination' => $pagination,
        ]);
	
	}


	public function actionAdd(){
		
		return $this->render('add');
	}
	


	/**
	 * 房东账号列表
	 */
	public function actionLandlord(){

		return $this->render('landlord');
	}

	/**
	 * 房东账号审核
	 */
	public function actionLandlordcheck(){

		return $this->render('landlordcheck');
	}


	/**
	 * 租客账号列表
	 */
	public function actionRenter(){

		return $this->render('renter');
	}

	/**
	 * 租客账号审核
	 */
	public function actionRentercheck(){

		return $this->render('rentercheck');
	}
}
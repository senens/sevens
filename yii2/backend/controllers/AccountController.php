<?php
namespace backend\controllers;

use yii\web\Controller;

class AccountController extends Controller{

	public $layout = 'main.php';
	public function actionIndex(){

		return $this->render('index');	
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
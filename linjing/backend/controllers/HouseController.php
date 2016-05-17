<?php
namespace backend\controllers;

use yii\web\Controller;

class HouseController extends Controller{

	public $layout = 'main.php';
	/**
	 * 房源展示
	 * @return [type] [description]
	 */
	public function actionIndex(){

		return $this->render('house');	
	}

	/**
	 * 房源添加
	 */
	public function actionHouseadd(){

		return $this->render('houseadd');
	}

	/**
	 * 房源审核
	 */
	public function actionHousecheck(){

		return $this->render('housecheck');
	}
}

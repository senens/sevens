<?php
namespace backend\controllers;

use yii\web\Controller;

class ActiveController extends Controller{

	public $layout = 'main.php';
	/**
	 * 房源展示
	 * @return [type] [description]
	 */
	public function actionIndex(){

		return $this->render('active');	
	}

	/**
	 * 房源添加
	 */
	public function actionActiveadd(){

		return $this->render('activeadd');
	}


}

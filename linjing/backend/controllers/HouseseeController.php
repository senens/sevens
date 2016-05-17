<?php
namespace backend\controllers;

use yii\web\Controller;

class HouseseeController extends Controller{

	public $layout = 'main.php';
	/**
	 * 房源展示
	 * @return [type] [description]
	 */
	public function actionIndex(){

		return $this->render('housesee');	
	}

	
}

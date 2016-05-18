<?php
namespace backend\controllers;

use yii\web\Controller;

class HouseseeController extends Controller{

	public $layout = 'main.php';
	/**
	 * 看房记录
	 * @return [type] [description]
	 */
	public function actionIndex(){

		return $this->render('housesee');	
	}

	
}

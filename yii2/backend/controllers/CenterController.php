<?php
namespace backend\controllers;

use yii\web\Controller;

class CenterController extends CommonController{

	public $layout = 'main.php';
	public function actionIndex(){
		
		return $this->render('adminuser');	
	}


	public function actionAdd(){
		
		return $this->render('adminadd');
	}
	
}
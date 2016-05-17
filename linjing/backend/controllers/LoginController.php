<?php
namespace backend\controllers;

use yii\web\Controller;

class LoginController extends Controller{

	public $layout = 'public.php';
	public function actionIndex(){

		return $this->render('login');	
	}
	

}
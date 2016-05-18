<?php
namespace backend\controllers;

use yii\web\Controller;
use Yii;
class HouseController extends Controller{
	public $enableCsrfValidation = false;


	public $layout = 'main.php';
	/**
	 * 房源展示
	 * @return [type] [description]
	 */
	public function actionIndex(){

		$connection=\Yii::$app->db;
		$sql="select * from houses";
		//echo $sql;die;
		$command=$connection->createCommand($sql);
		$posts=$command->queryall();
		return $this->render("house",array('posts'=>$posts));
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

	Public function actionHouseinsert(){
		$request = Yii::$app->request;
		//接值
		//$h_title=$_POST['h_title'];
		$h_title= $request->post('h_title'); 
		//echo $h_title;die;
		$h_area= $request->post('h_area'); 
		$h_price= $request->post('h_price'); 
		$h_doors_type= $request->post('h_doors_type'); 
		$h_location= $request->post('h_location'); 
		$h_floors= $request->post('h_floors'); 
		$h_elevator= $request->post('h_elevator'); 
		$h_type= $request->post('h_type'); 
		$h_bedroom_type= $request->post('h_bedroom_typev'); 
		$h_rental_way= $request->post('h_rental_way'); 
		$h_deposit= $request->post('h_deposit'); 
		$h_introduce= $request->post('h_introduce');
		$h_status= $request->post('h_status');
		//添加
		$sql="insert into houses(h_title,h_area,h_price,h_doors_type,h_location,h_floors,h_elevator,h_type,h_bedroom_type,h_rental_way,h_deposit,h_introduce,h_status)
		values('$h_title','$h_area','$h_price','$h_doors_type','$h_location','$h_floors','$h_elevator','$h_type','$h_bedroom_type','$h_rental_way','$h_deposit','$h_introduce','$h_status')";
		//echo $sql;die
		$connection=\Yii::$app->db;
		$command=$connection->createCommand($sql);
		//var_dump($command);die;
		$command->execute();
		return $this->redirect("index.php?r=house/index");
	}

	



}

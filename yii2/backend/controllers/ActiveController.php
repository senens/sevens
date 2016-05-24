<?php
namespace backend\controllers;

use yii\web\Controller;
use Yii;

class ActiveController extends Controller{
	public $enableCsrfValidation = false;

	public $layout = 'main.php';
	/**
	 * 活动展示
	 * @return [type] [description]
	 */
	public function actionIndex(){

		$connection=\Yii::$app->db;
		$sql="select * from active";
		//echo $sql;die;
		$command=$connection->createCommand($sql);
		$posts=$command->queryall();
		return $this->render("active",array('posts'=>$posts));
	}

	/**
	 * 活动添加
	 */
	public function actionActiveadd(){

		return $this->render('activeadd');
	}

	//添加活动
	Public function actionActiveinsert(){
		$request = Yii::$app->request;
		$act_name=$request->post("act_name");
		$act_desc=$request->post("act_desc");
		$act_type=$request->post("act_type");
		$act_start=$request->post("act_start");
		$act_end=$request->post("act_end");
		$act_state=$request->post("act_state");
		//echo $act_name;die;
		$sql="insert into active(act_name,act_desc,act_type,act_start,act_end,act_state)
		values('$act_name','$act_desc','$act_type','$act_start','$act_end','$act_state')";
		//echo $sql;die
		$connection=\Yii::$app->db;
		$command=$connection->createCommand($sql);
		//var_dump($command);die;
		$command->execute();
		return $this->redirect("index.php?r=active/index");
	}


}

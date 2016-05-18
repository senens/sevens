<?php
namespace backend\controllers;

use yii\web\Controller;

class CommentController extends Controller{

	public $layout = 'main.php';
	/**
	 * 评论列表
	 */
	public function actionIndex(){
		$connection=\Yii::$app->db;
		$sql="select * from comment";
		$command=$connection->createCommand($sql);
		$posts=$command->queryall();
		return $this->render('comment',array('posts'=>$posts));	
	}



	/**
	 * 评论审核
	 */
	public function actionCommentcheck(){

		return $this->render('commentcheck');
	}

}

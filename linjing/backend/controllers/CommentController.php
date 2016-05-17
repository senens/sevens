<?php
namespace backend\controllers;

use yii\web\Controller;

class CommentController extends Controller{

	public $layout = 'main.php';
	/**
	 * 评论列表
	 */
	public function actionIndex(){

		return $this->render('comment');	
	}



	/**
	 * 评论审核
	 */
	public function actionCommentcheck(){

		return $this->render('commentcheck');
	}
}

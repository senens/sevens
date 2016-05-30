<?php
namespace backend\controllers;

use yii\web\Controller;
use yii\data\Pagination;
use backend\models\Comment;
use backend\models\CommentDatabase;

use Yii;

class CommentController extends Controller{

	public $layout = 'main.php';
	/**
	 * 评论列表
	 */
	public function actionIndex(){

		$query = Comment::find()->where(['c_status'=>1]);
        $pagination = new Pagination([
            'defaultPageSize' => 3,
            'totalCount' => $query->count(),
        ]);
        $countries = $query->orderBy('c_id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
         
        return $this->render('comment', [
            'data' => $countries,
            'pagination' => $pagination,
        ]);

		
	}

	/**
	 * 评论审核
	 */
	public function actionCommentcheck(){
		$query = Comment::find()->where(['c_status' => 0]);

        $pagination = new Pagination([
            'defaultPageSize' => 3,
            'totalCount' => $query->count(),
        ]);

        $countries = $query->orderBy('c_id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('commentcheck', [
            'data' => $countries,
            'pagination' => $pagination,
        ]);

		
	}


	//删除评论
	Public function actionCommentdel(){
		// $a=new AdminComment;
		// print_r($a);die;
		$request=Yii::$app->request;
		$id=$request->get("id");
		//echo $id;die;
		$CommentDatabase = new CommentDatabase();
		$CommentDatabase = CommentDatabase::findOne($id);
		$bool = $CommentDatabase->delete();
		if($bool){
			echo '1';
		}else{
			echo '0';
		}
	}

	//批量删除
    public function actionCommentDelall(){
        $request=Yii::$app->request;
        $connection = \Yii::$app->db;
        if($request->isPost) {
            $name = $request->post();
            $id=$name['id'];
            $del=$connection->createCommand()->delete('comment', "c_id in ($id)")->execute();
            if($del){
                echo 1;
            }
        }
    }

	//评论审核
	Public function actionCommentupdate(){
		$request=Yii::$app->request;
		$id=$request->get("id");
		//实例化model
		$CommentDatabase = new CommentDatabase();
		$CommentDatabase = CommentDatabase::findOne($id);
		$CommentDatabase ->c_status = 1;
		$bool = $CommentDatabase->save();
		if($bool){
			echo '1';
		}else{
			echo '0';
		}
	}

}

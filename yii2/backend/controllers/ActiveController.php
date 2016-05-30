<?php
namespace backend\controllers;

use yii\web\Controller;
use Yii;
use yii\data\Pagination;
use app\models\Active;
use yii\web\UploadedFile;
use backend\models\ActiveDatabase;



class ActiveController extends CommonController{
	public $enableCsrfValidation = false;

	public $layout = 'main.php';
	/**
	 * 广告展示
	 * @return [type] [description]
	 */
	public function actionIndex(){

		$query = Active::find();

        $pagination = new Pagination([
            'defaultPageSize' => 3,
            'totalCount' => $query->count(),
        ]);
        $countries = $query->orderBy('act_id DESC')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('active', [
            'data' => $countries,
            'pagination' => $pagination,
        ]);
		
	}

	/**
	 * 广告添加
	 */
	public function actionActiveadd(){
		$model=new Active();
		return $this->render('activeadd',['model'=>$model]);
	}

	//添加广告
	Public function actionActiveinsert(){
		$request = Yii::$app->request;
		$act_name=$request->post("act_name");
		/*$act_url = $request->post("act_url");
		print_r($act_url);die;*/
		$act_bgcolor=$request->post("act_bgcolor");
		$act_time=date('Y-m-d H:i:s',time());
		$act_status=$request->post("act_status");
		$photo=$_FILES;
		//var_dump($photo);die;
		$act_url=$photo["Active"]["name"]["act_url"];
		//$data = Input::file('act_url');
		//print_r(count($act_url));
		$str='';
		for($i=0;$i<count($data);$i++){
		    $filename= $data[$i]->getClientOriginalName();
		    $path = $data[$i]-> move('D:\WWW\linjingyouwu\uploads',$filename);
		    $str.='|'.$filename;
		}
		$str1 = substr($str,1);


		//print_r($request->post());die;

		//文件上传
		$model = new Active();

        if (Yii::$app->request->isPost) {
            $model->act_url = UploadedFile::getInstance($model, 'act_url');
            if ($model->upload()) {
                // 文件上传成功
                $sql="insert into active(act_name,act_url,act_bgcolor,act_time,act_status)
				values('$act_name','$act_url','$act_bgcolor','$act_time','$act_status')";
				//echo $sql;die
				$connection=\Yii::$app->db;
				$command=$connection->createCommand($sql);
				//var_dump($command);die;
				$command->execute();
				return $this->redirect("index.php?r=active/index");
            }
        }			
	}

	//删除广告
	Public function actionActivedel(){
		$request=Yii::$app->request;
		$id=$request->get("id");
		//echo $id;die;
		$ActiveDatabase = new ActiveDatabase();
		$ActiveDatabase = ActiveDatabase::findOne($id);
		$bool = $ActiveDatabase->delete();
		if($bool){
			echo '1';
		}else{
			echo '0';
		}
	}

	
}

<?php
namespace backend\controllers;

use yii\web\Controller;
use Yii;
use yii\data\Pagination;
use backend\models\HouseDatabase;
use app\models\Housese;
use backend\models\AdminUser;
use backend\models\AdminDatabase;
use backend\models\UserDatabase;
use yii\web\Request; 

use yii\web\UploadedFile;


class HouseController extends Controller{
	public $enableCsrfValidation = false;


	public $layout = 'main.php';
	/**
	 * 房源展示
	 * @return [type] [description]
	 */
	public function actionIndex(){

		$query = Housese::find()->where(['h_ischeck' => 1]);

        $pagination = new Pagination([
            'defaultPageSize' => 3,
            'totalCount' => $query->count(),
        ]);

        $countries = $query->orderBy('h_id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('house', [
            'data' => $countries,
            'pagination' => $pagination,
        ]);
	

		
	}

	/**
	 * 房源添加
	 */
	public function actionHouseadd(){
		$model=new Housese();

		return $this->render('houseadd',['model'=>$model]);
	}

	/**
	 * 房源审核
	 */
	public function actionHousecheck(){
		$query = Housese::find()->where(['h_ischeck' => 0]);

        $pagination = new Pagination([
            'defaultPageSize' => 3,
            'totalCount' => $query->count(),
        ]);

        $countries = $query->orderBy('h_id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('housecheck', [
            'data' => $countries,
            'pagination' => $pagination,
        ]);
	
		
	}

	//添加房源
	Public function actionHouseinsert(){
	/*	$request = Yii::$app->request;
		//接值
		//$h_title=$_POST['h_title'];
		$h_rent_type= $request->post('h_rent_type'); 
		$h_plot_name= $request->post('h_plot_name'); 
		$h_loc_detail= $request->post('h_loc_detail');
		$h_gender_demand= $request->post('h_gender_demand'); 
		$h_room_num= $request->post('h_room_num'); 
		$h_hall_num= $request->post('h_hall_num'); 
		$h_toilet_num= $request->post('h_toilet_num'); 
		$h_floor_st= $request->post('h_floor_st'); 
		$h_floor_all= $request->post('h_floor_all'); 
		$h_area= $request->post('h_area');
		$h_orientation= $request->post('h_orientation'); 
		$h_decorate= $request->post('h_decorate'); 
		$h_type= $request->post('h_type'); 
		$h_facility= $request->post('h_facility'); 
		$h_price= $request->post('h_price'); 
		$h_price_type= $request->post('h_price_type');
		$h_title= $request->post('h_title'); 
		$h_description= $request->post('h_description'); 
		$h_contact_name= $request->post('h_contact_name');
		$h_contact_phonenumber= $request->post('h_contact_phonenumber'); 
		$h_pub_date= $request->post('h_pub_date');
		$h_ischeck= $request->post('h_ischeck');
		$h_issell= $request->post('h_issell');
		$h_timelimit= $request->post('h_timelimit');
		$photo=$_FILES;
		$h_photo=$photo["Housese"]["name"]["h_photo"];
		$model = new Housese();

        if (Yii::$app->request->isPost) {
            $model->h_photo = UploadedFile::getInstance($model, 'h_photo');
            if ($model->upload()) {
                // 文件上传成功
                $sql="insert into housese(h_rent_type,h_plot_name,h_loc_detail,h_gender_demand,h_room_num,h_hall_num,h_toilet_num,h_floor_st,h_floor_all,h_area,h_orientation,h_decorate,h_type,h_facility,h_price,h_price_type,h_title,h_description,h_photo,h_contact_name,h_contact_phonenumber,h_pub_date,h_ischeck,h_issell,h_timelimit)values('$h_rent_type','$h_plot_name','$h_loc_detail','$h_gender_demand','$h_room_num','$h_hall_num','$h_toilet_num','$h_floor_st','$h_floor_all','$h_area','$h_orientation','$h_decorate','$h_type','$h_facility','$h_price','$h_price_type','$h_title','$h_description','$h_photo','$h_contact_name','$h_contact_phonenumber','$h_pub_date','$h_ischeck','$h_issell','$h_timelimit')";
				$connection=Yii::$app->db;
				$command=$connection->createCommand($sql);
				//var_dump($command);die;
				$command->execute();*/
				return $this->redirect("index.php?r=house/index");
                
           // }
       // }
		
	}


	//删除房源
	Public function actionHousedel(){
		$request=Yii::$app->request;
		$id=$request->get("id");
		// $connection=\Yii::$app->db;
		// $sql="delete from housese where h_id='$id'";
		// $command=$connection->createCommand($sql);
		// $posts=$command->execute();
		// if($posts){
		// 	echo 1;
		// }else{
		// 	echo 0;
		// }
		$HouseDatabase = new HouseDatabase();
		$HouseDatabase = HouseDatabase::findOne($id);
		$bool = $HouseDatabase->delete();
		if($bool){
			echo '1';
		}else{
			echo '0';
		}
	}

	//房源审核
	Public function actionHouseupdate(){
		$request=Yii::$app->request;
		$id=$request->get("id");
		//实例化model
		$HouseDatabase = new HouseDatabase();
		$HouseDatabase = HouseDatabase::findOne($id);
		$HouseDatabase ->h_ischeck = 1;
		$bool = $HouseDatabase->save();
		if($bool){
			echo '1';
		}else{
			echo '0';
		}
	}

	//权限
	//创建权限
/*	Public function createPermission($item) 

  { 

    $auth = Yii::$app->authManager; 

    $createPost = $auth->createPermission($item); 

    $createPost->description = '创建了 ' . $item . ' 许可'; 

    $auth->add($createPost); 

  } 
	//创建角色
  public function createRole($item) 

  { 

    $auth = Yii::$app->authManager; 

    $role = $auth->createRole($item); 

    $role->description = '创建了 ' . $item . ' 角色'; 

    $auth->add($role); 

  } 

  //分配权限
  static public function createEmpowerment($items) 

  { 

    $auth = Yii::$app->authManager; 

    $parent = $auth->createRole($items['name']); 

    $child = $auth->createPermission($items['description']); 

    $auth->addChild($parent, $child); 

  } 

  //分配用户

static public function assign($item) 

  { 

    $auth = Yii::$app->authManager; 

    $reader = $auth->createRole($item['name']); 

    $auth->assign($reader, $item['description']); 

  } 

  //验证权限
   public function beforeAction($action) 

  { 

    $action = Yii::$app->controller->action->id; 

    if(\Yii::$app->user->can($action)){ 

      return true; 

    }else{ 

      throw new \yii\web\UnauthorizedHttpException('对不起，您现在还没获此操作的权限'); 

    } 

  } 
*/



}

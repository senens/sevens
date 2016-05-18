<?php
namespace backend\controllers;

use yii\web\Controller;

class LoginController extends Controller{
    public $enableCsrfValidation = false;

	public $layout = 'public.php';
	public function actionIndex(){

		return $this->render('login');	
	}
    //判断登陆
    public function actionId_login(){
        $request = \Yii::$app->request;

        $connection = \Yii::$app->db;
        $session = \Yii::$app->session;
        // 检查session是否开启 if ($session->isActive) ...
        // 开启session
        $session->open();
       // $pp=$request->post('u_pawd');
        $name=$request->post('name');
       // echo $name;die;
        $pawd=$request->post('pawd');
        $re=isset($_POST['re'])?$_POST['re']:'';
       // echo $re;die;
        if($re==1){
            $val=array(
                'name'=>$name,
                'pawd'=>$pawd,
            );
            session_set_cookie_params(3600*24);
            $session->set('name', $val);

        }else if($re==''){
            $val=array(
                'name'=>'',
                'pawd'=>'',
            );
            session_set_cookie_params(3600*24);
            $session->set('name', $val);
        }

      //  echo $re;die;
       // echo $pawd;die;
        //查询
        $command = $connection->createCommand("SELECT * FROM admin_user WHERE u_name='$name'");
        $post = $command->queryOne();
        $pp=$post["u_pawd"];

        // var_dump($pp);die;
        //var_dump($post);
        if($post){
                  if($pp==$pawd){
               // echo "登录成功";
                $session->set('username', $name);
                echo "<script>alert('登录成功');location.href='index.php?r=center/index'</script>";
            }else{
                echo "<script>alert('密码输入有误');location.href='index.php?r=login/index'</script>";
            }
        }else{
            echo "<script>alert('用户名不存在');location.href='index.php?r=login/index'</script>";
        }

    }
	//退出
    public function actionExit(){
        $session = \Yii::$app->session;
        // 检查session是否开启 if ($session->isActive) ...
        // 开启session
        $session->open();
        unset($session['username']);
        echo "<script>location.href='index.php?r=site/index'</script>";

    }

}
<?php
namespace backend\controllers;
use yii\web\Controller;
use backend\models\Login;
class LoginController extends Controller{
    public $enableCsrfValidation = false;
	public $layout = 'public.php';
     //验证码
    public function actions()
    {
        return [
            //验证码
            'captcha' => [
                //验证码类
                'class' => 'yii\captcha\CaptchaAction',
                'maxLength' => 4, //生成验证码最大个数
                'minLength' => 4, //生成验证码最小个数
                'width' => 80, //验证码的宽度
                'height' => 40, //验证码的高度
            ],
        ];
    }

	public function actionIndex(){
        $model = new Login();
        //  print_r($model);d\ie;
         return $this->render('login',['model' => $model]);
	}

    //判断登陆
    public function actionId_login(){

        $request = \Yii::$app->request;
        $connection = \Yii::$app->db;
        $session = \Yii::$app->session;
        // 检查session是否开启 if ($session->isActive) ...
        // 开启session
        $session->open();
        $connection = \Yii::$app->db;
        $name = $request->post('name');
        $pawd = $request->post('pawd');
        $re = isset($_POST['re']) ? $_POST['re'] : '';

        if ($re == 1) {
            $val = array(
                'name' => $name,
                'pawd' => $pawd,
            );
            session_set_cookie_params(3600 * 24);
            $session->set('name', $val);
          } else if ($re == '') {
            $val = array(
                'name' => '',
                'pawd' => '',
            );
            session_set_cookie_params(3600 * 24);
            $session->set('name', $val);
        }
        If (\Yii::$app->request->isPost) { //验证验证码
            //实例化一个验证码验证对象
            $v = new \yii\captcha\CaptchaValidator();
            //配置 action 为当前的
            $v->captchaAction = 'login/captcha';
            //创建一个验证码对象
            $vaction = $v->createCaptchaAction();
            //读取验证码
            $code = $vaction->getVerifyCode();
            $yan = \Yii::$app->request->post('verifyCode');

             if($code==$yan) {
                 //查询
                 $command = $connection->createCommand("SELECT * FROM admin_user WHERE u_name='$name'");
                 $post = $command->queryOne();
                 $pp = $post["u_pawd"];
                 if ($post) {
                     if ($pp == $pawd) {
                         $session->set('username', $name);
                         echo "<script>alert('登录成功');location.href='index.php?r=center/index'</script>";
                         $command = $connection->createCommand("UPDATE admin_user SET u_num=1 WHERE u_name='$name'");
                         $command->execute();
                     } else {
                        $command = $connection->createCommand("SELECT u_num FROM admin_user WHERE u_name='$name'");
                        $post = $command->queryOne();
                           $num=$post['u_num'];
                            if($num<3){
                               $command = $connection->createCommand("UPDATE admin_user SET u_num=u_num+1 WHERE u_name='$name'");
                               $command->execute();
                               echo "<script>alert('密码错误，您已输入".$num."次');location.href='index.php?r=login/index'</script>";
                           }else{

                                echo "<script>alert('密码错误，您的账户已锁定');location.href='index.php?r=center/index'</script>";
                           }
                     }
                 } else {
                     echo "<script>alert('用户名不存在');location.href='index.php?r=login/index'</script>";
                 }
             } else{
                echo "<script>alert('验证码输入有误');location.href='index.php?r=login/index'</script>";
             }
        }
    }
	//退出
    public function actionExit(){
        $session = \Yii::$app->session;
         // 开启session
        $session->open();
        unset($session['username']);
        echo "<script>location.href='index.php?r=site/index'</script>";

    }

}
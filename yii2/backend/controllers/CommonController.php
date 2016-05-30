<?php

namespace backend\Controllers;

class CommonController extends \yii\web\Controller
{
    public function  init()
    {
        parent:: init();
        $session = \Yii::$app->session;
        // 检查session是否开启 if ($session->isActive) ...
        // 开启session
        $session->open();
        $username = $session->get('username');
        if (empty($username)) {
            echo "<script>alert('请先登陆');location.href='index.php?r=login/index'</script>";
        }
    }

}

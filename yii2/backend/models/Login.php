<?php
namespace backend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class Login extends Model
{
    public $verifyCode; //添加的验证码字段
    public function rules(){
        return [
//captchaAction 是生成验证码的控制器
            ['verifyCode' , 'captcha' , 'captchaAction' => 'login/captcha' , 'message'=>'验证码不正确'],
        ];
    }
}
?>
<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "admin_user".
 *
 * @property integer $u_id
 * @property string $u_name
 * @property string $u_pawd
 * @property integer $u_num
 * @property string $u_time
 */
class AdminUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['u_num'], 'integer'],
            [['u_name', 'u_pawd', 'u_sex'], 'string', 'max' => 222]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'u_id' => 'U ID',
            'u_name' => 'U Name',
            'u_pawd' => 'U Pawd',
            'u_num' => 'U Num',
            'u_sex' => 'U Sex',
        ];
    }
}

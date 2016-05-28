<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $u_id
 * @property string $u_type
 * @property string $u_name
 * @property string $u_nickname
 * @property string $u_pawd
 * @property string $u_header_url
 * @property string $u_email
 * @property string $u_sex
 * @property string $u_address
 * @property string $u_phone
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['u_name'], 'required'],
            [['u_type', 'u_name', 'u_nickname', 'u_pawd', 'u_header_url', 'u_email', 'u_sex', 'u_address', 'u_phone', 'u_status'], 'string', 'max' => 222]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'u_id' => 'U ID',
            'u_type' => 'U Type',
            'u_name' => 'U Name',
            'u_nickname' => 'U Nickname',
            'u_pawd' => 'U Pawd',
            'u_header_url' => 'U Header Url',
            'u_email' => 'U Email',
            'u_sex' => 'U Sex',
            'u_address' => 'U Address',
            'u_phone' => 'U Phone',
            'u_status' => 'U Status',
        ];
    }
}

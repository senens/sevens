<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $c_id
 * @property string $c_title
 * @property string $c_desc
 * @property integer $u_id
 * @property string $c_time
 * @property string $c_status
 * @property integer $h_id
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['u_id', 'h_id'], 'integer'],
            [['c_time'], 'safe'],
            [['c_desc', 'c_status'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c_id' => 'C ID',
            
            'c_desc' => 'C Desc',
            'u_id' => 'U ID',
            'c_time' => 'C Time',
            'c_status' => 'C Status',
            'h_id' => 'H ID',
        ];
    }
}

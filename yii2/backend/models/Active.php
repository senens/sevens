<?php

namespace app\models;

use yii\web\UploadedFile;

use Yii;

/**
 * This is the model class for table "active".
 *
 * @property integer $act_id
 * @property string $act_name
 * @property string $act_url
 * @property integer $act_time
 * @property integer $act_status
 * @property string $act_bgcolor
 */
class Active extends \yii\db\ActiveRecord
{


    public $imageFile;
    public $act_url;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'active';
    }

    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['act_name', 'act_url'], 'required'],
            [['act_time', 'act_status'], 'integer'],
            [['act_name'], 'string', 'max' => 60],
            [['act_url'], 'string', 'max' => 120],
            [['act_bgcolor'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'act_id' => 'Act ID',
            'act_name' => 'Act Name',
            'act_url' => 'Act Url',
            'act_time' => 'Act Time',
            'act_status' => 'Act Status',
            'act_bgcolor' => 'Act Bgcolor',
        ];
    }

     public function upload()
    {
        
        return  $this->act_url->saveAs('C:\server\WWW\linjing\uploads\\' . $this->act_url->baseName . '.' . $this->act_url->extension);
            
    }


}

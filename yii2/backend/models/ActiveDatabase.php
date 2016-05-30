<?php 
namespace backend\models;
use yii\db\ActiveRecord;

class ActiveDatabase extends ActiveRecord
{
	public static function tableName()
	{
		return 'active';
	}
    
}
 ?>
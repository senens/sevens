<?php 
namespace backend\models;
use yii\db\ActiveRecord;

class CommentDatabase extends ActiveRecord
{
	public static function tableName()
	{
		return 'comment';
	}
    
}
 ?>
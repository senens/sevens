<?php 
	namespace backend\models;
	use yii\db\ActiveRecord;

	class UserDatabase extends ActiveRecord
	{
		/**
		 * 
		 * @return string 返回表名
		 */
		public static function tableName()
		{
			return 'user';
		}
	} 
 ?>
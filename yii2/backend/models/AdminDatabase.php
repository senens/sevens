<?php 
	namespace backend\models;
	use yii\db\ActiveRecord;

	class AdminDatabase extends ActiveRecord
	{
		/**
		 * 
		 * @return string 返回表名
		 */
		public static function tableName()
		{
			return 'admin_user';
		}
	} 
 ?>
<?php 
namespace backend\models;
use yii\base\Model;
use backend\models\UserDatabase;

class Handel extends Model
{	
	/**
	 * 管理员添加账号唯一性
	 * @return array
	 */
	public function GselectedOne($names)
	{
		$connection = \Yii::$app->db;
		$command = $connection->createCommand("SELECT * FROM admin_user WHERE u_name='$names'");
		$data = $command->queryOne();
		return $data; 
	}
	/**
	 * 管理员添加
	 * 
	 */
	public function Gadd($names,$pwd,$sex)
	{
		$connection = \Yii::$app->db;
		$bool = $connection->createCommand()->insert('admin_user', [
						    'u_name' => $names,
						    'u_pawd' => $pwd,
						    'u_sex' => $sex,
			])->execute();
		return $bool;
	}
	/**
	 * 管理员删除
	 * 
	 */
	public function Gdel($id)
	{
		$admin_user = new AdminDatabase();
		$admin_user = AdminDatabase::findOne($id);
		$bool = $admin_user->delete();
		return $bool;
	}
	/**
	 * 管理员默认
	 * 
	 */
	public function Gupdate($id)
	{
		$admin_user = new AdminDatabase();
		$admin_user = AdminDatabase::find()
					->where(['u_id' => $id])
					->asArray()
					->one();
		return $admin_user;
	}
	/**
	 * 管理员修改成功
	 */
	public function Gupdated($names,$pwd,$sex,$id)
	{
		$admin_user = new AdminDatabase();
		$admin_user = AdminDatabase::findOne($id);
		$admin_user	->u_name = $names;
		$admin_user	->u_pawd = $pwd;
		$admin_user	->u_sex = $sex;
		$bool = $admin_user->save();
		return $bool;
	}
	/**
	 * 房东默认
	 */
	public function Fdefault($id)
	{
		$UserDatabase = new UserDatabase();
		$UserDatabase = UserDatabase::find()
					->where(['u_id' => $id])
					->asArray()
					->one();
		return $UserDatabase;
	}
	/**
	 * 房东修改
	 */
	public function Fupdated($id,$names,$pwd,$sex,$email,$address,$phone,$nick)
	{
		$UserDatabase = new UserDatabase();
		$UserDatabase = UserDatabase::findOne($id);
		$UserDatabase->u_name = $names;
		$UserDatabase->u_nickname = $nick;
		$UserDatabase->u_pawd = $pwd;
		$UserDatabase->u_sex = $sex;
		$UserDatabase->u_email = $email;
		$UserDatabase->u_address = $address;
		$UserDatabase->u_phone = $phone;
		$bool = $UserDatabase->save();
		return $bool;
	}
	/**
	 * 房东删除
	 * 
	 */
	public function Fdel($id)
	{
		$UserDatabase = new UserDatabase();
		$UserDatabase = UserDatabase::findOne($id);
		$bool = $UserDatabase->delete();
		return $bool;
	}
	/**
	 * *房东账号未审核变审核
	 */
	public function Fshen($id)
	{
		$UserDatabase = new UserDatabase();
		$UserDatabase = UserDatabase::findOne($id);
		$UserDatabase->u_status = 1;
		$bool = $UserDatabase->save();
		return $bool;
	}
	/**
	 * 房东账号唯一性
	 */
	public function Fonly($names)
	{
		$connection = \Yii::$app->db;
		$command = $connection->createCommand("SELECT * FROM user WHERE u_name='$names'");
		$data = $command->queryOne();
		return $data;
	}
	/**
	 * 租客删除
	 */
	public function Zdel($id)
	{
		$UserDatabase = new UserDatabase();
		$UserDatabase = UserDatabase::findOne($id);
		$bool = $UserDatabase->delete();
		return $bool;
	}
	/**
	 * 租客默认
	 */
	public function Zdefault($id)
	{
		$UserDatabase = new UserDatabase();
		$UserDatabase = UserDatabase::find()
							->where(['u_id' => $id])
							->asArray()
							->one();
		return $UserDatabase;
	}
	/**
	 * 租客修改
	 */
	public function Zupdate($id,$names,$pwd,$sex,$email,$address,$phone,$nick)
	{
		$UserDatabase = new UserDatabase();
		$UserDatabase = UserDatabase::findOne($id);
		$UserDatabase->u_name = $names;
		$UserDatabase->u_nickname = $nick;
		$UserDatabase->u_pawd = $pwd;
		$UserDatabase->u_sex = $sex;
		$UserDatabase->u_email = $email;
		$UserDatabase->u_address = $address;
		$UserDatabase->u_phone = $phone;
		$bool = $UserDatabase->save();
		return $bool;
	}
	/**
	 * 租客账号未审核变审核
	 */
	public function Zshen($id)
	{
		$UserDatabase = new UserDatabase();
		$UserDatabase = UserDatabase::findOne($id);
		$UserDatabase->u_status = 1;
		$bool = $UserDatabase->save();
		return $bool;
	}
}
 ?>
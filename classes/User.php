<?php

class User
{
	private $_id;
	private $_email;
	private $_time;

	function __construct($id)
	{
		$id = (int)$id;
		if($id > 0){
			$this->$_id = $id;
		}
	}

	public static function userExist($c, $value){
		$_db = new PDO('sqlite:../data.db', null, null, [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		]);
		$req = $_db->query('SELECT COUNT(*) as nbr FROM users WHERE '.$c.'="'.$value.'"');
		$count = $req->fetch()['nbr'];
		$req->closeCursor();
		if($count == 1){
			return true;
		}
		return false;
	}

	public static function userLogin($email, $password){
		$_db = new PDO('sqlite:../data.db', null, null, [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
		]);
		$email = $_db->quote($email);
		$req = $_db->query('SELECT COUNT(*) as nbr, password FROM users WHERE email='.$email);
		$data = $req->fetch();
		$count = $data->nbr;

		if($count == 1){
			if(md5($password) == $data->password){
				return true;
			}
			$req->closeCursor();
		}else{
			return false;
		}
	}

	public static function getUserId($email){
		$_db = new PDO('sqlite:../data.db', null, null, [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		]);
		//$email = $_db->quote($email);
		$req = $_db->query('SELECT * FROM users WHERE email="'.$email.'"');
		$data = $req->fetch();
		return (int)$data['id'];
	}

	public static function userRegister($email, $password){
		$_db = new PDO('sqlite:../data.db', null, null, [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
		]);
		$email = $email;
		$password = md5($password);
		$time = time();
		if(self::userExist('email',$email)){
			return false;
		}else{
			$req = $_db->prepare('INSERT INTO users (`email`,`password`,`created_at`)VALUES(?,?,?)');
			$req->execute([$email,$password,$time]);
			$last_id = $_db->lastInsertId();
			echo $last_id;
			$req->closeCursor();
			if(self::userExist('id',$last_id)){
				return true;
			}
			return false;
		}
		
	}
}
?>
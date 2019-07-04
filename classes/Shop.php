<?php 

class Shop
{
	private $_id;
	private $_name;
	private $_image;
	private $_distance;

	function __construct($arr)
	{
		$_id = $arr['id'];
		$_name = $arr['name'];
		$_image = $arr['image'];
		$_distance = $arr['distance'];
	}

	public static function getShops()
	{
		$pdo = new PDO('sqlite:data.db', null, null, [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
		]);
		$query = $pdo->query('SELECT * FROM shops ORDER BY distance');
		$error = null;
		$i = 0;
		$arr = [];
		try{
			while($shops = $query->fetch()){
				$arr[$i] = $shops;
				$i++;
			}
			return $arr;
			
		} catch(PDOException $e){
			$error = $e->getMessage();
		}
	}

	public static function liked($user,$id){
		$pdo = new PDO('sqlite:data.db', null, null, [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
		]);
		$query = $pdo->query('SELECT COUNT(*) nbr FROM shops,`like_dislike` WHERE id='.$id.' AND id_shop='.$id.' AND id_user='.$user.' AND type=1 ORDER BY distance');
		$count = $query->fetch();
		if($count->nbr == 0){
			return false;
		}else{
			return true;
		}
	}

	public static function disliked($user,$id){
		$pdo = new PDO('sqlite:data.db', null, null, [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
		]);
		$query = $pdo->query('SELECT COUNT(*) nbr FROM shops,like_dislike WHERE id='.$id.' AND id_shop='.$id.' AND id_user='.$user.' AND type=0 ORDER BY distance');
		$count = $query->fetch();
		if($count->nbr == 0){
			return false;
		}else{
			return true;
		}
	}

	public static function likeDislikeShop($user,$id,$type){
		$time = time();
		$pdo = new PDO('sqlite:../data.db', null, null, [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
		]);
		$query = $pdo->query('SELECT COUNT(*) nbr FROM shops,like_dislike WHERE id='.$id.' AND id_shop='.$id.' AND id_user='.$user);
		$count = $query->fetch();
		echo $count->nbr;
		$query->closeCursor();
		if($count->nbr == 0){
			$req = $pdo->prepare('INSERT INTO like_dislike VALUES(?,?,?,?)');
			$req->execute([$id,$user,$type,$time]);
		}else{
			$req = $pdo->prepare('UPDATE like_dislike SET type=?, `time`=? WHERE id_shop=? AND id_user=?');
			$req->execute([$type,$time,$id,$user]);
		}		
	}

	public static function dislikeShop($user,$id,$type){
		$time = time();
		$pdo = new PDO('sqlite:../data.db', null, null, [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
		]);
		$req = $pdo->prepare('INSERT INTO like_dislike VALUES(?,?,?,?)');
		$req->execute([$id,$user,$type,$time]);
	}

	public static function dislikedForLess2hours($user,$id){
		$time = time();
		$pdo = new PDO('sqlite:data.db', null, null, [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
		]);
		$query = $pdo->query('SELECT `time` FROM like_dislike WHERE id_shop='.$id.' AND id_user='.$user.' AND type=0');
		$r = $query->fetch();
		return ((time() - $r->time)/3600 < 2);
	}

	// GETTERS
	public function id()
	{
		return $this->$_id;
	}

	public function name()
	{
		return $this->$_name;
	}

	public function image()
	{
		return $this->$_image;
	}

	public function distance()
	{
		return $this->$_distance;
	}

}
?>
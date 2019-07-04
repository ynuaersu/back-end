<?php 
	session_start();
	require_once('../classes/Shop.php');
	if(isset($_SESSION['id'])){
		if(isset($_POST['id'], $_POST['type'])){
			$id = (int)$_POST['id'];
			if($_POST['type'] == 0 || $_POST['type'] == 1){
				$type = (int)$_POST['type'];
				Shop::likeDislikeShop($_SESSION['id'],$id, $type);
			}else if($_POST['type'] == 2){
				$pdo = new PDO('sqlite:../data.db', null, null, [
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
				]);
				$req = $pdo->prepare('DELETE FROM like_dislike WHERE id_shop=? AND id_user=?');
				$req->execute([$id,$_SESSION['id']]);
			}
		}
	}
?>
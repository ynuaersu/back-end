<?php 
	session_start();
	require_once('../classes/Shop.php');
	// if user is signed in
	if(isset($_SESSION['id'])){
		if(isset($_POST['id'], $_POST['type'])){
			// get the id of the shop
			$id = (int)$_POST['id'];
			if($_POST['type'] == 0 || $_POST['type'] == 1){
				// get the type of the action (0 for dislike, 1 for like)
				$type = (int)$_POST['type'];
				Shop::likeDislikeShop($_SESSION['id'],$id, $type); // like or dislike the shop
			}else if($_POST['type'] == 2){
				// if type = 2 then it means to remove the like/dislike
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
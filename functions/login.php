<?php 
	require_once('../classes/User.php');
	if(isset($_POST['email'], $_POST['password'])){
		$email = $_POST['email'];
		$password = $_POST['password'];

		if(User::userLogin($email, $password)){
			// Connexion
			session_start();
			$_SESSION['id'] = User::getUserId($email);
			header("location: ../nearbyShops");


		}else{
			// Error

			echo "wrong password";

		}
	}
?>
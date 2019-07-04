<?php 
	require_once('../classes/User.php');
	if(isset($_POST['email'], $_POST['password'])){
		$email = $_POST['email'];
		$password = $_POST['password'];

		if(User::userRegister($email, $password)){
			// Inscription

			header("location: ../login");


		}else{
			// Error

			echo "noooooooope";


		}
	}
?>
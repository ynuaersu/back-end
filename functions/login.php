<?php 
	require_once('../classes/User.php');
	// check if there is an email and password
	if(isset($_POST['email'], $_POST['password'])){
		$email = $_POST['email'];
		$password = $_POST['password'];

		// if the user infos are correct
		if(User::userLogin($email, $password)){
			// sign in
			session_start();
			$_SESSION['id'] = User::getUserId($email); // session id gets the id of the user
			header("location: ../nearbyShops"); // redirect to nearbyShops


		}else{
			// Error

			echo "wrong email or password";
			?>
			<p><a href="login">Try again</a></p>
			<?php
		}
	}
?>
<?php 
	require_once('../classes/User.php');
	// check if there is an email and password
	if(isset($_POST['email'], $_POST['password'])){
		$email = $_POST['email'];
		$password = $_POST['password'];

		// register the user if the email and password are valid
		if(User::userRegister($email, $password)){
			

			header("location: ../login");


		}else{
			// Error

			echo "Couldn't sign up, please try again";
			?>
			<p><a href="register">Try again</a></p>
			<?php


		}
	}
?>
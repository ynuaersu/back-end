	<?php 
		if(isset($_SESSION['id'])){
			header("location: nearbyShops");
		}
	?>
	<form class="form-signin" method="POST" action="functions/register.php">
		<h1 class="h3 mb-3 font-weight-normal">Register</h1>
		<label for="inputEmail" class="sr-only">Email address</label>
		<input type="email" name="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required autofocus>
		<label for="inputPassword" class="sr-only" name="password">Password</label>
		<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
		<div class="checkbox mb-3">
		</div>
		<button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
		<label><a href="login">Login</a></label>
	</form>
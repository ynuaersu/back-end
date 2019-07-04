<?php 
	session_start();
	// include all the classes
	require_once('classes/Shop.php');
	require_once('classes/User.php');

	$url = ''; // the variable that contains the url of page

	// check if their is a non empty url
	if(isset($_GET['url']) and !empty($_GET['url'])){
		$url = $_GET['url'];
	}else{
		// else the url goes to login
		$url = "login";
	}

	// include the header (contains html)
	include 'views/header.php';


	// include the html code coresponding to the url
	// we check if the file exist then include it
	if(file_exists('views/'.$url.'.php')){
		require_once('views/'.$url.'.php');
	}else{
		require_once('views/404.php');
	}
	

	include 'views/footer.php';	
?>
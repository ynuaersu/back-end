<?php 
	session_start();
	require_once('classes/Shop.php');
	require_once('classes/User.php');

	$url = '';
	if(isset($_GET['url']) and !empty($_GET['url'])){
		$url = $_GET['url'];
	}else{
		$url = "login";
	}

	include 'views/header.php';

	if(file_exists('views/'.$url.'.php')){
		require_once('views/'.$url.'.php');
	}else{
		require_once('views/404.php');
	}
	

	include 'views/footer.php';	
?>

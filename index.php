<?php 
	
	$url = ''; // this variable containes the name of the page

	// we use the GET method to get the url, this way we can have all the page of our application in a single file (index.php)
	if(isset($_GET['url']) and !empty($_GET['url'])){
		$url = $_GET['url'];
	}else{
		// if their is nothing the page is by default login
		$url = "login";
	}

	// include the header
	include 'views/header.php';

	// the we include the view (html code) that coresponds to the page, the views are named the same as the page and are stored in the views repository
	if(file_exists('views/'.$url.'.php')){
		require_once('views/'.$url.'.php');
	}else{
		// if the file doesn't exist we show Error 404
		require_once('views/404.php');
	}
	
	// include the footer
	include 'views/footer.php';	
?>
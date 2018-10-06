<?php

/* session_start(); */



if (!isUserLoggedIn()) {
	
	header('location: ../login/index.php');
	exit();
	
}



function isUserLoggedIn() {
	
	if ( isset($_SESSION['id']) || isset($_COOKIE['id']) ) {
		
		return true;
		
	} else {
		
		return false;
		
	}
	
}


?>
<?php
	
	
include 'connection.php';

	session_start();
	$sessionId = $_SESSION['id'];
	$cookieId = $_COOKIE['id'];
	
	if (isset($cookieId)) {
			
			$id = $cookieId;
			
		} else {
			
			$id = $sessionId;
			
		}

		
		$query = "SELECT bio FROM `users` WHERE id = '".$id."' ";
	
		$result = mysqli_query($link, $query);
		
		$row = mysqli_fetch_array($result);
		echo $row['bio'];
		
		
?>	
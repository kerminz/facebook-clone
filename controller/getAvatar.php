<?php

// ** ------------------------- TIMELINE init: loads posts from database on page load ------------------------

include 'connection.php';
$data = json_decode(file_get_contents("php://input")); // waiting for Json Data

	session_start();
	$sessionId = $_SESSION['id'];
	$cookieId = $_COOKIE['id'];
	
	if (isset($cookieId)) {
			
			$id = $cookieId;
			
		} else {
			
			$id = $sessionId;
			
		}



	$query = "SELECT * FROM `avatar` WHERE userId = '".$id."' ";
				
	$result = mysqli_query($link, $query);
		
	if (mysqli_num_rows($result) > 0) {
			              
		while($row = mysqli_fetch_assoc($result) ) {
				              
			$arr[] = $row;
			        
		}	              
	}
		
	echo json_encode($arr);
		
// ** ------------------------- TIMELINE init: loads posts from database on page load ------------------------


	
	
?>
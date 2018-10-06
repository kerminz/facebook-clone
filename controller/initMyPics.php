<?php

// ** ------------------------- TIMELINE init: loads posts from database on page load ------------------------

include 'connection.php';
$data = json_decode(file_get_contents("php://input")); // waiting for Json Data
$limit = $data->limit;

	session_start();
	$sessionId = $_SESSION['id'];
	$cookieId = $_COOKIE['id'];
	
	if (isset($cookieId)) {
			
			$id = $cookieId;
			
		} else {
			
			$id = $sessionId;
			
		}

if (!isset($limit)) {
	$limit = 6;
}

		

	$query = "SELECT postings.id, postings.userId, postings.timestamp, postings.image, postings.imgWidth, postings.imgHeight FROM `postings` WHERE postings.userId = '".$id."' AND postings.image ORDER BY postings.timestamp DESC LIMIT $limit";
				
	$result = mysqli_query($link, $query);
		
	if (mysqli_num_rows($result) > 0) {
			              
		while($row = mysqli_fetch_assoc($result) ) {
				              
			$arr[] = $row;
			        
		}	              
	}
		
	echo json_encode($arr);
		
// ** ------------------------- TIMELINE init: loads posts from database on page load ------------------------


	
	
?>
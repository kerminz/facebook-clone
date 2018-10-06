<?php

// ** ------------------------- TIMELINE init: loads posts from database on page load ------------------------

include 'connection.php';
$data = json_decode(file_get_contents("php://input")); // waiting for Json Data
$timestamp = $data->timestamp;

	session_start();
	$sessionId = $_SESSION['id'];
	$cookieId = $_COOKIE['id'];
	
	if (isset($cookieId)) {
			
			$id = $cookieId;
			
		} else {
			
			$id = $sessionId;
			
		}



		$query = "SELECT users.name, users.id as userId, postings.post, postings.id, postings.timestamp, postings.image, postings.imgWidth, postings.imgHeight, postings.videoThumb, postings.linkTitle, postings.linkDesc, postings.linkUrl, postings.linkImage, postings.longt, postings.lat, postings.ort, postings.linkVideo, avatar.image as avatar FROM `users` JOIN `postings` ON users.id = postings.userId JOIN `avatar` ON postings.userId = avatar.userId WHERE EXISTS (SELECT * FROM `relations` WHERE ( (userOneId = '".$id."' OR userTwoId = '".$id."') AND (userOneId = postings.userId OR userTwoId = postings.userId )) AND relations.status=1 ) AND postings.timestamp > $timestamp ORDER BY postings.timestamp DESC LIMIT 10";
				
	$result = mysqli_query($link, $query);
		
	if (mysqli_num_rows($result) > 0) {
			              
		while($row = mysqli_fetch_assoc($result) ) {
				              
			$arr[] = $row;
			        
		}	              
	}
		
	echo json_encode($arr);
		
// ** ------------------------- TIMELINE init: loads posts from database on page load ------------------------


	
	
?>
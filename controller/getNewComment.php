<?php
	
// ** ------------------------- TIMELINE init: loads posts from database on page load ------------------------

include 'connection.php';

$data = json_decode(file_get_contents("php://input")); // waiting for Json Data
$postId = $data->postId;
$timestamp = $data->timestamp;

	
session_start();
	$sessionId = $_SESSION['id'];
	$cookieId = $_COOKIE['id'];
	
	if (isset($cookieId)) {
			
			$id = $cookieId;
			
		} else {
			
			$id = $sessionId;
			
		}

if ($timestamp == null) {
	
	$timestamp = 0;
	
}

$query = "SELECT users.name, comments.comment, comments.id, comments.postId, comments.userId, comments.timestamp, comments.image, avatar.image as avatar FROM `comments` JOIN `users` ON users.id = comments.userId JOIN `avatar` ON comments.userId = avatar.userId WHERE comments.postId = '".$postId."' AND comments.timestamp > $timestamp ORDER BY comments.timestamp DESC";
				
			$result = mysqli_query($link, $query);
				
			if (mysqli_num_rows($result) > 0) {
					              
				while($row = mysqli_fetch_assoc($result) ) {
						              
					$arr[] = $row;
					        
				}	              
			}
				
			echo json_encode($arr);



/*
	$query = "SELECT users.name, comments.comment, comments.postId, comments.userId, comments.timestamp, comments.image, avatar.image as avatar FROM `comments` JOIN `users` ON users.id = comments.userId JOIN `postings` ON postings.id = comments.postId JOIN `avatar` ON comments.userId = avatar.userId WHERE EXISTS (SELECT * FROM `relations` WHERE ( (userOneId = '".$id."' OR userTwoId = '".$id."') AND (userOneId = postings.userId OR userTwoId = postings.userId )) AND relations.status=1 ) ORDER BY comments.timestamp DESC LIMIT 100";
				
			$result = mysqli_query($link, $query);
				
			if (mysqli_num_rows($result) > 0) {
					              
				while($row = mysqli_fetch_assoc($result) ) {
						              
					$arr[] = $row;
					        
				}	              
			}
				
			echo json_encode($arr);
*/
		
// ** ------------------------- TIMELINE init: loads posts from database on page load ------------------------	
	
?>
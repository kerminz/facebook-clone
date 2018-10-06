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


		

	$query = "SELECT users.name, relations.actionUserId, avatar.image as avatar FROM `relations`, `users`, `avatar` WHERE (relations.userOneId = '".$id."' OR relations.userTwoId = '".$id."') AND avatar.userId = relations.actionUserId AND status = 0 AND users.id = relations.actionUserId AND relations.actionUserId != '".$id."' ";
				
	$result = mysqli_query($link, $query);
		
	if (mysqli_num_rows($result) > 0) {
			              
		while($row = mysqli_fetch_assoc($result) ) {
				              
			$arr[] = $row;
			        
		}	              
	}
		
	echo json_encode($arr);

		

	
?>
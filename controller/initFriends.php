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



	$query = "SELECT users.name, users.id, users.bio, avatar.image as avatar FROM `users`, `avatar` WHERE EXISTS (SELECT * FROM `relations` WHERE ( (userOneId = '".$id."' OR userTwoId = '".$id."') AND (userOneId = users.id OR userTwoId = users.id )) AND relations.status = 1 ) AND avatar.userId = users.id ORDER BY users.id ASC";
	$result = mysqli_query($link, $query);
	

	if (mysqli_num_rows($result) > 0) {
              
		while($row = mysqli_fetch_assoc($result) ) {
				              
			$arr[] = $row;
			      
		}	              
	}
				
	
		
	
	
	echo json_encode($arr);

	
?>	
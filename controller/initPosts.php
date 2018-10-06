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
	$limit = 10;
}

		

	$query = "SELECT users.name, users.id as userId, postings.post, postings.id, postings.timestamp, postings.image, postings.imgWidth, postings.imgHeight, postings.videoThumb, postings.linkTitle, postings.linkDesc, postings.linkUrl, postings.linkImage, postings.lat, postings.longt, postings.ort, postings.linkVideo, avatar.image as avatar FROM `users` JOIN `postings` ON users.id = postings.userId JOIN `avatar` ON postings.userId = avatar.userId WHERE EXISTS (SELECT * FROM `relations` WHERE ( (userOneId = '".$id."' OR userTwoId = '".$id."') AND (userOneId = postings.userId OR userTwoId = postings.userId )) AND relations.status=1 ) ORDER BY postings.timestamp DESC LIMIT $limit";
	
				
	$result = mysqli_query($link, $query);
		
	if (mysqli_num_rows($result) > 0) {
			              
		while($row = mysqli_fetch_assoc($result) ) {
			
			         
			$arr[] = $row;
			        
		}	              
	}
	
	
	for ($i = 0; $i < sizeof($arr); $i++) {
		
			$postId = $arr[$i]['id'];
			
			$query2 = "SELECT * FROM `likes` WHERE postId = $postId";		
			$result2 = mysqli_query($link, $query2);
			
			if (mysqli_num_rows($result2) > 0) {
			              
				while($row3 = mysqli_fetch_assoc($result2) ) {
					
					         
					$counter1 = $counter1 + 1;
					        
				}
				
				
				$arr[$i]['counter'] = $counter1;
				$counter1 = 0;
					              
			} 

		
	}
	
	
	
	
	for ($i = 0; $i < sizeof($arr); $i++) {
		
			$postId = $arr[$i]['id'];
			
			$query4 = "SELECT * FROM `likes` WHERE postId = $postId AND userId = $id ";	
			$result4 = mysqli_query($link, $query4);

			
			if (mysqli_num_rows($result4) > 0) {
			              
				while($row4 = mysqli_fetch_assoc($result4) ) {
					
					         
					$counter2 = $counter2 + 1;
					        
				}
				
				
			
				$arr[$i]['userLike'] = $counter2;
				$counter2 = 0;           
			}

		
	}




	
	

		
	echo json_encode($arr);
		
// ** ------------------------- TIMELINE init: loads posts from database on page load ------------------------


	
	
?>
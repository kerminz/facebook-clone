<?php

class Relation {
	
	
	function sendFriendRequest($sessionId, $cookieId, $userTwoId, $status, $link) {
		
		if ($status === 0) {

			if (isset($cookieId)) {
				
				$id = $cookieId;
				$actionId = $cookieId;
				
			} else {
				
				$id = $sessionId;
				$actionId = $sessionId;
				
			}
			
			if ($id > $userTwoId) {
				
				$temp = $id;
				$id = $userTwoId;
				$userTwoId = $temp;
				
			}
			
			$queryCheck = "SELECT * FROM `relations` WHERE `userOneId` = '".$id."' AND `userTwoId` = '".$userTwoId."' AND `status` = '".$status."'";
			$result = mysqli_query($link, $queryCheck);
			while($row = mysqli_fetch_assoc($result) ) { //mysqli_fetch_assoc() im Prinzip das gleiche wie mysqli_fetch_array(), liefert allerdings false wenn kein Datensatz mehr vorhanden ist.
				              
				$arr[] = $row;	        
						        
			}
			
			if ($userTwoId > 0 && $arr[0]['status'] == NULL && $id > 0) {
			
				$query = "INSERT INTO `relations` (`userOneId`, `userTwoId`, `status`, `actionUserId`) VALUES ('".$id."', '".$userTwoId."', '".$status."', '".$actionId."')";
				mysqli_query($link, $query);
				
			}
		
		}
		
	}
	
	
	function acceptFriendRequest($sessionId, $cookieId, $userTwoId, $status, $link) {
		
		if ($status === 1) {
		
		
			if (isset($cookieId)) {
				
				$id = $cookieId;
				$actionId = $cookieId;
				
			} else {
				
				$id = $sessionId;
				$actionId = $sessionId;
				
			}
			
			if ($id > $userTwoId) {
				
				$temp = $id;
				$id = $userTwoId;
				$userTwoId = $temp;
				
			}
			
			$queryCheck = "SELECT * FROM `relations` WHERE `userOneId` = '".$id."' AND `userTwoId` = '".$userTwoId."' AND `status` = 0";
			$result = mysqli_query($link, $queryCheck);
			while($row = mysqli_fetch_assoc($result) ) { 
				              
				$arr[] = $row;	        
						        
			}
			
			if ($userTwoId > 0 && $id > 0 && $arr[0]['status'] == 0 && $arr[0]['status'] != 1 && $arr[0]['actionUserId'] != $actionId ) {
	
			
				$query = "UPDATE `relations` SET `status` = '".$status."', `actionUserId` = '".$actionId."' WHERE `userOneId` = '".$id."' AND `userTwoId` = '".$userTwoId."'";
				mysqli_query($link, $query);
			
			}
		
		}
		
	}
	
	
	function checkFriendship ($sessionId, $cookieId, $userTwoId, $link) {

		if (isset($cookieId)) {
			
			$id = $cookieId;
			
		} else {
			
			$id = $sessionId;
			
		}
		
		if ($id > $userTwoId) {
			
			$temp = $id;
			$id = $userTwoId;
			$userTwoId = $temp;
			
		}
		
		if ($userTwoId > 0 && $id > 0) {
		
			$query = "SELECT * FROM `relations` WHERE `userOneId` = '".$id."' AND `userTwoId` = '".$userTwoId."' ";
			$result = mysqli_query($link, $query);
			
			 while($row = mysqli_fetch_assoc($result) ) { 
			              
				$arr[] = $row;
					        
					        
			}
			
			echo json_encode($arr);
		
		}
		
		
	}
	
	
	
}
	
	
?>
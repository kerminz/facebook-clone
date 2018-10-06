<?php

class User {

	
	// ------------ GET Functions ------------------------------------------------------------------------------------------------
	
	
	// Checker Function, checks if Data is already in SQL Database
	public function getUserName ($sessionId, $cookieId, $link) {
	
		if (isset($cookieId)) {
			
			$id = $cookieId;
			
		} else {
			
			$id = $sessionId;
			
		}
		
		$query = "SELECT name FROM `users` WHERE id='".$id."'";
		$result = mysqli_query($link, $query);
		$row = mysqli_fetch_array($result);
		return $row['name'];
		
		
	}
	
	
	
	public function getUserBio($sessionId, $cookieId, $link) {
		
		
		if (isset($cookieId)) {
			
			$id = $cookieId;
			
		} else {
			
			$id = $sessionId;
			
		}

		
		$query = "SELECT bio FROM `users` WHERE id = '".$id."' ";
	
		$result = mysqli_query($link, $query);
		
		if (mysqli_num_rows($result) > 0) {
			              
			while($row = mysqli_fetch_assoc($result) ) {
				              
				$arr[] = $row;
			        
			}	              
		}
		
		return json_encode($arr);	

	}
	
	
	// ------------ GET Functions END------------------------------------------------------------------------------------------------
		
}




/*
// ------------  display php errors ------------ 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// ------------ display php errors END ---------
*/

?>
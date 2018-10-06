<?php


class Login {
	
	// checks if Username is already stored and if user entered correctly
	function userNameValidation($name, $link) {
		
		$query = "SELECT * FROM `users` WHERE name='".mysqli_real_escape_string($link, $name)."'";
			
		$result = mysqli_query($link, $query);
			
		$results = mysqli_num_rows($result);
			
		if ($results) {
				
			return true; // Name is in use
				
		} else {
			
			if(strlen($name)<4) return $error ="Dein Name muss mindestens <strong>4 Zeichen</strong> enthalten";	// checks the length of entered Name, must be >= 4
				else return false;
					
		}
		
	}
	
	
	
	// Login Info Checker - checks if email and password information are correct
	function userLoginDataCheck ($email, $password, $link) {
		
		$query = "SELECT * FROM `users` WHERE email='".mysqli_real_escape_string($link, $email)."' AND password='".md5(md5($email).$password)."' LIMIT 1";
			
		$result = mysqli_query($link, $query);
			
		$row = mysqli_fetch_array($result);
		
		if ($row) {
				
			$_SESSION['id'] = $row['id'];
				
			// TODO: Redirect to mainpage.php after Log in process
				
		} else {
				
			return $error =  "Passwort und/oder E-Mail nicht richtig. Versuche es nochmal. ";
			
		}
		
	}
	
	
	function isUserNameSet ($link, $sessionId) {
		
		
		$query = "SELECT * FROM `users` WHERE id='".mysqli_real_escape_string($link, $sessionId)."'";
				
			$result = mysqli_query($link, $query);
				
			$row = mysqli_fetch_array($result);
				
			if ($row['name'] != NULL) {
					
				return true;
		
					
			} else {
					
				return false;
						
			}
		
	}
	
	
	function isUserLoggedIn() {
		
		if (isset($_SESSION['id']) || isset($_COOKIE['id'])) {
	
			return true;
			
		} else {
			
			return false;
			
		}
		
	}
	
	
	
	//Name Adder
	function addUserName ($name, $sessionId, $link) {
		
		$query = "UPDATE `users` SET name='".mysqli_real_escape_string($link, $name)."' WHERE id='".$sessionId."'";
		mysqli_query($link, $query);
					
	}
	
	
	// cookie setter
	function setUserCookie ($sessionId, $checkbox) {
		
		
		if ($checkbox == "on") {
			
			return setcookie("id", $sessionId, time()+60*60*24*7, "/");
			
		}
		
	}

	
}

/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
	
?>
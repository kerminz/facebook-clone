<?php

class Register {
	

	function userRegValidation($email, $password, $link) {

	if (!$email) $error .="<br />Bitte E-Mail eingeben";
			else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $error.="<br />Bitte gültige E-Mail eingeben";
			
		if (!$password) $error.="<br />Bitte Password eingeben";
			else {
					
				if(strlen($password)<8) $error.="<br />Das Passwort muss mindestens <strong>8 Zeichen</strong> enthalten";
				if(!preg_match('`[A-Z]`', $password)) $error.="<br />Das Passwort muss mindestens <strong>einen Großbuchstaben</strong> enthalten";
			}
			
		if ($error) return $error =  "<strong>Überprüfe bitte deine Eingabe(n): </strong>".$error;
			else {
				
					$query = "SELECT * FROM `users` WHERE email='".mysqli_real_escape_string($link, $email)."'";
				
					$result = mysqli_query($link, $query);
						
					$results = mysqli_num_rows($result);
				
					if ($results) {  // checks if E-Mail is already registered
						return $error = "Diese E-Mail Adresse ist bereits registriert. Willst du Dich einloggen?";
					}  
					else { // Otherwise Account-Informations will be stored in Database
						
						return false; // returns false if no errors was found --> Data ready for Database insert
						
					}
			}
		
		
	}

	
	// email and password inseratio in database
	function addUser ($email, $password, $link) {
		
		$query = "INSERT INTO `users` (`email`, `password`) VALUES ('".mysqli_real_escape_string($link, $email)."', '".md5(md5($email).$password)."')";
									
		mysqli_query($link, $query);
		
		$_SESSION['id']=mysqli_insert_id($link);
		$sessionId = $_SESSION['id'];
		
		// Dummy relation user to user, neccessary for displaying own posts on timeline
		
		$query2 = "INSERT INTO `relations` (`userOneId`, `userTwoId`, `status`, `actionUserId`) VALUES ('".$sessionId."', '".$sessionId."', 1, '".$sessionId."')";
		mysqli_query($link, $query2);


		// Dummy Avatar
		$time = time();
		$image = "avatar.jpg";
		
		$query3 = "INSERT INTO `avatar` (`userId`, `timestamp`, `image`) VALUES ('".$sessionId."', '".$time."', '".$image."') ";
		mysqli_query($link, $query3);
					
	}	

	
	
}

/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

	
?>
<?php 

include '../controller/connection.php';	
include 'login.php';
include 'register.php';	

session_start();


// parse Post variables into $PHP variables
$submit = $_POST['submit'];
$email = $_POST['email'];
$password = $_POST['password'];
$name = $_POST['name'];
$sessionId = $_SESSION['id']; // IMPORTANT - if you are updating the Session ID, use $_SESSION['id'] !!!
$showNameForm = false;
$checkbox = isset($_POST['keep']);
$cookieId = $_COOKIE['id'];

// ----------** Login process **---------------
$login = new Login();


if ($login->isUserNameSet ($link, $sessionId)) {
	
	header("location: ../index.php");
	exit();
	
}


if($submit == "Anmelden") {
	
	$error = $login->userLoginDataCheck ($email, $password, $link);
	$sessionId = $_SESSION['id']; // update Session variable
	$login->setUserCookie ($sessionId, $checkbox);
	
	if ($login->isUserNameSet ($link, $sessionId)) {
		
		header("Location: ../index.php");
		
		
	} else {
		
		$showNameForm = true; // triggering Event for Ng-Show Div in index.php - User detail form will be shown
		$regSuccess = '<div class="alert alert-info">Du hast noch keinen Benutzernamen, um auf die Startseite zu gelangen, musst Du zunächst einen Namen eingeben</div>';
		
	}
	
}


if($submit == "Speichern") {
	
	if ($login->userNameValidation($name, $link) === true) { // checks if Name is in use
		
		$error = "Dieser Name ist bereits vergeben. Wähle einen anderen.";
		$showNameForm = true; 
		
	} else if ($login->userNameValidation($name, $link) != false) { // name is not in use, but too short
		
		$error = $login->userNameValidation($name, $link);
		$showNameForm = true;
		
	} else { // name is not too short an not in use -> Insert into database
		
		$login->addUserName ($name, $sessionId, $link);
		header("Location: ../index.php");
		
	}
	
}
// ----------** Login process END **---------------


// ------------------** Registration process **-------------------
$reg = new Register();

if($submit == "Registrieren") {
	
	$error = $reg->userRegValidation($email, $password, $link);
	
	if ($error == false) {
		
				
		$reg->addUser ($email, $password, $link); // insert data into databse	
					
		$showNameForm = true; // triggering Event for Ng-Show Div in index.php - User detail form will be shown
		$regSuccess = '<div class="alert alert-success">Registrierung erfolgreich! In Kürze bekommst du eine Bestätigung per Mail.</div><br /><p>Bevor es losgeht, würden wir zunächst gerne von Dir wissen, wie wir Dich nennen sollen?</p>';
	}

}
// ------------------** Registration process END **-------------------


/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/


	
?>
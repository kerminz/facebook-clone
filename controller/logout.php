<?php 

session_start();
session_destroy();
setcookie("id", "", time()-60*60*24*7, "/");	

header("location: ../login/index.php");
	
?>
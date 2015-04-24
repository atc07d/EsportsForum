<?php
	session_start();
	
	//unset($_SESSION['logged_in']);
	//unset($_SESSION['username']);
	//unset($_SESSION['userID']);
	session_unset();
	header ("Location: index.php");
?>
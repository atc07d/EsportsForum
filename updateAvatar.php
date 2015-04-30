<?php

session_start();
include_once "connect.php";

	




	if (isset($_POST['submit']))
	{

		$tempchoice = $_POST['select'];
	
		$tempU = $_SESSION['username'];
		$conn = new mysqli($servername, $username, $password, $dbname);
    	$sql = " UPDATE users
              	 SET user_avatar_choice = $tempchoice
              	 WHERE user_name = '$tempU'";


	    if ($conn->query($sql) === TRUE) 
	    {
	      //cho "Avatar selected:" . $tempchoice;
	    	header ("Location: uploadBlob.php");
	    } 
	    else 
	    {
	        echo "Error: " . $sql1 . "<br>" . $conn->error;
	    }

	    mysqli_close($conn);
	}





?>
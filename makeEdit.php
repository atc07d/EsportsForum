<?php
	session_start();
	include_once 'connect.php';


	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$datID = $_SESSION['qselect'];

	$sql3 = "UPDATE question 
			 SET q_content = '$_GET[edcontent]'
			 WHERE q_id = '$datID'";	

	if (isset($_GET['subedit'])) 
	{
		

		$result1 = $conn->query($sql3);
		echo "Edit made successfully!";
		//if ($conn->query($sql3) === TRUE) 
		//{
			//echo "Question edited successfully?";
			
		//} 
		unset($_SESSION['userID']);

	}











	echo '<br></br>
		<br></br>
		<form action=profile.php>
			<input type="submit" value="Back">  
		</form>
				
	
		';

		$conn->close();
?>
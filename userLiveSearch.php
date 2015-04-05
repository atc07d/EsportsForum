<?php
	
	// Runs query against user table for username, returns array of matching user names
	session_start();
	include_once 'connect.php';

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) 
	{
		die("Connection failed: " . $conn->connect_error);
	} 
	
	// Array for results of username characters
	$arr = array();

	if (!empty($_POST['keywords'])) 
	{
		$keywords = $conn->real_escape_string($_POST['keywords']);

		// Search user table for username like keyword
		// Cannot search for admin profile
		$sql = "SELECT user_name 
				FROM users 
				WHERE user_name LIKE '%".$keywords."%'
				AND user_name <>  'ADMINISTRATOR'";
				

		$result = $conn->query($sql) or die($mysqli->error);

		if ($result->num_rows >= 1) 
		{
			while ($obj = $result->fetch_object()) 
			{
				$arr[] = array('name' => $obj->user_name);
			}
		}
	}

	echo json_encode($arr);

?>
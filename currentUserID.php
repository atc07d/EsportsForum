<?php
// currentUserID function
	// returns current user id from users table + 1
	// Because Im an idiot and did not auto increment my primary key lol
	
	function currentUserID()
	{
		$servername = "localhost";
		$username = "admin";
		$password = "5pR1nG2OlS";
		$dbname = "messageboard";

		$conn3 = new mysqli($servername, $username, $password, $dbname);
		if ($conn3->connect_error ) 
		{
			die("Connection failed: " . $conn->connect_error);
		} 

		$UserID;

		$sql3 = "SELECT MAX(user_id) max
				 FROM users";

		$result3 = $conn3->query($sql3);
		$row3 = mysqli_fetch_array($result3);
		$UserID = $row3[0];

		$UserID++;

		mysqli_close($conn3);
		return $UserID;
		

	}

?>
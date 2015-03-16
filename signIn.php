<?php
	// Checks new user name against DB and rejects if not unique
	// If unique, add to user table

	session_start();
	include_once "connect.php";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	// Current last User ID, incremenet each time when inserted?
	// global $UserID = 14;

	// SQL queries
	// First query enables user name check against DB
	$sql = "SELECT * FROM users";

	// Second query inserts new user into DB once name uniqueness is established
	
			 
	// Find max id from table because id is not auto incremented in table, Im an idiot
	// Might be able to hard code at first the increment by 1 each new user since I can read table
	$sql3 = "SELECT MAX(user_id) max 
			 FROM users"; 
	
	// Get result of query from DB, need multiple connections for multiple queries?
	$result = $conn->query($sql);
	//$result2 = $conn->query($sql2);
	//$result3 = $conn->query($sql3);

	
	// Flag variable tests for uniqueness in user names in table users from messageboard DB
	// BUG: Breaks on null value for username. FIX: use isset on on those POST values, both uname and pw? 
	$flag = 0;
	if ($result->num_rows > 0) 
	{
		// output data of each row
		while($row = $result->fetch_assoc()) 
		{
			
			if (strcmp($_POST["User_Name"],$row["user_name"]) == 0)
			{

				//echo "Username in use. Try again ";
				$flag  = 1;
				break;
				
			}
			else 
			{
				
			}
		}
	} 
	else 
	{
		echo "0 results";
	}
	
	// If flag is tripped then the username is unique and can be inserted into DB
	if ($flag == 0)
	{
		echo "Username is unique";
		
		//============================================================
		// Need a way to save state of $UserID, other than that it works!
		//===============================================================

		static $UserID = 16;
		$UserID++;
		$sql2 = "INSERT INTO users (user_id,user_name,user_pw)
			 VALUES ('$UserID','$_POST[User_Name]','$_POST[User_PW]')";
		if ($conn->query($sql2) === TRUE) 
		{
			echo '<p>New record created successfully</p>
					<form action=index.php>
						<input type="submit" value="Home">
					</form>
				';
			

			//header ("Location: index.php");

		} 
		else 
		{
			echo "Error: " . $sql2 . "<br>" . $conn->error;
			echo '<p>New record failed</p>
					<form action=index.php>
						<input type="submit" value="Home">
					</form>
				';
		}
		

	}
	else
	{
		//echo $flag;

		echo '	<p>Rejected. Username is not unique. Select a different name.</p>
				<form action=index.php>
					<input type="submit" value="Home">
				</form>
			';

	}


	$conn->close();

?>
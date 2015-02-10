<?php
	//Checks logIn name/pw with user database
	session_start();
	$servername = "localhost";
	$username = "admin";
	$password = "5pR1nG2OlS";
	$dbname = "messageboard";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT user_id,user_name,user_pw FROM users";
	$result = $conn->query($sql);


	//$referer = $_SERVER['HTTP_REFERER'];
	
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) 
		{
			//echo " - username and password: " . $row["username"]. " " . $row["password"]. "<br>"; 
			if (!(strcmp($_POST["uname"],$row["user_name"]) && strcmp($_POST["pword"],$row["user_pw"])))
			{
				
				$_SESSION['username'] = $_POST["uname"];
				$_SESSION['userID'] = $row["user_id"];
				$_SESSION['logged_in'] = 1;
				//echo "<p>Successful Login!</p>" . $_SESSION['username'] . $_SESSION['userID'] ;
				//header("Location: $referer");
				header ("Location: indexBS.php");
				//break;
			}
			else {
				//echo "Login failed.  ";
				//echo $_POST["uname"] . " " . $_POST["pword"];
				//echo " - username and password: " . $row["username"]. " " . $row["password"]. "<br>"; 
				header("Location: logForm.php");
				//break;
				
			}
		}
	} else {
		echo "0 results";
	}
	$conn->close();
?>
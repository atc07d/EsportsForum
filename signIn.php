<?php
	// Checks new user name against DB and rejects if not unique
	// If unique, add to user table

	session_start();
	error_reporting(-1);
	ini_set('display_errors', 'On');
	include_once "connect.php";
	include_once "currentUserID.php";
	include_once "getGravatar.php";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	//$conn3 = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error  ) {
		die("Connection failed: " . $conn->connect_error);
	} 



	// SQL queries
	// First query enables user name check against DB
	$sql = "SELECT * FROM users";


	
	// Get result of query from DB, need multiple connections for multiple queries?
	$result = $conn->query($sql);
	//$result2 = $conn->query($sql2);
	//$result3 = $conn->query($sql3);



	// Send mail function from mailgun website
	// Parameters: users email address and user name
	// Result: send email to provided address containing validation link
	// 			validation link returns user to site and activate validation
	//			user can now do more than just look
	function sendFromMG($users_addr, $users_name)
	{

		$message = '
		<html>
		<head>
			<title>Validation Email</title>
		</head>
		<body>
			<h3>Greetings, ' . $users_name . '!</h3>
			<p>In order to fully use our website, please validate via the link below</p>
			
			<p><a href="http://wsdl-docker.cs.odu.edu:60283/linkValidation.php?emadrs=' . $users_addr . '">LINK</a></p>
			<br>
			<p>Sincerely,</p>
			<p>Staff</p>
		</body>
		</html>
		';

		$postQueryParameters =
			http_build_query(array(	
				"from" => 'Mailgun Sandbox <postmaster@sandboxb7356edd503a4f7889b10b55c6980167.mailgun.org>',	
				"to"  => $users_addr,
				"subject" => "CS418 - eSports WebSite",
				"text" => "Your mail do not support HTML",
				"html" => $message
			));

		$username = "api";
		$password = "key-0870ae65b68c2e4f30ea910f2fba542d"; 
		$ch = curl_init(); 

		curl_setopt($ch, CURLOPT_URL, "https://api.mailgun.net/v3/sandboxb7356edd503a4f7889b10b55c6980167.mailgun.org/messages"); 
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_USERPWD, $username.":".$password);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$postQueryParameters);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec ($ch);

		if($output != false)
		{
			echo $output;
			echo "done";
		}

		else 
		{
			echo "But there was an error<br>";
			echo $output;
			echo curl_error($ch);
		}

		curl_close ($ch);

	}


	// Flag variable tests for uniqueness in user names in table users from messageboard DB
	// BUG: Breaks on null value for username. FIX: use isset on on those POST values, both uname and pw? 
	$flag = 0;
	if ($result->num_rows > 0) 
	{
		// output data of each row
		while($row = $result->fetch_assoc()) 
		{
			
			if (strcmp($_POST["username"],$row["user_name"]) == 0)
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
		echo "Username is unique<br>";
		$_SESSION['email'] = $_POST["email"];

		$tempUser = currentUserID();
		$tempGrav = get_gravatar($_POST["email"]);
		//echo $tempGrav;

		$sql2 = "INSERT INTO users (user_id,user_name,user_pw,user_email,user_gravatar_url)
			 VALUES ('$tempUser','$_POST[username]','$_POST[password]','$_POST[email]','$tempGrav')";
		if ($conn->query($sql2) === TRUE) 
		{
			
			//sendMail($_POST["email"], $_POST["username"]);
			sendFromMG($_POST["email"], $_POST["username"]);

			echo '<p>New record created successfully</p>
					<form action=index.php>
						<input type="submit" value="Home">
					</form>
				';
			
				
			mysqli_close($conn);

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


	

?>
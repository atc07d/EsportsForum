<?php
	// Checks new user name against DB and rejects if not unique
	// If unique, add to user table

	session_start();
	error_reporting(-1);
	ini_set('display_errors', 'On');
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

	
	// Send mail function
	// Parameters: users email address and user name
	// Result: send email to provided address containing validation link
	// 			validation link returns user to site and activate validation
	//			user can now do more than just look
	function sendMail($users_addr, $users_name)
	{
		$to = $users_addr;

		$subject = 'CS418 eSports WebSite Validation';

		$message = '
		<html>
		<head>
			<title>Validation Email</title>
		</head>
		<body>
			<h3>Greetings, ' . $users_addr . '!</h3>
			<p>In order to fully use our website, please conform your existence
				as a non-robot and validate via the link below</p>
			<br>
			<p>link here</p>
		</body>
		</html>
		';

		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Additional headers
		$headers .= 'To:'. $users_name .  ' <' . $users_addr . '>' . "\r\n";
		$headers .= 'From: CS418 eSports WebSite Validation atc07d@gmail.com>' . "\r\n";
		$headers .= 'Reply-To: atc07d@gmail.com' . "\r\n";
		


		// Send mail
		if (mail($to, $subject, $message, $headers))
		{
			echo '<br>Please check your email and follow the validation link. Thank you for registering!';
		}

		else
		{
			echo '<br>Mail failed';
		}

	}

	// Professor Kelly's code from Notes
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
			
			<p><a href="http://wsdl-docker.cs.odu.edu:60283/linkValidation.php?emadrs="' . $users_addr . '">LINK</a<</p>
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
			echo "There was an error";
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
		echo "Username is unique";
		
		//============================================================
		// Need a way to save state of $UserID, other than that it works!
		//===============================================================

		static $UserID = 16;
		$UserID++;
		$sql2 = "INSERT INTO users (user_id,user_name,user_pw,user_email)
			 VALUES ('$UserID','$_POST[username]','$_POST[password]','$_POST[email]')";
		if ($conn->query($sql2) === TRUE) 
		{
			
			//sendMail($_POST["email"], $_POST["username"]);
			sendFromMG($_POST["email"], $_POST["username"]);

			echo '<p>New record created successfully</p>
					<form action=index.php>
						<input type="submit" value="Home">
					</form>
				';
			
				
			

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
<?php
	
	//Submit title and question content to questions DB, table main
	session_start();

	$servername = "localhost";
	$username = "admin";
	$password = "5pR1nG2OlS";
	$dbname = "messageboard";

	$conn0 = new mysqli($servername, $username, $password, $dbname);
	//$result = "SELECT "
	//$questionID = 
	
	$conn1 = new mysqli($servername, $username, $password, $dbname);
			$sql1 = "INSERT INTO question (q_asker,q_title, q_content,q_type)
					VALUES ('$_SESSION[username]','$_POST[title]', '$_POST[content]','$_POST[t_name]')";

	if ($conn1->query($sql1) === TRUE) 
		{
			echo "New record created successfully";
			echo '
					<form action=index.php>
						<input type="submit" value="Go Home">
					</form>
				';
		} 
	else 
		{
			echo "Error: " . $sql1 . "<br>" . $conn1->error;
		}

	$conn1->close();
?>


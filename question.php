<?php
	
	//Submit title and question content to questions DB, table main
	session_start();
	include_once 'connect.php';

	$conn0 = new mysqli($servername, $username, $password, $dbname);
	//$result = "SELECT "
	//$questionID = 
	
	$conn1 = new mysqli($servername, $username, $password, $dbname);
			$sql1 = "INSERT INTO question (q_asker,q_title, q_content,q_type, q_tags)
					VALUES ('$_SESSION[username]','$_POST[title]', '$_POST[content]','$_POST[t_name]', '$_POST[tagcontent]')";

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

	mysqli_close($conn1);
?>


<?php
	error_reporting(0);
	session_start();
	include_once 'connect.php';
	$conn = new mysqli($servername, $username, $password, $dbname);

	
	if(isset($_GET["searchname"]))
	{
		//echo $_GET["searchname"];
		// Print name of user currently logged in by accessing SESSIOn vars
		// STRONG HAS BEEN DEPRECATED
		echo  '<br></><strong>Profile for: </strong>' . $_GET['searchname'] . '<br></br>' ;
		$UN = $_GET['searchname'];
		
		// Query DB for user with SESSION var user name to obtain all related question data
		$sql = "SELECT *
				FROM users u
                LEFT JOIN question q
                ON u.user_name = q.q_asker
				WHERE u.user_name = '$UN' ";

		
		$result = $conn->query($sql);
		// STRONG HAS BEEN DEPRECATED!!!
		echo '<strong>Question Data: <br></>(VALUE|TITLE|GAME) </strong><br></br> ';
		$count = 0;

		while($row = $result->fetch_assoc()) 
		{
			
			
			if(empty($row["q_id"]))
			{

				$count = $count + 1;
				
			}
			else
			{
				echo ' ' . $row['q_value'] . ' | ' . $row['q_title'] . ' | ' . $row['q_type'] . '<br></br>' ;
				
			}

		}

		if($count != 0)
		{
			echo 'No post history';
		}
		/*scan upload folder for img with employee name appended to front
		$ufname = (string)$_SESSION['username'];
		$dir = 'http://' . (string)$serverAdd . '/uploads/';
		$results = scandir($dir);
		for($x in $results)
		{
			if(strpos($ufname,$x)!== FALSE)
			{

				$x = (string)$x
				echo '<strong>Avatar: </strong>
				<br></br>
				<img src="http://' . $serverAdd . '/uploads/' . $x .'" />
				<br></br>
				<br></br>
			';
			}

		}

	*/

	}
	else 
	{
		//do nothing

	}


	echo '<br></br>
		<form action=index.php>
			<input type="submit" value="Home">  
		</form>
				
	
		';

	


?>
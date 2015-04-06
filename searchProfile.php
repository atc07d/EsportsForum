<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>eSports Q&A Site</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="offcanvas.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/js/ie-emulation-modes-warning.js"></script>
</html>

<?php
	error_reporting(0);
	session_start();
	include_once 'connect.php';
	$conn = new mysqli($servername, $username, $password, $dbname);
	$conn2 = new mysqli($servername, $username, $password, $dbname);
	

	
	if(isset($_GET["searchname"]))
	{
		$UN = $_GET['searchname'];
		//echo $_GET["searchname"];
		// Print name of user being searched for
		// STRONG HAS BEEN DEPRECATED
		$sql2 = "SELECT user_score
				FROM users u
				WHERE WHERE u.user_name = '$UN' ";

		$result2 = $conn2->query($sql2);

		$row2 = mysqli_fetch_array($result2,MYSQLI_NUM);
		echo $row2[0];

		echo  '<br></><strong>Profile for: </strong><mark>' . $_GET['searchname'] . '</mark><br></br>' ;
		// Show avatar
		echo  '<br></><strong>Avatar: </strong>Placeholder<br></br>' ;
		// Show score
		echo  '<br></><strong>Score: </strong>' . $row2[0] . '<br></br>' ;

		
		
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

	
$conn->close();

?>
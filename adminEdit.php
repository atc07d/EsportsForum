<!DOCTYPE html>
<html lang="en">
<!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="offcanvas.css" rel="stylesheet">


</html>
<?php
	// Takes input from radio button on admin profile
	// Presents correspondong question for admin to edit
	session_start();
	include_once 'connect.php';


	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$gotID = $_GET['qselect'];
	$sql = "SELECT q_id, q_content
			FROM question
			WHERE q_id = '$gotID'";

	if (isset($_GET['edit'])) 
	{
		
		if(isset($_GET['qselect']))
		{
			$result = $conn->query($sql);
			$row = mysqli_fetch_array($result,MYSQLI_NUM);
	
			echo '<div class="row">
				  <div class="col-md-4">
				  <form method="post" action="#" method="get">
				  <h3><u>Make Changes:</u></h3>
				  <textarea class="form-control" rows="3">';
			printf ("%s (%s)\n",$row[0],$row[1]); 
			echo '</textarea>
				  <input type="submit" name="submit"	value="Submit" />
				  </form>
				  </div>
				  </div>';

		}
	}
	else if (isset($_GET['delete'])) 
	{
		
		if(isset($_GET['qselect']))
		{
		echo "<span>You have selected :<b> ".$_POST['qselect']."</b></span>";
		}
		else
		{ 
			echo "<span>Please choose any radio button.</span>";	
		}
	}
	else
	{

	}


	echo '<br></br>
		<br></br>
		<form action=profile.php>
			<input type="submit" value="Back">  
		</form>
				
	
		';

?>
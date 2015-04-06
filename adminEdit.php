<!DOCTYPE html>
<html lang="en">
<!-- Bootstrap core CSS 
	This is just a test-->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="offcanvas.css" rel="stylesheet">


</html>
<?php
	// Takes input from radio button on admin profile
	// Edit/delete logic for admin profile
	session_start();
	include_once 'connect.php';


	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	
	$gotID = $_GET['qselect'];
	$_SESSION['qselect'] = $_GET['qselect'];
	//echo $_SESSION['qselect'];

	$sql = "SELECT q_id, q_content, q_title
			FROM question
			WHERE q_id = '$gotID'";
	
	$sql2 = "DELETE FROM question
			 WHERE q_id = '$gotID'"; 
	
	

	if (isset($_GET['edit'])) 
	{
		
		if (isset($_GET['qselect']))
		{
			//echo $_GET['qselect'];
			$result = $conn->query($sql);
			$row = mysqli_fetch_array($result,MYSQLI_NUM);
	
			echo '<div class="row">
				  <div class="col-md-4">
				  <form  action="makeEdit.php" method="get" >
				  <h3><u>Edit</u>:<mark> ' . $row[2] . '</mark></h3>
				  <textarea class="form-control" rows="3" name="edcontent">';
			//printf ("%s (%s)\n",$row[0],$row[1]); 
			echo $row[1];
			echo '</textarea>
				  <input type="submit" name="subedit"	value="Submit" />
				  </form>
				  </div>
				  </div>';
		}


			

	}
	else if (isset($_GET['delete'])) 
	{
		
		if (isset($_GET['qselect']))
		{
			// delete question
			$result = $conn->query($sql2);
			echo "Deleted sucessfully!";

		}	
		
	}
	else
	{
		echo 'Make a selection before choosing an action!';
	}


	echo '<br></br>
		<br></br>
		<form action=profile.php>
			<input type="submit" value="Back">  
		</form>
				
	
		';
$conn->close();
?>
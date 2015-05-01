<?php
	//submitAnswer.php is linked to from conversation.php
	//and serves to connect to the DB and insert the answer and its details
	//into the relevant database.
	
	//error_reporting(0);
	echo '<link href="/css/bootstrap.min.css" rel="stylesheet">';
	session_start();

	include_once 'connect.php';
	
	$questionID=$_GET['askerID']; 
	$aRating = 0;         
    // Was using POST ID from answer form for a_id
    //$aID = intval($_POST['id']);
    $aID = $_SESSION['questionNum'];
					
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql = "INSERT INTO answer (a_id,a_asker,  a_content, a_rating)
			VALUES ('$aID','$_SESSION[username]',  '$_POST[answer]','$aRating')";
					
	if (isset($_POST['submit']))
	{
		
		
		

		
		if ($conn->query($sql) === TRUE) 
			{
				
				//echo "New answer created successfully";
				header("Location: index.php");
				
			} 
		else 
			{
				echo "Error: " . $sql . "<br>" . $conn1->error;
			}			
					 
					 

  
    
	}

	mysqli_close($conn);
	//unset($_SESSION['questionNum']);
?>
<!DOCTYPE html>
<html>
  <p><strong>Upload blob below:</strong></p>

    <form enctype="multipart/form-data" action="" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="30000">
          
      <input name="mkfile" type="file">
        <input type="submit" value="Upload">
    </form>


</html>

<?php
	
	session_start();
	include_once 'connect.php';


	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	


		
			
			echo 'jere';
			$img = file_get_contents($_POST['mkfile']);


			$sql = "INSERT into users (user_avatar)
			SET user_avatar = '$img'
			WHERE user_name = " . $_SESSION['username'];
		

		
		if ($conn->query($sql) === TRUE) 
			{
				
				echo "New avatar uploaded successfully";
				//header("Location: index.php");
				
			} 
		else 
			{
				echo "Error: " . $sql . "<br>" . $conn1->error;
			}			
					 
					 

  
    




?>

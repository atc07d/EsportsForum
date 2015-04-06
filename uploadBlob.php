<!DOCTYPE html>
<html>
  <p><strong>Upload blob below:</strong></p>

    <form enctype="multipart/form-data"  method="post">
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

	
if(count($_FILES) > 0) 
{
	if(is_uploaded_file($_FILES['mkfile']['tmp_name'])) 
	{

		$UNF = $_SESSION['username'];
		echo $_SESSION['username'];
		$imgData = addslashes(file_get_contents($_FILES['mkfile']['tmp_name']));
		$imageProperties = getimageSize($_FILES['mkfile']['tmp_name']);
		//$sql = "INSERT INTO users(user_avatar)
		//		VALUES('$imgData')
		//		WHERE user_name = '$UNF'";
		//$result = $conn->query($sql) 

		$sql = "UPDATE users
				SET user_avatar = '$imgData'
				WHERE user_name = '$UNF'";
		if($conn->query($sql) === TRUE) 
		{
			//echo 'success';
			header("Location: index.php");
		}
		else
		{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
}







echo '	<br></br>
		<form action=index.php>
		<input type="submit" value="Home">
		</form>
		';















		
			
		/*	echo 'jere';
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
					 
					 
	
	*/  
    




?>

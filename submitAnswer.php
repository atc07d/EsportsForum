<?php

echo '<link href="/css/bootstrap.min.css" rel="stylesheet">';
	session_start();

	$servername = "localhost";
	$username = "admin";
	$password = "5pR1nG2OlS";
	$dbname = "messageboard";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	//$sql = "SELECT username, password FROM main";
	//$result = $conn->query($sql);
	
	



         
    echo '<form method="post" action="question.php" method="post">
         <br>Content: <textarea class="form-control" rows="3" name="content" /></textarea>
         <input type="submit" name="submit"	value="Submit" />
		 </form>';
					
				
				 
				 

  
    

?>
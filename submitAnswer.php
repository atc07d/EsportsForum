<?php
	//submitAnswer.php is linked to from conversation.php
	//and serves to connect to the DB and insert the answer and its details
	//into the relevant database.
	
error_reporting(0);
echo '<link href="/css/bootstrap.min.css" rel="stylesheet">';
	session_start();

	$servername = "localhost";
	$username = "admin";
	$password = "5pR1nG2OlS";
	$dbname = "messageboard";
	
	$questionID=$_GET['askerID']; 
	//Other characters are getting passed through url. Need to strip out all types except ints to place into a_id
	//static $onlyINT ;
	$onlyINT= intval(preg_replace('/[^0-9]+/', '', $questionID), 10);
	//echo $onlyINT;
	//$questionAsker=$_GET["$asker"];
	//$questionTitle=$_GET["$qTitle"];
	//$questionType=$_GET["qType"];
	$aRating=1;



	

	

         
    echo '<form method="post" action="?" method="post">
         <br>Answer: <textarea class="form-control" rows="3" name="answer" /></textarea>
         <input type="submit" name="submit"	value="Submit" />
		 </form>';
					
		
	if (isset($_POST['submit']))
	{
		
		//echo $onlyINT;
		$conn = new mysqli($servername, $username, $password, $dbname);
				$sql = "INSERT INTO answer (a_id,a_asker, a_content, a_rating)
						VALUES ('$onlyINT','$_SESSION[username]', '$_POST[answer]','$aRating')";

		if ($conn->query($sql) === TRUE) 
			{
				echo "New answer created successfully";
			} 
		else 
			{
				echo "Error: " . $sql . "<br>" . $conn1->error;
			}			
					 
					 

  
    
	}
?>
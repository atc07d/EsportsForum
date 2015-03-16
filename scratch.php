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
	//$onlyINT= intval(preg_replace('/[^0-9]+/', '', $questionID), 10);
	$questionINT = (int) $questionID;
	$_SESSION['varID'] = $_GET['askerID'];
	$QID = (int) $_SESSION['varID'];
	echo $_SESSION['varID'];
	//$questSESH = 
	//echo $onlyINT;
	//$questionAsker=$_GET["$asker"];
	//$questionTitle=$_GET["$qTitle"];
	//$questionType=$_GET["qType"];
	$aRating=$questionINT;
	//echo $_GET['askerID'];
	//$aTopic=$_GET['askerID'];
	//echo 'Please input question ID along with answer. Q ID is ' . $questionID . '<br>';
	echo gettype($questionINT) . '<br>';
	echo gettype($questionID);
	echo gettype($_SESSION['varID']) . '<br>';
	echo gettype($QID);
	
	

	

         
    echo '<form method="post" action="?" method="post">
         <br>Answer: <textarea class="form-control" rows="3" name="answer" /></textarea>
         <input type="submit" name="submit"	value="Submit" />
		 
		 </form>';
					
	$conn = new mysqli($servername, $username, $password, $dbname);
		$sql = "INSERT INTO answer (a_id,a_asker,  a_content, a_rating)
				VALUES ('$QID','$_SESSION[username]',  '$_POST[answer]','$aRating')";
					
	
	if (isset($_POST['submit']))
	{
		
		
		//$conn = new mysqli($servername, $username, $password, $dbname);
				//$sql = "INSERT INTO answer (a_id,a_asker, a_content, a_rating)
						//VALUES ('$onlyINT','$_SESSION[username]', '$_POST[answer]','$aRating')";

		
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


if ($result2 = mysqli_query($conn1,$sql2))
	{
		//while($row = $result2->fetch_assoc($))
		while($row = mysqli_fetch_assoc($result2))
		{
			$flag = 0;
			if ($questionID == $row['q_id'] )
			{
				echo '<div class="panel panel-default">
							  <div class="panel-heading"><button type="button"><strong>Vote ^  </strong></button><br>
							  <button type="button"><strong>Vote v  </strong></button><br>
							  <strong>Rating: </strong>'.$row['a_rating']. '<br><strong>Responder:  </strong>' .$row['a_asker'].'</div>
							  <div class="panel-body">
								'.$row['a_content'].'
							  </div>
							</div>
									';
				$flag = 1;
			}
			//elseif ($flag == 0)
			//{
				//echo "No answers posted yet";
				//break;
			//}
		}
	mysqli_free_result($result2);
	}
	mysqli_close($conn1);
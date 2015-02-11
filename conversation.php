<?php


	echo ' <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="offcanvas.css" rel="stylesheet"> ';
	
	$servername = "localhost";
	$username = "admin";
	$password = "5pR1nG2OlS";
	$dbname = "messageboard";
	
	$questionID = $_GET['var'];
	//$answerID = '';
	$questionAsker='';
	$questionTitle='';
	$questionType='';
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	//Grab selected question. Var is sent via url
	$sql = "SELECT q_id,q_asker,q_title, q_content,q_type  FROM question";
	
	//Grab related answers
	//$sql = "SELECT a_id,a_asker,a_title, a_content,a_type  FROM answer";
	$result = $conn->query($sql);

	//Find question in DB to post content
	while($row = $result->fetch_assoc())
	{
		
		
		if ($row['q_id'] === $questionID)
		{
			echo '<div class="panel panel-default">
					  <div class="panel-heading"><strong>Title:  </strong>'.$row['q_title']. '<br><strong>Asker:  </strong>' .$row['q_asker'].'</div>
					  <div class="panel-body">
						'.$row['q_content'].'
					  </div>
					</div>
							';
			$questionAsker=$row['q_asker'];
			$questionTitle=$row['q_title'];
			$questionType=$row['q_type'];
			
			
		}
			
		
	}
	
	//echo $questionAsker;
	//echo '<a class="btn btn-default" href="submitAnswer.php?askerID=' . $questionID . '&asker=' . $questionAsker .' role="button">Answer</a>';
	echo '<a class="btn btn-default" href="submitAnswer.php?askerID=' . $questionID . ' role="button">Answer</a>';
	
	
	$conn1 = new mysqli($servername, $username, $password, $dbname);
	$sql1 = "SELECT * FROM answer";
	
	$result1 = $conn1->query($sql1);
	while($row = $result1->fetch_assoc())
	{
		echo '<div class="panel panel-default">
					  <div class="panel-heading"><button type="button"><strong>Rate +1  </strong></button><br><strong>Rating: </strong>'.$row['a_id']. '<br><strong>Responder:  </strong>' .$row['a_asker'].'</div>
					  <div class="panel-body">
						'.$row['a_content'].'
					  </div>
					</div>
							';
		
	}
	
	
	
?>
<!DOCTYPE html>
<html>
<head>
  <script src="/js/jquery-1.11.2.min.js"></script>
 
	<script>

	/*global $:false */
	function asyncPlus(){
	  $.ajax({
		  url: "updatePlus.php",
		  data: {action: change},
		  success: function(response){
			$("#myText").html(response);
		  },
		  error: function(err) {
			console.log("Error");
			console.log(err);
		  }
	  });
	}
	function asyncMinus(){
	  $.ajax({
		  url: "updateMinus.php",
		  data: {action: change},
		  success: function(response){
			$("#myText").html(response);
		  },
		  error: function(err) {
			console.log("Error");
			console.log(err);
		  }
	  });
	}



	$(document).ready(function(){
	  $("#id").ready(function(){asynchronouslyUpdate("get");});
	  
	  
	});

	</script>
</head>
</html>

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
					  <div class="panel-heading"><strong>Title:  </strong>'.$row['q_title']. '<br><strong>Asker:  </strong>' .$row['q_asker'].
					  '<br><strong>Q ID:  </strong>' .$row['q_id'].'</div>
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
	//echo $questionID;
	//echo $questionAsker;
	//echo '<a class="btn btn-default" href="submitAnswer.php?askerID=' . $questionID . '&asker=' . $questionAsker .' role="button">Answer</a>';
	//echo '<a class="btn btn-default" href="submitAnswer.php?askerID=' . $questionID . ' role="button">Answer</a>';
	//echo '<a class="btn btn-default" href="submitAnswer.php?askerID=' . $questionID . '">Answer</a>';
	echo '<form method="post" action="submitAnswer.php" method="post">
         <br>Answer: <textarea class="form-control" rows="3" name="answer" /></textarea>
        
		 <br>Q ID: <textarea class="form-control" rows="1" cols="10" name="id" /></textarea>
		 <input type="submit" name="submit"	value="Submit" />
		 </form>';
	
	echo '<strong> Answers: </>';
	$conn1 = new mysqli($servername, $username, $password, $dbname);
	//$sql1 = "SELECT * FROM answer";
	$sql2 = "SELECT * 
			FROM question
			JOIN answer
			ON question.q_id = answer.a_id";
	
	//$result1 = $conn1->query($sql1);
	//$result2 = $conn1->query($sql2);
	//echo '<script type="text/javascript">
			//function castVote(vote){
				//if (vote == "up")
				//{
					//'$sql3 = "UPDATE answer 
							 // SET a_rating = a_rating + 1
							 // WHERE a_order = '
							//  ";
					//$conn3->query($sql3);
				 // '
				//}
				//else if (vote == "down")
				
				
			//}
	
	
	
		//</script>';
		

	
	if ($result2 = mysqli_query($conn1,$sql2))
	{
		//while($row = $result2->fetch_assoc($))
		while($row = mysqli_fetch_assoc($result2))
		{
			$flag = 0;
			if ($questionID == $row['q_id'] )
			{
				echo '<form method="post" action=""
							<div class="panel panel-default">
							  <div class="panel-heading"><button onclick="asyncPlus();"><strong>+1  </strong></button><br>
							  <button onclick="asyncMinus();"><strong>-1  </strong></button><br>
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
?>
	

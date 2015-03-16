<!DOCTYPE>
<html>
	<!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="offcanvas.css" rel="stylesheet">

	<title> New conversation page in HTML </title>
	<head> 
		<script src="/js/jquery-1.11.2.min.js"></script>
		<script>
			function asynchronouslyUpdate(change){
			  $.ajax({
				  url: "updateValue.php",
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


	<body>
	<div>
			<?php
				//Retrieve and display question from DB
				include_once "connect.php";
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
				$sql = "SELECT *  FROM question";
				
				//Grab related answers
				//$sql = "SELECT a_id,a_asker,a_title, a_content,a_type  FROM answer";
				$result = $conn->query($sql);

				//Exit php to call sync script to rate question
				?> 
				<!--
				<h6>Rate Question: </h6>
				<p id="myText">Processing...</p>
				<button onclick="asynchronouslyUpdate('increment');">+</button>
				<button onclick="asynchronouslyUpdate('decrement');">-</button>
				<br />
				-->
			<?php
				//Find question in DB to post content
				while($row = $result->fetch_assoc())
				{
					
					
					if ($row['q_id'] === $questionID)
					{
						echo '<div class="panel panel-default">
								  <div class="panel-heading"><strong>Title:  </strong>'.$row['q_title']. '<br><strong>Asker:  </strong>' .$row['q_asker'].
								  '<br><strong>ID: </strong>' .$row['q_id'].'
								  	<br><strong>Rating: </strong>' .$row['q_value'].'
								  </div>
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

			?>
	</div>

	<div>
		<form method="post" action="submitAnswer.php" method="post">
         <br>Answer: <textarea class="form-control" rows="3" name="answer" /></textarea>
        
		 <br>Q ID: <textarea class="form-control" rows="1" cols="10" name="id" /></textarea>
		 <input type="submit" name="submit"	value="Submit" />
		 </form>
	
		

	</div>

	<div>
		<?php
			session_start();
			$conn1 = new mysqli($servername, $username, $password, $dbname);
			//$sql1 = "SELECT * FROM answer";
			$sql2 = "SELECT * 
					FROM question
					JOIN answer
					ON question.q_id = answer.a_id";
			
			
				

			
			if ($result2 = mysqli_query($conn1,$sql2))
			{
				while($row = mysqli_fetch_assoc($result2))
				{
					$flag = 0;
					if ($questionID == $row['q_id'] )
					{
						
						$_SESSION['answer_ID'] = $row['a_order'];
						//echo $_SESSION['answer_ID'];
						?>
						
						
						
						<form method="post" action=""
							<div class="panel panel-default">
							<div class="panel-heading">
							<h6><b>Rate Answer: </b></h6>
							<p id="myText"></p>
							<button name="up" onclick="asynchronouslyUpdate('increment');">+</button>
							<button name="down" onclick="asynchronouslyUpdate('decrement');">-</button>
							<br />
							
							<?php
							
							echo ' <strong>Rating: </strong>'.$row['a_rating']. '<br><strong>Responder:  </strong>' .$row['a_asker'].'
									 </div>
									 <div class="panel-body">
										'.$row['a_content'].'
									 </div>
									</div>
								</form>
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
			echo '
					<form action=index.php>
						<input type="submit" value="Go Home">
					</form>
				
	
					';

		?>

	</div>


</html>
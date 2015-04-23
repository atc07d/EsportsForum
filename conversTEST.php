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
				// Show question
				session_start();
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
				if ($conn->connect_error ) {
					die("Connection failed: " . $conn->connect_error);
				} 


				//$sql = "SELECT *  FROM question";
				$sql = "SELECT *
				FROM users u
                LEFT JOIN question q
                ON u.user_name = q.q_asker";
				
				
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

				//echo '<img src="data:image/jpeg;base64,'.base64_encode( $row05['user_avatar'] ).'" width="42" height="42"/>';
				while($row = $result->fetch_assoc())
				{
					
					
					if ($row['q_id'] === $questionID)
					{
						echo '<div class="row">
								<div class="col-md-4">
								<div class="panel panel-primary">
								  <div class="panel-heading"><strong>Title:  </strong>'.$row['q_title']. '<strong>Tags:  </strong>'.$row['q_tags']. '<br>
								  <strong>Asker:  </strong>' .$row['q_asker'].
								  '<br><img src="data:image/jpeg;base64,'.base64_encode( $row['user_avatar'] ).'" width="42" height="42"/>' .
								  '<br><strong>ID: </strong>' .$row['q_id'].'
								  	<br><strong>Rating: </strong>' .$row['q_value'].'
								  </div>
								  <div class="panel-body">
									'.$row['q_content'].'
								  </div>
								</div>
							</div>
							</div>
										';
						$questionAsker=$row['q_asker'];
						$questionTitle=$row['q_title'];
						$questionType=$row['q_type'];
						
						if ($row['q_state'] == '1')
						{
							echo '<h1>FROZEN</h1>';
						}

						else if ($row['q_state'] == '0')
						{
							echo '  <div class="row">
								  	<div class="col-md-4">
										<form method="post" action="submitAnswer.php" method="post">
								         <br>Answer: <textarea class="form-control" rows="3" name="answer" /></textarea>
								        
										 <br>Q ID: <textarea class="form-control" rows="1" cols="10" name="id" /></textarea>
										 <input type="submit" name="submit"	value="Submit" />
										 </form>
									</div>
									</div>';

						}

					}
						
					
				}

			?>
	</div>

	

	<div>
		<?php
			// Show answers
			
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
							//?>
							
							
							<div class="row">
	  						<div class="col-md-4">
							<form method="post" action=""
								<div class="panel panel-warning">
								<div class="panel-heading">
								
								<p id="myText"></p>
								<button class="btn btn-primary" name="up" onclick="asynchronouslyUpdate('increment');">+</button>
								<button class="btn btn-primary" name="down" onclick="asynchronouslyUpdate('decrement');">-</button>
								<br />
								
						

								
								<?php
								//<img src="data:image/jpeg;base64,'.base64_encode( $row['user_avatar'] ).'" width="42" height="42"/>
								echo ' <strong>Rating: </strong>'.$row['a_rating']. 
										'<br><strong>Responder:  </strong>' .$row['a_asker'].'
										 </div>
										 <div class="panel-body">
											'.$row['a_content'].'
										</div>
									</form>
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
			echo '	<br></br>
					<form action=index.php>
						<input type="submit" value="Home">
					</form>
				
	
					';


		?>




</html>
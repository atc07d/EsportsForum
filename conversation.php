<!DOCTYPE>
<html>
<head> 
		<link href="css/testConvo.css" rel="stylesheet">
	 	<link href="/css/bootstrap.min.css" rel="stylesheet">

		 <title>http://bootsnipp.com/snippets/featured/google-plus-styled-post</title>



	  <nav class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          
        </div>
        
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
			      <li><a href="profile.php">Profile Page</a></li>
            <li><a href="logForm.php">Login/Register</a></li>  
            <li><a href="uploadBlob.php">Avatar</a></li>
            <li><a href="tagDisplay.php">Archive</a></li>            
			
          </ul>
        </div>
      </div>
    </nav>
</head>
<body>
	<div class="container">
	  <div class="row">
	    <div class="col-md-8">

<br>
<br>
<br>
	<div>
			<?php
				// Show question
				session_start();
				error_reporting(0);
				//Retrieve and display question from DB
				include_once "connect.php";
				include_once 'getAvatar.php';
				$questionID = $_GET['var'];
				$_SESSION['questionNum'] = $questionID;

				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
			
				// Check connection
				if ($conn->connect_error ) {
					die("Connection failed: " . $conn->connect_error);
				} 

				$sql = "SELECT *
				FROM users u
                LEFT JOIN question q
                ON u.user_name = q.q_asker";
				
				$result = $conn->query($sql);

				while($row = $result->fetch_assoc())
				{
					
					
					if ($row['q_id'] == $questionID && isset($_SESSION['logged_in']) &&  $_SESSION['valid'] == 1)
					{
						echo '<!-- Question -->
						 	<h2 class="page-header">'.$row['q_title'].'</h2>
	      					<section class="comment-list">
						          <article class="row">
						            <div class="col-md-2 col-sm-2 hidden-xs">
						              <figure class="thumbnail">
						                '. get_avatar($row['q_asker'],$_SESSION['github'],0).'
						                <figcaption class="text-center">'.$row['q_asker'].'</figcaption>
						              </figure>
						            </div>
						            <div class="col-md-10 col-sm-10">
						              <div class="panel panel-default arrow left">
						                <div class="panel-body">
						                  <header class="text-left">
						                    <div class="comment-user"><i class="fa fa-usd"> </i> '.$row['q_value'].'</div>
						                    <div class="comment-tags"><i class="fa fa-tags"></i> '.$row['q_tags'].'</div>
						                    <div>
							                    <form method="post" action="voteQuestion.php">
							                    	<i class="fa fa-chevron-circle-up fa-2x"></i><input type="submit" name="up" value="$">
							                    	<input type="hidden" name="id" value="'.$questionID . '">
							                    </form>
							                 </div>
							                 <div>					
							                    <form method="post" action="voteQuestion.php">
							                    	<i class="fa fa-chevron-circle-down fa-2x"></i><input type="submit" name="down" value="$">
							                    	<input type="hidden" name="id" value="'.$questionID . '">
							                    </form>
							                 </div>
						                  </header>
						                  <div class="comment-post">
						                    <p>'. $row['q_content'] .'</p>
						                  </div>
						                  
						                </div>
						              </div>
						            </div>
						          </article>
					          </section>
					         

										';

						
						if ($row['q_state'] == '1')
						{
							echo '<div class="row">
								 	<div class="col-md-4 col-md-offset-2">
										<h1>FROZEN</h1>
									</div>
								  </div>';
						}

						else if ($row['q_state'] == '0' && isset($_SESSION['logged_in']))
						{
							echo '  <article class="row">
						            <div class="col-md-10 col-sm-10">
						              <div class="panel panel-default ">
										<form method="post" action="submitAnswer.php" method="post">
								         <br><textarea class="form-control" rows="3" name="answer" /></textarea>
								         <input type="submit" name="submit"	value="Submit" />
										 </form>
						              </div>
						            </div>
						          </article>
						          ';

						}

					}

					elseif ($row['q_id'] == $questionID &&  ($_SESSION['valid'] != 1 || !isset($_SESSION['logged_in'])))
					{
						echo '<!-- Question -->
						 	<h2 class="page-header">'.$row['q_title'].'</h2>
	      					<section class="comment-list">
						          <article class="row">
						            <div class="col-md-2 col-sm-2 hidden-xs">
						              <figure class="thumbnail">
						                '. get_avatar($row['q_asker'],$_SESSION['github'],0).'
						                <figcaption class="text-center">'.$row['q_asker'].'</figcaption>
						              </figure>
						            </div>
						            <div class="col-md-10 col-sm-10">
						              <div class="panel panel-default arrow left">
						                <div class="panel-body">
						                  <header class="text-left">
						                    <div class="comment-user"><i class="fa fa-usd"> </i> '.$row['q_value'].'</div>
						                    <div class="comment-tags"><i class="fa fa-tags"></i> '.$row['q_tags'].'</div>
						                  </header>
						                  <div class="comment-post">
						                    <p>'. $row['q_content'] .'</p>
						                  </div>
						                  
						                </div>
						              </div>
						            </div>
						          </article>
					          </section>
					         

										';

						
						if ($row['q_state'] == '1')
						{
							echo '<div class="row">
								 	<div class="col-md-4 col-md-offset-2">
										<h1>FROZEN</h1>
									</div>
								  </div>';
						}

						else if ($row['q_state'] == '0' && isset($_SESSION['logged_in']) &&  $_SESSION['valid'] == 1)
						{
							echo '  <article class="row">
						            <div class="col-md-10 col-sm-10">
						              <div class="panel panel-default ">
										<form method="post" action="submitAnswer.php" method="post">
								         <br><textarea class="form-control" rows="3" name="answer" /></textarea>
								         <input type="submit" name="submit"	value="Submit" >
								         <input type="hidden" name="id" value="'.$_SESSION['questionNum']. '">
										 </form>
						              </div>
						            </div>
						          </article>
						          ';

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
					ON question.q_id = answer.a_id
					WHERE question.q_id = '$questionID'
					ORDER BY a_best DESC, a_rating DESC";	

			
			if ($result2 = mysqli_query($conn1,$sql2))
			{
				//$_SESSION['answer_ID'] = array();
				while($row = mysqli_fetch_assoc($result2))
				{
					//$questionID == $row['q_id'] &&
					if ($_SESSION['username'] == $row['q_asker'] && isset($_SESSION['logged_in'])  && $_SESSION['valid'] == 1)
					{
							
							echo '<section class="comment-list">
									<article class="row">
							            <div class="col-md-10 col-sm-10">
							              <div class="panel panel-default arrow right">
							                <div class="panel-body">
							                  <header class="text-right">
							                     <i class="fa fa-usd"></i> '.$row['a_rating']. '
							                    <br>
							                    <div>
							                    <form method="post" action="voteTest.php">
							                    	<i class="fa fa-chevron-circle-up fa-2x"></i><input type="submit" name="up" value="$">
							                    	<input type="hidden" name="id" value="'.$row['a_order']. '">
							                    </form>
							                    </div>
							                    <div>					
							                    <form method="post" action="voteTest.php">
							                    	<i class="fa fa-chevron-circle-down fa-2x"></i><input type="submit" name="down" value="$">
							                    	<input type="hidden" name="id" value="'.$row['a_order']. '">
							                    </form>
							                    </div>
							                    <div>
							                    <form method="post" action="submitBest.php">
							                    	<i class="fa fa-trophy fa-2x"></i><input type="submit" name="select" value="#">
							                    	<input type="hidden" name="id" value="'.$row['a_order']. '">
							                    	<input type="hidden" name="best" value="'.$row['a_best']. '">
							                    </form>
							                    </div>
							                  </header>
							                  <div class="comment-post">
							                    <p>'. $row['a_content'] .'</p>
							                  </div>
							                  
							                 ';
							
								echo '	
							                 
							                </div>
							              </div>
							            </div>
							            <div class="col-md-2 col-sm-2 hidden-xs">
							              <figure class="thumbnail">
							                '. get_avatar($row['a_asker'],$_SESSION['github'],0).'
							                <figcaption class="text-center">'.$row['a_asker'].'</figcaption>
							              </figure>
							            </div>
							          </article>
						          	</section>
									  ';
							


					}

					else if ($_SESSION['username'] != $row['q_asker'] && isset($_SESSION['logged_in'])  && $_SESSION['valid'] == 1)
					{
						
					
							echo '<section class="comment-list">
									<article class="row">
							            <div class="col-md-10 col-sm-10">
							              <div class="panel panel-default arrow right">
							                <div class="panel-body">
							                  <header class="text-right">
							                     <i class="fa fa-usd"></i> '.$row['a_rating']. '
							                    <br>
												<div>
							                    <form method="post" action="voteTest.php">
							                    	<i class="fa fa-chevron-circle-up fa-2x"></i><input type="submit" name="up" value="$">
							                    	<input type="hidden" name="id" value="'.$row['a_order']. '">
							                    </form>
							                    </div>
							                    <div>					
							                    <form method="post" action="voteTest.php">
							                    	<i class="fa fa-chevron-circle-down fa-2x"></i><input type="submit" name="down" value="$">
							                    	<input type="hidden" name="id" value="'.$row['a_order']. '">
							                    </form>
							                    </div>
							                  </header>
							                  <div class="comment-post">
							                    <p>'. $row['a_content'] .'</p>
							                  </div>
							                  
							                 ';
							
								echo '	
							                 
							                </div>
							              </div>
							            </div>
							            <div class="col-md-2 col-sm-2 hidden-xs">
							              <figure class="thumbnail">
							                '. get_avatar($row['a_asker'],$_SESSION['github'],0).'
							                <figcaption class="text-center">'.$row['a_asker'].'</figcaption>
							              </figure>
							            </div>
							          </article>
						          	</section>
									  ';
							


					}
					//$questionID == $row['q_id'] &&
					else if ($_SESSION['username'] != $row['q_asker'] && !isset($_SESSION['logged_in']) && $_SESSION['valid'] != 1)
					{
						echo '<section class="comment-list">
									<article class="row">
							            <div class="col-md-10 col-sm-10">
							              <div class="panel panel-default arrow right">
							                <div class="panel-body">
							                  <header class="text-right">
							                     <i class="fa fa-usd"></i> '.$row['a_rating']. '
							                    <br>
							                    
							                  </header>
							                  <div class="comment-post">
							                    <p>'. $row['a_content'] .'</p>
							                  </div>
							                  
							                 ';
							
								echo '	
							                 
							                </div>
							              </div>
							            </div>
							            <div class="col-md-2 col-sm-2 hidden-xs">
							              <figure class="thumbnail">
							                '. get_avatar($row['a_asker'],$_SESSION['github'],0).'
							                <figcaption class="text-center">'.$row['a_asker'].'</figcaption>
							              </figure>
							            </div>
							          </article>
						          	</section>
									  ';
							


					}

					

				}
				mysqli_free_result($result2);

			}
			mysqli_close($conn1);
			
		

		?>
	</div>


		</div>
	</div>
</div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>eSports Type Display</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="offcanvas.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
      <br>
      <br>
  </body>

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

	
		$sql = "SELECT *
			FROM question";
	
	

	echo '<br>
		  <div class="col-md-4 col-md-offset-2" >
          <table class="table table-striped">
          <thead>
            <tr>
            
            <th>Title</th>
        
            <th>Asker</th>

            <th>Value</th>

            <th>Tags</th>
            
            </tr>
          </thead>
          <tbody>';


	if ($result = mysqli_query($conn,$sql))
	{
		while($row = mysqli_fetch_assoc($result))
		{
			 echo '<tr><td><a href="conversTEST.php?var=' . $row['q_id'] . '">' . $row['q_title'] . '</a></td><td>' . $row['q_asker'] . 
			 '</td><td>' . $row['q_value'] . '</td><td>' . 
			 '<a href="tagCollection.php?var='. $row['q_tags'] . '">' . $row['q_tags'] . '</a></td></tr>'; 

		}
	}
	echo '</tbody>
          </table>
          </div> ';





		$conn->close();
?>
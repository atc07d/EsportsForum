<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>eSports Tag Display</title>

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
            <li><a href="LogForm.php">Login/Register</a></li> 
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

	$tagvar = $_GET['var'];
	//echo $tagvar;
	$explodetags = explode(" ", $tagvar);
	$arcount = count($explodetags);

	//echo $explodetags;

	// Build like part of sql query
	// $x becomes each tag delimited by space 
	$buildq = "";
	$endexplode = end($explodetags);
	// Building for SQL LIKE, not as efficent as below ?????
	foreach ($explodetags as $x)
	{
		if ($arcount == "1")
		{
			$buildq = $buildq . "'%" . $x . "%'";
		}
		
		else
		{
			if ($x == $explodetags[0])
			{
			$buildq = $buildq . "'%" . $x . "%'";
			}
			
			else 
			{
				$buildq = $buildq . " OR q_tags LIKE '%" . $x . "%'";
			}
		}
		
	}
	

	/* easier to just use SQL IN
	foreach ($explodetags as $x)
	{
		if ($arcount == "1")
		{
			$buildq = "('" . $tagvar . "', '" . $x . "')";
		}
		
		else
		{
			if ($x == $explodetags[0])
			{
				$buildq = "('" . $tagvar . "', '" . $x . "', '";
			}
			else if ($x == $endexplode)
			{
				$buildq = $buildq . $x . "')";
			}
			else 
			{
				$buildq = $buildq . $x . "', '";
			}
		}
		
	}
	*/

	//echo $buildq;

	// easier to just use in?
	//$explodetags2 = explode(" ", string)


	$sql = "SELECT * 
			FROM question
			WHERE q_tags IN $buildq";

	$sql2 = "SELECT * 
		FROM question
		WHERE q_tags LIKE $buildq";
	
	echo '<br>
		  <div class="col-md-4 col-md-offset-2">
		  <h3><b>Tags:</b><p class="text-info">' . strtoupper($tagvar) . '</p></h3>
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


	if ($result = mysqli_query($conn,$sql2))
	{
		while($row = mysqli_fetch_assoc($result))
		{
			 echo '<tr><td><a href="conversTEST.php?var=' . $row['q_id'] . '">' . $row['q_title'] . '</a></td><td>' . $row['q_asker'] . '</td><td>' . $row['q_value'] . '</td><td>' . $row['q_tags'] . '</td</tr>'; 

		}
	}
	echo '</tbody>
          </table>
          </div> ';





		$conn->close();
?>
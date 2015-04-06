<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>eSports Q&A Site</title>

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
  </head>
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

	$typevar = $_GET['type'];
	if ($typevar == "all")
	{
		$sql = "SELECT *
			FROM question";
	}
	else
	{
		$sql = "SELECT *
			FROM question
			WHERE q_type = '$typevar'";

	}
	

	echo '<h3><b>Showing:</b><mark>' . strtoupper($typevar) . '</mark></h3>
		  <div class="col-md-6">
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
			 echo '<tr><td><a href="conversTEST.php?var=' . $row['q_id'] . '">' . $row['q_title'] . '</a></td><td>' . $row['q_asker'] . '</td><td>' . $row['q_value'] . '</td><td>' . $row['q_tags'] . '</td</tr>'; 

		}
	}
	echo '</tbody>
          </table>
          </div> ';



	echo '	<br></br>
		<form action=index.php>
		<input type="submit" value="Home">
		</form>
		';

		$conn->close();
?>
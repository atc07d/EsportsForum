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
  <body>
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
            <li class="active"><a href="#">Home</a></li>
            <li><a href="profile.php">Profile Page</a></li>
            <li><a href="LogForm.php">Login/Register</a></li>  
            <li><a href="uploadBlob.php">Avatar</a></li>
            <li><a href="tagDisplay.php">Archive</a></li>             
            
          </ul>
        </div>
      </div>
    </nav>
    <br>
    <br>
      <br>
    <br>
    </body>
</html>
<?php 

	
	session_start();
    error_reporting(0);

    include_once "connect.php";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	//$sql = "SELECT username, password FROM main";
	//$result = $conn->query($sql);
	
	

if($_SESSION['logged_in'] == 0)
{
    //the user is not signed in
    echo '<div class="row">
          <div class="col-md-3 col-md-offset-3">
            <p>Sorry, you have to be <a href="index.php">Logged in</a> to submit a question.</p>
          </div>
          </div>';
}
else
{
    //the user is signed in

      
        //the form hasn't been posted yet, display it
        //retrieve the categories from the database for use in the dropdown
        $sql = "SELECT
                    t_id,
                    t_name,
                    t_description
                FROM
                    type";
         
        $result = $conn->query($sql);
		//echo "$result";
         
        if(!$result)
        {
            //the query failed
			echo $result;
            echo 'Error while selecting from database. Please try again later.';
			echo $result;
        }
        
        else
            {
         
                echo ' <div class="row">
                       <div class="col-md-3 col-md-offset-3">
                       <form class="form-horizontal" method="post" action="question.php" method="post">
                       <legend>Create Question</legend>
					   <br>Title: 
                       <br><input type="text" name="title" />
					   '; 
                 
               
                echo '  
                        </div>
                        </div>'; 
                     
                echo '<br>
                    <div class="row">
                        <div class="col-md-3 col-md-offset-3 ">
                        Content: <textarea class="form-control" rows="3" name="content" /></textarea>
                        Tags: <textarea class="form-control" rows="3" name="tagcontent" /></textarea>
                        <input type="submit" name="submit"	value="Submit" class="btn btn-primary"/>
    					</fieldset>
                        </form>
                        </div>
                    </div>';
				 
				 
			}
}   
   
/*
 echo '<select name="t_name">';
                   while($row = $result->fetch_assoc())
                    {
                        echo '<option value="' . $row['t_name'] . '">' . $row['t_name'] . '</option>';
                    }
*/
?>
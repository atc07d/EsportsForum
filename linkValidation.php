<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>eSports Q and A Site</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="offcanvas.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/js/ie-emulation-modes-warning.js"></script>
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
            <li><a href="logForm.php">Login/Register</a></li>  
            <li><a href="uploadBlob.php">Avatar</a></li>
            <li><a href="tagDisplay.php">Archive</a></li>            
			
          </ul>
        </div>
      </div>
    </nav>
  <br><br><br><br>

  <div class="row">
  <div class="col-md-3 col-md-offset-2">
    <form action="?" method="get" role="form" >
  <fieldset>
    <legend>Email Validation Link</legend>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Email</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" name="inputEmail" placeholder="Email">
      </div>
    </div>
    
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button name="submit" type="submit"  class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
  </div>
   
  </fieldset>
</form>


  </body>

</html>


<?php

  session_start();
  error_reporting(0);
  //ini_set('display_errors', 'On');
  include_once "connect.php";

  $gotEmail = $_GET['inputEmail'];
  echo $gotEmail;

  $sql = "UPDATE users
          SET user_valid = 1
          WHERE user_email ='$gotEmail'";


  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } 




if (isset($_GET["inputEmail"]) and $_GET['emadrs'] == $gotEmail)
  {

    echo "Sucessfully validated!"
    $result = $conn->query($sql);


  }


  /*
  if (isset($_POST["submit"]) and $_GET['emadrs'] == $_POST['inputEmail'])
  {

    echo $_POST['inputEmail'];
    //$result = $conn->query($sql);
    if ($conn->query($sql) === TRUE)
    {
      echo "Your account has been validated! Welcome";


    }
    else
    {
      echo "Email address incorrect. Please try again.";
    }


  }

*/


?>



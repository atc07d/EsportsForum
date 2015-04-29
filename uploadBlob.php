<!DOCTYPE html>
<html>
<head>
  <title>Upload Avatar</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="offcanvas.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/js/ie-emulation-modes-warning.js"></script>
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
    <br><br><br><br>


    </body>

</html>

<?php
	
	session_start();
	include_once 'connect.php';
  include_once 'getGravatar.php';
  include_once 'getAvatar.php';
  error_reporting(0);

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
  $conn1 = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error || $conn1->connect_error ) 
  {
		die("Connection failed: " . $conn->connect_error);
	} 



if (isset($_SESSION['username']) and $_SESSION['github'] != 1)
{

  echo '<div class="row">
        <div class="col-md-4 col-md-offset-2">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Upload avatar:</h3>
          </div>
          <div class="panel-body panel-primary"> 
            <form enctype="multipart/form-data"  method="post">
            <input type="hidden" name="MAX_FILE_SIZE" value="30000">
             
            <input name="mkfile" type="file">
            <input type="submit" value="Upload"> 
          </div>
          </form>
    </div>
    </div>
    </div>';

    $UNF = $_SESSION['username'];

  if(count($_FILES) > 0) 
  {
  	if(is_uploaded_file($_FILES['mkfile']['tmp_name'])) 
  	{

  		//$UNF = $_SESSION['username'];
  		//echo $_SESSION['username'];
  		$imgData = addslashes(file_get_contents($_FILES['mkfile']['tmp_name']));
  		$imageProperties = getimageSize($_FILES['mkfile']['tmp_name']);
  		//$sql = "INSERT INTO users(user_avatar)
  		//		VALUES('$imgData')
  		//		WHERE user_name = '$UNF'";
  		//$result = $conn->query($sql) 

  		$sql = "UPDATE users
  				SET user_avatar = '$imgData'
  				WHERE user_name = '$UNF'";
  		if($conn->query($sql) === TRUE) 
  		{
  			//echo 'success';
  			header("Location: index.php");
  		}
  		else
  		{
  			echo "<p>Error: " . $sql . $conn->error . "</p>";
  		}
  	}
  }

  


$tempURLs = get_avatar($UNF, $_SESSION['github']);


  echo '<div class="row">
          <div class="col-md-4 col-md-offset-2">
          <div class="panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title">Select default avatar:</h3>
            </div>
            <div class="panel-body panel-primary"> 
            '. $tempURLs .'
            </div>
      </div>
      </div>
      </div>';

  //mysqli_close($conn1);
}

elseif ($_SESSION['github'] == 1) 
{
  
  echo '<div class="row">
        <div class="col-md-2 col-md-offset-3">
        <p>Visit GitHub to change avatar</p>
        </div>
        </div>
        <br>  
        <br>';
}

else
{
  echo '
        <div class="row">
        <div class="col-md-2 col-md-offset-3">
        <a href="logForm.php">Please log in</a>
        </div>
        </div>
        <br>  
        <br>
    ';
}




?>

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
            <li><a href="uploadAvatar.php">Avatar</a></li>
            <li><a href="tagDisplay.php">Archive</a></li>            
      
          </ul>
        </div>
      </div>
    </nav>
    </head>

    <body>
    <br><br><br><br>

    <div class="row">
    <div class="col-md-4 col-md-offset-3">
    <p><strong>Upload Avatar below:</strong></p>
    
    <form enctype="multipart/form-data"  method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="30000">
          
      <input name="mkfile" type="file">
        <input type="submit" value="Upload">
    </form>
    </div>
    </div>

    </body>
</html>




<?php
      // Upload file + rename file to username saved in session to ID when displaying?
      // Eventually allow user to view all their avatars in dir and select one with checkbox
      // Use img src tag for showing img?
      // Check for existence of equivallently named file before uploading?
      session_start();

      $serverAdd = $_SERVER['SERVER_NAME'] .':'. $_SERVER['SERVER_PORT'] ;

      if($_FILES)
      {
        //$uploaddir = '/home/acoffman/public_html/cs418/uploads';
        $uploaddir = 'http://' . $serverAdd . '/uploads/ ';
        //$uploadfile = '';
        $uploadfile = $uploaddir . basename($_FILES['mkfile']['name']);
       // $uploadfile = $uploaddir . $_SESSION['username'] . basename($_FILES['mkfile']['name']);
        $uploadfile = str_replace(".php",".txt",$uploadfile); //prevent .php files from being uploaded
        // Remove spaces from filename to prevent %20 in front of filename
        $uploadfile = str_replace(" ", "", $uploadfile);
    
    

        if (!$_FILES['mkfile']['error'] && move_uploaded_file($_FILES['mkfile']['tmp_name'],$uploadfile)) 
        {
          echo "File is valid, and was successfully uploaded.\n";
          //chmod($uploadfile,0644);

        } 
        elseif($_FILES['mkfile']['error'])
        {
          echo "Error ".$_FILES['mkfile']['error']."<br />";
        } 
        else 
        {
          echo "Something is wrong<br></br>";
          echo $uploadfile;
          echo '<br></br>';
          echo $uploaddir;
        }

        //print_r($_FILES);
      }
      else 
      {

      }

      
?>
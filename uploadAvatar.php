<!DOCTYPE html>
<html>
  <p><strong>Upload Avatar below:</strong></p>

    <form enctype="multipart/form-data" action="" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="30000">
          
      <input name="mkfile" type="file">
        <input type="submit" value="Upload">
    </form>


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
        $uploadfile = $uploaddir . basename($_FILES['mkfile']['name']);
        $uploadfile = str_replace(".php",".txt",$uploadfile); //prevent .php files from being uploaded
        // Remove spaces from filename to prevent %20 in front of filename
        $uploadfile = str_replace(" ", "", $uploadfile);
        $uploadfile = (string)$_SESSION['username'] . $uploadfile;

        if (!$_FILES['mkfile']['error'] && move_uploaded_file($_FILES['mkfile']['tmp_name'],$uploadfile)) 
        {
          echo "File is valid, and was successfully uploaded.\n";
          chmod($uploadfile,0644);

        } 
        elseif($_FILES['mkfile']['error'])
        {
          echo "Error ".$_FILES['mkfile']['error']."<br />";
        } 
        else 
        {
          echo "Something is wrong";
          //echo $uploadfile;
          //echo $uploaddir;
        }

        //print_r($_FILES);
      }
      else 
      {

      }

      echo '<br></br>
            <form action=index.php>
              <input type="submit" value="Go Home">
            </form>
        
  
          ';

?>
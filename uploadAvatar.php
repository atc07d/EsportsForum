<?php

      if($_FILES)
      {
        $uploaddir = '/home/acoffman/public_html/cs418/uploads/';
        $uploadfile = $uploaddir . basename($_FILES['mkfile']['name']);
        $uploadfile = str_replace(".php",".txt",$uploadfile); //prevent .php files from being uploaded

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
          echo "Possible file upload attack!";
        }

        print_r($_FILES);
      }
      else 
      {

      }

?>
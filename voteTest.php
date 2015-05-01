<?php
  
	include_once "connect.php";
  session_start();
	
	//$UN = $_SESSION['username'];
  $url = "conversation.php?var=" . intval($_SESSION['questionNum']);
  
  $conn = new mysqli($servername, $username, $password, $dbname);
	$sql1 = "UPDATE answer
			 SET a_rating = a_rating + 1
       WHERE a_order = '$_POST[id]'";
	$sql2 = "UPDATE answer
			 SET a_rating = a_rating - 1
       WHERE a_order = '$_POST[id]'";

  $postId = $_POST['id'];
  //$_SESSION['vote'][$postId] = 0;

  //var_dump($_SESSION['vote'][$postId]);
  //echo $_SESSION['vote'][$postId] ;

  //echo $postID;

    if(isset($_POST['up']) && $_SESSION['vote'][$postId] != 1)
    {
      $conn->query($sql1);
      //echo $_POST['id'];
      $_SESSION['vote'][$postId] = 1;
      //echo $_SESSION['vote'][$postId];
     // echo 'hi';
      header("Location: $url");
    }

    if(isset($_POST['down']) && $_SESSION['vote'][$postId] != 1)
    {
      $conn->query($sql2);
      //echo $_POST['id'];
      $_SESSION['vote'][$postId] = 1;
       //echo $_SESSION['vote'][$postId];
      header("Location: $url");
    }

    else
    {
      header("Location: $url");
      //echo 'errir';
      //echo $_SESSION['vote'][$postId];
    }
    
    unset($_SESSION['questionNum']);
	  mysqli_close($conn);
    die();
  

?>


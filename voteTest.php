<?php
  
  include_once "connect.php";
  session_start();
	
  $url = "conversation.php?var=" . intval($_SESSION['questionNum']);
  
  $conn = new mysqli($servername, $username, $password, $dbname);
	$sql1 = "UPDATE answer
			 SET a_rating = a_rating + 1
       WHERE a_order = '$_POST[id]'";
	$sql2 = "UPDATE answer
			 SET a_rating = a_rating - 1
       WHERE a_order = '$_POST[id]'";

  $postId = $_POST['id'];

    if(isset($_POST['up']) && $_SESSION['vote'][$postId] != 1)
    {
      $conn->query($sql1);
      $_SESSION['vote'][$postId] = 1;
      header("Location: $url");
    }

    if(isset($_POST['down']) && $_SESSION['vote'][$postId] != 1)
    {
      $conn->query($sql2);
      $_SESSION['vote'][$postId] = 1;
      header("Location: $url");
    }

    else
    {
      header("Location: $url");
    }
    
    unset($_SESSION['questionNum']);
	  mysqli_close($conn);
    die();
  

?>


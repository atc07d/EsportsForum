<?php
  
  include_once "connect.php";
  session_start();
	

  $url = "conversation.php?var=" . intval($_SESSION['questionNum']);
  
  $conn = new mysqli($servername, $username, $password, $dbname);
	$sql1 = "UPDATE question
			 SET q_value = q_value + 1
       WHERE q_id = '$_POST[id]'";
	$sql2 = "UPDATE question
			 SET q_value = q_value - 1
       WHERE q_id = '$_POST[id]'";

  $postId = $_POST['id'];

    if(isset($_POST['up']) && $_SESSION['Qvote'][$postId] != 1)
    {
      $conn->query($sql1);
      $_SESSION['Qvote'][$postId] = 1;

      header("Location: $url");
    }

    if(isset($_POST['down']) && $_SESSION['Qvote'][$postId] != 1)
    {
      $conn->query($sql2);
      $_SESSION['Qvote'][$postId] = 1;

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


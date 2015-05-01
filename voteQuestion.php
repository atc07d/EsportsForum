<?php
  
	include_once "connect.php";
  session_start();
	
	//$UN = $_SESSION['username'];
  $url = "conversation.php?var=" . intval($_SESSION['questionNum']);
  
  $conn = new mysqli($servername, $username, $password, $dbname);
	$sql1 = "UPDATE question
			 SET q_value = q_value + 1
       WHERE q_id = '$_POST[id]'";
	$sql2 = "UPDATE question
			 SET q_value = q_value - 1
       WHERE q_id = '$_POST[id]'";


    if(isset($_POST['up']))
    {
      $conn->query($sql1);
      //echo $_POST['id'];
      header("Location: $url");
    }

    elseif(isset($_POST['down']))
    {
      $conn->query($sql2);
      //echo $_POST['id'];
      header("Location: $url");
    }
    
    unset($_SESSION['questionNum']);
	   mysqli_close($conn);
    die();
  

?>


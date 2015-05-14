<?php
  
  include_once "connect.php";
  session_start();
	
  $url = "conversation.php?var=" . intval($_SESSION['questionNum']);
  
  $conn = new mysqli($servername, $username, $password, $dbname);
	$sql1 = "UPDATE answer
			 SET a_best = 1
       WHERE a_order = '$_POST[id]'";


  $postId = $_POST['best'];


    if(isset($_POST['select']) && $_SESSION['vote'][$postId] != 1)
    {
      $conn->query($sql1);
      header("Location: $url");
    }

    
    unset($_SESSION['questionNum']);
	  mysqli_close($conn);
    die();
  

?>


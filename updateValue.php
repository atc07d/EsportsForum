
<?php
  session_start();
	include_once "connect.php";

  /*$intOrder = intval($_SESSION['answer_ID']);

  //echo $intOrder;
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql1 = " UPDATE answer
			      SET a_rating = a_rating +  1
			      WHERE a_order = $intOrder";
	$sql2 = " UPDATE answer
			      SET a_rating = a_rating - 1
           WHERE a_order = $intOrder";
  */

  
  if($_GET['action'] == "increment")
  {
    $intOrder = intval($_SESSION['answer_ID']);
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql1 = " UPDATE answer
              SET a_rating = a_rating +  1
              WHERE a_order = $intOrder";


    if ($conn->query($sql1) === TRUE) 
    {
      echo "Vote Cast";
    } 
    else 
    {
        echo "Error: " . $sql1 . "<br>" . $conn->error;
    }

    unset($_SESSION['answer_ID']);
  }



  elseif($_GET['action'] == "decrement") 
  {
    $intOrder = intval($_SESSION['answer_ID']);
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql2 = " UPDATE answer
              SET a_rating = a_rating - 1
              WHERE a_order = $intOrder";


     if ($conn->query($sql2) === TRUE) 
      {
        echo "Vote Cast";
      } 
      else 
      {
          echo "Error: " . $sql2 . "<br>" . $conn->error;
      }
    unset($_SESSION['answer_ID']);
  }
    
	
   //unset($_SESSION['answer_ID']);
  die();
  
  
?>


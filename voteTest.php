<!DOCTYPE html>
<html>
<head>
  <script src="/js/jquery-1.11.2.min.js"></script>
  <style type="text/css">
    iframe {display: block; clear: both; width: 100%; border: 0; height: 5000px;}
  </style>
<script>

/*global $:false */
function asynchronouslyUpdate(change){
  $.ajax({
      url: "updateValue.php",
      data: {action: change},
      success: function(response){
        $("#myText").html(response);
      },
      error: function(err) {
        console.log("Error");
        console.log(err);
      }
  });
}

function showSource(){
    $("#source").show();
}

$(document).ready(function(){
  $("#id").ready(function(){asynchronouslyUpdate("get");});
  $("#source").hide();
  $("#showSource").click(showSource);
});

</script>
</head>
<?php
  
	include_once "connect.php";
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql1 = "UPDATE answer
			 SET answer_rating = answer_rating + 1";
	$sql2 = "UPDATE answer
			 SET answer_rating = answer_rating - 1";


    if($_GET['action'] == "increment"){
      $conn->query($sql);
    }elseif($_GET['action'] == "decrement") {
      $conn->query($sql);
    }
    
	
    die();
  

?>

</body>
</html>
<!DOCTYPE html>
<<html lang="en">
    <head>
    	<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
		<meta content="utf-8" http-equiv="encoding"> 

   		<title>Profile</title>

    </head>
<!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="offcanvas.css" rel="stylesheet">

<!-- Resource: http://stackoverflow.com/questions/6418973/how-to-use-ajax-to-update-mysql-db-when-checkbox-condition-is-changed -
 
    <script src="/js/ie-emulation-modes-warning.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript">
	    $('input[name = qselect]').live("click",function(){
	    var id = $(this).attr('id');

	    $.ajax({
	        type:'GET',
	        url:'adminEdit.php',
	        data:'id= ' + id 
	    });

	</script
 });
--><body>
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
             <li><a href="uploadBlob.php">Avatar</a></li>
            <li><a href="tagDisplay.php">Archive</a></li>            
			
          </ul>
        </div>
      </div>
    </nav>
    <br>
    <br>

<?php
	error_reporting(0);
	session_start();
	include_once 'connect.php';
	include_once 'getAvatar.php';
	$conn = new mysqli($servername, $username, $password, $dbname);
	$conn2 = new mysqli($servername, $username, $password, $dbname);
	

	
	if(isset($_GET["searchname"]))
	{
		$UN = $_GET['searchname'];
		$count = 0;
		echo  '	
				<br><br>
				<div class="row">
				<div class="col-md-4 col-md-offset-2">
			';
		
		/* Print name of user being searched for
		// STRONG HAS BEEN DEPRECATED
		$sql2 = "SELECT *
				FROM users 
				WHERE user_name = '$UN' ";

		$result2 = $conn2->query($sql2);

		if ($result2 === FALSE)
		{
			echo $conn2->error;
		}

		$row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
		//echo empty($row2);
		//echo is_array($row2);
		//echo count(array_filter($row2));

		echo  '<br></><strong>Profile for: </strong><mark>' . $_GET['searchname'] . '</mark><br></br>' ;
		// Show avatar
		echo  '<br></><strong>Avatar: </strong>' ;
		echo '<img src="data:image/jpeg;base64,'.base64_encode( $row2['user_avatar'] ).'" width="42" height="42"/>';
		// Show score
		echo  '<br></><strong>Score: </strong>' . $row2['user_score'] . '<br></br>' ;

		
		
		// Query DB for user with SESSION var user name to obtain all related question data
		$sql = "SELECT *
				FROM users u
                LEFT JOIN question q
                ON u.user_name = q.q_asker
				WHERE u.user_name = '$UN' ";

		
		$result = $conn->query($sql);
		// STRONG HAS BEEN DEPRECATED!!!
		echo '<strong>Question Data: <br></>(VALUE|TITLE|GAME) </strong><br></br> ';
		$count = 0;

		while($row = $result->fetch_assoc()) 
		{
			
			
			if(empty($row["q_id"]))
			{

				$count = $count + 1;
				
			}
			else
			{
				echo ' ' . $row['q_value'] . ' | ' . $row['q_title'] . ' | ' . $row['q_type'] . '<br></br>' ;
				
			}

		}

		if($count != 0)
		{
			echo 'No post history';
		}
		*/
		// Query DB for user with SESSION var user name to obtain all related question data
		$sql = "SELECT *
				FROM users u
                LEFT JOIN question q
                ON u.user_name = q.q_asker
				WHERE u.user_name = '$UN' ";

		
		$result = $conn->query($sql);
		$result2 = mysqli_query($conn, $sql);		
		
		echo "<div class='panel panel-info'>
  			  <div class='panel-heading'>
  			  	<br><h3>" . $UN . "'s Profile</h3>
			  	<strong>Avatar: </strong>
		  	  
		  	  ";
		$row01 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
		//echo $row01["user_avatar"];
		//echo '<img src="data:image/jpeg;base64,'.base64_encode( $row01['user_avatar'] ).'" width="42" height="42"/>';
		//echo '<img src="data:image/jpeg;base64,'.base64_encode($row1['user_avatar']->load()) .'" />';
		echo get_avatar($UN, 0, 0);

		// STRONG HAS BEEN DEPRECATED!!!
		echo '</div>
			  <div class="panel-body">
				<br><strong>Question Data: <br>(VALUE|TITLE|GAME) </strong><br> ';

		while($row = $result->fetch_assoc()) 
		{
			
			if(empty($row["q_id"]))
			{

				$count = $count + 1;
				
			}

			else
			{
				echo ' ' . $row['q_value'] . ' | ' . $row['q_title'] . ' | ' . $row['q_type'] . '<br>' ;
			}

		}


		if($count != 0)
		{
			echo 'No post history';
		}
		

		echo '</div>
			  
			  </div>
			  </div>';
		

	}
	else 
	{
		//do nothing

	}



	
$conn->close();
$conn2->close();

echo ' </body>

	</html>';

?>
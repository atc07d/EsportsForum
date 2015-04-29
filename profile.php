<!DOCTYPE html>
<html lang="en">
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
	$conn = new mysqli($servername, $username, $password, $dbname);
	$conn9 = new mysqli($servername, $username, $password, $dbname);

	//echo $_SERVER['SERVER_NAME'] . '<br></>';
	//echo __FILE__ . '<br></>';
	//echo $_SERVER['SERVER_PORT'] .'<br></>';

	$serverAdd = $_SERVER['SERVER_NAME'] .':'. $_SERVER['SERVER_PORT'] ;

	//echo $serverAdd;

	//Test for admin status
	if (isset($_SESSION['username']) and $_SESSION['username'] != "ADMINISTRATOR")
	{
		// Print name of user currently logged in by accessing SESSIOn vars
		// STRONG HAS BEEN DEPRECATED
		echo  '	
				<br><br>
				<div class="row">
				<div class="col-md-4 col-md-offset-2">
			';
		$UN = $_SESSION['username'];
		
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
  			  	<br><h3>" . $_SESSION['username'] . "'s Profile</h3>
			  	<strong>Avatar: </strong>
		  	  
		  	  ";
		$row01 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
		//echo $row01["user_avatar"];
		echo '<img src="data:image/jpeg;base64,'.base64_encode( $row01['user_avatar'] ).'" width="42" height="42"/>';
		//echo '<img src="data:image/jpeg;base64,'.base64_encode($row1['user_avatar']->load()) .'" />';
	

		// STRONG HAS BEEN DEPRECATED!!!
		echo '</div>
			  <div class="panel-body">
				<br><strong>Question Data: <br>(VALUE|TITLE|GAME) </strong><br> ';

		while($row = $result->fetch_assoc()) 
		{
			
			echo ' ' . $row['q_value'] . ' | ' . $row['q_title'] . ' | ' . $row['q_type'] . '<br>' ;

		}

		

		echo '</div>
			  
			  </div>
			  </div>';



		//scan upload folder for img with employee name appended to front
		/*$ufname = (string)$_SESSION['username'];
		$dir = 'http://' . (string)$serverAdd . '/uploads/';
		$results = scandir($dir);
		for($x in $results)
		{
			if(strpos($ufname,$x)!== FALSE)
			{

				$x = (string)$x
				echo '<strong>Avatar: </strong>
				<br></br>
				<img src="http://' . $serverAdd . '/uploads/' . $x .'" />
				<br></br>
				<br></br>
			';
			}

		}

		*/

	}

	 // Code for admin account ONLY
	elseif (isset($_SESSION['username']) and $_SESSION['username'] == "ADMINISTRATOR")
	{

		echo '<div class="row">
			<div class="col-md-3 col-md-offset-2">
			<br><h3>Welcome, <mark>ADMINISTRATOR</mark></h3><br>';

		$sql = "SELECT *
				FROM users u
                LEFT JOIN question q
                ON u.user_name = q.q_asker";

        $sql9 = "SELECT user_name, user_score,user_valid, COUNT(q_id) qcount
				FROM users u
                LEFT JOIN question q
                ON u.user_name = q.q_asker
                GROUP BY user_name, user_score";
	

				
		$result = $conn->query($sql);
		$result9 = $conn9->query($sql9);
		echo '<table class="table table-striped">
			  <br>
		      <thead>
		      <tr class="info">
		      	<th>User</th>
		      	<th>Score</th>
		      	<th># of Qs</th>
		      	<th>Status</th>
	      	  </tr>
	      	  </thead>
	      	  <tbody>';
		while($row9 = $result9->fetch_assoc()) 
		{
			if ($row9['user_name'] == "ADMINISTRATOR")
			{
				echo '';
			}
			else
			{
				echo '<tr class="active"><td>' . $row9['user_name'] . '</td><td> ' . $row9['user_score'] . '</td><td>' . $row9['qcount'] . '</td><td>' . $row9['user_valid'] . '</td></tr>' ;
			}
			

		}

		// STRONG HAS BEEN DEPRECATED!!!
		echo '</tbody>
			  </table>
			  </div>
			  <br>
			  <div class="col-md-3">
			  <br><br><br><br><br>
			 
			  <table class="table table-striped">
			  <thead>
			  <tr class="info">
			  	<th>Asker</th>
			  	<th>Value</th>
			  	<th>Title</th>
			  	<th>Game</th>
			  	<th>Score</th>
			  	<th>State</th>
			  	<th>Valid</th>
			  </tr>
		  	  </thead>
		  	  </table>

			  <br>';

		// start form for radio button(q id) and action (delete/edit) select
		// Resource: http://www.formget.com/php-select-option-and-php-radio-button/
		echo '<form action="adminEdit.php" method="get">';
		while($row = $result->fetch_assoc()) 
		{
			
			
			if(empty($row["q_id"]))
			{

				
				
			}
			else
			{
				
				echo '<input type="radio" name="qselect" value="' . $row["q_id"] . '">' . ' ' . $row['q_asker'] . 
					 ' | ' . $row['q_value'] . ' | ' . $row['q_title'] . ' | ' . $row['q_type'] . 
					 ' | ' . $row['user_score'] .  ' | ' . $row['q_state'] . '<br></br>' ;
					
			}
			

		}

	 echo ' 
	 		</div>
	 		</div>

	 		<div class="row">
	 		<div class="col-md-5 col-md-offset-5">
	 		
	 		<div class="btn-group ">
	 		<button name="edit" type="submit" value="edit" class="btn btn-primary btn-lg">Edit</button>
	 		<button name="delete" type="submit" value="delete" class="btn btn-danger btn-lg">Delete</button>
	 		</div>
	 		<br>
	 		<div class="btn-group ">
	  		<button name="freeze" type="submit" value="freeze" class="btn btn-info btn-lg">Freeze</button>
	 		<button name="unfreeze" type="submit" value="unfreeze" class="btn btn-success btn-lg">Unfreeze</button>
	 		<div>
	  		
	  		</form>
	  		</div>
	  		</div>
	  		';


	 

	}

	elseif ($_SESSION['github'])
	{
		echo  '	
				<br><br>
				<div class="row">
				<div class="col-md-4 col-md-offset-2">
			';
		$UN = $_SESSION['username'];
		
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
  			  	<br><h3>" . $_SESSION['username'] . "'s Profile</h3>
			  	<strong>Avatar: </strong>
		  	  
		  	  ";
		$row01 = mysqli_fetch_array($result2,MYSQLI_ASSOC);

		echo '	<img src="'.$_SESSION['avatar_url'].'" width="42" height="42"/>
				<strong>Location:</strong>'.$_SESSION['location'].'
				<strong>Last GitHub Update:</strong>'.$_SESSION['updated_at'].'

	
			  </div>
			  <div class="panel-body">
				<br><strong>Question Data: <br>(VALUE|TITLE|GAME) </strong><br> ';

		while($row = $result->fetch_assoc()) 
		{
			
			echo ' ' . $row['q_value'] . ' | ' . $row['q_title'] . ' | ' . $row['q_type'] . '<br>' ;

		}

		

		echo '</div>
			  
			  </div>
			  </div>';

	}
	else
	{
		 echo '<br><br>
        <div class="row">
        <div class="col-md-2 col-md-offset-3">
        <a href="logForm.php">Please log in</a>
        </div>
        </div>
        <br>  
        <br>
    		';
	}
	


$conn->close();
$conn9->close();

echo ' </body>

	</html>';
?>



<!DOCTYPE html>
<html lang="en">
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
-->
</html>

<?php
	error_reporting(0);
	session_start();
	include_once 'connect.php';
	$conn = new mysqli($servername, $username, $password, $dbname);

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
		echo  '<br></><strong>Logged in as: </strong>' . $_SESSION['username'] . '<br></br>' ;
		$UN = $_SESSION['username'];
		
		// Query DB for user with SESSION var user name to obtain all related question data
		$sql = "SELECT *
				FROM users u
                LEFT JOIN question q
                ON u.user_name = q.q_asker
				WHERE u.user_name = '$UN' ";

		
		$result = $conn->query($sql);
		// STRONG HAS BEEN DEPRECATED!!!
		echo '<strong>Question Data: <br></>(VALUE|TITLE|GAME) </strong><br></br> ';

		while($row = $result->fetch_assoc()) 
		{
			
			echo ' ' . $row['q_value'] . ' | ' . $row['q_title'] . ' | ' . $row['q_type'] . '<br></br>' ;

		}

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
			<div class="col-xs-12 col-md-8">
			<br></br>Welcome, <mark>ADMINISTRATOR</mark><br></br>';

		$sql = "SELECT *
				FROM users u
                LEFT JOIN question q
                ON u.user_name = q.q_asker";

	

				
		$result = $conn->query($sql);
		// STRONG HAS BEEN DEPRECATED!!!
		echo '<strong>ALL QUESTIONS: <br></>(ASKER|VALUE|TITLE|GAME|TOTAL SCORE) </strong><br></br> ';

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
				
				echo '<input type="radio" name="qselect" value="' . $row["q_id"] . '">' . ' ' . $row['q_asker'] . ' | ' . $row['q_value'] . ' | ' . $row['q_title'] . ' | ' . $row['q_type'] . ' | ' . $row['user_score'] . '<br></br>' ;
				
			}
			

		}

	 echo ' <button name="edit" type="submit" value="edit" class="btn btn-default btn-lg">Edit</button><br></br></div></div>
	  		<button name="freeze" type="submit" value="freeze" class="btn btn-info btn-lg">Freeze</button>
	 		<button name="unfreeze" type="submit" value="unfreeze" class="btn btn-success btn-lg">Unfreeze</button><br></br></div></div>
	  		<button name="delete" type="submit" value="delete" class="btn btn-danger btn-lg">Delete</button><br></br></div></div>
	  		</form>';


	 

	}

	else
	{
		echo '
				<br></br>
				<a href="logForm.php">Please log in</a>
				<br></br>
				
				<br></br>
		';
	}
	
	







	echo '
		<form action=index.php>
			<input type="submit" value="Home">  
		</form>
				
	
		';

	/*
		$conn = new mysqli($servername, $username, $password, $dbname);
		SELECT *
				FROM users u
                LEFT JOIN question q
                ON u.user_name = q.q_asker
				WHERE u.user_name = 'thewoz';
//No need for form, check SESSION variables against DB and display profile.
//Create a PROFILE PAGE that uses PHP query parameters to build the page's contents. 
//This query parameter must indicate a value that can be used to uniquely query the user from your database. 
//On this profile page, display the user's username, avatar, and all questions asked along with the corresponding question's current value.
// TEST CODE from http://www.startutorial.com/articles/view/php_file_upload_tutorial_part_2 ONLY TEST
	//scan "uploads" folder and display them accordingly
           $folder = "/home/acoffman/public_html/cs418/uploads/";
           $results = scandir('uploads');
           foreach ($results as $result) {
            if ($result === '.' or $result === '..') continue;
            
            if (is_file($folder . '/' . $result)) {
                echo '
                <div class="col-md-3">
                    <div class="thumbnail">
                        <img src="'.$folder . '/' . $result.'" alt="...">
                            <div class="caption">
                            <p><a href="remove.php?name='.$result.'" class="btn btn-danger btn-xs" role="button">Remove</a></p>
                        </div>
                    </div>
                </div>';
            }
           }







echo '<strong>Avatar: </strong>
				<br></br>
				<img src="http://' . $serverAdd . '/uploads/images.jpg" />
				<br></br>
				<br></br>
			';


	FOR AVATAR ENCLOSURE

	<img src="..." alt="..." class="img-rounded">
	<img src="..." alt="..." class="img-circle">
	<img src="..." alt="..." class="img-thumbnail">



	*/


?>



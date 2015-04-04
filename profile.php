<?php
	error_reporting(0);
	session_start();
	include_once 'connect.php';
	$conn = new mysqli($servername, $username, $password, $dbname);

	//echo $_SERVER['SERVER_NAME'] . '<br></>';
	//echo __FILE__ . '<br></>';
	//echo $_SERVER['SERVER_PORT'] .'<br></>';

	$serverAdd = $_SERVER['SERVER_NAME'] .':'. $_SERVER['SERVER_PORT'] ;

	echo $serverAdd;

	if (isset($_SESSION['username']))
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

		echo '<strong>Avatar: </strong>
				<br></br>
				<img src="http://' . $serverAdd . '/uploads/images.jpg" />
				<br></br>
				<a href="http://' . $serverAdd . '/uploads/images.jpg">image</a>
				<br></br>
			';
				//<img src="http://localhost/uploads/images.jpg" />
				// <img src="/home/acoffman/public_html/cs418/uploads/images.jpg" />
				// <img src="' . $serverAdd . '/uploads/images.jpg" />
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
			<input type="submit" value="Go Home">  
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


	*/


?>

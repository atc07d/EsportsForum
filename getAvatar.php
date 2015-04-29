<?php
	
 /**
 * Get avatar from database depending on user choice.
 * 0 = default url, 1 = blob in db, 2 = gravtar, if user is logged in from GH then show GH avatar
 * @param string $loginName is that of currently logged in user
 *
 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
 * @return String img src
 * 
 */
	function get_avatar($loginName, $gitstatus)
	{
		$servername = "localhost";
		$username = "admin";
		$password = "5pR1nG2OlS";
		$dbname = "messageboard";

		$conn3 = new mysqli($servername, $username, $password, $dbname);
		if ($conn3->connect_error ) 
		{
			die("Connection failed: " . $conn->connect_error);
		} 

		$UserID;

		$sql3 = "SELECT user_avatar_choice, user_avatar, user_gravatar_url, user_avatar_url 
				 FROM users
				 WHERE user_name = $loginName";

		$result3 = $conn3->query($sql3);
		$row3 = mysqli_fetch_array($result3);
		$tempChoice = $row3[0];
		$tempBlob = $row3[1];
		$tempGrav = $row3[2];
		$tempGH = $row3[3];
		mysqli_close($conn3);

		if ($tempChoice == 0)
		{
			$tempUrl = '<img src="http://www.gravatar.com/avatar/00000000000000000000000000000000" />';
			return $tempUrl;
		}

		elseif ($tempChoice == 1)
		{
			$tempUrl = '<img src="data:image/jpeg;base64,'.base64_encode( $tempBlob).'" width="42" height="42" />';
			return $tempUrl;
		}

		elseif ($tempChoice == 2) 
		{
			$tempUrl = '<img src="'. $tempGrav .'" />';
			return $tempUrl;
		}

		elseif ($gitstatus == 1) 
		{
			$tempUrl = '<img src="'. $tempGH .'" />';
			return $tempUrl;
		}

		else
		{
			return "No such choice";
		}
		


	}




?>
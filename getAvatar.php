<?php
	
 /**
 * Get avatar from database depending on user choice.
 * If option 0 then show avatar corresponding to users choice in db (for use in conversation.php)
 * If option 1 then display all avatars stored in DB for that user (for use in uploadBoB.php to show user avatar selection)
 * 0 = default url, 1 = blob in db, 2 = gravtar, if user is logged in from GH then show GH avatar
 * @param string $loginName is that of currently logged in user
 *
 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
 * @return String img src
 * 
 */
	function get_avatar($loginName, $gitstatus, $option)
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
				 WHERE user_name = '$loginName'";

		$result3 = $conn3->query($sql3);
		
		$result3 = mysqli_query($conn3, $sql3);
		$row3 = mysqli_fetch_array($result3,MYSQLI_ASSOC);	

		//var_dump($row3);

		$tempChoice = $row3['user_avatar_choice'];
		$tempBlob = $row3['user_avatar'];
		$tempGrav = $row3['user_gravatar_url'];
		$tempGH = $row3['user_avatar_url'];

		mysqli_close($conn3);

		if ($option == 0)
		{
			if ($tempGH !== NULL)
			{
				$tempUrl = '<img src="'. $tempGH .'" />';
				return $tempUrl;
			}

			elseif ($tempChoice == 0)
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
			//More for conversation use when need to display avatar with asker and responders
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

		elseif ($option == 1)
		{
			$tempUrl1 = '<img src="http://www.gravatar.com/avatar/00000000000000000000000000000000" />';
			$tempUrl2 = '<img src="data:image/jpeg;base64,'.base64_encode( $tempBlob).'" width="42" height="42" />';
			$tempUrl3 = '<img src="'. $tempGrav .'" />';

			
			return '<form class="form-horizontal" method="POST" action="updateAvatar.php">
				    <fieldset>
				      <legend>Current Avatar:'. get_avatar($_SESSION['username'], $_SESSION['github'], 0) . '</legend>
				      '. $tempUrl1 .' ' . $tempUrl2 . ' ' . $tempUrl3 .' 
				      <div class="form-group">
				      <br><br><br>
				      <label for="select" class="col-lg-2 control-label">Selects</label>
					      <div class="col-lg-10">
					        <select class="form-control" id="select" name="select">
					          <option label="local default">0</option>
					          <option label="uploaded image">1</option>
					          <option label="gravatar">2</option>
					        </select>
					        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
				       		</div>
			       		</div>
		       		</fieldset>
		       		</form>

    			';
			
		}

		else
		{

		}


	}




?>
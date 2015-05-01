<?php
	
	//Checks logIn name/pw with user database
	session_start();
	//error_reporting(-1);
	include_once 'connect.php';
	include_once "currentUserID.php";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	$conn1 = new mysqli($servername, $username, $password, $dbname);
	

	// Check connection
	if ($conn->connect_error || $conn1->connect_error || $conn2->connect_error) 
	{
		die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT * FROM users";

	$result = $conn->query($sql);

	//echo " - username and password: " . $_POST["uname"]. " " . $_POST["pword"]. "<br></br>"; 
	//$referer = $_SERVER['HTTP_REFERER'];
	if($_POST["login-submit"])  
	{
		if ($result->num_rows > 0) 
		{
			// output data of each row
			while($row = $result->fetch_assoc()) 
			{
				//echo " - username and password: " . $row["user_name"]. " " . $row["user_pw"]. "<br>"; 
				if ((strcmp($_POST["uname"],$row["user_name"]) == 0) && (strcmp($_POST["pword"],$row["user_pw"]) == 0))
				{
					
					$_SESSION['username'] = $_POST["uname"];
					$_SESSION['userID'] = $row["user_id"];
					$_SESSION['logged_in'] = 1;
					$_SESSION['github'] = 0;
					$_SESSION['vote'] = array();
					$_SESSION['Qvote'] = array();
					//echo "<p>Successful Login!</p>" ;
					//echo "<p>Successful Login!</p>" . $_SESSION['username'] . $_SESSION['userID'] ;
					//header("Location: $referer");
					header ("Location: index.php");
					//break;
				}
				else 
				{
					//echo "Login failed.  ";
					//echo $_POST["uname"] . " " . $_POST["pword"];
					//echo " - username and password: " . $row["username"]. " " . $row["password"]. "<br>"; 
					//header("Location: index.php");
					//break;
					//header ("Location: index.php");
				}
			}
		} 

		else 
		{
			echo "0 results";
		}
		
		mysqli_close($conn);

		echo '<br></br><p>Login failed</p>
			<form action=index.php>
				<input type="submit" value="Home">  
			</form>
					
		
			';
	}

	else if($_POST["github-submit"] && !isset($_GET['code'])) 
	{

		// Rescources: https://developer.github.com/v3/oauth/#directing-users-to-review-their-access-for-an-application
		// 				http://www.binarytides.com/php-add-login-with-github-to-your-website/
		//				http://www.phpgang.com/how-to-add-github-oauth-login-on-your-website-using-php_740.html
		// My application info
		$client_id = '29fbbf34ee6862f70fa3';
		$clientSecret = '5d20cfd3d5450ce970609674a1f5731835437222';
    	$redirect_url = 'http://wsdl-docker.cs.odu.edu:60283/logIn.php';
     
	    //login request
	    if($_SERVER['REQUEST_METHOD'] == 'POST')
	    {
	        
		
			$url = "https://github.com/login/oauth/authorize?client_id=$client_id&redirect_uri=$redirect_url&scope=user";
	    	header("Location: $url");
			
			
	    }	    
	}

	else if(isset($_GET['code']))
	{
     	
     	// Code from course website:https://raw.githubusercontent.com/machawk1/ODUCS418/spring2015/docker_cs418/deployUI.php  
     	$client_id = '29fbbf34ee6862f70fa3';
		$clientSecret = '5d20cfd3d5450ce970609674a1f5731835437222';
    	$redirect_url = 'http://wsdl-docker.cs.odu.edu:60283/logIn.php';

        $ch = curl_init();

		curl_setopt($ch, CURLOPT_URL,"https://github.com/login/oauth/access_token");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,
					http_build_query(array(
						'code' => $_GET['code'],
						'client_id' => $client_id,
						'client_secret' => $clientSecret

					))
				);
		curl_setopt($ch, CURLOPT_HTTPHEADER,array("Accept: application/json"));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec ($ch);
		curl_close ($ch);
		$json = json_decode($server_output,true);
		//var_dump($json);
		$accessToken = json_decode($server_output,true)["access_token"];
		

		if(	!$json || !isset($json['access_token']) || strpos($json['access_token'],' ') !== FALSE)
		{
			echo "Bad access token. <a href='http://wsdl-docker.cs.odu.edu:60283/index.php'>Reload the page.</a> Try again.";
			die();
		}

		
		if (isset($json['access_token']))
		{

            $ch1 = curl_init();

			// Defining user agent is important 
			curl_setopt($ch1, CURLOPT_URL,"https://api.github.com/user?access_token=$accessToken");
			curl_setopt($ch1, CURLOPT_HTTPHEADER,array("Accept: application/json","User-Agent: CS418M4"));
			curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
			$server_output1 = curl_exec ($ch1);
			$json1 = json_decode($server_output1,true);

			
			/*echo '<h3>Your profile will be reflected with the following:</h3>
				<br><br>';
	
			echo $json1['login'];
			echo '<br>';
			echo $json1['email'];
			echo '<br>';
			echo $json1['avatar_url'];
			echo '<br>';
			echo '<img src="'. $json1['avatar_url'] .'" width="100px" height="100px"/><br>';
		    echo $json1['location'];
		    echo '<br>';
	        echo $json1['updated_at'];
	        */

	        $flag = 0;
	        while($row = $result->fetch_assoc()) 
	        {
	        	if ($row['user_name'] == $json1['login'])
	        	{
	        		++$flag;
	        	}


	        }

	        mysqli_close($conn);
	        // Could search for currentUserID - 1 to check for user existing already
	        $tempUser = currentUserID();

	        if ($flag == 0)
	        {
	        	$sql1 = "INSERT INTO users (user_id,user_name,user_pw,user_email,user_valid,user_avatar_url,user_location,user_last_login)
			 	VALUES ('$tempUser','$json1[login]', '@github','$json1[email]', '1','$json1[avatar_url]', '$json1[location]', '$json1[updated_at]')";

	        	$result1 = $conn1->query($sql1);
	        	mysqli_close($conn1);

	        }
	        // Update values
	        $tempNAME = $json1['login'];
	        else if ($flag != 0)
	        {
	        	$sql1 = "UPDATE users
	        			 SET user_email = '$json1[email]', user_avatar_url = '$json1[avatar_url]', user_location = '$json1[location]', user_last_login = '$json1[updated_at]'
	        			 WHERE user_name = '$tempNAME'";

	        	$result1 = $conn1->query($sql1);
	        	mysqli_close($conn1);

	        }


    		$_SESSION['username'] = $json1['login'];
			$_SESSION['userID'] = $tempUser;
			$_SESSION['logged_in'] = 1;
			$_SESSION['avatar_url'] = $json1['avatar_url'];
			$_SESSION['github'] = 1;
			$_SESSION['location'] = $json1['location'];
			$_SESSION['updated_at'] = $json1['updated_at'];
			$_SESSION['email'] = $json1['email'];
			$_SESSION['vote'] = array();
			$_SESSION['Qvote'] = array();

			

			header("Location: index.php");
	        
		}
	}

	else
	{
		echo "LoginIn Failed";

	}
?>
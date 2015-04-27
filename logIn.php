<?php
	
	//Checks logIn name/pw with user database
	session_start();
	error_reporting(0);
	include_once 'connect.php';

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT user_id,user_name,user_pw FROM users";
	$result = $conn->query($sql);

	//echo " - username and password: " . $_POST["uname"]. " " . $_POST["pword"]. "<br></br>"; 
	//$referer = $_SERVER['HTTP_REFERER'];
	if($_POST["login-submit"])  
	{
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) 
			{
				//echo " - username and password: " . $row["user_name"]. " " . $row["user_pw"]. "<br>"; 
				if ((strcmp($_POST["uname"],$row["user_name"]) == 0) && (strcmp($_POST["pword"],$row["user_pw"]) == 0))
				{
					
					$_SESSION['username'] = $_POST["uname"];
					$_SESSION['userID'] = $row["user_id"];
					$_SESSION['logged_in'] = 1;
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
		$conn->close();

		echo '<br></br><p>Login failed</p>
			<form action=index.php>
				<input type="submit" value="Home">  
			</form>
					
		
			';
	}

	if($_POST["github-submit"]) 
	{

		// Rescources: http://www.binarytides.com/php-add-login-with-github-to-your-website/
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
			
			
			/*
			if(setcookie("github",$accessToken))
			{
				echo "sucessfully authenticated with github!";
				header("Location:index.php");
			}
			*/
	    }	    
	}

	if(isset($_GET['code']))
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
						'client_id' => $clientId,
						'client_secret' => $clientSecret

					))
				);
		curl_setopt($ch, CURLOPT_HTTPHEADER,array("Accept: application/json"));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec ($ch);
		curl_close ($ch);
		$json = json_decode($server_output,true);
		//$accessToken = json_decode($server_output,true)["access_token"];
		
		if ($json->access_token)
		{
			$data = array('url' => 'https://api.github.com/user?access_token='.$json->access_token,
                  'header' => array("Content-Type: application/x-www-form-urlencoded","User-Agent: CS418M4","Accept: application/json"),
                  'method' => 'GET');
    
	        $gitUser = json_decode(curlRequest($data));
	        
	        echo '
	        <table>
	            <tr>
	                <td colspan="2"><a href="'.$gitUser->html_url.'" target="_blank"><img src="'.$gitUser->avatar_url.'" width="200px" height="200px"/></a></td>
	            </tr>
	            <tr>
	                <td>Name:</td>
	                <td>'.$gitUser->name.'</td>
	            </tr>
	            <tr>
	                <td>Email:</td>
	                <td>'.$gitUser->email.'</td>
	            </tr>
	            <tr>
	                <td>Location:</td>
	                <td>'.$gitUser->location.'</td>
	            </tr>
	            <tr>
	                <td>Website:</td>
	                <td>'.$gitUser->blog.'</td>
	            </tr>
	        </table>';
		}
	}
?>
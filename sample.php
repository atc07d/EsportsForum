<?php
	//https://www.youtube.com/watch?v=ueWpNe0PG34
	//https://www.youtube.com/watch?v=lB9aKoFjwkg&list=PL5A60C9222A50CD6A
	//http://stackoverflow.com/questions/15089294/slim-framework-for-beginners
	if (isset($_POST['submit']))
	{
		echo "Great work";
	}
	//header("Location: index.php");
?>

<?php
	//Checks logIn name/pw with user database
	session_start();
	$servername = "localhost";
	$username = "admin";
	$password = "5pR1nG2OlS";
	$dbname = "messageboard";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT * FROM users";

	//$sql2 = "INSERT INTO users (user_id,user_name,user_pw,)
			 //VALUES ('?','$_POST[exampleUserName]','$_POST[exampleInputPassword]')";
			 
	//$sql3 = "SELECT MAX(user_id) max 
			//FROM users"; 
	
	$result = $conn->query($sql);
	//$result2 = $conn->query($sql2);
	//$result3 = $conn->query($sql3);
	
	//echo $result3;
	
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) 
		{
			
			if (!(strcmp($_POST["exampleUserName"],$row["user_name"])))
			{
				//Write insert query and echo sucess then re direct
				//
				
				//$_SESSION['username'] = $_POST["exampleUserName"];
				//$_SESSION['userID'] = $row["user_id"];
				//$_SESSION['logged_in'] = 1;
				
				//echo "<p>Successful Login!</p>" . $_SESSION['username'] . $_SESSION['userID'] ;
				//$result3 = $conn->query($sql3);
				//$idAdd = $result3 + 1;
				
				//$sql2 = "INSERT INTO users (user_id,user_name,user_pw,)
						//VALUES ('$idAdd','$_POST[exampleUserName]','$_POST[exampleInputPassword]')";
				//$result2 = $conn->query($sql2);
				//header ("Location: index.php");
				echo 'Successful';
				
			}
			else {
				echo "Login failed. Try again ";
				//echo $_POST["uname"] . " " . $_POST["pword"];
				//echo " - username and password: " . $row["username"]. " " . $row["password"]. "<br>"; 
				//header("Location: index.php");
				
				
			}
		}
	} else {
		echo "0 results";
	}
	$conn->close();
?>

include_once "connect.php";
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql = "SELECT * FROM answer
			WHERE answer_"


    if($_GET['action'] == "increment"){
      $currentValue++;
    }elseif($_GET['action'] == "decrement") {
      $currentValue--;
    }
    
	
    die();


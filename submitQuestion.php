<?php 

	echo '<link href="/css/bootstrap.min.css" rel="stylesheet">';
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

	//$sql = "SELECT username, password FROM main";
	//$result = $conn->query($sql);
	
	

if($_SESSION['logged_in'] == 0)
{
    //the user is not signed in
    echo 'Sorry, you have to be <a href="logIn.php">Logged in</a> to submit a question.';
}
else
{
    //the user is signed in

      
        //the form hasn't been posted yet, display it
        //retrieve the categories from the database for use in the dropdown
        $sql = "SELECT
                    t_id,
                    t_name,
                    t_description
                FROM
                    type";
         
        $result = $conn->query($sql);
		//echo "$result";
         
        if(!$result)
        {
            //the query failed
			echo $result;
            echo 'Error while selecting from database. Please try again later.';
			echo $result;
        }
        
        else
            {
         
                echo '<div class="row">
                        <div class="col-md-10 ">
                        <form method="post" action="question.php" method="post">
					   <br>Title: <input type="text" name="title" />
					   Type: '; 
                 
                echo '<select name="t_name">';
                   while($row = $result->fetch_assoc())
                    {
                        echo '<option value="' . $row['t_name'] . '">' . $row['t_name'] . '</option>';
                    }
                echo '  </select>
                        </div>
                        </div>'; 
                     
                echo '<br>
                    <div class="row">
                        <div class="col-md-2 ">
                        Content: <textarea class="form-control" rows="3" name="content" /></textarea>
                        <input type="submit" name="submit"	value="Submit" />
    					</form>
                        </div>
                    </div>';
				 
				 
			}
}   
    

?>
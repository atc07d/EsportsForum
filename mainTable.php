<!DOCTYPE html>
<?php
	
	
	
	
	echo '<p><div class="col-md-6">
				  <table class="table table-striped">
					<thead>
					  <tr>
						<th>Popularity</th>
						<th>Title</th>
						<th>Question</th>
						<th>Asker</th>
						</tr>
					</thead>
				</table>
			</div>
		</p>
						';
	
	
	
	
	
	
	
	<div class="col-md-6">
				  <table class="table table-striped">
					<thead>
					  <tr>
						<th>Popularity</th>
						<th>Title</th>
						<th>Question</th>
						<th>Asker</th>
						
					  </tr>
					</thead>
					<tbody>
					  <tr>
						<td>1</td>
						<td>Mark</td>
						<td>Otto</td>
						<td>@mdo</td>
					  </tr>
					  <tr>
						<td>2</td>
						<td>Jacob</td>
						<td>Thornton</td>
						<td>@fat</td>
					  </tr>
					  <tr>
						<td>3</td>
						<td>Larry</td>
						<td>the Bird</td>
						<td>@twitter</td>
					  </tr>
					</tbody>
				  </table>
				</div>
	
	
	//Checks logIn name/pw with user database
	session_start();
	$servername = "localhost";
	$username = "root";
	$password = "admin";
	$dbname = "questions";

	// Create connection
	//$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	//if ($conn->connect_error) {
		//die("Connection failed: " . $conn->connect_error);
	//} 

	//$sql = "SELECT * FROM suppliedusers";
	//$result = $conn->query($sql);
	
	$result = $sql->query("SELECT * FROM `$dbname`;");
	while(null !== ($row = mysqli_fetch_assoc($result))) 
{ 
		echo $row;
} 









?>









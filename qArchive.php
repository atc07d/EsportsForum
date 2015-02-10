<?php
	//diplays asker, title, and content from main table in questions DB
	echo ' <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="offcanvas.css" rel="stylesheet"> ';
	
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

$sql = "SELECT q_id,q_asker,q_title, q_content,q_type  FROM question";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
	echo '<table class="table table-hover">
                      <tr>
                        <th>Topic</th>
                        <th>Created by</th>
						<th>Game</th>
						
                      </tr>'; 
    while($row = $result->fetch_assoc()) {
        /*echo " - title and question: " . $row["title"]. " " . $row["question"]. "<br>";
		echo '</p><div class="col-md-6">
				  <table class="table table-striped" aligm="left">
					<tbody>
					  <tr>
						<td>'. $row["asker_id"] .'</td>
						<td>'.$row["asker"].'</td>
						<td>'.$row["title"].'</td>
						<td>'.$row["question_type"].'</td>
					  </tr>
					</tbody>
				</table>
			</div>
		</p>				'; */
    echo '<tr>';
                        echo '<td class="leftpart">';
                            echo '<h3><a href="conversation.php?var=' . $row['q_id'] . '">' . $row['q_title'] . ' '  . '</a><h3>';
                        echo '</td>';
                        echo '<td class="midpart">';
                            echo '<h3>' . $row['q_asker'] . ' ' . '<h3>';
                        echo '</td>';
						echo '<td class="rightpart">';
                            echo '<h3>' . $row['q_type'] . ' ' . '<h3>';
                        echo '</td>';
                    echo '</tr>';
	
	
	
	}
} else {
    echo "0 results";
}
$conn->close();
?>

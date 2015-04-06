<?php
	/*
		Adam Coffman CS418 Index/home page
		
	*/
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>eSports Q&A Site</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="offcanvas.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <nav class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
			      <li><a href="profile.php">Profile Page</a></li>
            <li><a href="logForm.php">Login</a></li>
			      <li><a href="signupForm.php">Sign Up</a></li>
         

            
			
          </ul>
        </div>
      </div>
    </nav>


    <div class="container">

      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
          <div class="jumbotron">
            <h1>Hello sports fan!</h1>
            <p>This is a Q&A site in response to the growing popularity of eSports. </p>
          </div>


    <!-- Code for live search box 
          Resource: http://www.finalwebsites.com/jquery-ajax-live-search/
    -->  
    
<div class="panel panel-default">
  <div class="panel-body">
    <div class="row">
      <div class="col-md-4">
        <form>
          <div class="search box">
            <label class="sr-only" for="descr">user name live search</label>
                <div class="input-group">
                  <div class="input-group-addon">Search:</div>
                  <input type="text" class="form-control" id="keyword" placeholder="Handle">
                </div>
          </div>
        </form>

        
        <ul  id="searchBar" ></ul>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {
          $('#keyword').on('input', function() 
          {
            var searchKeyword = $(this).val();
            
            // If at least 1 character is entered, begin search -> searchProfile.php
            if (searchKeyword.length >= 1 ) 
            {
              $.post('userLiveSearch.php', { keywords: searchKeyword }, function(data) {
                $('ul#searchBar').empty()
                $.each(data, function() 
                {
                  $('ul#searchBar').append('<u><a href="searchProfile.php?searchname=' + this.name + '">' + this.name + '</a></li></u><p>  </p>');

                });
              }, "json");
            }

            // Else if, clear search box by appending blank space thereby clearing previous search
            else if (searchKeyword.length == 0 ) 
            {
              $.post('userLiveSearch.php', { keywords: searchKeyword }, function(data) {
                $('ul#searchBar').empty()
                $.each(data, function() 
                {
                  
                  $('ul#searchBar').append('');

                });
              }, "json");

            }
            // Else, say no match ? Not working 
            else if (searchKeyword.length > 7 ) 
            {
              $('ul#searchBar').append('No match');

            }
          });
        });
        </script>
    </div> 
    <div class="col-md-6">
      
      <button type="button" class="btn btn-xs btn-default"><a href="tagDisplay.php?type=all" style="color: #000000; text-decoration: none;">All</a></button>
      <button type="button" class="btn btn-xs btn-primary"><a href="tagDisplay.php?type=d3" style="color: #FFFFFF; text-decoration: none;">D3</a></button>
      <button type="button" class="btn btn-xs btn-success"><a href="tagDisplay.php?type=wow"style="color: #FFFFFF; text-decoration: none;">WoW</a></button>
      <button type="button" class="btn btn-xs btn-info"><a href="tagDisplay.php?type=lol"style="color: #FFFFFF; text-decoration: none;">LoL</a></button>
      <button type="button" class="btn btn-xs btn-warning"><a href="tagDisplay.php?type=dota2"style="color: #FFFFFF; text-decoration: none;">DoTA 2</a></button>
      <button type="button" class="btn btn-xs btn-danger"><a href="tagDisplay.php?type=csgo"style="color: #FFFFFF; text-decoration: none;">CS:GO</a></button>

    </div>
    </div> 
<!-- 00000000000000000000000000000000000000000000000000000000 -->  

      <br></br>

      <div class="row">
        <div class="col-md-4">
		  	<?php 
				if($_SESSION['logged_in'])
				{
					echo 'Logged in as: <mark>' . $_SESSION['username'] . '</mark><br><a href="logOut.php">Log out</a>';
				}
				else
				{
					//echo '<a href="logForm.php">Login</a> ';
				}
			?>
      <br></br><br></br>
      <p><a class="btn btn-primary btn-lg" href="submitQuestion.php" role="button">Create Question</a></p>
		  </div> 

    
      <div class="col-md-6">
        
      <table class="table table-striped">
          <thead>
            <tr>
            
            <th>Title</th>
        
            <th>Asker</th>

            <th>Value</th>

            <th>Tags</th>
            
            </tr>
          </thead>
          <tbody>
            <?php
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
              //Show questions in each category where answers have highest total
              $sql = "SELECT *  FROM question
                      ORDER BY q_value DESC LIMIT 5";
              $result = $conn->query($sql);
              
              while($row = mysqli_fetch_array($result))
                {
                  echo '<tr><td><a href="conversTEST.php?var=' . $row['q_id'] . '">' . $row['q_title'] . 
                  '</a></td><td>' . $row['q_asker'] . '</td><td>' . $row['q_value'] . '</td><td>' . $row['q_tags'] . '</td</tr>'; 
                
                }

                 mysqli_close($con);
            ?>
          </tbody>
          </table>


      </div> 
     

      <div class="row">
        <div class="col-md-10"></div>
      </div>
      


         </div>   
          </div><!--/row-->
        </div><!--/.col-xs-12.col-sm-9-->

		<?php include 'mainTable.php'; ?>
		
        <!-- <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
          <div class="list-group">
            <a href="#" class="list-group-item active">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
          </div> -->
        </div><!--/.sidebar-offcanvas-->
      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; Coffman 2015</p>
      </footer>

    </div><!--/.container-->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/js/ie10-viewport-bug-workaround.js"></script>

    <script src="offcanvas.js"></script>
    </div>
    </div>
  </body>
</html>
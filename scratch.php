<!DOCTYPE html>
<html>
<head>
	 <link href="css/testConvo.css" rel="stylesheet">
	 <link href="/css/bootstrap.min.css" rel="stylesheet">

	 <title>http://bootsnipp.com/snippets/featured/google-plus-styled-post</title>

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
            <li class="active"><a href="index.php">Home</a></li>
			      <li><a href="profile.php">Profile Page</a></li>
            <li><a href="logForm.php">Login/Register</a></li>  
            <li><a href="uploadBlob.php">Avatar</a></li>
            <li><a href="tagDisplay.php">Archive</a></li>            
			
          </ul>
        </div>
      </div>
    </nav>
</head>

<body>
<br><br>
	<div class="container">
	  <div class="row">
	    <div class="col-md-8">
	      <h2 class="page-header">Conversation About: Q Title</h2>
	        <section class="comment-list">
	          <!-- First Comment -->
	          <article class="row">
	            <div class="col-md-2 col-sm-2 hidden-xs">
	              <figure class="thumbnail">
	                <img class="img-responsive" src="http://www.keita-gaming.com/assets/profile/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg" />
	                <figcaption class="text-center">username</figcaption>
	              </figure>
	            </div>
	            <div class="col-md-10 col-sm-10">
	              <div class="panel panel-default arrow left">
	                <div class="panel-body">
	                  <header class="text-left">
	                    <div class="comment-user"><i class="fa fa-user"></i> That Guy</div>
	                    <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
	                  </header>
	                  <div class="comment-post">
	                    <p>
	                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
	                    </p>
	                  </div>
	                  <p class="text-right"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> reply</a></p>
	                </div>
	              </div>
	            </div>
	          </article>
	        
	          <!-- Third Comment -->
	          <article class="row">
	            <div class="col-md-10 col-sm-10">
	              <div class="panel panel-default arrow right">
	                <div class="panel-body">
	                  <header class="text-right">
	                    <div class="comment-user"><i class="fa fa-user"></i> That Guy</div>
	                    <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
	                  </header>
	                  <div class="comment-post">
	                    <p>
	                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
	                    </p>
	                  </div>
	                  <p class="text-right"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> reply</a></p>
	                </div>
	              </div>
	            </div>
	            <div class="col-md-2 col-sm-2 hidden-xs">
	              <figure class="thumbnail">
	                <img class="img-responsive" src="http://www.keita-gaming.com/assets/profile/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg" />
	                <figcaption class="text-center">username</figcaption>
	              </figure>
	            </div>
	          </article>
	          <!-- Fifth Comment -->
	          <article class="row">
	            <div class="col-md-10 col-sm-10">
	              <div class="panel panel-default arrow right">
	                <div class="panel-body">
	                  <header class="text-right">
	                    <div class="comment-user"><i class="fa fa-user"></i> That Guy</div>
	                    <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
	                  </header>
	                  <div class="comment-post">
	                    <p>
	                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
	                    </p>
	                  </div>
	                  <p class="text-right"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> reply</a></p>
	                </div>
	              </div>
	            </div>
	            <div class="col-md-2 col-sm-2 hidden-xs">
	              <figure class="thumbnail">
	                <img class="img-responsive" src="http://www.keita-gaming.com/assets/profile/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg" />
	                <figcaption class="text-center">username</figcaption>
	              </figure>
	            </div>
	          </article>
	          <div class="panel-footer">
		    	<span class="label label-default">Image</span> <span class="label label-default">Updates</span> <span class="label label-default">July</span>
			 </div>
	         
	        </section>
	    </div>
	  </div>
	</div>

</body>
</html>

<?/* Print name of user being searched for
		// STRONG HAS BEEN DEPRECATED
		$sql2 = "SELECT *
				FROM users 
				WHERE user_name = '$UN' ";

		$result2 = $conn2->query($sql2);

		if ($result2 === FALSE)
		{
			echo $conn2->error;
		}

		$row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
		//echo empty($row2);
		//echo is_array($row2);
		//echo count(array_filter($row2));

		echo  '<br></><strong>Profile for: </strong><mark>' . $_GET['searchname'] . '</mark><br></br>' ;
		// Show avatar
		echo  '<br></><strong>Avatar: </strong>' ;
		echo '<img src="data:image/jpeg;base64,'.base64_encode( $row2['user_avatar'] ).'" width="42" height="42"/>';
		// Show score
		echo  '<br></><strong>Score: </strong>' . $row2['user_score'] . '<br></br>' ;

		
		
		// Query DB for user with SESSION var user name to obtain all related question data
		$sql = "SELECT *
				FROM users u
                LEFT JOIN question q
                ON u.user_name = q.q_asker
				WHERE u.user_name = '$UN' ";

		
		$result = $conn->query($sql);
		// STRONG HAS BEEN DEPRECATED!!!
		echo '<strong>Question Data: <br></>(VALUE|TITLE|GAME) </strong><br></br> ';
		$count = 0;

		while($row = $result->fetch_assoc()) 
		{
			
			
			if(empty($row["q_id"]))
			{

				$count = $count + 1;
				
			}
			else
			{
				echo ' ' . $row['q_value'] . ' | ' . $row['q_title'] . ' | ' . $row['q_type'] . '<br></br>' ;
				
			}

		}

		if($count != 0)
		{
			echo 'No post history';
		}
		*/
?>
<!DOCTYPE html>
<html>
	<!-- Bootstrap core CSS <link href="/css/bootstrap.min.css" rel="stylesheet"> -->
	<!-- https://developer.mozilla.org/en-US/docs/Web/Guide/HTML/Forms/My_first_HTML_form -->
	<!-- Sign in form that will send username and pw via post to signIn.php to be inserted into DB -->


	<head> 
		<title> New User Sign-In Form</title>
			<h3> 
				Welcome to the new user sign-up form! 
				  <br></br>
				Please select a username and password below.
			</h3>
	</head>

	<body>
		<form action="signIn.php" method="post">
			<div>
				<label for="UserName"><strong>New Username: </strong></label>
				<input type="text" id="UserName" name="User_Name" />
			</div>
			<div>
				<label for="Password"><strong>Choose Password: </strong></label>
				<input type="password" id="Password" name="User_PW" />
			</div>

			<div class="button">
				<button type="Submit"> Register</button>
			</div>

		</form>
		<br></>
		<a href="uploadBlob.php">Upload Avatar</a>
	</body>
 
<!--
</html>

//Start at the beginning with the basics
//Work on making a form that accepts username and password, use action="" to send POST data to .php
//file that checks username against DB and rejects if that name already exists.
// 			FROM MILESTONE REQs
//Provide an HTML form for new users to register for your Q&A website by providing a username and password. 
//When a username is provided for registration that already exists in your database, reject the rejections and ask the user to select another.

// From the CS418 notes

</form>
		<br></br>
		<br></br>
		<p><strong>Upload Avatar below:</strong></p>

		<form enctype="multipart/form-data" action="" method="post">
  			<input type="hidden" name="MAX_FILE_SIZE" value="30000">
  				
			<input name="mkfile" type="file">
  			<input type="submit" value="Upload">
		</form>
-->
</html>
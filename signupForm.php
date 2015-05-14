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
</html>

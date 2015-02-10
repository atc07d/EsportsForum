<!DOCTYPE html>
<html>
	<head><title>Welcome</title>
	<!--    css here            -->
	</head>
	<body>
		<header>
			<h1>Welcome to the e-sports stack overflow!</h1>
				<p>This site is dedicated to all competitive gaming communities</p>
				<p>To sign in, please see the form below</p>
		</header>
		<form action="logIn.php" name="log-in" method="post" >
			username: <input type="text" name="uname" />
			password: <input type="text" name="pword" />
			<input type="submit">
		</form>
		<div>
			<h1>Thank you for loggin in, ... </h1>
			<p>List questions on this page.</p>
			<p>Link to other page or have form on this page for question submit?</p>
		</div>
		
		<form action="question.php" name="submit-q" method="post" >
			<div>
				<label for="title">Title:</label>
				<input type="text" name="title" />
			</div>
			<div>
				<label for="content">Content:</label>
				<textarea name="content"></textarea>
			</div>
			<div>
				<div class="button">
					<button type="submit">Post question</button>
				</div>
			</form>
			<div>
				<h1> Display questions from db here?</h1>
				<?php include 'test.php'; ?>
				
			</div>
	</body>
</html>

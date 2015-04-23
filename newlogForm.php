<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <link href="/css/newlogForm.css" rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <title>New login form from bootsnipp</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-3 col-md-offset-4">
            <div class="account-box">
                <div class="logo ">
                    
                </div>
                <form class="form-signin" action="logIn.php" method="POST">
                <div class="form-group">
                    <input name="uname" type="text" class="form-control" placeholder="Username" required autofocus />
                </div>
                <div class="form-group">
                    <input name="pword" type="password" class="form-control" placeholder="Password" required />
                </div>
                
                <button class="btn btn-lg btn-block btn-primary" type="submit" value="Submit">
                    Sign in</button>
                </form>
                
                <div class="or-box">
                    <span class="or">OR</span>
                    <div class="row">
                        <div class="col-md-12 row-block">
                            <a href="" class="btn btn-google btn-block">GitHub</a>
                        </div>
                    </div>
                </div>
                <div class="or-box row-block">
                    <div class="row">
                        <div class="col-md-12 row-block">
                            <a href="signupForm.php" class="btn btn-primary btn-block">Create New Account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

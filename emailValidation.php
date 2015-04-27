<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="offcanvas.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/js/ie-emulation-modes-warning.js"></script>

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
            <li><a href="logForm.php">Login/Register</a></li>  
            <li><a href="uploadBlob.php">Avatar</a></li>
            <li><a href="tagDisplay.php">Archive</a></li>            
      
          </ul>
        </div>
      </div>
    </nav>
    <br><br><br><br>

     <title>reCAPTCHA demo: Simple page</title>

     <!--<script src="https://www.google.com/recaptcha/api.js" async defer></script>-->
     <script src='https://www.google.com/recaptcha/api.js'></script>

  </head>
  <body>
    <div class="row">
    <div class="col-md-3 col-md-offset-2">
    <h3>Please complete the validation process:</h3>
    <form action="?" method="POST">
      <div class="g-recaptcha" data-theme="dark" data-sitekey="6LfK5wUTAAAAAN7CE-vB3ddApfbi3Fc--ptvF-r4"></div>
      <br>
      <input type="submit" name="submit" value="Submit">
      
    </form>
    </div>
    </div>
  </body>
</html>

<?php 
  
  echo $_SERVER['REMOTE_ADDR'];
  /* Resources: http://codeforgeek.com/2014/12/google-recaptcha-tutorial/
    http://www.stepblogging.com/how-to-integrate-google-new-recaptcha-using-php/
    http://www.codediesel.com/security/integrating-googles-new-nocaptcha-recaptcha-in-php/
    https://developers.google.com/recaptcha/docs/verify
    {
      "success": false,
      "error-codes": [
        "missing-input-response",
        "missing-input-secret"
    }
  */
  
   $captcha=$_POST['g-recaptcha-response'];

      echo $captcha;
  
  if(isset($_POST['submit']))
  {
    
      echo 'in post submit';
      //$captcha=$_POST['g-recaptcha-response'];
      //echo $captcha;

      $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfK5wUTAAAAAKPVK45_9y3wqBim7Fx4LL4mpubm&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
      //$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfK5wUTAAAAAKPVK45_9y3wqBim7Fx4LL4mpubm&response=".$captcha."&remoteip=http://wsdl-docker.cs.odu.edu:60283");

     $curl_init = curl_init();
     curl_setopt($curl_init, CURLOPT_URL, $response);
     curl_setopt($curl_init, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($curl_init, CURLOPT_TIMEOUT, 15);
     curl_setopt($curl_init, CURLOPT_SSL_VERIFYPEER, true);
     curl_setopt($curl_init, CURLOPT_SSL_VERIFYHOST, true); 

     $results = curl_exec($curl_init);
     
     print_r($results);
     
     if ($results != false)
     {
        echo 'hi';
        echo $results;
     }
     else
     {
        echo "There was an error";
        echo $results;
        echo curl_error($curl_init);
     }
     
     $newresults= json_decode($results, true);

     if($newresults['success'])
     {
      echo "Valid reCAPTCHA code. You are human.";
     }

     else
     {
     echo "Invalid reCAPTCHA code.";
     }
     curl_close($curl_init);
  }

  else
  {
    echo "Please re-enter your reCAPTCHA.";
  }

 

  

?>


<?php
session_start();

?>

<!--This is registration Page-->
<!--Creat a button for redirection to login page if the user has already logged registered-->
<!DOCTYPE html>
<html>
	<head>
	  <title>HTM_Registration</title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	  <script src="script.js"></script>
	</head>
<body>

<div class="container">
  <h2>Sign Up</h2>
  <form method ="post" action="register.php">

    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
    </div>
	
	<div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" required>
    </div>
	
	<div class="form-group">
      <label for="pwd">Confirm Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" required>
    </div>

<script type="text/javascript">
    function Validate() {
        var password = document.getElementById("txtPassword").value;
        var confirmPassword = document.getElementById("txtConfirmPassword").value;
        if (password != confirmPassword) {
            alert("Passwords do not match.");
            return false;
        }
        return true;
    }
</script>

    <div class="form-group">
      <label for="name">Username:</label>
      <input type="name" class="form-control" id="name" placeholder="Enter Username" name="name" required>
    </div>
    
    <div class="form-group">
     <label for="quali">Qualification:</label>
     <input type="text" class="form-control" name="quali" id="quali" placeholder="eg. Grade 12 student" required>
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
    <br>
  <div class="sgn">
Already Registered ? <a href="login_page.html" class="signup">Sign in Here</a>
  </div>
  </div>
</body>

</html>

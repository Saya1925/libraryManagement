<?php
session_start();
$_SESSION = array();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
<title>LogIn/REGISTER</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>

<img src="img/libraryTop.PNG" width="1000" height="300">
<h1>Welcome to Digital Library</h1>



<!--Register-->
<h3>Sign up here!</h3>
<section><div>
<form method="post" action="signUp.php" >
<p>Select your type: 
	<select id="type" name="type">
		<option value="librarian">librarian</option>
		<option value="borrower">borrower</option>
	</select><br>
<p><input type="text" name="name" placeholder="Firstname" />
<p><input type="text" name="surname" placeholder="Lastname"/></p>
<p><input type="text" name="phone" placeholder="phone"/></p>
<input type="text" name="email" placeholder="email"/></p>
<p><input type="password" name="password" placeholder="password (6characters)"/></p>
<p><input type="password" name="password2" placeholder="confirm password"/></p>
<input type="reset" name="reset" value="Reset" />
<input type="submit" name="submit" value="Register" />
</form></div></section>


<!--Login-->
<h3>Login</h3>
<section><div>
<form method="post" action="loginVerify.php" >
<p>Select your type: 
	<select name="type">
		<option value="librarian">librarian</option>
		<option value="borrower">borrower</option>
	</select><br>
<p><input type="text" name="email" placeholder="email"/></p>
<p><input type="password" name="password" placeholder="password (6characters)"/></p>
<input type="reset" name="reset" value="Reset" />
<input type="submit" name="submit" value="Log In" />
</form></div></section><br>



</body>
</html>

<?php
//$Body = "";
$errors = 0;
$email = "";
$result = "";


if (empty($_POST['email'])) {
	++$errors;
	echo "<p>You need to enter an e-mail address.</p>\n";
	}
else {
	$email = stripslashes($_POST['email']);
	//if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $email) == 0) {
	if (preg_match("/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)*(\.[a-z]{2,3})$/i", $email) == 0) {
		
		++$errors;
		echo "<p>You need to enter a valid " . "e-mail address.</p>\n";
		$email = "";
	}
}

if (empty($_POST['password'])) {
	++$errors;
	echo "<p>You need to enter a password.</p>\n"; 
	$password = "";
}
else
	$password = stripslashes($_POST['password']);

if (empty($_POST['password2'])) {
	++$errors;
	echo "<p>You need to enter a confirmation password.</p>\n";
	$password2 = "";
}
else
	$password2 = stripslashes($_POST['password2']);

if ((!(empty($password))) && (!(empty($password2)))) {
	if (strlen($password) < 6) {
		++$errors;
		echo "<p>The password is too short.</p>\n";
		$password = "";
		$password2 = "";
	}
	if ($password <> $password2) {
		++$errors;
		echo "<p>The passwords do not match.</p>\n";
		$password = "";
		$password2 = "";
	}
}

if ($errors == 0) {
	include ("includes/inc_dbconnect.php");
	if ($conn === FALSE) {
		echo "<p>Unable to connect to the database server. " . "Error code " . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p>\n";
		++$errors;
	}
	else {
		if ($result === FALSE) {
			echo "<p>Unable to select the database. " . "Error code " . mysqli_errno($conn) . ": " . mysqli_error($conn) . "</p>\n";
			++$errors;
		}
	}
}


if ($errors == 0) {
	$sql = "SELECT count(*) FROM person where Email='" . $email . "'";
	$qRes = mysqli_query($conn, $sql);
	if ($qRes != FALSE) {
		$Row = mysqli_fetch_row($qRes);
		if ($Row[0]>0) {
			echo "<p>The email address entered (" . htmlentities($email) . ") is already registered.</p>\n";
			++$errors;
		}
	}
}
if ($errors > 0) {
	echo "<p>Please use your browser's BACK button to return" . " to the form and fix the errors indicated.</p>\n";
}

if ($errors == 0) {
	$name = stripslashes($_POST['name']);
	$surname = stripslashes($_POST['surname']); 
	$type = stripslashes($_POST['type']);
	$phone = stripslashes($_POST['phone']);

	if ($type=="borrower")
	{
		$sql = "INSERT INTO person " . " (Name, Surname, Phone, Email, Type, Password_md5) " . " VALUES( '$name', '$surname', '$phone', '$email', 'borrower', " . " '" . md5($password) . "')";
		$qRes = mysqli_query($conn, $sql);	
	}
	else
	{
		$sql = "INSERT INTO person " . " (Name, Surname, Phone, Email, Type, Password_md5) " . " VALUES( '$name', '$surname', '$phone', '$email', 'librarian', " . " '" . md5($password) . "')";
		$qRes = mysqli_query($conn, $sql);	
	}
		
	if ($qRes === FALSE) {
		echo "<p>Unable to save your registration " . " information. Error code " . mysqli_errno($conn) . ": " . mysqli_error($conn) . "</p>\n";
		++$errors;
	}
	else {
		$UserID = mysqli_insert_id($conn);
		$_SESSION['UserID'] = $UserID;
	}
	mysqli_close($conn);
}
if ($errors == 0) {
	$Name = $name . " " . $surname;
	echo "<p>Thank you, $Name. ";
	echo "Your new user ID is <strong>" . $_SESSION['UserID'] . "</strong>.</p>\n";
}

?>

</body>
</html>

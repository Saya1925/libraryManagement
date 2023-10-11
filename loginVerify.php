<?php
session_start();

$body = "";
$errmsg = "";
$errors = 0;
$email = "";
$password = "";
$type = "";


try {
	include ("includes/inc_dbconnect.php");
	$type = $_POST['type'];


	$sql = "SELECT * FROM person WHERE Email='" . stripslashes($_POST['email']) ."' and 
			Password_md5='" . md5(stripslashes($_POST['password'])) . "'and Type='".$type."'";
	$qRes = mysqli_query($conn, $sql);
	
	//Check the user information has already taken or not
	if (mysqli_num_rows($qRes)==0) 
	{
		$errmsg;
		++$errors;
	}
    //When password and email are correct
	else 
	{
		while($Row = mysqli_fetch_array($qRes))
		{
			$UserID = $Row['UserID'];
			$Name = $Row['Name'] . " " . $Row['Surname'];
			$body = "<p>Welcome back, $Name!</p>\n";
			$_SESSION['UserID'] = $UserID;
		}    
	}
}
//DB connect error
catch(mysqli_sql_exception $e) 
{
	$errmsg =  "<p>Error: unable to connect/insert record in the database.</p>";
		++$errors;
}		

if ($errors > 0) {
	$errmsg .=  "<p>Incorrect information entered. </p>";
	$errmsg .=  "<p>Please use your browser's BACK button to return " . " to the form.</p>\n";
}
if ($errors == 0) {

		if ($type=="borrower")
		{
			?>
			<script type="text/javascript">window.location.href="borrower/BorrowerPage.php"</script>
			<?php
		}
		else
		{
			?>
			<script type="text/javascript">window.location.href="librarian/librarianPage.php"</script>
			<?php
		}	

		/*$body .=  "<form method='post' " . " action='librarianClick?" . SID . "'>\n";
		$body .=  "<input type='submit' name='submit' " . " value='View the available resources'>\n";
		$body .=  "</form>\n";*/ 
}
?>



<!DOCTYPE html>
<html>
<head>
<title>Login Verify</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<h1>Digital Library</h1>
<h2>Login Verify</h2></body>
</html>

<?php echo $body; ?>
<?php echo $errmsg; ?>

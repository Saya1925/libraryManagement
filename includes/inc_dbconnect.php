<?php
try{
	$conn = mysqli_connect("localhost", "root", "sm595", "library");

}
catch (mysqli_sql_exception $e) {
	die("Connection failed: ".mysqli_connect_errno()."-".mysqli_connect_error());
}

?>


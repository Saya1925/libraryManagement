<?php
try
{
	$conn = new mysqli("localhost", "root", "sm595", "library");
	return $conn;
}
catch (mysqli_sql_exception $e) 
{
	die($e->getCode().":".$e->getMessage());
}
?>


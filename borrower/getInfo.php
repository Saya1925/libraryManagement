<?php
include ("../includes/inc_dbconnect.php");

$q = $_GET["q"];

//Search by a Combination of Title, ISBN, Author, or Status
$sql = "SELECT * FROM Resource WHERE Title LIKE '%".$q."%' OR 
Author LIKE '%".$q."%' OR ISBN10 LIKE '%".$q."%' OR Status LIKE '%".$q."%'";

$qRes = mysqli_query($conn, $sql);


?>

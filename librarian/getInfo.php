<?php
include ("..includes/inc_dbconnect/php");

$q = $_GET["q"];

$sql = "SELECT * FROM Resources WHERE title LIKE '%".$q."%'";
$qRes = mysqli_query($conn, $sql);
$a="";
while (($Row = mysqli_fetch_assoc($qRes)) != FALSE) {
    $a .= $Row["title"].$Row["isbn"].$Row["author"];
}
echo $a;
?>

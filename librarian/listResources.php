<!DOCTYPE html>
<html>
<head>
<title>Librarian</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<h1>Librarian only</h1>
</body>
</html>

<?php
session_start();

include ("../includes/inc_dbconnect.php");

//Displat available resources only
if (isset ($_POST['availableList']))
{
	
	echo "<b><font size=5>Available list: </font></b>";
	$sql = "SELECT * FROM resource where Status = 'available'";
	$qRes = mysqli_query($conn,$sql);
	echo "<table border='1' width='100%'>\n";
	echo "<tr><th style='background-color:#FFCC00'>Book No.</th>\n";
	echo "<th style='background-color:#FFCC00'>ISBN10</th>\n";
	echo "<th style='background-color:#FFCC00'>Title</th>\n";
	echo "<th style='background-color:#FFCC00'>Author</th>\n";
	echo "<th style='background-color:#FFCC00'>Publisher</th>\n";
	echo "<th style='background-color:#FFCC00'>Status</th>\n";
	echo "<th style='background-color:#FFCC00'>Cost per day($)</th></tr>\n";
	while ($Row = mysqli_fetch_row($qRes)) 
	{
		echo "<tr><td align='center'>{$Row[0]}</td>";
		echo "<td align='center'>{$Row[1]}</td>\n";
		echo "<td align='center'>{$Row[2]}</td>\n";
		echo "<td align='center'>{$Row[3]}</td>\n";
		echo "<td align='center'>{$Row[4]}</td>\n";
		echo "<td align='center'>{$Row[5]}</td>\n";
		echo "<td align='center'>{$Row[6]}</td></tr>\n";
	}
	echo "</table>\n";
}


//Displat unavailable resources only
if (isset ($_POST['lendingList']))
{
	echo "<b><font size=5>Lending list: </font></b>";
	$sql = "SELECT * FROM resource where Status = 'lending'";
	$qRes = mysqli_query($conn,$sql);
	echo "<table border='1' width='100%'>\n";
	echo "<tr><th style='background-color:#FFCC00'>Book No.</th>\n";
	echo "<th style='background-color:#FFCC00'>ISBN10</th>\n";
	echo "<th style='background-color:#FFCC00'>Title</th>\n";
	echo "<th style='background-color:#FFCC00'>Author</th>\n";
	echo "<th style='background-color:#FFCC00'>Publisher</th>\n";
	echo "<th style='background-color:#FFCC00'>Status</th>\n";
	echo "<th style='background-color:#FFCC00'>Cost per day($)</th></tr>\n";
	while ($Row = mysqli_fetch_row($qRes)) 
	{
		echo "<tr><td align='center'>{$Row[0]}</td>";
		echo "<td align='center'>{$Row[1]}</td>\n";
		echo "<td align='center'>{$Row[2]}</td>\n";
		echo "<td align='center'>{$Row[3]}</td>\n";
		echo "<td align='center'>{$Row[4]}</td>\n";
		echo "<td align='center'>{$Row[5]}</td>\n";
		echo "<td align='center'>{$Row[6]}</td></tr>\n";
	}
	echo "</table>\n";


	
	
}


?>

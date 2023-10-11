<?php
session_start();

$UserID = $_SESSION['UserID'];
$Body = "";
$Body2 = "";
include("../includes/inc_dbconnect.php");

try
{
	//Display user borrowing list
	
	$sql = "SELECT * FROM resource WHERE BookNo IN (SELECT BookNo
			from record WHERE Status = 'borrowing' AND UserID = $UserID)";
	$qRes = mysqli_query($conn, $sql);
	$Body .= "<table border='1' width='100%'>\n";
	$Body .= "<tr><th style='background-color:#FFCC00'>Book No.</th>\n";
	$Body .= "<th style='background-color:#FFCC00'>ISBN10</th>\n";
	$Body .= "<th style='background-color:#FFCC00'>Title</th>\n";
	$Body .= "<th style='background-color:#FFCC00'>Author</th>\n";
	$Body .= "<th style='background-color:#FFCC00'>Publisher</th>\n";
	$Body .= "<th style='background-color:#FFCC00'>Cost per day($)</th></tr>\n";
	while ($Row = mysqli_fetch_row($qRes)) 
	{
		$Body .= "<tr><td align='center'>{$Row[0]}</td>";
		$Body .= "<td align='center'>{$Row[1]}</td>\n";
		$Body .= "<td align='center'>{$Row[2]}</td>\n";
		$Body .= "<td align='center'>{$Row[3]}</td>\n";
		$Body .= "<td align='center'>{$Row[4]}</td>\n";
		$Body .= "<td align='center'>{$Row[6]}</td></tr>\n";
	}
	$Body .= "</table>\n";
}
catch (mysqli_sql_exception $e)
{
	die ("Error: ".mysqli_error($conn));
}

try
{
	//Display user borrowed list
	$sql2 = "SELECT * FROM resource WHERE BookNo IN (SELECT BookNo
			from record WHERE Status = 'borrowed' AND UserID = $UserID)";
	$qRes2 = mysqli_query($conn, $sql2);
	$Body2 .= "<table border='1' width='100%'>\n";
	$Body2 .= "<tr><th style='background-color:#FFCC00'>Book No.</th>\n";
	$Body2 .= "<th style='background-color:#FFCC00'>ISBN10</th>\n";
	$Body2 .= "<th style='background-color:#FFCC00'>Title</th>\n";
	$Body2 .= "<th style='background-color:#FFCC00'>Author</th>\n";
	$Body2 .= "<th style='background-color:#FFCC00'>Publisher</th>\n";
	$Body2 .= "<th style='background-color:#FFCC00'>Cost per day($)</th></tr>\n";
	while ($Row = mysqli_fetch_row($qRes2)) 
	{
		$Body2 .= "<tr><td align='center'>{$Row[0]}</td>";
		$Body2 .= "<td align='center'>{$Row[1]}</td>\n";
		$Body2 .= "<td align='center'>{$Row[2]}</td>\n";
		$Body2 .= "<td align='center'>{$Row[3]}</td>\n";
		$Body2 .= "<td align='center'>{$Row[4]}</td>\n";
		$Body2 .= "<td align='center'>{$Row[6]}</td></tr>\n";
	}
	$Body2 .= "</table>\n";
}
catch (mysqli_sql_exception $e)
{
	die ("Error: ".mysqli_error($conn));
	
}

mysqli_close($conn);

?>

<h1>Your record</h1>

<h2></h2>
<b>Currently Borrowing List:</b>
<?php echo $Body; ?>

<h3></h3>
<b>Borrowed List:</b>
<?php echo $Body2; ?>
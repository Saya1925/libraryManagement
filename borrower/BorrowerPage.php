<?php

session_start();
include("../includes/inc_dbconnect.php");

$Body = "";
$Body2 = "";
$errors = 0;
$items = 0;
$total = 0;
$shoppingCart = array();
$resource = array();


//Display All available resources 
$sql = "SELECT * FROM resource where Status = 'available'";
$qRes = mysqli_query($conn,$sql);
$Body .= "<table border='1' width='100%'>\n";
$Body .= "<tr><th style='background-color:#FFCC00'>Book No.</th>\n";
$Body .= "<th style='background-color:#FFCC00'>ISBN10</th>\n";
$Body .= "<th style='background-color:#FFCC00'>Title</th>\n";
$Body .= "<th style='background-color:#FFCC00'>Author</th>\n";
$Body .= "<th style='background-color:#FFCC00'>Publisher</th>\n";
$Body .= "<th style='background-color:#FFCC00'>Cost per day($)</th>\n";
$Body .= "<th style='background-color:#FFCC00'># in Cart</th>\n";
$Body .= "<th style='background-color:#FFCC00'>Total Price($)</th>\n";
$Body .= "<th style='background-color:#FFCC00'>&nbsp;</th></tr>\n";
while ($Row = mysqli_fetch_row($qRes)) 
{
	$Body .= "<tr><td align='center'>{$Row[0]}</td>";
	$Body .= "<td align='center'>{$Row[1]}</td>\n";
	$Body .= "<td align='center'>{$Row[2]}</td>\n";
	$Body .= "<td align='center'>{$Row[3]}</td>\n";
	$Body .= "<td align='center'>{$Row[4]}</td>\n";
	$Body .= "<td align='center'>{$Row[6]}</td>\n";

	$Body .= "<td align='center'>$items</td>\n";
	$Body .= "<td align='center'>$total</td>\n";
	$Body .= "<td><a href='" . $_SERVER['SCRIPT_NAME'] . "?PHPSESSID=" . session_id()."'>Add"."Item</a></td>\n";

	
}	
	/*
	$addItem = $_POST['addItem'];
	
	$items = 1; /*$shoppingCart[$ID];

	$total = $item * intval($Row[6]);
	echo "<td class='currency'>" . $this->shoppingCart[$ID] . "</td>\n";
				$value = $Info['price']*$this->shoppingCart[$ID];/*

}
$Body .= "</table>\n";*/



/////////incomplete/////////
function SearchResource() 
{
	if (isset ($_POST['Search']))
	{		
		include("getInfo.php");
		/*$a="";*/
		while (($Row = mysqli_fetch_row($qRes)) != FALSE) 
		{
			/*$a .= $Row["Title"].$Row["ISBN10"].$Row["Author"].$Row["Status"];*/
			
			$Body2 .= "<table border='1' width='100%'>\n";
			$Body2 .= "<tr><th style='background-color:#FFCC00'>Book No.</th>\n";
			$Body2 .= "<th style='background-color:#FFCC00'>ISBN10</th>\n";
			$Body2 .= "<th style='background-color:#FFCC00'>Title</th>\n";
			$Body2 .= "<th style='background-color:#FFCC00'>Author</th>\n";
			$Body2 .= "<th style='background-color:#FFCC00'>Publisher</th>\n";
			$Body2 .= "<th style='background-color:#FFCC00'>Cost per day($)</th>\n";
			$Body2 .= "<th style='background-color:#FFCC00'>&nbsp;</th></tr>\n";

			while ($row = mysqli_fetch_row($qRes)) 
			{
				$Body2 .= "<tr><td align='center'>{$Row[0]}</td>";
				$Body2 .= "<td align='center'>{$Row[1]}</td>\n";
				$Body2 .= "<td align='center'>{$Row[2]}</td>\n";
				$Body2 .= "<td align='center'>{$Row[3]}</td>\n";
				$Body2 .= "<td align='center'>{$Row[4]}</td>\n";
				$Body2 .= "<td align='center'>{$Row[6]}</td>\n";
				$Bod2y .= "<td align='center'>{$Row[7]}</td>\n";
				$Body2 .= "<td><a href='" . $_SERVER['SCRIPT_NAME'] . "?PHPSESSID=" . session_id() . "&ItemToAdd='>Add " . " Item</a></td>\n";
			}
			$Body2 .= "</table>\n";	
		}	
	}
}

						

/*
function addItem() 
{
	$BookID = $_GET['ItemToAdd'];
	if (array_key_exists($BookID, $shoppingCart))
	{
		$shoppingCart[$BookID] += 1;
	}
}
*/

?>



<!DOCTYPE html>
<html>
<head>
<title>Borrower Only</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<script>
function showHint(str) {
    if (str.length == 0) { 
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "gethint.php?q=" + str, true);
        xmlhttp.send();
    }
}
</script>
</head>

<body>


<h1>Borrower Page</h1>
<!--Search a resource-->
<font size="4"><b>Search a resource</b></font>

<form method="post" action="BorrowerPage.php" >
<input type="text" name="Title" placeholder="Book Title" onkeyup="showHint(this.value)">&emsp;Suggestions:<span id="txtHint"></span><br></div>
<input type="text" name="ISBN10" placeholder="ISBN10"><br>
<input type="text" name="Author" placeholder="Author"><br>
Status: <select id="status" name="Status">
			<option value="available">available</option>
			<option value="lending">lending</option>
		</select><br>
<input type="reset" value="Clear" />&nbsp;
<input type="submit" name="Search" value="Search" /></p>
<?php echo $Body2; ?>

<!--List the resources that he/she has borrowed-->
<!--List currently borrowing-->
<a href ="borrowerRecord.php">Check your record</a><br><br>


<!--List Available Resources-->
<b><font size="4">All Available Resources Information</font></b>
<?php echo $Body; ?>

<br>
<a href ="LibraryLogin.php">Log out</a>

</body>
</html>
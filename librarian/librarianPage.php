<?php

$Body = "";
$Body2 = "";
$ISBN10 = "";
$BookNo = "";
$Errmsg="";
$Errmsg2="";
$errors = 0;	
include("librarian.classes.php");

	
//Check whether the input date are correct when the user click 'Add'
if (isset($_POST['insert']))
{

	$ISBN10 = trim($_POST['ISBN10']);
	$Title2 = trim($_POST['Title2']);
	$Author= trim($_POST['Author']);
	$Publisher = trim($_POST['Publisher']);
	$Status = trim($_POST['Status']);
	$Cost = trim($_POST['Cost']);
	
	if (empty($ISBN10) && empty($Title2) && empty($Author) && empty($Publisher) && empty($Status)
		&& empty($Cost))
	{
		$Errmsg = "Please enter all data indicated.";
		++$errors;
	}
	
	//instantiation class librarian
	$librarian = new librarian();
	$librarian->insertResource($ISBN10, $Title2, $Author, $Publisher, $Status, $Cost);
}

		
//Check whether the input data is correct when the user click 'Change Status'
if (isset($_POST['change']))
{

	$BookNo = $_POST['BookNo'];		
	
	if (empty($BookNo))
	{
		$Errmdg2 = "Please enter Book No.";
		++$errors;
	}
	if (!(preg_match('/^[0-9]{6}$/', $BookNo)))
	{	
		$Errmdg2 = "Please enter 6 digit numbers";
		++$errors;
	}
	
	$librarian = new librarian();
	$librarian->changeStatus($BookNo);
}

?>


<!---------HTML-------------->
<!DOCTYPE html>
<html>
<head>
<title>Librarian Only</title>
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
<h1>Librarian Only</h1>
<!--Search a resource-->
<section><div>
<font size="4"><b>Search a resource</b></font>
<form method="post" action="librarianPage.php" >
<input type="text" placeholder="Book Title" onkeyup="showHint(this.value)">&emsp;Suggestions:<span id="txtHint"></span><br>
<input type="text" placeholder="ISBN10" onkeyup="showHint(this.value)"><br>
<input type="text" placeholder="Author" onkeyup="showHint(this.value)"><br>
Status: <select id="status" name="status">
	<option value="available">available</option>
	<option value="lending">lending</option>
</select><br>
<input type="reset" value="Clear" />&nbsp;
<input type="submit" name="search" value="Search" /></p>
</div></section>

<!--Insert a resource-->
<section><div>
<b><font size="4">Add a resource: </font><br></b>
<input type="text" name="ISBN10" placeholder="ISBN10"/><br>
<input type="text" name="Title2" placeholder="Book Title"/><br>
<input type="text" name="Author" placeholder="Author"/><br>
<input type="text" name="Publisher" placeholder="Publisher"/><br>
<input type="text" name="Cost" placeholder="Cost per day"/><br>
<input type="text" name="ExtendedCost" placeholder="Extended Cost per day"/><br>
Status: <select id="status" name="Status">
			<option value="available">available</option>
			<option value="lending">lending</option>
		</select><br>
<input type="reset" value="Clear" />&nbsp;
<input type="submit" name="insert" value="Add" />
</div></section>
<font color="red"><?php echo $Body;?></font>
<font color="red"><?php echo $Errmsg;?></font>
<br><br>


<!--change status of a resource-->
<section><div>
<b><font size="4">Change status of a resource: </font></b><br>
<input type="text" name="BookNo" placeholder="Book No."/><br>
<input type="reset" value="Clear" />&nbsp;
<input type="submit" name="change" value="Change Status" /></p>
</div></section>
<font color="red"><?php echo $Body2; ?></font>
<font color="red"><?php echo $Errmsg2;?></font>
</form><br>


<b><font size="4">All Resources Information</font></b>

<!--List Available Resources-->
<form method="post" action="listResources.php" >
<font size="3">See the AVAILABLE resources only:</font> 
<input type="submit" name="availableList" value="Click" />&emsp;
<!--List Unvailable Resources-->
<font size="3">See the LENDING resources only: </font>
<input type="submit" name="lendingList" value="Click" />
</form><br>

<!--Display ALL resources resgistered-->
<?php 
	$librarian = new librarian();
	$librarian -> viewAllResources();	
?>
<br>
<a href ="../LibraryLogin.php">Log out</a>

</body>
</html>
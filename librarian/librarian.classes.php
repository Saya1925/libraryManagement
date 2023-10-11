<?php
session_start();


class librarian 
{
	//data member
	private $conn = NULL;
	private $BookNo = "";
	private $Status ="";
	private $ISBN10 ="";

	
	//member function definitions
	public function __construct() 
	{
		include("../includes/inc_dbconnect2.php");
		$this->conn = $conn;
	}
	
	//Display all resrouces
	public function viewAllResources()
	{
		$sql = "SELECT * FROM resource";
		$qRes = $this->conn->query($sql);
		echo "<table border='1' width='100%'>\n";
		echo "<tr><th style='background-color:#FFCC00'>Book No.</th>\n";
		echo "<th style='background-color:#FFCC00'>ISBN10</th>\n";
		echo "<th style='background-color:#FFCC00'>Title</th>\n";
		echo "<th style='background-color:#FFCC00'>Author</th>\n";
		echo "<th style='background-color:#FFCC00'>Publisher</th>\n";
		echo "<th style='background-color:#FFCC00'>Status</th>\n";
		echo "<th style='background-color:#FFCC00'>Cost per day($)</th></tr>\n";
		while ($Row = $qRes->fetch_row()) 
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
	

	///////////Incomplete/////////
	///Insert a resource entered
	public function insertResource ($ISBN10, $Title2, $Author, $Publisher, $Status, $Cost)
	{	
		$errors="";
		if($errors == 0)
		{		
			try
			{
				$sql = "SELECT * FROM resource WHERE ISBN10 = '".$ISBN10."'";
				$qRes = $this->conn->query($sql);
					
				//if the input resource does not exist in the system, the user can insert the resource
				if (($row = $qRes->fetch_row()) != FALSE)
				{
					$stmt = $this->conn->prepare
					("INSERT INTO resource (ISBN10, Title, Author, Publisher, Status, Cost_per_day)
					VALUES (?, ?, ?, ?, ?, ?, ?)");
					
					$stmt->bind_param("issssi", $ISBN10, $Title2, $Author, $Publisher, $Status, $Cost);
					
					$stmt->execute();
					$new_id = $this->conn->insert_id;
					$Body = "<p>Resource entered has been registered now. The book No. is ". $new_id. ".</p>\n";
				}
				else
				{
					$Body = "<p>The input resource has alredy taken.</p>";
				}
			}
			catch (mysqli_sql_exception $e)
			{
				$this->ISBN10= "";
			}
		}
	}

	///////////Incomplete/////////
	//Change status 'available' => 'lending' or 'lending' => 'available'
	public function changeStatus()
	{
		$errors="";
		if ($errors == 0)
		{
			try
			{
				//Change status 'available' into 'lending'.
				$sql = "UPDATE resource SET Status='lending' WHERE BookNo = '".$this->BookNo."' AND Status = 'available'";
				$qRes = $this->conn->query($sql);
				
				//Change status 'lending' into 'available'.
				$sql2 = "UPDATE resource SET Status='available' WHERE BookNo = '".$this->BookNo."' AND Status = 'lending'";
				$qRes2 = $this->conn->query($sql2);
				
				$Body2 = "<p>The Status of input resorce is changed.</p>\n";
			}
			catch (mysqli_sql_exception $e)
			{
			}
		}
	}
	

	///////////Incomplete/////////
	//Search a resource
	
	public function SearchResource() 
	{
		if (isset ($_POST['search']))
		{
		}		
	}


	//recreate connection with DB
	function __wakeup() 
	{
		include("inc_debconnect2.php");
		$this->conn = $conn;
	}

	function __destruct() 
	{
		$this->conn->close();
	}


}


	
?>


<?php
ini_set('display_errors',1);ini_set('display_startup_errors',1);error_reporting(-1);
require_once('whois/whois.php');


if(isset($_GET['type']))
	define('Status', $_GET['type']);
else
{
	echo "I am so sorry!";
	exit();
}

// define('Status', 'show');
// define('Status', 'add_to_db');
// define('Status', 'check_whois');


// serever db data
$servername = "localhost";
$username   = "ermile";
$password   = "ermile@#$567";
$dbname     = "whoischecker";
$res        = array();
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


echo '<html><body>';
echo "<style>table, th, td {margin: 0 auto;border: 1px solid black;border-collapse: collapse;}th, td {padding:2px 15px;}</style>";
echo '<table>';
echo '<tr>';
echo '<th>Row id</th>';
echo '<th>Domain</th>';
echo '<th>Status</th>';
echo '</tr>';

if(Status == 'show')
{
	showtable($conn);
}
else
{
	$res  = getnames($conn);
	if(isset($_GET['count']))
		$mycount = $_GET['count'] == 'all'? count($res)-1: $_GET['count'];
	else
		$mycount = 10;
	$mystart = isset($_GET['start'])? $_GET['start']: 0;

	$res2 = checkwhois($conn, $res, $mystart , $mycount);
}

echo '</table>';
echo '</body></html>';

$conn->close();





// check wois status
function checkwhois($_conn, $_res, $_start = null, $_period = null)
{
	$mylist = array();
	if( Status == 'auto')
		$mylist = showtable($_conn, false, false);

	else
		// create a new little list for check
		for ($i=$_start; $i < $_start + $_period; $i++)
			$mylist[$_res[$i]] = null;


	if(Status == 'check_whois')
	{
		// create a loop for whois domains
		foreach ($mylist as $key => $value)
		{
			$mydomain = null;
			$mydomain = new Whois($key.'.ir');
			$myresult = array();
			echo '<tr>';
			echo '<td> </td>';
			echo '<td>'.$key.'</td>';

			if ($mydomain && $mydomain->isAvailable())
				$myresult[$key] = 'available' ;
			else
				$myresult[$key] = 'taken' ;

			echo '<td>'.$myresult[$key].'</td>';
			echo '</tr>';

			// add in db
			$sql = "UPDATE ir SET status='".$myresult[$key]."' where name = '$key';";

			if ($_conn->query($sql) !== TRUE)
				echo "Error: " . $sql . "<br>" . $_conn->error;
			// else
			// 	echo "New record to db successfully";
		}
	}
}


// create names of domain and add to db
function getnames($_conn)
{
	$allowchar = '23456789ABCDEFHJKLMNPRTVWXYZ';
	$myresult  = array();

	// Create names
	for ($i=0; $i <strlen($allowchar) ; $i++) { 
		for ($j=0; $j <strlen($allowchar) ; $j++) { 
			for ($k=0; $k <strlen($allowchar) ; $k++) { 
				$mydom    = substr($allowchar, $i,1). substr($allowchar, $j,1) .substr($allowchar, $k,1);
				array_push($myresult,$mydom);
			}
		}
	}
	echo ('<h2>'.count($myresult).' domain</h2>');


	// add to db
	if(Status == 'add_to_db')
	{
		$sql   = "INSERT INTO ir (rowid, name) VALUES ";

		// create a loop for add in db
		foreach ($myresult as $key => $value)
			$sql .= "('".$key."', '".$value."'), ";
		$sql = substr($sql, 0, -2);

		if ($_conn->query($sql) === TRUE)
			echo "New record to db successfully";
		else
			echo "Error: " . $sql . "<br>" . $_conn->error;
	}

	return $myresult;
}


// show result for viewer
function showtable($_conn, $_show = true, $_notnull = true)
{
	$sql               = "Select * from ir where status ";
	if($_notnull)
		$mycond            = isset($_GET['status'])? "='".$_GET['status']."'": 'is not NULL';
	else
		$mycond            = isset($_GET['status'])? "='".$_GET['status']."'": 'is NULL';

	$sql               = $sql. $mycond;
	
	$myresult          = $_conn->query($sql);
	$mydata            = array();

	$mycount           = 0;
	$mycount_available = 0;
	$mycount_taken     = 0;
	while($row = $myresult->fetch_array())
	{
		$mydata[$row['name']] = $row['status'];
		$mycount           += 1;
		$mycount_available += $row['status']=='available'? 1: 0;
		$mycount_taken     += $row['status']=='taken'?     1: 0;

		if($_show)
		{
			echo '<tr>';
			echo '<td>'.$row['rowid'].'</td>';
			echo '<td>'.$row['name'].'</td>';
			echo '<td>'.$row['status'].'</td>';
			echo '</tr>';

			if(($row['rowid']+1)%500 == 0)
			{
				echo '<td style="border:none;background-color:#ccc; height:50px"></td>';
				echo '<td style="border:none;background-color:#ccc; height:50px"></td>';
				echo '<td style="border:none;background-color:#ccc; height:50px"></td>';
			}
		}
	}

	echo 'No of Doamins: <b>'.$mycount.'</b><br/>';
	echo 'Available: <b>'.$mycount_available.'</b><br/>';
	echo 'Taken: <b>'.$mycount_taken.'</b><br/>';

	return $mydata;
}
?>
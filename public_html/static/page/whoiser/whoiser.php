<?php
ini_set('display_errors',1);ini_set('display_startup_errors',1);error_reporting(-1);
require_once('whois/whois.php');

define('Status', 'show');
// define('Status', 'add_to_db');
// define('Status', 'check_whois');

// fix for local and web
// $host = parse_url($_SERVER['SERVER_NAME']);
// preg_match('/(.*?)((\.co)?.[a-z]{2,4})$/i', $host['path'], $m);
// $tld = isset($m[2]) ? $m[2]: '';
// $tld = substr($tld, 1);

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
echo "<style>table, th, td {margin: 0 auto;border: 1px solid black;border-collapse: collapse;}th, td {padding: 15px;}</style>";
echo '<table>';
echo '<tr>';
echo '<th>Domain</th>';
echo '<th>Status</th>';
echo '</tr>';

$res = getnames($conn);
$res2 = checkwhois($conn, $res, 0 , 1);

echo '</table>';
echo '</body></html>';

$conn->close();





// check wois status
function checkwhois($_conn, $_res, $_start, $_period)
{
	// create a new little list for check
	$mylist = array();
	for ($i=$_start; $i < $_period; $i++)
		$mylist[$i] = $_res[$i];

	var_dump($mylist);

	if(Status == 'check_whois')
	{
		// create a loop for whois domains
		foreach ($mylist as $key => $value)
		{
			$mydomain    = null;
			$mydomain = new Whois($value.'.ir');
			$myresult = array();
			echo '<tr>';
			echo '<td>'.$value.'</td>';

			if ($mydomain && $mydomain->isAvailable())
				$myresult[$value] = 'available' ;
			else
				$myresult[$value] = 'taken' ;

			echo '<td>'.$myresult[$value].'</td>';
			echo '</tr>';

			// add in db
			$sql = "UPDATE ir SET status='".$myresult[$value]."' where name = '$value';";

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
?>
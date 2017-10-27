<?php
/**
 @ In the name Of Allah
**/

// if Saloos exist, require it else show related error message
if ( file_exists( '../../dash/autoload.php') )
{
	require_once( '../../dash/autoload.php');
}
else
{   // A config file doesn't exist
	echo( "<p>We can't find <b>Saloos</b>! Please contact administrator!</p>" );
	exit();
}
?>
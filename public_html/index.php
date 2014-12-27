<?php
/**
 @ In the name Of Allah
**/

// if config exist, require it else show related error message
if ( file_exists( __DIR__ . '/config.php') )
	require_once( __DIR__ . '/config.php');
else
{   // A config file doesn't exist
	echo( "<p>There doesn't seem to be a <code>config.php</code> file. I need this before we can get started.</p>" );
	exit();
}
// if Saloos exist, require it else show related error message
if ( file_exists( '../../saloos/autoload.php') )
{
	require_once( '../../saloos/autoload.php');
}
else
{   // A config file doesn't exist
	echo( "<p>We can't find <b>Saloos</b>! Please contact administrator!</p>" );
	exit();
}
?>
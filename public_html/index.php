<?php
/**
 @ In the name Of Allah
**/





/**
 * Localized Language, defaults to English.
 *
 * Change this to localize Saloos. A corresponding MO file for the chosen
 * language must be installed to content/languages. For example, install
 * fa_IR.mo to content/languages and set LANGUAGE to 'fa_IR' to enable Persian
 * language support.
 */
if(isset($_COOKIE["lang"]))
	$language = $_COOKIE["lang"];

elseif (isset($_GET["lang"]))
    $language = $_GET["lang"];

else if (isset($_SESSION["lang"]))
    $language = $_SESSION["lang"];

else 
    $language = "en_US";

// save language preference for future page requests
$_SESSION["Language"]  = $language;
// setcookie('lang',$language,time() + 30*24*60*60,'/','.'.URL_RAW);

// $domain = "messages";
// putenv("LANG=" . $language);
// setlocale(LC_ALL, $language);
// bindtextdomain($domain , 'languages/');
// bind_textdomain_codeset($domain , 'UTF-8');
// textdomain($domain);

// translator does not work!
// echo _("HELLO_WORLD");
// 

putenv("LANG=".$language);
setlocale(LC_ALL, $language);


$domain = "messages";
bindtextdomain($domain , 'Locale');
// bind_textdomain_codeset($domain , 'UTF-8');
textdomain($domain);



if(function_exists("gettext"))
{
	var_dump("yes");
}
echo gettext("test");





// if config exist, require it else show related error message
if ( file_exists( __DIR__ . '/config.php') )
	require_once( __DIR__ . '/config.php');
else
{   // A config file doesn't exist
	echo( "<p>There doesn't seem to be a <code>config.php</code> file. I need this before we can get started.</p>" );
	exit();
}

// if settings exist, require it else show related error message
if ( file_exists( __DIR__ . '/../includes/settings.php') )
	require_once( __DIR__ . '/../includes/settings.php');
else
{   // A settings file doesn't exist
	echo( "<p>There doesn't seem to be a <code>Settings.php</code> file in includes folder. Please contact administrator!</p>" );
	exit();
}

// if Saloos exist, require it else show related error message
if ( file_exists( '../../saloos/autoload.php') )
{
	// read from saloos project
	require_once( '../../saloos/autoload.php');
	new \lib\saloos;
}
else if ( file_exists( '../core/autoload.php') )
{
	// read from local core
	require_once( '../core/autoload.php');
	new \lib\saloos;
}
else
{   // A config file doesn't exist
	echo( "<p>We can't find <b>Saloos</b>! Please contact administrator!</p>" );
	exit();
}
?>
<?php
// in coming soon period show public_html/pages/coming/ folder
// developer must set get parameter like site.com/dev=anyvalue
$coming_soon = true;
if($coming_soon && isset($_GET['dev'])){
	setcookie('preview','yes',time() + 30*24*60*60,'/','.'.$_SERVER["SERVER_NAME"]);
}
elseif($coming_soon && !isset($_COOKIE["preview"])){
	header('Location: http://'.$_SERVER["SERVER_NAME"]."/static/page/coming/", true, 302);
	exit();
}


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
setcookie('lang',$language,time() + 30*24*60*60,'/','.'.$_SERVER["SERVER_NAME"]);

$domain = "messages";
putenv("LANG=" . $language);
setlocale(LC_ALL, $language);
bindtextdomain($domain , 'languages/');
bind_textdomain_codeset($domain , 'UTF-8');
textdomain($domain);

// translator does not work!
// echo _("HELLO_WORLD");

?>
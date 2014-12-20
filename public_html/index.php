<?php

if (!defined('LC_MESSAGES')) 
	{
		define('LC_MESSAGES', 6);
		var_dump("LC_MESSAGES not defined");
	}

// $lang = "en"; $locale = "en_GB";
// if (isset($_GET["lang"]) && $_GET["lang"] == "fa"){ $lang = "fa"; $locale = "fa_IR"; }
// if (isset($_GET["lang"]) && $_GET["lang"] == "de"){ $lang = "de"; $locale = "de_DE"; }


$lang = "en"; $locale = "en_US";
if(isset($_GET["lang"]))
{
	$locale =$_GET["lang"];
}

// var_dump($locale);
// var_dump( getenv('LANG'), putenv('LANG=en_GB'), getenv('LANG') );


putenv("LC_ALL=$locale"); // wrong in windows
putenv('LC_ALL='.$locale);

setlocale(LC_ALL, $locale);
setlocale(LC_MESSAGES, $locale);
bindtextdomain('messages', __DIR__ . '/locale');
textdomain("messages");


// print "”._(“hi! This website is written in English.”).”\n”;


// putenv("LC_ALL=en_US");



// bindtextdomain("messages", "./locale");
// textdomain("messages");

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=$locale?>" lang="<?=$locale?>">
<head>
	<title><?=_("Hello World!")?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
	<h1><?=_("Hi")?></h1>
	<h1><?=_("PHP Localization Benchmark")?></h1>
	
	<p><?=_("This is just a sample page to compare the various localization methods. This is just a sample page to compare the various localization methods. This is just a sample page to compare the various localization methods. This is just a sample page to compare the various localization methods. This is just a sample page to compare the various localization methods. This is just a sample page to compare the various localization methods. This is just a sample page to compare the various localization methods. This is just a sample page to compare the various localization methods. This is just a sample page to compare the various localization methods. This is just a sample page to compare the various localization methods.")?></p>

</body>
</html>

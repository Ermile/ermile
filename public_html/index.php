<?php

require_once("lib/streams.php");
require_once("lib/gettext.php");

// $lang = "en"; $locale_file = "en_US";
// if ($_GET["lang"] == "de"){ $lang = "de"; $locale_file = "de_DE"; }
// if ($_GET["lang"] == "fa"){ $lang = "fa"; $locale_file = "fa_IR"; }
// var_dump($locale_file);

$locale_file = "en_US";
if(isset($_GET["lang"]))
{
	$locale_file =$_GET["lang"];
}

$locale_file_reader = new FileReader("locale/$locale_file/LC_MESSAGES/messages.mo");
$locale_reader = new gettext_reader($locale_file_reader);

function __($text){
	global $locale_reader;
	return $locale_reader->translate($text);
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=$locale_file?>" lang="<?=$locale_file?>">
<head>
	<title><?=__("Hello World!")?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
	<h1><?=__("Hi")?></h1>
	<h1><?=__("PHP Localization Benchmark")?></h1>
	
	<p><?=__("This is just a sample page to compare the various localization methods. This is just a sample page to compare the various localization methods. This is just a sample page to compare the various localization methods. This is just a sample page to compare the various localization methods. This is just a sample page to compare the various localization methods. This is just a sample page to compare the various localization methods. This is just a sample page to compare the various localization methods. This is just a sample page to compare the various localization methods. This is just a sample page to compare the various localization methods. This is just a sample page to compare the various localization methods.")?></p>

</body>
</html>

<?php

$lang = "en"; $locale = "en_US";
if ($_GET["lang"] == "de"){ $lang = "de"; $locale = "de_DE"; }

putenv("LC_ALL=$locale");
setlocale(LC_ALL, $locale);
bindtextdomain("messages", "./locale");
textdomain("messages");

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=$lang?>" lang="<?=$lang?>">
<head>
	<title><?=_("Hello World!")?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

	<h1><?=_("PHP Localization Benchmark")?></h1>
	
	<p><?=_("This is just a sample page to compare the various localization methods. This is just a sample page to compare the various localization methods. This is just a sample page to compare the various localization methods. This is just a sample page to compare the various localization methods. This is just a sample page to compare the various localization methods. This is just a sample page to compare the various localization methods. This is just a sample page to compare the various localization methods. This is just a sample page to compare the various localization methods. This is just a sample page to compare the various localization methods. This is just a sample page to compare the various localization methods.")?></p>

</body>
</html>

<?php

$lang = "en";
if ($_GET["lang"] == "de") $lang = "de";
require_once("languages/$lang.php");

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=$lang?>" lang="<?=$lang?>">
<head>
	<title><?=$strings["Title"]?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

	<h1><?=$strings["Heading"]?></h1>
	
	<p><?=$strings["WelcomeParagraph"]?></p>

</body>
</html>

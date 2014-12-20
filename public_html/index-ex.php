<?php

var_dump(setlocale(LC_ALL, null) );

$locale = "en_GB";
putenv('LC_ALL='.$locale);
setlocale(LC_ALL, $locale);

var_dump(setlocale(LC_ALL, 0) );




// wrong, doesn't change the language dates are displayed
setlocale(LC_ALL, "nl_nl");
// wrong, dates in Dutch, but also numbers and therefore causing problems with MySQL etc.
// see http://nl3.php.net/manual/en/function.setlocale.php#25041
setlocale(LC_ALL, "Dutch");
// perfect, just dates in Dutch language
// setlocale(LC_TIME, "Dutch");

var_dump(setlocale(LC_ALL, "Dutch") );


// $lang = "en"; $locale = "en_GB";
// if (isset($_GET["lang"]) && $_GET["lang"] == "fa"){ $lang = "fa"; $locale = "fa_IR"; }
// if (isset($_GET["lang"]) && $_GET["lang"] == "de"){ $lang = "de"; $locale = "de_DE"; }


$locale = "en_US";
if(isset($_GET["lang"]))
{
	$locale =$_GET["lang"];
}

// putenv("LC_ALL=$locale"); // wrong in windows
// putenv('LC_ALL='.$locale);

// setlocale(LC_ALL, $locale);
// setlocale(LC_MESSAGES, $locale);
// bindtextdomain('messages', __DIR__ . '/locale');
// textdomain("messages");


$lang = $locale;
var_dump($lang);

$codeset = "UTF8";  // warning ! not UTF-8 with dash '-' 
putenv('LANG='.$lang.'.'.$codeset);
putenv('LANGUAGE='.$lang.'.'.$codeset);
bind_textdomain_codeset('messages', $codeset);

// set locale
// var_dump(__DIR__);
// var_dump( preg_replace("[\\\\]", "/", __DIR__) );
bindtextdomain('messages', preg_replace("[\\\\]", "/", __DIR__).'/locale');
// setlocale(LC_MESSAGES, $lang.'.'.$codeset);
setlocale(LC_ALL, $lang.'.'.$codeset);
textdomain('messages');





// $language = "fa_IR";
// putenv("LANG=" . $language); 
// setlocale(LC_ALL, $language);
 
// // Set the text domain as "messages"
// $domain = "messages";
// bindtextdomain($domain, "locale"); 
// bind_textdomain_codeset($domain, 'UTF-8');
 
// textdomain($domain);
 
echo _("Hi");




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

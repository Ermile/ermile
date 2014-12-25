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

// // $locale = 'fa_IR';
// $locale = 'en_US';
// header("charset=UTF-8");
// putenv("LC_ALL=$locale");
// putenv("LANG=$locale");
// putenv("LANGUAGE=$locale");
// setlocale(LC_ALL,$locale);
// // setlocale(LC_MESSAGES,$locale);
// $domain = $locale;
// bindtextdomain($domain, __DIR__.'/languages/');
// bind_textdomain_codeset($domain, 'UTF-8');
// textdomain($domain);



// use saloos php gettext function
// define constants
define('LOCALE_DIR', __DIR__.'/languages');
define('DEFAULT_LOCALE', 'en_US');

require_once('../../saloos/lib/gettext/gettext.inc');

// $supported_locales = array('en_US', 'sr_CS', 'de_CH','fa_IR');
$encoding = 'UTF-8';

$locale = (isset($_GET['lang']))? $_GET['lang'] : DEFAULT_LOCALE;

// gettext setup
T_setlocale(LC_MESSAGES, $locale);
// Set the text domain as 'messages'
$domain = 'messages';
T_bindtextdomain($domain, LOCALE_DIR);
T_bind_textdomain_codeset($domain, $encoding);
T_textdomain($domain);


//can use
// T_()
// T_ngettext()
// locale_emulation() for check support dll

// if (!locale_emulation()) {
// 	print "<p>locale '$locale' is supported by your system, using native gettext implementation.</p>\n";
// }
// else {
// 	print "<p>locale '$locale' is <strong>not</strong> supported on your system, using custom gettext implementation.</p>\n";
// }


session_start();
?>
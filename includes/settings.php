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

// $locale = 'fa_IR';
$locale = 'en_US';
header("charset=UTF-8");
putenv("LC_ALL=$locale");
putenv("LANG=$locale");
putenv("LANGUAGE=$locale");
setlocale(LC_ALL,$locale);
// setlocale(LC_MESSAGES,$locale);
$domain = $locale;
bindtextdomain($domain, __DIR__.'/languages/');
bind_textdomain_codeset($domain, 'UTF-8');
textdomain($domain);
?>
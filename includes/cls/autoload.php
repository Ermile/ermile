<?php
namespace cls;

class autoload{
	public static function config(){
		if(!defined("mvc")){
			define("mvc", dir_includes."mvc/");
		}
		array_push(\autoload::$core_prefix, 'mvc');



		// $langs = array(
		// 	'en_US',
		// 	'fa_IR',
		// 	'ar_SA'
		// 	);
		// if(isset($_GET['lang']) && array_search($_GET['lang'], $langs) !==false){
		// 	setcookie("lang", $_GET['lang'], time()+31536000, '/');
		// 	$locale = $langs[array_search($_GET['lang'], $langs)];
		// }elseif(isset($_COOKIE['lang']) && array_search($_COOKIE['lang'], $langs) !==false){
		// 	$locale = $langs[array_search($_COOKIE['lang'], $langs)];
		// }else{
		// 	$locale = "en_US";
		// }
		// var_dump($locale); 
		// setlocale(LC_MESSAGES, $locale);
		// putenv('LC_MESSAGES=$locale');
		// putenv("LC_ALL=$locale");
		// setlocale(LC_ALL, $locale);
		// bindtextdomain("index", dir_includes."languages/");
		// bind_textdomain_codeset("index", "UTF-8");
		// textdomain("index");
		// var_dump(_('Version'));
	}
}
?>
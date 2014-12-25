<?php
namespace cls;

class autoload{
	public static function config(){
		if(!defined("mvc")){
			define("mvc", dir_includes."mvc/");
		}
		array_push(\autoload::$core_prefix, 'mvc');



		// Define Project Attributes **************************************************************************************
		/**
		 * in coming soon period show public_html/pages/coming/ folder
		 * developer must set get parameter like site.com/dev=anyvalue
		 * for disable this attribute turn off it from config.php in project root
		 */
		define("DOMAIN"		, $_SERVER["SERVER_NAME"]);

		if(CommingSoon && isset($_GET['dev'])){
			setcookie('preview','yes',time() + 30*24*60*60,'/','.'.$_SERVER["SERVER_NAME"]);
		}
		elseif(CommingSoon && !isset($_COOKIE["preview"])){
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



		$langs = array(
			'en_US',
			'fa_IR',
			'ar_SA'
			);
		if(isset($_GET['lang']) && array_search($_GET['lang'], $langs) !==false){
			setcookie("lang", $_GET['lang'], time()+31536000, '/');
			$locale = $langs[array_search($_GET['lang'], $langs)];
		}elseif(isset($_COOKIE['lang']) && array_search($_COOKIE['lang'], $langs) !==false){
			$locale = $langs[array_search($_COOKIE['lang'], $langs)];
		}else{
			$locale = "en_US";
		}
		var_dump($locale); 
		setlocale(LC_MESSAGES, $locale);
		putenv('LC_MESSAGES=$locale');
		putenv("LC_ALL=$locale");
		setlocale(LC_ALL, $locale);
		bindtextdomain("index", dir_includes."languages/");
		bind_textdomain_codeset("index", "UTF-8");
		textdomain("index");
		var_dump(_('Version'));
		var_dump("لطفا اون چیزی که فکر میکنی همه ازش استفاده می کنند رو توی هسته نیار.\nشاید درست نباشه.");
		var_dump("فکر نکن که هرچی که شما نیاز داری بقیه هم نیاز دارن");
		var_dump("هسته از اسمش مشخصه، یعنی هسته نه یک سیستم مدیریت محتوا");
		var_dump("یه نگاهی به کد‌اگنایتر، سمفونی، زند و یا هر کوفت و زهرمار دیگه بنداز بعد بیا توی هسته دست بزن");
		var_dump("می تونی یه پروژه از سالوس تعریف کنی و بعد هرکاری خواستی توش انجام بدی.");



		if(MultiLanguage)
		{
			if (isset($_GET["lang"]))
				$language = $_GET["lang"];

			elseif(isset($_COOKIE["lang"]))
				$language = $_COOKIE["lang"];

			elseif(substr(DOMAIN, strrpos(DOMAIN, '.') + 1)=='ir')
				$language = "fa_IR";
			else
				$language = "en_US";


			// save language preference for future page requests
			setcookie('lang',$language,time() + 30*24*60*60,'/','.'.DOMAIN);

			// use saloos php gettext function
			require_once(ilib.'gettext/gettext.inc');

			// gettext setup
			T_setlocale(LC_MESSAGES, $language);
			// Set the text domain as 'messages'
			T_bindtextdomain('messages', root.'includes/languages');
			T_bind_textdomain_codeset('messages', 'UTF-8');
			T_textdomain('messages');
		}

		/**
		 * If DEBUG is TRUE you can see the full error description, If set to FALSE show userfriendly messages
		 * change it from project config.php
		 */
		if (DEBUG)
		{
			error_reporting(E_ALL);
			ini_set('display_errors'		,'On');
			ini_set('display_startup_errors','On');
			ini_set('error_reporting'		,'E_ALL | E_STRICT');
			ini_set('track_errors'			,'On');
			ini_set('display_errors'		,1);
			error_reporting(E_ALL);
		}

		/**
		 * A session is a way to store information (in variables) to be used across multiple pages.
		 * Unlike a cookie, the information is not stored on the users computer.
		 * access to session with this code: $_SESSION["test"]
		 */
		session_name(DOMAIN);
		session_set_cookie_params(0, '/', '.'.DOMAIN);
		session_start();
	}
}
?>
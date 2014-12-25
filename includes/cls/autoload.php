<?php
namespace cls;

class autoload{
	public static function config(){
		if(!defined("mvc")){
			define("mvc", root."includes/mvc/");
		}
		array_push(\autoload::$core_prefix, 'mvc');
	}
}
?>
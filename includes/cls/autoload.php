<?php
namespace cls;

class autoload{
	public static function config(){
		if(!defined("mvc")){
			define("mvc", dir_includes."mvc/");
		}
		array_push(\autoload::$core_prefix, 'mvc');
	}
}
?>
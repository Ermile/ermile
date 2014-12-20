<?php
namespace helper;
use \lib\saloos;
use \lib\router;

class route{
	public function _before(){
		$route = new router\route("/^api([^\/]*)/", function($reg){
			router::remove_url($reg[0]);
			router::add_storage('api', true);
		});
	}
}
?>
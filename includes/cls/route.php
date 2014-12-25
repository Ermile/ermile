<?php
namespace cls;
use \lib\saloos;
use \lib\router;

class route{
	public function _before(){
		$route = new router\route("/^api([^\/]*)/", function($reg){
			router::remove_url($reg[0]);
			router::add_storage('api', true);
		});
		$route = new router\route("/^test/", function(){
			router::remove_url('test');
		});
		new router\route(
			array(
				"sub_domain" => "account",
				"url" => "/.*/"
			),
			function(){
				router::set_repository("content_account");
				// var_dump(router::get_repository());
			}
		);
	}
}
?>

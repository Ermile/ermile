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


		// automatically set repository if folder of it exist
		$myrep = 'content_'.router::get_sub_domain();
		if(is_dir(root.$myrep))
			router::set_repository($myrep);
	}
}
?>

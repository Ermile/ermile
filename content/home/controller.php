<?php
namespace content\home;
use \lib\saloos;

class controller extends \lib\controller{
	public function _construct(){
		$function = $this->load->method('user', 'get_track');
	}
	function _route(){
		$this->get("track")
			->REST("/^route$/")
			->SERVER();
	}

}
?>
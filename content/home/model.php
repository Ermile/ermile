<?php
namespace content\home;
class model extends \lib\model{
	public function _construct(){
	}
	public function get_check($object){
		$this->testLoad = "HI MY DEAR CLASS";
		return $object;
	}
}
?>
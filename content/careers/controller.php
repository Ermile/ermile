<?php
namespace content\careers;
use \lib\saloos;

class controller extends \mvc\controller
{
	public function _route()
	{
		$this->get("list", "list")->ALL("/^careers\/get$/");
		$this->post("careers")->ALL();
	}
}
?>
<?php
namespace content\contact;

class controller extends \mvc\controller
{
	function _route()
	{

		$this->get(false, false)->ALL("/contact/");
		$this->post("contact")->ALL("/contact/");
		// $this->get()
	}
}
?>
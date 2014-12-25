<?php
namespace content\user\api;

class controller extends \mvc\controller{
	function config(){
		$this->view_name	= 'content\home\view';
		$this->display_name	= 'content\home\display.html';
	}
}
?>
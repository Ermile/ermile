<?php
namespace content\logout;

class controller extends \mvc\controller
{
	function config()
	{
		$this->view_name	= 'content\home\view';
		$this->display_name	= 'content_account\home\display.html';
	}
}
?>
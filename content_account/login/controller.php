<?php
namespace content\login;
use \lib\saloos;

class controller extends \content\home\controller
{
	function config()
	{
		$this->view_name	= 'content\home\view';
		$this->display_name	= 'content_account\home\display.html';
	}

}
?>
<?php
namespace content\signup;

class controller extends \mvc\controller
{
	function config()
	{
		$this->view_name	= 'content\home\view';
		$this->display_name	= 'content_account\home\display.html';


		$this->post(substr(__NAMESPACE__, strpos(__NAMESPACE__, '\\')+1))->ALL("account");
	}
}
?>
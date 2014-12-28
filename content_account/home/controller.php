<?php
namespace content\home;

class controller extends \mvc\controller
{
	function config()
	{
		$this->route("/^login|signup|recovery|logout$/", function(){
			$module	= \lib\router::get_real_url();
			$this->model_name	= 'content\\'.$module.'\model';
			$this->display_name	= 'content_account\\'.$module.'\display.html';
			// $this->display_name	= 'content_account\home\display.html';
			$this->post($module)->ALL($module);
		});
		$this->route("/^verification|changepass$/", function(){
			$module	= \lib\router::get_real_url();
			$this->model_name	= 'content\\'.$module.'\model';
			$this->display_name	= 'content_account\\'.$module.'\display.html';
			$this->put($module)->ALL($module);
		});
	}
}
?>
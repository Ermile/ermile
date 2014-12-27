<?php
namespace content\home;

class controller extends \mvc\controller
{
	function config()
	{
		$this->route("/^login|signup|recovery|logout$/", function(){
			$module	= \lib\router::get_real_url();
			$this->model_name	= 'content\\'.$module.'\model';
			$this->post($module)->ALL($module);
		});
		$this->route("/^verification|changepass$/", function(){
			$module	= \lib\router::get_real_url();
			$this->model_name	= 'content\\'.$module.'\model';
			$this->put($module)->ALL($module);
		});
	}
}
?>
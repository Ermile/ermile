<?php
namespace content\home;

class controller extends \mvc\controller
{
	function config()
	{
		$module	= \lib\router::get_real_url();

		$this->route($module);
		$this->model_name	= 'content\\'.$module.'\model';
		$this->post($module)->ALL($module);
	}
}
?>
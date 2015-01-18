<?php
namespace content\main;

class controller extends \mvc\controller
{
	public function config()
	{
		if($this->login())
			var_dump($this->login('all'));
	}

	function _route()
	{
		$mymodule = $this->module('array');
		if($mymodule=='home')
			return;
	
		$url_type = $this->model()->url_checker($mymodule);
		if($url_type == 'invalid')
		{
			\lib\http::page(T_("Does not exist!"));
		}
		else
		{
			$this->get()->ALL();
			// if page exist show it
			// $this->get('page', 'page')->ALL();
		}
	}

}
?>
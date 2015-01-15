<?php
namespace mvc;
use \lib\router;

class controller extends \lib\controller
{
	function _construct()
	{
		if(method_exists($this, 'options')){
			$this->options();
		}
		// add all visitor to visitor table
		// $this->get('modeldef')->ALL(router::get_url());
		// $this->model()->get_modeldef();
	}
}
?>
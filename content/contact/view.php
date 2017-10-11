<?php
namespace content\contact;

class view extends \mvc\view
{
	function config()
	{
		if($this->module() === 'home')
		{
			$this->include->js_main      = true;
		}
		else
		{
			$this->data->page['title'] = $this->data->module;
		}

		$this->data->bodyclass = 'unselectable vflex';
	}
}
?>
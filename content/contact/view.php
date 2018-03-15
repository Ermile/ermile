<?php
namespace content\contact;

class view extends \mvc\view
{
	function config()
	{
		if(\lib\url::module() === null)
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
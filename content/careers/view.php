<?php
namespace content\careers;

class view extends \mvc\view
{
	public function options()
	{
		// $this->include->css_main    = null;
		$this->include->fontawesome = true;

		$this->data->bodyclass  = 'unselectable';

	    if(\lib\url::module() == 'careers')
	    {
			$this->include->css = false;
			$this->include->js  = false;
	    }
	}

	public function view_list($_args)
	{
		$this->data->file_list = $_args->api_callback;
	}


}
?>
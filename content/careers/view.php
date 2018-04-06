<?php
namespace content\careers;

class view extends \mvc\view
{
	public function options()
	{
		$this->include->fontawesome = true;

		$this->data->bodyclass  = 'unselectable';

	    if(\dash\url::module() == 'careers')
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
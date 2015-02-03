<?php
namespace content\home;

class view extends \content\main\view
{
	public function options()
	{
		// $this->include->css_main    = null;
		$this->include->fontawesome = true;

		$this->data->bodyclass  = 'unselectable';
		
	}
}
?>
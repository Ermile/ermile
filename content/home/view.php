<?php
namespace content\home;

class view extends \mvc\view
{
	public function options()
	{
		// $this->include->css_main    = null;
		$this->include->fontawesome = true;

		$this->data->bodyclass  = 'unselectable';
		
	}
}
?>
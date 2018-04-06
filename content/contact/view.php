<?php
namespace content\contact;

class view extends \mvc\view
{
	function config()
	{
		$this->data->page['title'] = \dash\url::module();
		$this->data->bodyclass     = 'unselectable vflex';
	}
}
?>
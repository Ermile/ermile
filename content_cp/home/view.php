<?php
namespace content_cp\home;

class view extends \content_cp\main\view
{
	public function config()
	{
		$this->data->list 	= $this->cpModlueList('all');
	}
}
?>
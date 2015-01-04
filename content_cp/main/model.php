<?php
namespace content_cp\main;
use \lib\utility;
use \lib\debug;

class model extends \mvc\model
{
	public function get_datatable($object)
	{
		$mytable	= 'table'.ucfirst($this->module());
		$tmp_result	=  $this->sql()->$mytable()->select();
		return $tmp_result->Allassoc();
	}

	function get_add($obj)
	{
		$this->prepareChild();

	}

	function get_edit($obj)
	{

	}

	function get_delete($obj)
	{

	}

	private function prepareChild()
	{
		// var_dump('get');
	}
}
?>
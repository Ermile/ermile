<?php
namespace content_cp\main;
use \lib\utility;
use \lib\debug;

class model extends \mvc\model
{
	public function get_datatable($object)
	{
		// delete this func and use direct from model in view
		// $this->model()->datatable();
		return $this->datatable();
	}

	function get_add($obj)
	{
		$this->prepareChild();

	}

	function get_edit($obj)
	{
		$this->prepareChild();
	}

	private function prepareChild()
	{
		// var_dump('get');
	}

	function get_delete()
	{
		$this->delete();
	}

	function post_delete()
	{
		$this->delete();
	}

	function post_add()
	{
		$this->insert();
		// debug::warn(T_("Edit Record successfully"));
	}

	function post_edit()
	{
		$this->update(null, 145);
		// debug::warn(T_("Edit Record successfully"));
	}

	function post_options()
	{
		return 'soon';
	}
}
?>
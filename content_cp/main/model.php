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

	private function prepareChild()
	{
		// var_dump('get');
	}



	function get_delete($obj)
	{
		$qry_module	= $this->module();
		$qry_table	= 'table'.ucfirst($qry_module);
		$qry_slug	= $this->childparam('delete');
		$qry_where	= 'whereId';
		$qry		= $this->sql()->$qry_table()->$qry_where($qry_slug);

		if($qry->select()->num()>0)
		{
			$this->delete_delete($qry);
		}
		else
		{
			$this->redirector()->set_url($qry_module);
			debug::warn(T_("This id does not exist!"));
		}
	}

	function delete_delete($_qry = null)
	{
		$_qry->delete();
		// ======================================================
		// you can manage next event with one of these variables,
		// commit for successfull and rollback for failed
		//
		// if query run without error means commit
		$this->commit(function()
		{
			$this->redirector()->set_url($this->module());
			debug::true(T_("Delete successfully"));
		});

		// if a query has error or any error occour in any part of codes, run roolback
		$this->rollback(function()
		{
			// $this->redirector()->set_url($this->module());
			debug::error(T_("Delete failed!"));
		} );
	}
}
?>
<?php
namespace content_cp\main;
use \lib\utility;
use \lib\debug;

class model extends \mvc\model
{
	public function get_datatable($object)
	{
		$mytable    = 'table'.ucfirst($this->module());
		$tmp_result =  $this->sql()->$mytable()->select();
		return $tmp_result->Allassoc();
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



	function get_delete($obj)
	{
		$qry_module = $this->module();
		$qry_table  = 'table'.ucfirst($qry_module);
		$qry_where  = 'whereId';
		$qry_slug   = $this->childparam('delete');
		$qry        = $this->sql()->$qry_table()->$qry_where($qry_slug);

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


	public function create_query()
	{
		// for debug uncomment below line for disable redirect
		// $this->redirect = false;
		$qry_module        = $this->module();
		$qry_table         = 'table'.ucfirst($qry_module);
		$qry_where         = 'whereId';
		$qry               = $this->sql()->$qry_table();
		
		// get all fields of table and filter fields name for show in datatable
		// access from columns variable
		// check if datatable exist then get this data
		$is_null           = true;
		$is_incomplete     = true;
		
		$fields     = \lib\sql\getTable::get($qry_module,'post');
		var_dump($fields);

		foreach ($fields as $key => $value)
		{
			if($value)
				$require = true;

			$tmp_setfield = 'set'.ucfirst($key);
			$tmp_value    = utility::post($value);

			if(!empty($tmp_value))
			{
				$qry    = $qry->$tmp_setfield($tmp_value);
				$is_null = false;
			}
		}
		// var_dump($qry);

		if($is_null)
		{
			debug::warn(T_("All of records are null"));
			return null;
		}
		if($is_incomplete)
		{
			debug::warn(T_("All require fields must fill"));
			return false;
		}
		// exit();
		// var_dump($qry);
		return $qry;
	}












	public function sql_datatable($mytable=null)
	{
		// this function get table name and return all record of it. table name can set in view
		// if user don't pass table name function use current real method name get from url
		if ($mytable)
			$tmp_qry_table = 'table'.ucfirst($mytable);
		else
			$tmp_qry_table = 'table'.ucfirst(config_lib::$method);
		return $this->sql()->$tmp_qry_table()->select()->allassoc();
	}

	public function sql_datarowbyid($mytable=null, $myid=null)
	{
		// this function get table name and slug then related record of it. table name and slug can set
		// but if user don't pass table name or slug,
		// function use current real method name get from url for table name and current parameter for slug
		if (!$mytable)
			$mytable = config_lib::$method;

		// if myid parameter set use it else use url parameter for myid
		if (!$myid)
			$myid = $this->url_parameter();
		
		$mytable		= ucfirst($mytable);
		$tmp_qry_where	= 'whereId';
		$mytable		= 'table'.$mytable;


		$tmp_result = $this->sql()->$mytable()->$tmp_qry_where($myid)->select();
		
		if ($tmp_result->num() == 1)
		{
			return $tmp_result->assoc();
		}
		elseif($tmp_result->num() > 1)
		{
			page_lib::access("id is found 2 or more times. it's imposible!");
		}
		else
		{
			page_lib::access("Url incorrect: id not found");
		}
		return 0;
	}


















	function put_edit($_qry = null)
	{
		$_qry->update();
		// ======================================================
		// you can manage next event with one of these variables,
		// commit for successfull and rollback for failed
		//
		// if query run without error means commit
		$this->commit(function()
		{
			$this->redirector()->set_url($this->module());
			debug::true(T_("Update successfully"));
		});

		// if a query has error or any error occour in any part of codes, run roolback
		$this->rollback(function()
		{
			// $this->redirector()->set_url($this->module());
			debug::error(T_("Update failed!"));
		} );
	}

	function post_add()
	{
		$this->create_query();
		exit();
		// debug::warn(T_("Add Record successfully"));
		// sleep(3);
		// exit();
	}

	function post_edit()
	{
		debug::warn(T_("Edit Record successfully"));
	}
}
?>
<?php
namespace content_cp\main;

class view extends \mvc\view
{
	public function options()
	{
		$this->include->telinput  = false;
		$this->include->customcss = false;
		$this->include->customjs  = false;
		$this->data->bodyclass    = 'fixed';
	}


	function view_datatable($obj)
	{		
		// in root page like site.com/admin/banks show datatable
		// get data from database through model
		$this->data->datatable = $obj->api_callback;
		$this->global->js      = array($this->url->static.'js/jquery.dataTables.min.js');
		// check if datatable exist then get this data
		if($this->data->datatable)
		{
			// get all fields of table and filter fields name for show in datatable, access from columns variable
			$this->include->datatable = true;
			$this->data->columns      = \lib\sql\getTable::get($this->data->module);
		}

		// var_dump($obj->api_callback);
	}

	function view_add($obj)
	{
		$this->prepareChild();
	}

	function view_edit($obj)
	{
		$this->prepareChild();
	}

	private function prepareChild()
	{
		$this->include->editor  = true;
		$this->data->field_list = \lib\sql\getTable::get($this->data->module);
		$this->global->js       = array($this->url->static.'js/medium-editor.min.js');
		$myform                 = $this->createform('@'.db_name.'.'.$this->data->module,'edit');
	}
}
?>
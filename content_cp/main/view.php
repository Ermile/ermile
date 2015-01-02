<?php
namespace content_cp\main;

class view extends \mvc\view
{
	public function config()
	{
		$mymodule	= $this->module();
		$mychild	= $this->child();

		if($mymodule && $mymodule!="home")
		{
			if($mychild)
			{
				
				$this->data->form_show		= true;
			}
			else
			{

			}
		}

	}




	// ---------------------------------------------------------------- default config function for ADMIN
	public function configold()
	{
		$this->data->store = config_cls::$project;
		if($this->data->module && $this->data->module!="home")
		{
			if($this->data->child)
			{
				// in add, edit or delete pages
				$this->data->form_title		= ucfirst($this->url_table_prefix());
				$this->global->page_title	= $this->url_title() . ' ' . $this->data->form_title;
				$myForm						= $this->createform("@".$this->data->module, $this->data->child);
				$this->data->form_show		= true;
				$this->data->field_list		= getTable_cls::forms($this->data->module);
				// var_dump($this->data->field_list);

				
				if($this->data->child=='edit')
				{
					$tmp_result = $this->sql("#datarowbyid");
					$this->fill_for_edit($tmp_result, $myForm);
				}
			}
			else
			{
				// in root page like site.com/admin/banks show datatable

				// get data from database through model
				$this->data->datatable		= $this->sql("#datatable");
				if($this->data->datatable)
				{
					// get all fields of table and filter fields name for show in datatable, access from columns variable
					// check if datatable exist then get this data
					$this->include->datatable	= true;
					// $this->data->columns		= getTable_cls::fields($this->data->module);
					// var_dump($this->data->columns);
					$this->data->columns		= getTable_cls::datatable($this->data->module);
				}
			}
		}
	}




}
?>
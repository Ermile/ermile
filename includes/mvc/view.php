<?php
namespace mvc;

class view extends \lib\view
{
	function _construct()
	{
		// define default value for global
		$this->global->site_title		= __("Ermile");
		$this->global->site_desc		= __("Ermile is our company");
		$this->global->site_slogan		= __("Ermile is our company");
		$this->global->page_title		= __("");
		$this->global->page_desc		= __("Ermile is new");
		$this->global->site_title_show	= true;
		$this->global->login			= false;

		// define default value for include
		$this->include->datatable		= false;
		$this->include->jquery			= true;
		$this->include->fontawesome		= false;
		$this->include->telinput		= false;
		$this->include->customcss		= true;
		$this->include->customjs		= true;

		$this->data->layout_account		= "content_account/home/display.html";
	}
}
?>
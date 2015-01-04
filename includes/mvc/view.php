<?php
namespace mvc;

class view extends \lib\view
{
	function _construct()
	{
		// define default value for global
		// var_dump(T_("Ermile"));
		// var_dump(T_(1));
		$this->global->site_title		= T_("Ermile");
		$this->global->site_desc		= T_("Ermile is new");
		$this->global->site_slogan		= T_("Ermile is our company");
		$this->global->login			= $this->login();
		// add language list for use in display
		$this->global->langlist			= array(
												'fa_IR' => 'فارسی',
												'en_US' => 'English',
												'de_DE' => 'Deutsch'
												);
		
		$this->data->module				= $this->module();
		// if you need to set a class for body element in html add in this value
		$this->data->bodyclass			= null;

		// define default value for include
		$this->include->datatable		= false;
		$this->include->fontawesome		= false;
		$this->include->telinput		= false;
		$this->include->customcss		= true;
		$this->include->customjs		= true;

		$this->data->layout_account		= "content_account/main/layout.html";
		$this->data->layout_cp			= "content_cp/main/layout.html";
		// var_dump($this->global->site_slogan);


		if (!locale_emulation()) {
			$this->include->gettext 	= 'Translation use native gettext dll';
		}
		else {
			$this->include->gettext 	= 'Translation use PHP gettext class';
		}

		if(method_exists($this, 'options')){
			$this->options();
		}
	}
	function pushState(){
		$this->data->layout_account		= "content_account/main/xhr-layout.html";
		$this->data->layout_cp			= "content_cp/main/xhr-layout.html";
	}
}
?>
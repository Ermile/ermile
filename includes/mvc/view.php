<?php
namespace mvc;

class view extends \lib\view
{
	function _construct()
	{
		// define default value for global

		$this->data->site['title']   = T_("Ermile");
		$this->data->site['desc']    = T_("Ermile is new");
		$this->data->site['slogan']  = T_("Ermile is our company");

		$this->data->page['desc']    = T_("Ermile is Inteligent.");

		// add language list for use in display
		$this->global->langlist		= array(
												'fa_IR' => 'فارسی',
												'en_US' => 'English',
												'de_DE' => 'Deutsch'
												);

		// if you need to set a class for body element in html add in this value
		// $this->data->bodyclass      = null;
		
		$this->data->display['account'] = "content_account/main/layout.html";
		$this->data->display['cp']      = "content_cp/main/layout.html";



		if (!locale_emulation()) {
			$this->include->gettext  = 'Translation use native gettext dll';
		}
		else {
			$this->include->gettext  = 'Translation use PHP gettext class';
		}

		if(method_exists($this, 'options')){
			$this->options();
		}
	}

	function pushState()
	{
		$this->data->display['account'] = "content_account/main/xhr-layout.html";
		$this->data->display['cp']      = "content_cp/main/xhr-layout.html";
	}
}
?>
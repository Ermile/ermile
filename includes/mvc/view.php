<?php
namespace mvc;

class view extends \lib\mvc\view
{
	function _construct()
	{
		// define default value for global

		$this->data->site['title']   = T_("Ermile");
		$this->data->site['desc']    = T_("Ermile contain a new tools for each one");
		$this->data->site['slogan']  = T_("One account to access all service");

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




		if (!locale_emulation()) {
			$this->include->gettext  = 'Translation use native gettext dll';
		}
		else {
			$this->include->gettext  = 'Translation use PHP gettext class';
		}

		// if($this->login())
		// 	var_dump($this->login('all'));

		// var_dump($_SESSION['ssid']);
	}

	function pushState()
	{
		$this->data->display['account'] = "content_account/main/xhr-layout.html";
		$this->data->display['cp']      = "content_cp/home/layout-xhr.html";
	}
}
?>
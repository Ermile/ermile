<?php
namespace mvc;

class view extends \lib\mvc\view
{
	function _construct()
	{
		// set default value for site properties
		$this->data->site['title']   = T_("Ermile");
		$this->data->site['desc']    = T_("Ermile contain a new tools for each one");
		$this->data->site['slogan']  = T_("As easy as ABC is our slogan!");

		$this->data->page['desc']    = T_("Ermile is inteligent");


		// if you need to set a class for body element in html add in this value
		// $this->data->bodyclass      = null;


		// default value for includes. if you use one of the files set it true
		// $this->include->css_main     = true;
		// $this->include->js_main      = true;
		// $this->include->css          = true;
		// $this->include->js           = true;
		// $this->include->fontawesome  = null;
		// $this->include->datatable    = null;
		// $this->include->telinput     = null;
		// $this->include->editor       = null;

		$this->data->template['social']      = 'content/template/social.html';
		$this->data->template['share']       = 'content/template/share.html';

	}
}
?>
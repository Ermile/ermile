<?php
namespace mvc;

class view extends \lib\view
{
	function project()
	{
		// set default value for site properties
		$this->data->site['title']   = T_("Ermile");
		$this->data->site['desc']    = T_("Ermile contain a new tools for each one");
		$this->data->site['slogan']  = T_("As easy as ABC is our slogan!");

		$this->data->page['desc']    = T_("Ermile is inteligent");


		// if you need to set a class for body element in html add in this value
		// $this->data->bodyclass      = null;


		// default value for includes. if you use one of the files set it true
		$this->include->css_main     = false;

		$this->data->template['social']      = 'content/template/social.html';
		$this->data->template['share']       = 'content/template/share.html';

	}
}
?>
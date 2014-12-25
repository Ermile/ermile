<?php
namespace content\home;

class view extends \mvc\view{
	public function config(){
		$this->data->title = "hi";
		// $this->url->domain = "hisss";
		// var_dump($this->data->url->domain);

		// define default value for global
		$this->global->site_title		= _("Station");
		$this->global->site_desc		= _("Station is fast");
		$this->global->site_slogan		= $this->global->site_title . _(" is your Secure Storage");
		$this->global->page_title		= _("");
		$this->global->page_desc		= _("");
		$this->global->site_title_show	= true;
		$formEdit = $this->form(".custom", "edit");
	}


	public function view_query($object){
		var_dump($object->api_callback); 
		// or var_dump($this->controller()->api_callback); 
	}
}
?>
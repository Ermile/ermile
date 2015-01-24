<?php
namespace content\home;

class view extends \content\main\view{
	public function config(){
		$formEdit = $this->createform(".custom");
		// $this->twigextract();
	}


	public function view_query($object){
		var_dump($object->api_callback); 
		// or var_dump($this->controller()->api_callback); 
	}
}
?>
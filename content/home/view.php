<?php
namespace content\home;

class view extends \mvc\view{
	public function config(){
		$formEdit = $this->createform(".custom", "edit");
		// $this->twigextract();
	}


	public function view_query($object){
		var_dump($object->api_callback); 
		// or var_dump($this->controller()->api_callback); 
	}
}
?>
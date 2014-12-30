<?php
namespace content\home;
use \lib\saloos;

class controller extends \mvc\controller{
	public function config(){
		if($this->login())
			var_dump($this->login('all'));
	}

	function _route(){
		$this->get("validate")
		->REST("validate")
		->SERVER();

		$this->get(false)
		->SERVER("form")
		->REST();
			// first parm= model like get_query
			// second param= view like view_query
			// rest(form) 
		$this->get('query', 'query')
		->REST(array(
			'url'=> "/^query\/([^\/]*)$/"
			)
		)
		->SERVER();
	}

}
?>
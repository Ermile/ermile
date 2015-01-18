<?php
namespace content\home;
use \lib\saloos;

class controller extends \content\main\controller
{
	function _route2()
	{
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
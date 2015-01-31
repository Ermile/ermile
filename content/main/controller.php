<?php
namespace content\main;

class controller extends \mvc\controller
{
	public function config()
	{
		// var_dump($_COOKIE); exit();
		// if($this->login())
		// 	var_dump($this->login('all'));
	}

	function _route()
	{
		$mymodule = $this->module('array');
		if($mymodule=='home')
			return;
	
		// $url_type = $this->model()->url_checker($mymodule);
		$url_type = null;
		if($url_type == 'invalid')
		{
			\lib\http::page(T_("Does not exist!"));
		}
		else
		{
			if( is_file(root.'content/'.$url_type.'/display.html') )
				$this->display_name	= 'content\\'.$url_type.'\display.html';
			else
				$this->display_name	= 'content\post\display.html';

				// $this->get($url_type, $url_type)->ALL();

			switch ($url_type)
			{
				case 'page':
				case 'post':
					$this->get('posts', 'posts')->ALL();
					break;

				case 'cat':
				case 'tag':
					$this->get('terms', 'terms')->ALL();
					break;

				default:
					break;
			}


			// $this->get()->ALL();
			// if page exist show it
		}
	}

}
?>
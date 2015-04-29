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
		$mymodule = $this->module();
		if($mymodule == 'home')
			return;
		elseif($mymodule == 'search')
		{
			if( is_file(root.'content/template/search.html') )
				$this->display_name	= 'content\template\search.html';

			$this->get()->ALL();
			return;
		}

		$myurl = $this->model()->url_checker();

		// if url does not exist show 404 error
		if(!$myurl)
		{	
			// if 404 template exist show it
			if( is_file(root.'content/template/404.html') )
				$this->display_name	= 'content\template\404.html';
			// else show saloos default error page
			else
			{
				\lib\error::page(T_("Does not exist!"));
				return;
			}
		}

		// elseif template type exist show it
		elseif( is_file(root.'content/template/'.$myurl['type'].'-'.$myurl['slug'].'.html') )
			$this->display_name	= 'content\template\\'.$myurl['type'].'-'.$myurl['slug'].'.html';

		// elseif template type exist show it
		elseif( is_file(root.'content/template/'.$myurl['type'].'.html') )
			$this->display_name	= 'content\template\\'.$myurl['type'].'.html';

		// if default template exist show it else use homepage!
		elseif( is_file(root.'content/template/dafault.html') )
			$this->display_name	= 'content\template\dafault.html';



		// var_dump($myurl);
		$this->get()->ALL();
	}



	function _route_old()
	{
		$mymodule = $this->module('array');
		if($mymodule=='home')
			return;
	
		// $url_type = $this->model()->url_checker($mymodule);
		$url_type = null;
		if($url_type == 'invalid')
		{
			\lib\error::page(T_("Does not exist!"));
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
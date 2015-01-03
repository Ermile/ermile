<?php
namespace content_cp\home;

class controller extends \mvc\controller
{
	function _route()
	{
		$mymodule	= $this->module();
		$mychild	= $this->child();
		$islogin	= $this->login();

		if($islogin)
		{
			// var_dump("welcome to admin panel");
		}
		else
		{
			// var_dump("you must login to system");
			// \lib\http::access(T_("You must login to access!"));
			// redirect to login
		}

		// Restrict unwanted child
		if($mychild && !($mychild=='add' || $mychild=='edit' || $mychild=='delete'))
			\lib\http::page(T_("Not found!"));




		if( is_file(root.'content_cp/'.$mymodule.'/display.html') )
		{
			$this->display_name	= 'content_cp\\'.$mymodule.'\display.html';
		}
		else
		{
			$this->display_name	= 'content_cp\main\layout.html';
		}


		if($mymodule=='home')
			return;

		// on module root without child like /post
		if(!$mychild)
		{
			$this->get('datatable', "datatable")->ALL(\lib\router::get_real_url());
		}


		if($mychild)
		{
			// complete soon
			$this->get()->ALL(\lib\router::get_real_url());
			return;
		}
		// if($mymodule !='home' )
		// {
			// @hasan: write regular experssion for childs
			// add, edit, delete
			// var_dump("expression");
			// var_dump($a);

		// }


		// $this->model_name	= 'content_cp\\'.$mymodule.'\model';
		// $this->post($mymodule)->ALL($mymodule);
	}






public function configold()
	{

		if($this->login())
		{
			// var_dump( 'User Logined to system. Nickname: ' . $_SESSION['user']['nickname'] );
		}
		else
		{
			debug_lib::warn("You must login to use admin");
			$this->redirect('login')->subdomain("account");
		}
		// var_dump(config_cls::$project);

		if (config_lib::$method !='home')
		{
			$this->listen(
				array(
					"min" => 1,
					"max" => 1,
					"url" => array('add')
					),
				array()
			);
			$this->listen(
				array(
					"min" => 1,
					"max" => 1,
					"url" => array("/.*/", "edit" => "/^[0-9]{1,10}+$/")
					),
				array()
			);
			$this->listen(
				array(
					"min" => 1,
					"max" => 1,
					"url" => array("/.*/", "delete" => "/^[0-9]{1,10}+$/")
					),
				array( 'mod' => 'delete')
			);
		}
	}

}
?>
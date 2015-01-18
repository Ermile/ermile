<?php
namespace content_cp\main;

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
		if($mychild && !($mychild=='add' || $mychild=='edit' || $mychild=='delete') || !$this->cpModlueList())
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

		$myaddress = \lib\router::get_real_url();
		// on module root without child like /post
		if($mychild)
		{
			if($mychild=='delete')
				$this->get($mychild)->ALL($myaddress);
			else
			{
				$this->get($mychild, $mychild)->ALL($myaddress);
				$this->post($mychild)->ALL($myaddress);
			}

		}
		else
		{
			$this->get('datatable', 'datatable')->ALL($myaddress);
		}
		// $this->model_name	= 'content_cp\\'.$mymodule.'\model';
		// $this->post($mymodule)->ALL($mymodule);
	}


	// if url is outside of our list, return false else if valid module return true
	public function cpModlueList($_module = null)
	{
		$mylist		= array(
						'accounts',
						'addons',
						'attachments',
						'banks',
						'comments',
						'costs',
						'errorlogs',
						'errors',
						'funds',
						'locations',
						'notifications',
						'options',
						'papers',
						'permissions',
						'posts',
						'productcats',
						'productprices',
						'products',
						'receipts',
						'smss',
						'terms',
						'transactions',
						'userlogs',
						'users',
						'users',
						'verifications',
						'visitors'
					);
		if($_module == 'all')
			return $mylist;

		$_module 	= $_module? $_module: $this->module();
		if(in_array($_module, $mylist) || $_module == 'home')
			return true;
		else
			return false;
	}
}
?>
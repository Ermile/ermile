<?php
namespace content_cp\main;

class controller extends \mvc\controller
{
	function _route()
	{
		$mymodule = $this->module();
		$mychild	 = $this->child();

		if(!$this->login())
		{
			\lib\debug::warn(T_("first of all, you must login to system!"));
			$this->redirector()->set_domain($this->url('LoginService'))->set_url('login')->redirect();
			exit();
		}

		// Restrict unwanted child
		if($mychild && !($mychild=='add' || $mychild=='edit' || $mychild=='delete' || $mychild=='options')
			 || !$this->cpModlueList()
			)
			\lib\http::page(T_("Not found!"));


		if( is_file(root.'content_cp/'.$mymodule.'/display.html') )
		{
			$this->display_name	= 'content_cp\\'.$mymodule.'\display.html';
		}
		else
		{
			$this->display_name	= 'content_cp\main\layout.html';
		}

		// var_dump($this->childparam($mychild));

		if($mymodule=='home')
			return;

		// on module root without child like /post
		if($mychild)
		{
			//all("edit=.*")
			if($mychild == 'delete')
			{
				$this->post($mychild)->ALL();
				// $this->model()->get_delete();
				// return;
				// $this->get()->ALL();		// @hasan: regular?
				// $this->redirector()->set_domain('cp.ermile.dev')->set_url('banks');
			}
			if($mychild == 'edit')
			{
				$this->get($mychild, $mychild)->ALL();
				$this->post($mychild)->ALL();
			}
			elseif($mychild == 'add')
			{
				$this->get($mychild, $mychild)->ALL();
				$this->post($mychild)->ALL();
			}
			elseif($mychild == 'options')
			{
				$this->post($mychild)->ALL();
			}

		}
		else
		{
			$this->get('datatable', 'datatable')->ALL();
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
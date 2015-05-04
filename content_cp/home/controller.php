<?php
namespace content_cp\home;

class controller extends \mvc\controller
{
	function _route()
	{
		if(!$this->login())
		{
			\lib\debug::warn(T_("first of all, you must login to system!"));
			// $this->redirector(null, false)->set_domain($this->url('AccountService'))->set_url('login?dev=y')->redirect();
			// exit();
		}

		$mymodule = $this->module();
		$mychild  = $this->child();
		$mypath   = $this->url('path','_');

		if($mymodule === 'utility')
		{
			if($mychild === 'dbtables')
				\lib\utility\dbTables::create();
			elseif( $mychild === 'twigtrans')
				\lib\utility\twigTrans::extract();
			
			$this->get()->ALL();
			$this->display_name	= 'content_cp/templates/raw.html';
			return;
		}



		// Restrict unwanted child
		if($mychild && !($mychild=='add' || $mychild=='edit' || $mychild=='delete' || $mychild=='options')
			 || !$this->cpModlueList()
			)
			\lib\error::page(T_("Not found!"));

		// on module root without child like /post
		if($mychild)
		{
			$this->display_name	= 'content_cp\home\display-child.html';
			//all("edit=.*")
			if($mychild == 'delete')
			{
				// $this->model()->delete();
				// $controller->route_check_true = true;
				// $this->redirector()->set_url($mymodule); //->redirect();
				$this->get($mychild)->ALL();		// @hasan: regular?
				$this->post($mychild)->ALL();
				// return;
				// $this->redirector()->set_domain('cp.ermile.dev')->set_url('banks');
			}
			if($mychild == 'edit')
			{
				// var_dump($this->model()->datarow());
				$this->get(null, 'child')->ALL();
				$this->post($mychild)->ALL();
			}
			elseif($mychild == 'add')
			{
				$this->get(null, 'child')->ALL();
				$this->post($mychild)->ALL();
			}
			elseif($mychild == 'options')
			{
				$this->post($mychild)->ALL();
			}

		}
		elseif($mymodule !== 'home')
		{
			$this->display_name	= 'content_cp\home\display-module.html';
			$this->get(null, 'datatable')->ALL();
		}


		if( is_file(root.'content_cp/templates/'.$mypath.'.html') )
		{
			$this->display_name	= 'content_cp/templates/'.$mypath.'.html';
		}
	}


	// if url is outside of our list, return false else if valid module return true
	public function cpModlueList($_module = null)
	{
		return true;
		$mylist		= array(
						'accounts',
						'comments',
						'costs',
						'papers',
						'posts',
						'productcats',
						'products',
						'terms',
						'transactions',
						'users',
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
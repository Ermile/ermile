<?php
namespace content\home;

class view extends \mvc\view
{
	public function config()
	{
		$this->include->telinput		= true;
		$this->include->fontawesome		= false;
		// $this->data->module				= \lib\router::get_real_url();
		$this->global->page_title		= ucfirst(\lib\router::get_real_url());
		$this->global->site_title_show	= false;
		$this->global->site_desc		= T_("One Account for all services");
		
		$this->data->module				= 'account';

		// $form 									= $this->form(".signup");
		// $this->data->module = 'accounts';
        // var_dump($this->data->module);
        
  //       $this->createform('.'.$this->data->module);


		// $this->global->page_title               = T_("Account Manager");
		// $this->global->page_desc                = T_("Manage your account");

		// $form = $this->form("@jibres.accounts");
		// $form->before('account_slug', 'account_title');
		// 


	}

	public function view_login()
	{
		// $form = $this->form(".login");
		$form = $this->createform(".account",'login');
	}

	public function view_signup()
	{
		var_dump("signup");
		// var_dump($this->form(".signup"))
		$form = $this->createform(".signup");
		// or var_dump($this->controller()->api_callback); 
	}


	public function view_recovery()
	{
		$form = $this->createform(".account",'recovery');

		// var_dump("recovery");
		// $form = $this->createform(".recovery");
		// $form = $this->form(".signup");
		// or var_dump($this->controller()->api_callback); 
	}

	public function view_verification()
	{
		$form = $this->createform(".account",'verification');
		// $form = $this->createform(".verification");
		// var_dump("verification");
	}
}
?>
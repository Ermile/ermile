<?php
namespace content\home;

class view extends \mvc\view{
	public function config(){
		$this->global->site_desc                = _("One Account for all service");
		$this->global->page_title               = _("Account Manager");
		$this->global->page_desc                = _("Manage your account");
		$this->global->site_title_show          = false;

		$form = $this->form("@jibres.accounts");
		$form->before('account_slug', 'account_title');
	}

	public function view_signup(){
		$form = $this->form(".signup");
		// or var_dump($this->controller()->api_callback); 
	}


	public function view_recovery(){
		var_dump("recovery");
		// $form = $this->form(".signup");
		// or var_dump($this->controller()->api_callback); 
	}
}
?>
<?php
namespace content\home;

class view extends \mvc\view
{
	public function config()
	{
		$this->include->customcss		= false;
		$this->data->myform				= 'account';
		$this->data->module				= \lib\router::get_real_url();
		$this->include->telinput		= true;
		$this->global->site_slogan		= T_("One Account for all services");

		if($this->data->module =='login')
		{
			$this->global->page_desc	= T_('Login');
		}
		elseif($this->data->module =='signup')
		{
			$this->global->page_desc	= T_('Create an account');
		}
		elseif($this->data->module =='verification')
		{
			$this->global->page_desc	= T_('Verificate');
		}
		elseif($this->data->module =='recovery')
		{
			$this->global->page_desc	= T_('Recovery');
		}
		elseif($this->data->module =='changepass')
		{
			$this->global->page_desc	= T_('Change password');
		}
		else
		{
			return;
		}

		$this->global->page_title		= $this->global->page_desc;
		$form = $this->createform('.'.$this->data->myform, $this->data->module);

		// $form = $this->form("@jibres.accounts");
		// $form->before('account_slug', 'account_title');
	}
}
?>
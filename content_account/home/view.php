<?php
namespace content_account\home;

class view extends \mvc\view
{
	public function config()
	{
		// $this->include->datatable		= false;
		// $this->include->jquery			= true;
		// $this->include->fontawesome		= false;
		$this->include->telinput		= true;
		$this->include->customcss		= false;
		$this->include->customjs		= false;
		$this->data->bodyclass			= 'unselectable';
		
		$this->data->myform				= 'account';
		$this->global->site_slogan		= T_("One Account for all services");

		if($this->data->module =='login'){
			$this->global->page_desc	= T_('Login');
		}
		elseif($this->data->module =='signup'){
			$this->global->page_desc	= T_('Create an account');
		}
		elseif($this->data->module =='verification'){
			$this->global->page_desc	= T_('Verificate');
		}
		elseif($this->data->module =='verification_send'){
			$this->global->page_desc	= T_('Verificate');
		}
		elseif($this->data->module =='recovery'){
			$this->global->page_desc	= T_('Recovery');
		}
		elseif($this->data->module =='changepass'){
			$this->global->page_desc	= T_('Change password');
		}
		elseif($this->data->module =='smsdelivery'){
			$this->global->page_desc	= T_('SMS Delivery');
		}
		elseif($this->data->module =='smscallback'){
			$this->global->page_desc	= T_('SMS Callback');
		}
		else
		{
			$this->global->page_desc	= T_('Ermile');
			return;
		}


		$this->global->page_title		= $this->global->page_desc;
		$form = $this->createform('.'.$this->data->myform, $this->data->module);

		// $form = $this->form("@jibres.accounts");
		// $form->before('account_slug', 'account_title');
	}
}
?>
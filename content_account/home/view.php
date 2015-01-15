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
		$this->data->site_slogan		= T_("One Account for all services");

		if($this->data->module =='login'){
			$this->data->page_desc	= T_('Login');
		}
		elseif($this->data->module =='signup'){
			$this->data->page_desc	= T_('Create an account');
		}
		elseif($this->data->module =='verification'){
			$this->data->page_desc	= T_('Verificate');
			$this->data->mobile			= \lib\utility::get('mobile');
		}
		elseif($this->data->module =='verificationsms'){
			$this->data->page_desc	= T_('Verificate');
		}
		elseif($this->data->module =='recovery'){
			$this->data->page_desc	= T_('Recovery');
		}
		elseif($this->data->module =='changepass'){
			$this->data->page_desc	= T_('Change password');
			$this->include->telinput	= false;
		}
		elseif($this->data->module =='smsdelivery'){
			$this->data->page_desc	= T_('SMS Delivery');
			$this->include->telinput	= false;
		}
		elseif($this->data->module =='smscallback'){
			$this->data->page_desc	= T_('SMS Callback');
			$this->include->telinput	= false;
		}
		else
		{
			$this->data->page_desc	= T_('Ermile');
			return;
		}


		$this->data->page_title		= $this->data->page_desc;
		$form = $this->createform('.'.$this->data->myform, $this->data->module);

		// $form = $this->form("@jibres.accounts");
		// $form->before('account_slug', 'account_title');
	}
}
?>
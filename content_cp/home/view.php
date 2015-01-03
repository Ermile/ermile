<?php
namespace content_cp\home;

class view extends \content_cp\main\view
{
	public function options()
	{
		$this->global->page_title = 'Admin';
		//$this->include->datatable = true;
		//$this->include->jquery = false;

		// easily show the list of folders
		$tmp		=glob("../content_cp/*");
		$tmp_array	=null;
		foreach ($tmp as $i) 
		{
			$a				= explode('/', $i);
			$b				= $a[count($a)-1];
			if($b!='home' && $b!='main' )
			{
				$tmp_array[$b]= '';
			}
		}
		$this->data->tmp	= array_keys($tmp_array);




		// $this->include->datatable		= false;
		// $this->include->jquery			= true;
		// $this->include->fontawesome		= false;
		$this->include->telinput		= false;
		$this->include->customcss		= false;
		$this->include->customjs		= false;
		$this->data->bodyclass			= 'fixed';
		
		$this->data->myform				= 'account';
		$this->global->site_slogan		= T_("One Account for all services");

		if($this->data->module =='login'){
			$this->global->page_desc	= T_('Login');
		}
		elseif($this->data->module =='signup'){
			$this->global->page_desc	= T_('Create an account');
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
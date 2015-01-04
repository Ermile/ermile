<?php
namespace cls\form;

class account extends \lib\form
{
	public function __construct($function=null)
	{
		if ($function and method_exists($this, $function))
		{
			$this->$function();
		}
		else
		{
			// if(DEBUG)
			// 	var_dump('Please pass correct function name as parameter');
			return;
		}
	}

	private function login()
	{
		$this->mobile	= $this->make('#mobile')->label(null)->desc(T_("Enter your registered mobile"))
							->value(((isset($_GET["mobile"]))?htmlspecialchars('+'.$_GET["mobile"]):null));
		$this->password	= $this->make('#password')->label(null)->desc(T_("Enter your password"))->autocomplete('on');
		$this->submit	= $this->make('submit')->title(T_('Login'));
	}

	private function signup()
	{
		$this->mobile	= $this->make('#mobile')->label(null)->autocomplete('off')
							->value(((isset($_GET["mobile"]))?htmlspecialchars('+'.$_GET["mobile"]):null));
		$this->password	= $this->make('#password')->label(null);
		$this->submit	= $this->make('submit')->title(T_('Create an account'));
	}

	private function verification()
	{
		$this->mobile	= $this->make('#mobile')->label(null)->disabled('disabled')->tabindex('-1')->autocomplete('off')
							->value(((isset($_GET["mobile"]))?htmlspecialchars('+'.$_GET["mobile"]):null))->disabled('disabled');
		$this->code		= $this->make('code')->label(null)->pl(T_('Code'))->maxlength(4)->autofocus()->autocomplete('off')
							->required()->pattern('[0-9]{4}')->title(T_('input 4 number'))
							->pos('hint--bottom')->desc(T_("Check your mobile and enter the code"));
		$this->submit	= $this->make('submit')->title(T_('Verification'));
	}

	private function recovery()
	{
		$this->mobile	= $this->make('#mobile')->label(null)->autocomplete('off')
							->value(((isset($_GET["mobile"]))?htmlspecialchars('+'.$_GET["mobile"]):null));
		$this->submit	= $this->make('submit')->title(T_('Recovery'));
	}

	private function changepass()
	{
		$this->password	= $this->make('#password')->label(null);
		$this->submit	= $this->make('submit')->title(T_('Change my password'));
	}

	private function smsdelivery()
	{
		$this->messageid	= $this->make('messageid')->label(null)->pl('message id');
		$this->status	= $this->make('status')->label(null)->pl('status');
		$this->submit	= $this->make('submit')->title(T_('Send Delivery'));
	}

	private function smscallback()
	{
		$this->from			= $this->make('from')->label(null)->pl('from');
		$this->to			= $this->make('to')->label(null)->pl('to');
		$this->message		= $this->make('message')->label(null)->pl('message');
		$this->messageID	= $this->make('messageID')->label(null)->pl('message id');
		$this->submit		= $this->make('submit')->title(T_('Send Delivery'));
	}
}
?>
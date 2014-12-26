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
			var_dump('Please pass correct function name as parameter');
			return;
		}
	}

	private function login()
	{
		$this->mobile	= $this->make('#mobile')->label(null)
							->value(((isset($_GET["mobile"]))?htmlspecialchars('+'.$_GET["mobile"]):null));
		$this->password	= $this->make('#password')->label(null);
		$this->submit	= $this->make('submit')->title(T_('Login'));
	}

	private function signup()
	{
		$this->mobile	= $this->make('#mobile')->label(null)
							->value(((isset($_GET["mobile"]))?htmlspecialchars('+'.$_GET["mobile"]):null));
		$this->password	= $this->make('#password')->label(null);
		$this->submit	= $this->make('submit')->title(T_('Create an account'));
	}

	private function verification()
	{
		$this->mobile	= $this->make('#mobile')->label(null)
							->value(((isset($_GET["mobile"]))?htmlspecialchars('+'.$_GET["mobile"]):null));
		$this->code		= $this->make('code')->label(null)->pl(T_('Code'))->maxlength(4)->autofocus();
		$this->submit	= $this->make('submit')->title(T_('Verification'));
	}

	private function recovery()
	{
		$this->mobile	= $this->make('#mobile')->label(null)
							->value(((isset($_GET["mobile"]))?htmlspecialchars('+'.$_GET["mobile"]):null));
		$this->submit	= $this->make('submit')->title(T_('Recovery'));
	}

	private function changepass()
	{
		$this->password	= $this->make('#password')->label(null);
		$this->submit	= $this->make('submit')->title(T_('Change my password'));
	}
}
?>
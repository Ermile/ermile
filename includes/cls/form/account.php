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

		var_dump("test login");
		$this->username	= $this->make('input')->name("username")->label('username');
		$this->password	= $this->make('password')->name("password")->label('password');
		$this->submit	= $this->make('submit')->label('signup');




		// $form->hidden->value(__FUNCTION__);

		// 	$form = new forms_lib;
		// 	$form = $form->make("@users");
		// 	$form->white("hidden, user_mobile, user_pass, submit");
			
		// 	$form->before("user_mobile","user_pass");
		// 	$form->user_mobile->label('')->pl('Mobile');
		// 	$form->user_mobile->value( ((isset($_GET["mobile"]))?htmlspecialchars('+'.$_GET["mobile"]):"") );
		// 	$form->user_pass->label('')->pl('Password');
		// 	$form->submit->value("");
		// 	return $form;


	}

	private function recovery()
	{
		$this->mobile	= $this->make('#mobile')->label('');
		// $this->password	= $this->make('#password')->label('');
		$this->submit	= $this->make('submit')->label('signup');
	}

}
?>
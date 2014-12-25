<?php
namespace cls\form;

class login extends \lib\form{
	public function __construct()
	{
		// var_dump("login form");
		$this->username	= $this->make('input')->name("username")->label('username');
		$this->password	= $this->make('password')->name("password")->label('password');
		$this->submit	= $this->make('submit')->label('signup');
	}
}
?>
<?php
namespace cls\form;

class signup extends \lib\form{
	public function __construct(){
		var_dump("expression");
		$this->username = $this->make('input')->name("username")->label('username');
		$this->password = $this->make('password')->name("password")->label('password');
		$this->submit = $this->make('submit')->label('signup');
	}
}
?>
<?php
namespace content\login;

class model extends \mvc\model{
	public function post_login()
	{
		\lib\debug::fatal("login", 'username', 'form');
		// var_dump("signup");
		// exit();

	}
}
?>
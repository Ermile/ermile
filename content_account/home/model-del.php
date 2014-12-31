<?php
namespace content_account\home;

class model extends \mvc\model{
	public function post_signup_old(){
		\lib\debug::error("hi", 'username', 'form');
		$test = 190;
		$this->commit(function($arg_test){
			var_dump("commit - ".$arg_test);
	}, $test);
		$this->rollback(function(){
			var_dump("rollback");
		});
	}

	public function post_signup()
	{
		var_dump("signup model");
		exit();

	}
}
?>
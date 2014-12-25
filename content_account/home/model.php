<?php
namespace content\home;

class model extends \mvc\model{
	public function post_signup(){
		\lib\debug::fatal("hi", 'username', 'form');
		$test = 190;
		$this->commit(function($arg_test){
			var_dump("commit - ".$arg_test);
		}, $test);
		$this->rollback(function(){
			var_dump("rollback");
		});
	}
}
?>
<?php
namespace content_account\changepass;
use \lib\utility;
use \lib\debug;

class model extends \mvc\model
{
	function post_changepass()
	{
		$myid = $this->login('id');
		$mypass   = utility::post('password', 'hash');

		$qry      = $this->sql()->tableUsers()->whereId($myid)->setUser_pass($mypass);
		$sql      = $qry->update();

		$this->commit(function()
		{
			debug::true(T_("change password successfully"));
			$this->redirector()->set_domain()->set_url();
		});

		// if a query has error or any error occour in any part of codes, run roolback
		$this->rollback(function() { debug::error(T_("change password failed!")); } );
	}
}
?>
<?php
namespace content\smsdelivery;
use \lib\utility;
use \lib\debug;

class model extends \mvc\model
{
	public function post_smsdelievry()
	{
		// for debug you can uncomment below line to disallow redirect
		// $this->controller()->redirector	= false; 

		$_from		= utility::post('from');
		$_to		= utility::post('to');
		$_message	= utility::post('message');
		$_messageID	= utility::post('messageID');

		$_messageid	= utility::post('messageid');
		$_status	= utility::post('status');


		var_dump($_from);
		var_dump($_to);
		var_dump($_message);
		var_dump($_messageid);
		// exit();

			$qry		= $this->sql()->tableUserlogs()
							->setUserlog_title($_from)
							->setUserlog_desc('msg:'.$_message.' |msgid'.$_messageid.' |status:'.$_status)
							->setUserlog_pass($mypass);
			$sql		= $qry->insert();

			$this->commit(function($_parameter, $_parameter2)
			{
				debug::true("Register successfully");
			}, $_from, $_to);

			// if a query has error or any error occour in any part of codes, run roolback
			$this->rollback(function()
			{
				debug::fatal("Register failed!");
			} );
	}
}
?>
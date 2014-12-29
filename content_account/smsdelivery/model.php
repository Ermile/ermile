<?php
namespace content\smsdelivery;
use \lib\utility;
use \lib\debug;

class model extends \mvc\model
{
	public function post_smsdelivery()
	{
		// for debug you can uncomment below line to disallow redirect
		// $this->controller()->redirector	= false; 

		// $_from		= utility::post('from');
		// $_to		= utility::post('to');
		// $_message	= utility::post('message');
		// $_messageID	= utility::post('messageID');

		$_messageid	= utility::post('messageid');
		$_status	= utility::post('status');

		$_messageid = is_null($_messageid)?utility::get('messageid'):$_messageid;
		$_status 	= is_null($_status)?utility::get('status'):$_status;

		

		if($_messageid == 123)
		{
			$qry		= $this->sql()->tableUserlogs()->select();
			var_dump($qry->allAssoc() );
			exit();
		}
		// var_dump($_from);
		// var_dump($_to);
		// var_dump($_message);
		// var_dump($_messageid);
		// exit();

			$qry		= $this->sql()->tableUserlogs()
							->setUserlog_title($_messageid)
							->setUserlog_priority('low')
							->setUserlog_desc(' |status:'.$_status);
			$sql		= $qry->insert();



			$this->commit(function()
			{
				debug::true("Register successfully");
			} );

			// if a query has error or any error occour in any part of codes, run roolback
			$this->rollback(function()
			{
				debug::fatal("Register failed!");
			} );
	}
}
?>
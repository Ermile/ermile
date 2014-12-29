<?php
namespace content\sms;
use \lib\utility;
use \lib\debug;

class model extends \mvc\model
{
	public function post_smsdelivery()
	{
		// for debug you can uncomment below line to disallow redirect
		// $this->controller()->redirector	= false; 

		if(isset($_POST))
		{
			$_messageid	= utility::post('messageid');
			$_status	= utility::post('status');
			$_method 	= 'post';
		}
		else
		{
			$_messageid = utility::get('messageid');
			$_status 	= utility::get('status');
			$_method 	= 'get';
		}

		// delete soon
		if(DEBUG && $_messageid == 1233)
		{
			$qry	= $this->sql()->tableSms()->select();
			var_dump($qry->allAssoc() );
			var_dump($_messageid);
			var_dump($_status);
			var_dump($_method);
			exit();
		}

		$qry		= $this->sql()->tableSms()
						->setSms_messageid($_messageid)
						->setSms_status($_status)
						->setSms_method($_method);
		$sql		= $qry->insert();

		$this->commit(function()
		{
			$this->redirector()->set_url('smsdelivery?uid=201500001');
			debug::true("Register sms successfully");
		} );

		// if a query has error or any error occour in any part of codes, run roolback
		$this->rollback(function()
		{
			$this->redirector()->set_url('smsdelivery?uid=201500001');
			debug::fatal("Register sms failed!");
		} );
	}


	public function post_smscallback()
	{
		// for debug you can uncomment below line to disallow redirect
		// $this->controller()->redirector	= false; 

		if(isset($_POST))
		{
			$_from		= utility::post('from');
			$_to		= utility::post('to');
			$_message	= utility::post('message');
			$_messageID	= utility::post('messageID');
			$_method 	= 'post';
		}
		else
		{
			$_from		= utility::get('from');
			$_to		= utility::get('to');
			$_message	= utility::get('message');
			$_messageID	= utility::get('messageID');
			$_method 	= 'get';
		}

		// delete soon
		if(DEBUG && $_messageID == 1233)
		{
			$qry	= $this->sql()->tableSms()->select();
			var_dump($qry->allAssoc() );
			var_dump($_from);
			var_dump($_to);
			var_dump($_message);
			var_dump($_messageID);
			var_dump($_method);
			exit();
		}


		$qry		= $this->sql()->tableSms()
						->setSms_from($_from)
						->setSms_to($_to)
						->setSms_message($_message)
						->setSms_messageid($_messageID)
						->setSms_method($_method);
		$sql		= $qry->insert();

		$this->commit(function()
		{
			debug::true("Register sms successfully");
			$this->redirector()->set_url('smscallback?uid=201500001');
		} );

		// if a query has error or any error occour in any part of codes, run roolback
		$this->rollback(function()
		{
			debug::fatal("Register sms failed!");
			$this->redirector()->set_url('smscallback?uid=201500001');
		} );
	}

}
?>
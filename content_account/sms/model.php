<?php
namespace content\sms;
use \lib\utility;
use \lib\debug;

class model extends \mvc\model
{
	// ********************************************************************************* SMS Delivery
	public function get_smsdelivery()
	{
		$_messageid = utility::get('messageid');
		$_status 	= utility::get('status');
		$_method	= 'get';

		if($_messageid || $_status)
			$this->smsdelivery($_messageid, $_status, $_method);
	}

	public function post_smsdelivery()
	{
		// for debug you can uncomment below line to disallow redirect
		// $this->controller()->redirector	= false;

		$_messageid	= utility::post('messageid');
		$_status	= utility::post('status');
		$_method 	= 'post';
		if($_messageid || $_status)
			$this->smsdelivery($_messageid, $_status, $_method);
	}

	private function smsdelivery($_messageid, $_status, $_method)
	{
		$qry		= $this->sql()->tableSms()
						->setSms_messageid($_messageid)
						->setSms_status($_status)
						->setSms_method($_method)
						->setSms_type('delivery');
		$sql		= $qry->insert();

		$this->commit(function()
		{
			$this->redirector()->set_url();
			debug::true("Register sms successfully");
		});

		// if a query has error or any error occour in any part of codes, run roolback
		$this->rollback(function()
		{
			$this->redirector()->set_url();
			debug::fatal("Register sms failed!");
		});

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
	}



	// ********************************************************************************* SMS Receive
	public function get_smscallback()
	{
		$_from		= utility::get('from');
		$_to		= utility::get('to');
		$_message	= utility::get('message');
		$_messageID	= utility::get('messageID');
		$_method 	= 'get';
		
		if($_from && $_to && $_message)
			$this->smscallback($_from, $_to, $_message, $_messageID, $_method);
	}

	public function post_smscallback()
	{
		// for debug you can uncomment below line to disallow redirect
		// $this->controller()->redirector	= false; 

			$_from		= utility::post('from');
			$_to		= utility::post('to');
			$_message	= utility::post('message');
			$_messageID	= utility::post('messageID');
			$_method 	= 'post';

		if($_from && $_to && $_message)
			$this->smscallback($_from, $_to, $_message, $_messageID, $_method);
	}

	private function smscallback($_from, $_to, $_message, $_messageID, $_method)
	{
		$qry		= $this->sql()->tableSms()
						->setSms_from($_from)
						->setSms_to($_to)
						->setSms_message($_message)
						->setSms_messageid($_messageID)
						->setSms_method($_method)
						->setSms_type('receive');
		$sql		= $qry->insert();

		$this->commit(function()
		{
			debug::true("Register sms successfully");
			$this->redirector()->set_url();
		} );

		// if a query has error or any error occour in any part of codes, run roolback
		$this->rollback(function()
		{
			debug::fatal("Register sms failed!");
			$this->redirector()->set_url();
		} );

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
	}
}
?>
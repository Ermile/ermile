<?php
namespace content_account\verificationsms;
use \lib\utility;
use \lib\debug;

class model extends \mvc\model
{
	function post_verificationsms()
	{
		// sleep(5);
		// exit();
		$mymobile	= '+'.utility::get('mobile');
		$tmp_result	= $this->sql()->tableSmss()
						->whereSms_from($mymobile)
						->andSms_type('receive')
						->andSms_status('enable')
						->select();

		if($tmp_result->num()==1)
		{
			$this->put_changeSmsStatus($mymobile);
		}
		elseif(strlen($mymobile) == 13 && substr($mymobile, 0,3)=='+98')
		{
			// check for iranian numbers
			$mymobile = '0'.substr($mymobile, 3);
			$tmp_result	= $this->sql()->tableSmss()
							->whereSms_from($mymobile)
							->andSms_type('receive')
							->andSms_status('enable')
							->select();

			if($tmp_result->num()==1)
			{
				$this->put_changeSmsStatus($mymobile);
			}
			else
			{
				debug::warn(T_('We are waiting for your message!'));
			}

		}
		else
			debug::warn(T_('We are waiting for your message!'));

		// sleep(1);
		// debug::fatal(T_('Error on verify your code!'));
		// $this->redirector()->set_url('login?from=verification&mobile='.$mymobile.
		// 			'&referer='.utility::get('referer') );
		// $this->controller()->redirector = false;
	}

	function put_changeSmsStatus($mymobile)
	{
		$qry		= $this->sql()->tableSmss()
						->setSms_status('expire')
						->whereSms_from($mymobile)
						->andSms_type('receive')
						->andSms_status('enable');
		$sql		= $qry->update();

		$this->commit(function()
		{
			sleep(3);
			debug::true(T_('We receive your message and your account is now verifited.'));
		});

		// if a query has error or any error occour in any part of codes, run roolback
		$this->rollback(function()
		{
			debug::error(T_('Error on verify your code!'));
		} );
	}
}
?>
<?php
namespace content_account\verification;
use \lib\utility;
use \lib\debug;

class model extends \mvc\model
{
	function post_verification()
	{
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
		else
		{
			debug::fatal(T_('We are waiting for your message!'));
		}

		// sleep(1);
		// debug::fatal(T_('Error on verify your code!'));
		// $this->redirector()->set_url('login?from=verification&mobile='.$mymobile.
		// 			'&referer='.utility::get('referer') );
		$this->controller()->redirector = false;
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
			debug::fatal(T_('Error on verify your code!'));
		} );
		$this->controller()->redirector = false;
	}

	function put_verification()
	{
		// for debug you can uncomment below line to disallow redirect
		// $this->controller()->redirector	= false; 

		$mymobile			= '+'.utility::get('mobile');
		$mycode				= utility::post('code');
		$tmp_result			=  $this->sql()->tableVerifications()
								->whereVerification_value($mymobile)
								->andVerification_code($mycode)
								->andVerification_status('enable')
								->select();

// var_dump($tmp_result);exit();
		if($tmp_result->num() == 1)
		{
			// mobile and code exist update the record and verify
			$qry		= $this->sql()->tableVerifications()
							->setVerification_status('expire')
							->whereVerification_value($mymobile)
							->andVerification_code($mycode)
							->andVerification_status('enable');
			$sql		= $qry->update();


			// ======================================================
			// you can manage next event with one of these variables,
			// commit for successfull and rollback for failed
			//
			// if query run without error means commit
			$this->commit(function($_parameter, $_parameter2)
			{
				if($_parameter2=='signup')
				{
					//Send SMS
					// \lib\utility::send_sms($_parameter);

					$this->redirector()->set_url('login?from=verification&mobile='.(substr($_parameter,1)).
						'&referer='.utility::get('referer') );
					debug::true("Verify successfully. Now you can login and enjoy!");
				}
				elseif($_parameter2=='recovery')
				{
					$this->redirector()->set_url('changepass?from=verification&mobile='.(substr($_parameter,1)).
						'&referer='.utility::get('referer') );
					// login user to system
					debug::true("Verify successfully. Please Input your new password");	
				}
			}, $mymobile, utility::get('from'));

			// if a query has error or any error occour in any part of codes, run roolback
			$this->rollback(function()
			{
				debug::error("Verify failed!");
			} );
		}
		elseif($tmp_result->num() == 0 )
		{
			// mobile does not exits
			debug::error("This code or mobile is incorrect");
		}
		else
		{
			// mobile exist more than 2 times!
			debug::error("Please forward this message to Administrator");
		}
	}
}
?>
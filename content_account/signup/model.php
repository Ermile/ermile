<?php
namespace content_account\signup;
use \lib\utility;
use \lib\debug;

class model extends \mvc\model
{
	public function post_signup()
	{
		// for debug you can uncomment below line to disallow redirect
		// $this->controller()->redirector	= false; 

		$mymobile	= str_replace(' ', '', utility::post('mobile'));
		$mypass		= utility::post('password');
		$tmp_result	=  $this->sql()->tableUsers()->whereUser_mobile($mymobile)->select();


		if($tmp_result->num() == 1)
		{
			// mobile exist
			debug::error("Mobile number exist!");
		}
		elseif($tmp_result->num() == 0 )
		{
			// mobile does not exits
			$qry		= $this->sql()->tableUsers()
							->setUser_type('storeadmin')
							->setUser_mobile($mymobile)
							->setUser_pass($mypass)
							->setUser_createdate(date('Y-m-d H:i:s'));
			$sql		= $qry->insert();

			$myuserid	= $sql->LAST_INSERT_ID();
			$mycode		= utility::randomCode();
			$qry		= $this->sql()->tableVerifications()
							->setVerification_type('mobileregister')
							->setVerification_value($mymobile)
							->setVerification_code($mycode)
							->setUser_id($myuserid)
							->setVerification_verified('no')
							->setVerification_createdate(date('Y-m-d H:i:s'));
			$sql		= $qry->insert();


			// ======================================================
			// you can manage next event with one of these variables,
			// commit for successfull and rollback for failed
			// if query run without error means commit
			$this->commit(function($_parameter, $_parameter2)
			{
				//Send SMS
				\lib\utility::send_sms($_parameter, $_parameter2);

				$this->redirector()->set_url('verification?from=signup&mobile='.(substr($_parameter,1)).
					'&referer='.utility::get('referer') );
				debug::true("Register successfully");
			}, $mymobile, $mycode);

			// if a query has error or any error occour in any part of codes, run roolback
			$this->rollback(function()
			{
				debug::error("Register failed!");
			} );
		}
		else
		{
			// mobile exist more than 2 times!
			debug::error("Please forward this message to Administrator");
		}
	}
}
?>
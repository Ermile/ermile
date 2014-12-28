<?php
namespace content\verification;
use \lib\utility;
use \lib\debug;

class model extends \mvc\model
{
	function put_verification()
	{
		// for debug you can uncomment below line to disallow redirect
		// $this->controller()->redirector	= false; 

		$mymobile			= str_replace(' ', '', utility::post('mobile'));
		$mycode				= utility::post('code');
		$tmp_result			=  $this->sql()->tableVerifications()
								->whereVerification_value($mymobile)
								->andVerification_code($mycode)
								->andVerification_verified('no')
								->select();

		if($tmp_result->num() == 1)
		{
			// mobile and code exist update the record and verify
			$qry		= $this->sql()->tableVerifications()
							->setVerification_verified('yes')
							->whereVerification_value($mymobile)
							->andVerification_code($mycode);
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
					\lib\utility::send_sms($_parameter);

					$this->redirector()->set_url('login?from=verification&mobile='.(substr($_parameter,1)) )->redirect();
					debug::true("Verify successfully");
				}
				elseif($_parameter2=='recovery')
				{
					$this->redirector()->set_url('changepass?from=verification&mobile='.(substr($_parameter,1)) )->redirect();
					// login user to system
					debug::true("Verify successfully. Please Input your new password");	
				}
			}, $mymobile, utility::get('from'));

			// if a query has error or any error occour in any part of codes, run roolback
			$this->rollback(function()
			{
				debug::fatal("Verify failed!");
			} );
		}
		elseif($tmp_result->num() == 0 )
		{
			// mobile does not exits
			debug::fatal("This code or mobile is incorrect");
		}
		else
		{
			// mobile exist more than 2 times!
			debug::fatal("Please forward this message to Administrator");
		}
	}
}
?>
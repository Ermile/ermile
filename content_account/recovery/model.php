<?php
namespace content_account\recovery;
use \lib\utility;
use \lib\debug;

class model extends \mvc\model
{
	function post_recovery()
	{
		// for debug you can uncomment below line to disallow redirect
		// $this->controller()->redirector	= false; 

		sleep(2);
		$mymobile   = str_replace(' ', '', utility::post('mobile'));
		$tmp_result =  $this->sql()->tableUsers()->whereUser_mobile($mymobile)->select();

		if($tmp_result->num() == 1)
		{
			// mobile exist
			// login: check password then user can login
			// register: show error
			// recovery: let's go
			
			$tmp_result = $tmp_result->assoc();
			$myuserid   = $tmp_result['id'];
			$mycode     = utility::randomCode();
			
			$qry        = $this->sql()->tableVerifications()
								->setVerification_type('mobileforget')
								->setVerification_value($mymobile)
								->setVerification_code($mycode)
								->setUser_id($myuserid)
								->setVerification_verified('no');
			$sql        = $qry->insert();


			// ======================================================
			// you can manage next event with one of these variables,
			// commit for successfull and rollback for failed
			//
			// if query run without error means commit
			$this->commit(function($_parameter, $_parameter2)
			{
				//Send SMS
				\lib\utility::send_sms($_parameter, $_parameter2);

				debug::true(T_("Step 1 of 2 is complete. Please check your mobile to continue"));
				$this->redirector()->set_url('verification?from=recovery&mobile='.(substr($_parameter,1)).
					'&referer='.utility::get('referer') );
			}, $mymobile, $mycode);

			// if a query has error or any error occour in any part of codes, run roolback
			$this->rollback(function()
			{
				debug::error(T_("Recovery failed!"));
			} );
		}

		elseif($tmp_result->num() == 0 )
		{
			// mobile does not exits
			// login: show mobile does not exist
			// register: ok, can register
			debug::error(T_("Mobile number is incorrect"));
		}

		else
		{
			// mobile exist more than 2 times!
			debug::error(T_("Please forward this message to Administrator"));
		}
	}
}
?>
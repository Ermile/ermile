<?php
namespace content_account\recovery;
use \lib\utility;
use \lib\debug;

class model extends \mvc\model
{
	public function post_recovery()
	{
		// get parameters and set to local variables
		$mymobile   = str_replace(' ', '', utility::post('mobile'));
		$mymobile   = substr($mymobile, 1);
		// check for mobile exist
		$tmp_result =  $this->sql()->tableUsers()->whereUser_mobile($mymobile)->select();

		if($tmp_result->num() == 1)
		{
			$myuserid = $tmp_result->assoc('id');
			$mycode   = utility::randomCode();
			
			$qry      = $this->sql()->tableVerifications ()
							->setVerification_type           ('mobilerecovery')
							->setVerification_value          ($mymobile)
							->setVerification_code           ($mycode)
							->setUser_id                     ($myuserid)
							->setVerification_verified       ('no');
			$sql      = $qry->insert();


			// ======================================================
			// you can manage next event with one of these variables,
			// commit for successfull and rollback for failed
			//
			// if query run without error means commit
			$this->commit(function($_mobile, $_code)
			{
				$myreferer = utility\Cookie::read('referer');
				//Send SMS
				\lib\utility\Sms::send($_mobile, 'recovery', $_code);
				debug::true(T_("we send a verification code for you"));

				$this->redirector()->set_url('verification?from=recovery&mobile='.$_mobile.'&referer='.$myreferer );
			}, $mymobile, $mycode);

			// if a query has error or any error occour in any part of codes, run roolback
			$this->rollback(function() { debug::error(T_("recovery failed!")); } );
		}

		// mobile does not exits
		elseif($tmp_result->num() == 0 )
			debug::error(T_("Mobile number is incorrect"));

		// mobile exist more than 2 times!
		else
			debug::error(T_("please forward this message to administrator"));
	}
}
?>
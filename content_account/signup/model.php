<?php
namespace content_account\signup;
use \lib\utility;
use \lib\debug;

class model extends \mvc\model
{
	public function post_signup()
	{
		// get parameters and set to local variables
		$mymobile   = utility::post('mobile', 'filter');
		$mypass     = utility::post('password', 'hash');
		// check for mobile exist
		$tmp_result = $this->sql()->tableUsers()->whereUser_mobile($mymobile)->select();

		// if exist
		if($tmp_result->num() == 1)
			debug::error(T_("mobile number exist!"));

		// if new mobile number
		elseif($tmp_result->num() == 0 )
		{
			$qry      = $this->sql()->tableUsers ()
							->setUser_type           ('storeadmin')
							->setUser_mobile         ($mymobile)
							->setUser_pass           ($mypass)
							->setUser_createdate     (date('Y-m-d H:i:s'));
			$sql      = $qry->insert();
			
			$myuserid = $sql->LAST_INSERT_ID();
			$mycode   = utility::randomCode();
			$qry      = $this->sql()->tableVerifications()
							->setVerification_type             ('mobilesignup')
							->setVerification_value            ($mymobile)
							->setVerification_code             ($mycode)
							->setUser_id                       ($myuserid)
							->setVerification_status           ('enable')
							->setVerification_createdate       (date('Y-m-d H:i:s'));
			$sql      = $qry->insert();


			// ======================================================
			// you can manage next event with one of these variables,
			// commit for successfull and rollback for failed
			// if query run without error means commit
			$this->commit(function($_mobile, $_code)
			{
				$myreferer = utility\Cookie::read('referer');
				//Send SMS
				\lib\utility\Sms::send($_mobile, 'signup', $_code);
				debug::true(T_("register successfully").'. '.T_('we send a verification code for you'));

				$this->redirector()->set_url('verification?from=signup&mobile='.$_mobile.'&referer='.$myreferer);
			}, $mymobile, $mycode);

			// if a query has error or any error occour in any part of codes, run roolback
			$this->rollback(function() { debug::error(T_("register failed!")); } );
		}

		// if mobile exist more than 2 times!
		else
			debug::error(T_("please forward this message to administrator"));
	}
}
?>
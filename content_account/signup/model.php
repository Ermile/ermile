<?php
namespace content\signup;
use \lib\utility;
use \lib\debug;

class model extends \mvc\model
{
	public function post_signup()
	{
		// for debug you can uncomment below line to disallow redirect
		// $this->controller()->redirector	= false; 

		$mymobile						= str_replace(' ', '', utility::post('mobile'));
		$mypass							= utility::post('password');
		$tmp_result						=  $this->sql()->tableUsers()->whereUser_mobile($mymobile)->select();


		if($tmp_result->num() == 1)
		{
			// mobile exist
			debug::fatal("Mobile number exist!");
			if(DEBUG)
				var_dump('Mobile number exist!');
		}

		elseif($tmp_result->num() == 0 )
		{
			if(DEBUG)
				var_dump('Mobile number not exist. go for register');
			// mobile does not exits
			$qry		= $this->sql()->tableUsers()
							->setUser_type('store_admin')
							->setUser_mobile($mymobile)
							->setUser_pass($mypass);
			$sql		= $qry->insert();

			$myuserid	= $sql->LAST_INSERT_ID();
			$mycode		= utility::randomCode();
			$qry		= $this->sql()->tableVerifications()
							->setVerification_type('mobileregister')
							->setVerification_value($mymobile)
							->setVerification_code($mycode)
							->setUser_id($myuserid)
							->setVerification_verified('no');
			$sql		= $qry->insert();



			// ======================================================
			// you can manage next event with one of these variables,
			// commit for successfull and rollback for failed
			// if query run without error means commit

			$this->commit(function($_parameter, $_parameter2)
			{
				if(DEBUG)
					var_dump('Register successfully. commit');

				//Send SMS
				// $sendnotify = new sendnotify_cls;
				\lib\utility::send_sms($_parameter, $_parameter2);
				// $sendnotify->sms();

				debug::true("Register successfully");
				// $this->redirect('/verification?mobile='.(substr($_parameter,1)).'&code='.$_parameter2);
				// $this->redirect('/verification?from=signup&mobile='.(substr($_parameter,1)));

				// \lib\redirector::
				// $x = new \lib\redirector(); // default: your url
				// $x->set_domain("ermile.com") // default: your doamin
				// ->set_protocol("https") // default:http 
				// ->redirect();


			}, $mymobile, $mycode);

			// if a query has error or any error occour in any part of codes, run roolback
			$this->rollback(function()
			{
				if(DEBUG)
					var_dump('Register failed. rollback');

				debug::fatal("Register failed!");
			} );
		}

		else
		{
			// mobile exist more than 2 times!
			debug::fatal("Please forward this message to Administrator");
		}
	}
}
?>
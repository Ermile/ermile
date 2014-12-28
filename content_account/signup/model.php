<?php
namespace content\signup;
use \lib\utility;
use \lib\debug;

class model extends \mvc\model
{
	public function post_signup()
	{
		// for debug you can uncomment below line to disallow redirect
		// $this->redirect 	= false;
		$mymobile			= str_replace(' ', '', utility::post('mobile'));
		$mypass				= utility::post('password');
		// var_dump($mymobile);var_dump($mypass);
		$tmp_result			=  $this->sql()->tableUsers()->whereUser_mobile($mymobile)->select();

		if($tmp_result->num() == 1)
		{
			// mobile exist
			debug::fatal("Mobile number exist!");
		}

		elseif($tmp_result->num() == 0 )
		{
			// mobile does not exits
			$qry		= $this->sql()->tableUsers()
							->setUser_type('store_admin')
							->setUser_mobile($mymobile)
							->setUser_pass($mypass);
			$sql		= $qry->insert();

			$myuserid	= $sql->LAST_INSERT_ID();
			// $mycode		= $this->randomCode();
			$mycode		= utility::randomCode();
			// var_dump($mycode);
			$qry		= $this->sql()->tableVerifications()
							->setVerification_type('mobileregister')
							->setVerification_value($mymobile)
							->setVerification_code($mycode)
							->setUser_id($myuserid)
							->setVerification_verified('no');
			$sql		= $qry->insert();


		$test = 190;
		$this->commit(function($arg_test){
			var_dump("commit - ".$arg_test);
		}, $test);
		$this->rollback(function(){
			var_dump("rollback");
		});


			// ======================================================
			// you can manage next event with one of these variables,
			// commit for successfull and rollback for failed
			//
			// if query run without error means commit
			$this->commit(function($_parameter, $_parameter2)
			{
				//Send SMS
				$sendnotify = new sendnotify_cls;
				$sendnotify->sms($_parameter, $_parameter2);

				debug::true("Register successfully");
				var_dump("Register successfully");
				// $this->redirect('/verification?mobile='.(substr($_parameter,1)).'&code='.$_parameter2);
				$this->redirect('/verification?from=signup&mobile='.(substr($_parameter,1)));
			}, $mymobile, $mycode);

			// if a query has error or any error occour in any part of codes, run roolback
			$this->rollback(function()
			{
				debug::fatal("Register failed!");
				var_dump("Register failed");
			} );
			var_dump("Register");
		}

		else
		{
			// mobile exist more than 2 times!
			debug::fatal("Please forward this message to Administrator");
		}

		// we need to create a module for sale the account to users for ourselves
		// $x = new dbconnection_lib
		// $x->query("my QUERY")



		exit();
		// \lib\debug::fatal("hi", 'username', 'form');

	}

	function post_signup_old()
	{
		// for debug you can uncomment below line to disallow redirect
		// $this->redirect 	= false;
		$mymobile			= str_replace(' ', '', post::mobile());
		$mypass				= post::pass();
		$tmp_result			=  $this->sql()->tableUsers()->whereUser_mobile($mymobile)->select();
		
		if($tmp_result->num() == 1)
		{
			// mobile exist
			debug_lib::fatal("Mobile number exist!");
		}

		elseif($tmp_result->num() == 0 )
		{
			// mobile does not exits
			$qry		= $this->sql()->tableUsers()
							->setUser_type('store_admin')
							->setUser_mobile($mymobile)
							->setUser_pass($mypass);
			$sql		= $qry->insert();

			$myuserid	= $sql->LAST_INSERT_ID();
			$mycode		= $this->randomCode();
			
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
			//
			// if query run without error means commit
			$this->commit(function($_parameter, $_parameter2)
			{
				//Send SMS
				$sendnotify = new sendnotify_cls;
				$sendnotify->sms($_parameter, $_parameter2);

				debug_lib::true("Register successfully");
				// $this->redirect('/verification?mobile='.(substr($_parameter,1)).'&code='.$_parameter2);
				$this->redirect('/verification?from=signup&mobile='.(substr($_parameter,1)));
			}, $mymobile, $mycode);

			// if a query has error or any error occour in any part of codes, run roolback
			$this->rollback(function()
			{
				debug_lib::fatal("Register failed!");
			} );
			
		}

		else
		{
			// mobile exist more than 2 times!
			debug_lib::fatal("Please forward this message to Administrator");
		}

		// we need to create a module for sale the account to users for ourselves
		// $x = new dbconnection_lib
		// $x->query("my QUERY")
	}
}
?>
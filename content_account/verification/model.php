<?php
namespace content_account\verification;
use \lib\utility;
use \lib\debug;

class model extends \mvc\model
{
	public function put_verification()
	{
		// for debug you can uncomment below line to disallow redirect
		// $this->controller()->redirector	= false; 
		sleep(1);
		$mytype     = utility\Cookie::read('from');
		$mymobile   = str_replace(' ', '', utility::post('mobile'));
		$mycode     = utility::post('code');
		$tmp_result	= $this->sql()->tableVerifications  ()
							->whereVerification_value        ($mymobile)
							->andVerification_code           ($mycode)
							->andVerification_type           ('mobile'.$mytype)
							->andVerification_status         ('enable')
							->select();
		var_dump($tmp_result->num());
		exit();

		if($tmp_result->num())
		{
			// mobile and code exist update the record and verify
			$qry		= $this->sql()->tableVerifications ()
							->setVerification_status        ('expire')
							->whereVerification_value       ($mymobile)
							->andVerification_code          ($mycode)
							->andVerification_type          ('mobile'.$mytype)
							->andVerification_status        ('enable');
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
					debug::true(T_("Verify successfully. Now you can login and enjoy!"));
				}
				elseif($_parameter2=='recovery')
				{
					$this->redirector()->set_url('changepass?from=verification&mobile='.(substr($_parameter,1)).
						'&referer='.utility::get('referer') );
					// login user to system
					debug::true(T_("Verify successfully. Please Input your new password"));
				}
				else
				{
					debug::warn(T_("Verify successfully. You must reffer from one point!"));
				}
			}, $mymobile, utility::get('from'));

			// if a query has error or any error occour in any part of codes, run roolback
			$this->rollback(function()
			{
				debug::error(T_("Verify failed!"));
			} );
		}
		elseif($tmp_result->num() == 0 )
		{
			// mobile does not exits
			debug::error(T_("This data is incorrect"));
		}
		else
		{
			// mobile exist more than 2 times!
			debug::error(T_("Please forward this message to Administrator").$tmp_result->string());
		}
	}
}
?>
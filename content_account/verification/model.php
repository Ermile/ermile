<?php
namespace content_account\verification;
use \lib\utility;
use \lib\debug;

class model extends \mvc\model
{
	public function post_verification()
	{
		put_verification();
	}

	public function put_verification()
	{
		// get parameters and set to local variables
		$mymobile   = utility::post('mobile', 'filter');
		$mycode     = utility::post('code');
		$myfrom     = utility\Cookie::read('from');

		// check for mobile exist
		$tmp_result	= $this->sql()->tableVerifications  ()
							->whereVerification_value        ($mymobile)
							->andVerification_code           ($mycode)
							->andVerification_type           ('mobile'.$myfrom)
							->andVerification_status         ('enable')
							->select();

		if($tmp_result->num())
		{
			// mobile and code exist update the record and verify
			$qry		= $this->sql()->tableVerifications ()
							->setVerification_status        ('expire')
							->whereVerification_value       ($mymobile)
							->andVerification_code          ($mycode)
							->andVerification_type          ('mobile'.$myfrom)
							->andVerification_status        ('enable');
			$sql		= $qry->update();


			// ======================================================
			// you can manage next event with one of these variables,
			// commit for successfull and rollback for failed
			//
			// if query run without error means commit
			$this->commit(function($_mobile, $_from)
			{
				$myreferer = utility\Cookie::read('referer');
				if($_from == 'signup')
				{
					//Send SMS
					\lib\utility\Sms::send($_mobile, 'verification');
					debug::true(T_("verify successfully.").' '.T_("now you can login and enjoy!"));

					$this->redirector()->set_url('login?from=verification&mobile='.$_mobile.'&referer='.$myreferer );
				}
				elseif($_from=='recovery')
				{
					debug::true(T_("verify successfully.").' '.T_("please Input your new password"));

					// login user to system
					$this->redirector()->set_url('changepass?from=verification&mobile='.$_mobile.'&referer='.$myreferer );
				}
				else
					debug::warn(T_("verify successfully.").' '.T_("but you must reffer from one point!"));
			}, $mymobile, $myfrom);

			// if a query has error or any error occour in any part of codes, run roolback
			$this->rollback(function() { debug::error(T_("verify failed!")); } );
		}

		// mobile does not exits
		elseif($tmp_result->num() == 0 )
			debug::error(T_("this data is incorrect"));

		// mobile exist more than 2 times!
		else
			debug::error(T_("please forward this message to administrator"));
	}
}
?>
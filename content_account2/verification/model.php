<?php
namespace content_account\verification;
use \lib\utility;
use \lib\debug;

class model extends \mvc\model
{
	public function post_verification()
	{
		$this->put_verification();
	}

	public function put_verification()
	{
		// get parameters and set to local variables
		$mymobile   = utility::post('mobile', 'filter');
		$mycode     = utility::post('code');
		$myfrom     = utility\cookie::read('from');

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
			// if query run without error means commit
			$this->commit(function($_mobile, $_from)
			{
				$myid = $this->sql()->tableUsers()->whereUser_mobile($_mobile)->select()->assoc('id');
				if($_from == 'signup')
				{
					// login user to system
					$this->model()->setLogin($myid);
					//Send SMS
					\lib\utility\Sms::send($_mobile, 'verification');
					debug::true(T_("verify successfully."));
				}
				else
				{
					// login user to system
					$this->model()->setLogin($myid, false);
					$this->redirector()->set_url('changepass');

					$myreferer = utility\cookie::write('mobile', $_mobile, 60*5);
					$myreferer = utility\cookie::write('from', 'verification', 60*5);
					debug::true(T_("verify successfully.").' '.T_("please Input your new password"));
				}
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
<?php
namespace content_account\verificationsms;
use \lib\utility;
use \lib\debug;

class model extends \mvc\model
{
	public function post_verificationsms()
	{
		$mymobile   = utility\cookie::read('mobile');

		$tmp_result	= $this->sql()->tableSmss ()
						->whereSms_from           ($mymobile)
						->andSms_type             ('receive')
						->andSms_status           ('enable')
						->select();

		if($tmp_result->num()==1)
			$this->put_changeSmsStatus($mymobile);

		else
			debug::warn(T_('we are waiting for your message!'));
	}

	function put_changeSmsStatus($mymobile)
	{
		$qry		= $this->sql()->tableSmss ()
						->setSms_status        ('expire')
						->whereSms_from        ($mymobile)
						->andSms_type          ('receive')
						->andSms_status        ('enable');
		$sql		= $qry->update();


		// ======================================================
		// you can manage next event with one of these variables,
		// commit for successfull and rollback for failed
		// if query run without error means commit
		$this->commit(function($_mobile)
		{
			$myfrom     = utility\cookie::read('from');
			$myid = $this->sql()->tableUsers()->whereUser_mobile($_mobile)->select()->assoc('id');
			if($myfrom == 'signup')
			{
				// login user to system
				$this->model()->setLogin($myid);
				//Send SMS
				\lib\utility\Sms::send($_mobile, 'verification');
				debug::true(T_('we receive your message and your account is now verifited.'));
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
		}, $mymobile);

		// if a query has error or any error occour in any part of codes, run roolback
		$this->rollback(function() { debug::error(T_('error on verify your code!')); } );
	}
}
?>
<?php
namespace content_account\login;
use \lib\utility;
use \lib\debug;

class model extends \mvc\model
{
	public function post_login()
	{
		// get parameters and set to local variables
		$mymobile   = utility::post('mobile', 'filter');
		$mypass     = utility::post('password');
		// check for mobile exist
		$tmp_result =  $this->sql()->tableUsers()->whereUser_mobile($mymobile)->select();

		// if exist
		if($tmp_result->num() == 1)
		{
			$tmp_result       = $tmp_result->assoc();
			$myhashedPassword = $tmp_result['user_pass'];
			// if password is correct. go for login:)
			if (isset($myhashedPassword) && utility::hasher($mypass, $myhashedPassword))
			{
				$this->model()->setLogin($tmp_result['id']);
				debug::true(T_("login successfully"));
			}
				// password is incorrect:(
			else
				debug::error(T_("mobile or password is incorrect").' pass');
		}
		// mobile does not exits
		elseif($tmp_result->num() == 0 )
			debug::error(T_("mobile or password is incorrect"). ' user');

		// mobile exist more than 2 times!
		else
			debug::error(T_("please forward this message to administrator"));
	}
}
?>
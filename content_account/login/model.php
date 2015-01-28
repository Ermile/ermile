<?php
namespace content_account\login;
use \lib\utility;
use \lib\debug;

class model extends \mvc\model
{
	public function post_login()
	{
		// get parameters and set to local variables
		$mymobile   = str_replace(' ', '', utility::post('mobile'));
		$mymobile   = substr($mymobile, 1);
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
				$this->setLoginSession($tmp_result);

				// Create Token and add to db for cross login ****************************************************
				$mycode	= md5('^_^'.$tmp_result['id'].'_*Ermile*_'.date('Y-m-d H:i:s').'^_^');
				$qry		= $this->sql()->tableUsermetas ()
								->setUser_id                ($tmp_result['id'])
								->setUsermeta_cat           ('cookie_token')
								->setUsermeta_name          (ip2long($_SERVER['REMOTE_ADDR']))
								->setUsermeta_value         ($mycode);
				$sql		= $qry->insert();


				// ======================================================
				// you can manage next event with one of these variables,
				// commit for successfull and rollback for failed
				// if query run without error means commit
				$this->commit(function($_code)
				{
					$myreferer = utility\Cookie::read('referer');
					$myreferer = isset($myreferer)? $myreferer : utility::get('referer');


					// create code for pass with get to service home page
					debug::true(T_("login successfully"));

					if($myreferer=='jibres')
						$this->redirector()->set_domain('jibres.'.$this->url('tld'))->set_url('?dev=y&from=ermile&ssid='.$_code);

					elseif($myreferer=='talambar')
						$this->redirector()->set_domain('talambar.'.$this->url('tld'))->set_url('?dev=y&from=ermile&ssid='.$_code);

					else
						$this->redirector()->set_domain()->set_url('?from=ermile&ssid='.$_code);
				}, $mycode);
				$this->rollback(function() { debug::error(T_("login failed!")); });

			}
				// password is incorrect:(
			else
				debug::error(T_("mobile or password is incorrect"));
		}
		// mobile does not exits
		elseif($tmp_result->num() == 0 )
			debug::error(T_("mobile or password is incorrect"));

		// mobile exist more than 2 times!
		else
			debug::error(T_("please forward this message to administrator"));
	}
}
?>
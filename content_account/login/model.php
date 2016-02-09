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
				// $this->model()->setLogin($tmp_result['id']);
				// debug::true(T_("login successfully"));



				// Create Token and add to db for cross login ****************************************************
				// you can change the code way easily at any time!
				$mycode	= md5('^_^'.$tmp_result['id'].'_*Ermile*_'.date('Y-m-d H:i:s').'^_^');
				$qry		= $this->sql()->table ('options')
								->setUser_id                ($tmp_result['id'])
								->setOption_cat           ('cookie_token')
								->setOption_key          (ip2long($_SERVER['REMOTE_ADDR']))
								->setOption_value         ($mycode);
				$sql		= $qry->insert();

				$_SESSION['ssid'] = $mycode;

				// ======================================================
				// you can manage next event with one of these variables,
				// commit for successfull and rollback for failed
				// if query run without error means commit
				$this->commit(function($_code)
				{
					$myreferer = utility\Cookie::read('referer');
					utility\Cookie::delete('referer');


					// create code for pass with get to service home page
					debug::true(T_("login successfully"));

					if($myreferer=='jibres')
					{
						$this->redirector()->set_domain('jibres.'.$this->url('tld'))->set_url('?ssid='.$_code);
					}

					elseif($myreferer=='talambar')
					{
						$this->redirector()->set_domain('talambar.'.$this->url('tld'))->set_url('?ssid='.$_code);
					}

					elseif($myreferer)
					{
						$this->redirector()->set_domain($myreferer.MainTld)->set_url('?ssid='.$_code);
					}
					else
					{
						// $this->redirector()->set_domain()->set_url('?ssid='.$_code);
						$this->redirector()->set_domain()->set_url();
					}

				}, $mycode);

				$this->rollback(function() { debug::error(T_("login failed!")); });






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
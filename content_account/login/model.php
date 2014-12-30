<?php
namespace content\login;
use \lib\utility;
use \lib\debug;

class model extends \mvc\model
{
	public function post_login()
	{
		// for debug you can uncomment below line to disallow redirect
		// $this->controller()->redirector	= false; 

		$mymobile	= str_replace(' ', '', utility::post('mobile'));
		$mypass		= utility::post('password');
		$tmp_result	=  $this->sql()->tableUsers()->whereUser_mobile($mymobile)->select();

		if($tmp_result->num() == 1)
		{
			// mobile exist
			$tmp_result = $tmp_result->assoc();
			if (isset($tmp_result['user_pass']) && $tmp_result['user_pass'] == $mypass)
			{
				// password is correct. go for login:)
				$_SESSION['user']	= array();
				$tmp_fields			= array('type', 'gender', 'firstname', 'lastname', 'nickname', 'mobile', 'status', 'credit');
				
				foreach ($tmp_fields as $key => $value) 
				{
					$_SESSION['user'][$value]	= $tmp_result['user_'.$value];
				}
				$_SESSION['user']['id']				= $tmp_result['id'];
				$_SESSION['user']['permission_id']	= $tmp_result['permission_id'];


				// Create Token and add to db for cross login ****************************************************
				$mycode		= md5($tmp_result['id'].'_Ermile_'.date('Y-m-d H:i:s'));
				$qry		= $this->sql()->tableUsermetas()
								->setUser_id($tmp_result['id'])
								->setUsermeta_cat('cookie_token')
								->setUsermeta_name(ip2long($_SERVER['REMOTE_ADDR']))
								->setUsermeta_value($mycode);
				$sql		= $qry->insert();

				$this->commit(function($_parameter1)
				{
					// create code for pass with get to service home page

					// debug::true("Register sms successfully");
					debug::true("Login successfully");

					if(utility::get('referer')=='jibres')
						$this->redirector()->set_domain('jibres.dev')->set_url('?ssid='.$_parameter1);

					elseif(utility::get('referer')=='station')
						$this->redirector()->set_domain('station.dev')->set_url('?ssid='.$_parameter1);

					else
						$this->redirector()->set_domain()->set_url('?ssid='.$_parameter1);
				}, $mycode);
				$this->rollback(function()
				{
					debug::true("Login Failed!");
				});

			}
			else
			{
				// password is incorrect:(
				debug::error("Password is incorrect", "mobile", "password");
			}
		}
		elseif($tmp_result->num() == 0 )
		{
			// mobile does not exits
			debug::error("Mobile number is incorrect", "mobile", "form");
		}
		else
		{
			// mobile exist more than 2 times!
			debug::error("Please forward this message to Administrator");
		}
	}
}
?>
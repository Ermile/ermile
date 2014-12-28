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
				$this->login_register($tmp_result);
				
				debug::true("Login successfully");

				if(utility::get('referer')=='jibres')
					$this->redirector()->set_domain('jibres.dev')->set_url();

				elseif(utility::get('referer')=='station')
					$this->redirector()->set_domain('station.dev')->set_url();

				else
					$this->redirector()->set_domain()->set_url();
			}
			else
			{
				// password is incorrect:(
				debug::fatal("Password is incorrect");
			}
		}
		elseif($tmp_result->num() == 0 )
		{
			// mobile does not exits
			debug::fatal("Mobile number is incorrect");
		}
		else
		{
			// mobile exist more than 2 times!
			debug::fatal("Please forward this message to Administrator");
		}
	}
}
?>
<?php
namespace content_account\home;

class controller extends \mvc\controller
{
	function _route()
	{
		// route sample
		// $this->route("/^hasan\/you\/any\/time$/")
		// $this->route(array("url|=>array("hasan", "you", "any", "time"))
		// $this->route("hasan/you/any/time")
		// $this->route(array("url|=> "hasan/you/any/time")

		// $referer = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER']: null;
		// if(!$referer)
		// {
		// 	// check if referer is our service
		// 	\lib\http::access("You must refer from one of our service!");
		// }

		$mymodule	= $this->module();
		$islogin	= $this->login();

		switch ($mymodule) 
		{
			case 'home':
				$this->redirector()->set_url("login")->redirect();
				break;


			case 'login':
			case 'signup':
			case 'recovery':
				if(!$islogin)
				{
					$module	= \lib\router::get_real_url();
					$this->model_name	= 'content_account\\'.$module.'\model';
					$this->display_name	= 'content_account\\'.$module.'\display.html';
					$this->post($module)->ALL($module);
				}
				else
				{
					\lib\http::access(T_("You are logined to system!"));
				}
				break;


			case 'changepass':
				if(!$islogin)
				{
					\lib\http::access(T_("You can't access to this page!"));
				}
			case 'verification':
				// if user 
				$mymobile = strlen(\lib\utility::get('mobile'));
				if($mymobile<11 || $mymobile>12)
					\lib\http::access(T_("Mobile not exist"));

				$module	= \lib\router::get_real_url();
				$this->model_name	= 'content_account\\'.$module.'\model';
				$this->display_name	= 'content_account\\'.$module.'\display.html';
				$this->put($module)->ALL($module);
				$this->post('checksms')->ALL($module);
				break;


			// logout user from system then redirect to ermile
			case 'logout':
				if(!$islogin)
				{
					\lib\http::access(T_("You must first logined to system!"));
				}
				else
				{
					// redirect to ermile
					session_unset();
					session_destroy();
					\lib\debug::true(T_("Logout successfully"));
					$this->redirector()->set_domain('ermile.dev')->set_url()->redirect();
				}
				break;


			// manage sms inputs and filter addresses without uid
			case 'smsdelivery':
			case 'smscallback':
				if(\lib\utility::get('uid')==201500001)
				{
					$module	= \lib\router::get_real_url();
					$this->model_name	= 'content_account\sms\model';
					$this->display_name	= 'content_account\sms\display.html';
					$this->post($module)->ALL($module);
					$this->get($module)->ALL($module);
				}
				else
				{
					\lib\http::access("SMS");
				}
				break;

			// if user add another address show 404
			default:
				\lib\http::page();
				break;
		}
	}
}
?>
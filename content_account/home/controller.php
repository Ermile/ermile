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

		$referer = \lib\router::urlParser('referer', 'domain');
		// var_dump($referer);exit();

		if($referer !== Domain)
			\lib\utility\Cookie::write('referer', $referer, 60*15);
		// var_dump( \lib\utility\Cookie::read('referer') );

		// var_dump(\lib\router::urlParser('referer', 'host'));

		// "/^logout$/"
		// 
		// var_dump($referer);

		// if(!$referer)
		// {
		// 	// check if referer is our service
		// 	\lib\http::access("You must refer from one of our service!");
		// }
		// 
		// a one module can only one from: post, put, delete
		// all of module can get method

		$mymodule = $this->module();
		$islogin	 = $this->login();
		switch ($mymodule) 
		{
			case 'home':
				$this->redirector()->set_url("login")->redirect();
				break;


			case 'login':
			case 'signup':
			case 'recovery':
			case 'verificationsms':
				if(!$islogin)
				{
					$this->model_name	= 'content_account\\'.$mymodule.'\model';
					$this->display_name	= 'content_account\\'.$mymodule.'\display.html';
					$this->post($mymodule)->ALL($mymodule);
					$this->get()->ALL($mymodule);
					// return;
				}
				else
				{
					\lib\debug::true(T_("you are logined to system!"));

					$myreferer = \lib\router::urlParser('referer', 'host');
					$myssid    = isset($_SESSION['ssid'])? '?ssid='.$_SESSION['ssid'].'&from=login': null;

					var_dump(1);
					var_dump($myssid);
					// var_dump($_SERVER['HTTP_REFERER']);
					// var_dump($myreferer);
					// exit();
					// $this->get()->ALL($mymodule);
					$this->redirector()->set_domain($myreferer)->set_url($myssid)->redirect();

					// \lib\http::access(T_("you are logined to system!"));
				}
				break;


			case 'changepass':
				if(!$islogin)
				{
					\lib\http::access(T_("you can't access to this page!"));
				}
			case 'verification':
				$this->model_name	= 'content_account\\'.$mymodule.'\model';
				$this->display_name	= 'content_account\\'.$mymodule.'\display.html';
				$this->put($mymodule)->ALL($mymodule);
				$this->get()->ALL($mymodule);
				break;


			// logout user from system then redirect to ermile
			// case 'logout':
			// 	$this->redirector()->set_domain()->set_url('logout')->redirect();

			// 	$this->model_name	= 'mvc\model';
			// 	$this->model()->logout();
			// 	// if(!$islogin)
			// 	// {
			// 	// 	\lib\debug::true(T_("you must first logined to system!"));
			// 	// 	$this->redirector()->set_domain()->set_url()->redirect();
			// 	// 	// \lib\http::access(T_("you must first logined to system!"));
			// 	// }
			// 	// else
			// 	// {
			// 	// 		// redirect to ermile
			// 	// 	session_unset();
			// 	// 	session_destroy();
			// 	// 	\lib\debug::true(T_("logout successfully"));
			// 	$this->redirector()->set_domain('ermile.dev')->set_url()->redirect();
			// 	$this->get()->ALL($mymodule);
			// 	// }
			// 	break;


			// manage sms inputs and filter addresses without uid
			case 'smsdelivery':
			case 'smscallback':
				if(\lib\utility::get('uid')==201500001)
				{
					$this->model_name	= 'content_account\sms\model';
					$this->display_name	= 'content_account\sms\display.html';
					$this->post($mymodule)->ALL($mymodule);
					$this->get($mymodule)->ALL($mymodule);
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
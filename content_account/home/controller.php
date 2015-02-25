<?php
namespace content_account\home;

class controller extends \mvc\controller
{
	function _route()
	{
		$referer  = \lib\router::urlParser('referer', 'domain');
		$from     = \lib\utility\Cookie::read('from');
		$islogin	= $this->login();
		$mymodule = $this->module();
		// set referrer in cookie
		if($referer !== Domain)
			\lib\utility\Cookie::write('referer', $referer, 60*15);
		// check permission for changepass
		if($mymodule === 'changepass' && $from === 'verification' && !$islogin)
			\lib\error::access(T_("you can't access to this page!"));

		switch ($mymodule)
		{
			case 'home':
				$this->redirector()->set_url("login")->redirect();
				break;


			case 'verification':
			case 'verificationsms':
				if($from !== 'recovery' && $from !== 'signup')
					\lib\error::access(T_("you can't access to this page!"));

			case 'login':
			case 'signup':
			case 'recovery':
				if($islogin)
				{
					\lib\debug::true(T_("you are logined to system!"));
					$myreferer = \lib\router::urlParser('referer', 'host');
					$myssid    = isset($_SESSION['ssid'])? '?ssid='.$_SESSION['ssid']: null;
					$this->redirector()->set_domain($myreferer)->set_url($myssid)->redirect();
				}
			case 'changepass':
				$this->model_name   = 'content_account\\'.$mymodule.'\model';
				$this->display_name = 'content_account\\'.$mymodule.'\display.html';
				$this->post($mymodule)->ALL();
				$this->get()          ->ALL();
				break;


			case 'smsdelivery':
			case 'smscallback':
				$uid = 201500001;
				if(\lib\utility::get('uid') == $uid || \lib\utility\Cookie::read('uid') == $uid)
				{
					$this->model_name	= 'content_account\sms\model';
					$this->display_name	= 'content_account\sms\display.html';
					$this->post($mymodule)->ALL();
					$this->get($mymodule) ->ALL();
				}
				else
					\lib\error::access("SMS");
				break;


			default:
				\lib\error::page();
				break;
		}
	}
}
?>
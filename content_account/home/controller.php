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

		$mymodule = $this->module();
		switch ($mymodule) 
		{
			case 'home':
				$this->redirector()->set_url("login")->redirect();
				break;


			case 'login':
			case 'signup':
			case 'recovery':
				$module	= \lib\router::get_real_url();
				$this->model_name	= 'content_account\\'.$module.'\model';
				$this->display_name	= 'content_account\\'.$module.'\display.html';
				$this->post($module)->ALL($module);
				break;

			case 'verification':
			case 'changepass':
				$module	= \lib\router::get_real_url();
				$this->model_name	= 'content_account\\'.$module.'\model';
				$this->display_name	= 'content_account\\'.$module.'\display.html';
				$this->put($module)->ALL($module);
				$this->post('checksms')->ALL($module);
				break;


			case 'logout':
				// redirect to ermile
				session_unset();
				session_destroy();
				\lib\debug::true("Logout successfully");
				$this->redirector()->set_domain()->set_url();
				header("location: http://".\lib\router::get_root_domain());
				exit();
				break;


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
					\lib\http::access("smsdelivery");
				}
				break;


			default:
				\lib\http::page();
				break;
		}

		// var_dump($mymodule);

		// $this->route("/^$/", function(){
		// 	$this->redirector()->set_url("login")->redirect();
		// });


		// $this->route("/^(login|signup|recovery)$/", function(){
		// 	$module	= \lib\router::get_real_url();
		// 	$this->model_name	= 'content_account\\'.$module.'\model';
		// 	$this->display_name	= 'content_account\\'.$module.'\display.html';
		// 	$this->post($module)->ALL($module);
		// });


		// $this->route("/^(verification|changepass)$/", function(){
		// 	$module	= \lib\router::get_real_url();
		// 	$this->model_name	= 'content_account\\'.$module.'\model';
		// 	$this->display_name	= 'content_account\\'.$module.'\display.html';
		// 	$this->put($module)->ALL($module);
		// 	$this->post('checksms')->ALL($module);
		// });


		// // manage sms inputs and filter addresses without uid
		// $this->route("/^(smsdelivery|smscallback)$/", function(){
		// 	if(\lib\utility::get('uid')==201500001)
		// 	{
		// 		$module	= \lib\router::get_real_url();
		// 		$this->model_name	= 'content_account\sms\model';
		// 		$this->display_name	= 'content_account\sms\display.html';
		// 		$this->post($module)->ALL($module);
		// 		$this->get($module)->ALL($module);
		// 	}
		// 	else
		// 	{
		// 		\lib\http::access("smsdelivery");
		// 	}

		// });


		// // logout user from system
		// $this->route("/^logout$/", function(){
		// 	// redirect to ermile
		// 	session_unset();
		// 	session_destroy();
		// 	\lib\debug::true("Logout successfully");
		// 	$this->redirector()->set_domain()->set_url();
		// 	header("location: http://".\lib\router::get_root_domain());
		// 	exit();
		// });		
	}
}
?>
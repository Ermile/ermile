<?php
namespace content\home;

class controller extends \mvc\controller
{
	function _route()
	{
		$this->route("/^$/", function(){
			$this->redirector()->set_url("login")->redirect();
		});

		$this->route("/^(login|signup|recovery|smsdelivery)$/", function(){
			var_dump(60);
			$module	= \lib\router::get_real_url();
			$this->model_name	= 'content\\'.$module.'\model';
			$this->display_name	= 'content_account\\'.$module.'\display.html';
			$this->post($module)->ALL($module);
		});

		$this->route("/^(verification|changepass)$/", function(){
			$module	= \lib\router::get_real_url();
			$this->model_name	= 'content\\'.$module.'\model';
			$this->display_name	= 'content_account\\'.$module.'\display.html';
			$this->put($module)->ALL($module);
		});

		// logout user from system
		$this->route("/^logout$/", function(){
			// redirect to ermile
			session_unset();
			session_destroy();
			\lib\debug::true("Logout successfully");
			$this->redirector()->set_domain()->set_url();
			header("location: http://".\lib\router::get_root_domain());
			exit();
		});		
	}
}
?>
<?php
namespace mvc;

class model extends \lib\model
{
	function _construct()
	{
		// var_dump("model");
		if(method_exists($this, 'options')){
			$this->options();
		}
	}


	public function get_modeldef()
	{
		$this->addVisitor();

		$referer = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER']: null;
		if($referer =='http://account.ermile.dev/login' && \lib\router::get_real_url()=='')
		{
			$this->setlogin();
		}
	}


	public function setlogin()
	{
		$ssid 		= \lib\utility::get('ssid');
		if($this->login() || !$ssid)
		{
			// if user logined to system or don't has ssid return and don't need run below code
			return;
		}

		$ip 			= ip2long($_SERVER['REMOTE_ADDR']);
		$tmp_result	= $this->sql()->tableUsermetas()
						->whereUsermeta_cat('cookie_token')
						->andUsermeta_name($ip)
						->andUsermeta_status('enable')
						->andUsermeta_value($ssid)
						->select();
		
		// var_dump($this->login());
		if($tmp_result->num() == 1)
		{
			// user request is correct and we can set session, because login is true!
			$qry	= $this->sql()->tableUsermetas()
						->setUsermeta_status('expire')
						->whereUsermeta_cat('cookie_token')
						->andUsermeta_name($ip)
						->andUsermeta_status('enable')
						->andUsermeta_value($ssid);
			$sql	= $qry->update();
			// var_dump($sql);

			$tmp_result = $tmp_result->assoc();
			if(isset($tmp_result['user_id']))
			{
				// if user_id set in usermetas table continue
				$tmp_result	=  $this->sql()->tableUsers()->whereId($tmp_result['user_id'])->select();
				$tmp_result = $tmp_result->assoc();
				$this->setLoginSession($tmp_result);
			}
		}
		else
		{
			\lib\http::bad("You want hijack us!!?");
		}
	}

	public function setLoginSession($tmp_result)
	{
		// set session for logined user
		$_SESSION['user']	= array();
		$tmp_fields			= array('type', 'gender', 'firstname', 'lastname', 'nickname', 'mobile', 'status', 'credit');
		
		foreach ($tmp_fields as $key => $value) 
		{
			$_SESSION['user'][$value]	= $tmp_result['user_'.$value];
		}
		$_SESSION['user']['id']				= $tmp_result['id'];
		$_SESSION['user']['permission_id']	= $tmp_result['permission_id'];
	}
}
?>
<?php
namespace mvc;

class controller extends \lib\controller
{
	function _construct()
	{
		// add all visitor to visitor table
		$this->get('checkmodel')->ALL(\lib\router::get_real_url());
	}

	// Return login status without parameter
	// If you pass the name as all return all of user session
	// If you pass specefic user data field name return it
	public function login($_name = null)
	{
		if(isset($_name))
		{
			if($_name=="all")
				return isset($_SESSION['user'])? $_SESSION['user']: null;

			else
				return isset($_SESSION['user'][$_name])? $_SESSION['user'][$_name]: null;
		}

		if(isset($_SESSION['user']['id']))
			return true;
		else
			return false;

	}

	// return module name for use in view or other place
	public function module()
	{
		$mymodule	= str_replace('/', '_', \lib\router::get_real_url());
		$mymodule	= $mymodule? $mymodule: 'home';
		return $mymodule;
	}
}
?>
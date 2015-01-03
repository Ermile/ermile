<?php
namespace mvc;

class controller extends \lib\controller
{
	function _construct()
	{
		// add all visitor to visitor table
		// $this->get('modeldef')->ALL(\lib\router::get_real_url());
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
	public function module($full = false)
	{
		if($full)
			$mymodule	= str_replace('/', '_', \lib\router::get_real_url());
		else
			$mymodule	= \lib\router::get_real_url(0);
		
		$mymodule	= $mymodule? $mymodule: 'home';
		return $mymodule;
	}

	// return module name for use in view or other place
	public function child()
	{
		return \lib\router::get_real_url(1);
	}
}
?>
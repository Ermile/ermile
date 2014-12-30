<?php
namespace mvc;

class controller extends \lib\controller
{
	function _construct()
	{
		// add all visitor to visitor table
		$this->get('checkmodel')->ALL(\lib\router::get_real_url());
	}

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
}
?>
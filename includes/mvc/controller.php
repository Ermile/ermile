<?php
namespace mvc;
use \lib\router;

class controller extends \lib\controller
{
	function _construct()
	{
		if(method_exists($this, 'options')){
			$this->options();
		}
		// add all visitor to visitor table
		// $this->get('modeldef')->ALL(router::get_real_url());
		// $this->model()->get_modeldef();
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
	public function module($full = null)
	{
		if($full=='prefix')
			$mymodule	= substr(router::get_real_url(0), 0, -1);
		elseif($full)
			$mymodule	= str_replace('/', '_', router::get_real_url());
		else
			$mymodule	= router::get_real_url(0);
		
		$mymodule	= $mymodule? $mymodule: 'home';
		return $mymodule;
	}

	// return module name for use in view or other place
	public function child($_title = null)
	{
		$mychild = router::get_real_url(1);
		if(!$_title)
			return $mychild;
		
		if($_title=='add')
			return T_('Add New');

		$mychild = substr($mychild,0,strrpos($mychild,'='));
		if($mychild == 'edit')
			return T_('Edit');
	}
}
?>
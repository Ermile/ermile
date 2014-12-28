<?php
namespace content\changepass;
use \lib\utility;
use \lib\debug;

class model extends \mvc\model
{
	function put_changepass()
	{
		// for debug you can uncomment below line to disallow redirect
		// $this->controller()->redirector	= false; 

		var_dump("we have problem in this part");
		var_dump("we must read user mobile from other source like session, complete soon");
		exit();

		$mypass		= utility::post('password');
	}
}
?>
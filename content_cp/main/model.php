<?php
namespace content_cp\main;
use \lib\utility;
use \lib\debug;

class model extends \mvc\model
{
	public function get_datatable($object)
	{
		$mymodule	= $this->module();
		$mytable	= 'table'.ucfirst($mymodule.'s');
		$tmp_result	=  $this->sql()->$mytable()->select();
		return $tmp_result->Allassoc();
	}
}
?>
<?php
namespace content_cp\main;
use \lib\utility;
use \lib\debug;

class model extends \mvc\model
{
	public function get_modelcp($object)
	{
		var_dump($object);
		return 'aaa';
	}
}
?>
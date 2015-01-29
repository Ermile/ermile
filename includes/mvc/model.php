<?php
namespace mvc;

class model extends \lib\mvc\model
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
		// $this->addVisitor();

		// $referer = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER']: null;
		// if($referer =='http://account.ermile.dev/login' && \lib\router::get_real_url()=='')
		// {
		// 	$this->setlogin();
		// }
	}
}
?>
<?php
namespace content_cp\main;
use \lib\utility;
use \lib\debug;

class model extends \mvc\model
{
	function get_delete()	{ $this->delete(); }
	function post_delete()	{ $this->delete(); }
	function post_add()  	{ $this->insert(); }
	function post_edit() 	{ $this->update(); }
	function post_options() { return 'soon';   }
}
?>
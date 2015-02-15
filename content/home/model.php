<?php
namespace content\home;
use \lib\debug;

class model extends \content\main\model
{
	// public function get_validate($object){
	// 	$maker = $this->validate()->make();
	// 	$maker->id()->formId("your id is incorrect");

	// 	$validate = $this->validate()->check(array('test', "1392"), $maker, 'form');
	// 	$validate2 = $this->validate()->check(array('test2', "h1392"), $maker, 'form');
	// 	var_dump($validate->compile());
	// 	var_dump($validate2->compile());
	// 	$x = \lib\validator::all();
	// 	var_dump(\lib\debug::compile());
	// 	var_dump($x);
	// }

	// public function get_query($object){
	// 	// \lib\error::access("login");
	// 	// \lib\dbconnection::$db_user = "hi";
	// 	$query = $this->sql('banks')->tableAccounts()->limit(10);
	// 	$result = $query->select()->allObject();
	// 	$x = $this->sql('bankss')->tableAccounts()->where("##1", "=", '#1')->delete();
	// 	var_dump($x->String());
	// 	\lib\debug::error("fuck");
	// 	var_dump(\lib\debug::compile());
	// 	return $result;
	// }
}
?>
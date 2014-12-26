<?php
namespace content\home;
use \lib\saloos;

class controller extends \mvc\controller{
// 	$x = new \lib\redirector("login"); // default: your url
// $x->set_domain("ermile.com") // default: your doamin
// ->set_protocol("https") // default:http 
// ->redirect();

	public function _route(){
		//return all array
		// var_dump(\lib\router::get_url(-1));
		// //return index array
		// var_dump(\lib\router::get_url(0));
		// //return string
		// var_dump(\lib\router::get_url());
		// // get class
		// var_dump(\lib\router::get_class());
		
		// var_dump(\lib\router::get_sub_domain());
		
		// var_dump(\lib\router::get_method());
		
		// var_dump(\lib\router::get_domain());

		// var_dump(\lib\router::get_url_property('add'));

		$this->post('signup')->ALL("signup");

		$this->get(false, 'signup')->ALL("signup");

		$this->post('login')->ALL("login");
		$this->get(false, 'login')->ALL("login");
		
		$this->post('recovery')->ALL("recovery");
		$this->get(false, 'recovery')->ALL("recovery");
		
		$this->post(false, 'verification')->ALL("verification");
		$this->get(false, 'verification')->ALL("verification");


		// $this->get(false, 'signup')
		// ->ALL("signup");

		// $this->get("user_list", "user")
		// ->SERVER("user")
		// ->REST();

		// $this->post("user_add")
		// ->SERVER("user")
		// ->REST();
	}
}
?>


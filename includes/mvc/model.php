<?php
namespace mvc;

class model extends \lib\model
{
	function _construct()
	{
		// var_dump("model");
	}

	public function login_register($tmp_result)
	{
		$_SESSION['user']	= array();
		$tmp_fields			=  array('type', 'gender', 'firstname', 'lastname', 'nickname', 'mobile', 'status', 'credit');
		
		foreach ($tmp_fields as $key => $value) 
		{
			$_SESSION['user'][$value]	= $tmp_result['user_'.$value];
		}
		$_SESSION['user']['id']				= $tmp_result['id'];
		$_SESSION['user']['permission_id']	= $tmp_result['permission_id'];
	}
	public function sql_addVisitor()
	{
		// this function add each visitor detail in visitors table
		// var_dump($_SERVER['REMOTE_ADDR']);
		$ip = ip2long($_SERVER['REMOTE_ADDR']);
		$url = 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME']
				.( $_SERVER["SERVER_PORT"] != "80"? ":".$_SERVER["SERVER_PORT"]: '' ).$_SERVER['REQUEST_URI'];
		$referer = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER']: null;
		$agent = $_SERVER['HTTP_USER_AGENT'];
		$robot = 'no';
		$botlist = array("Teoma", "alexa", "froogle", "Gigabot", "inktomi",
			"looksmart", "URL_Spider_SQL", "Firefly", "NationalDirectory",
			"Ask Jeeves", "TECNOSEEK", "InfoSeek", "WebFindBot", "girafabot",
			"crawler", "www.galaxy.com", "Googlebot", "Scooter", "Slurp",
			"msnbot", "appie", "FAST", "WebBug", "Spade", "ZyBorg", "rabaz",
			"Baiduspider", "Feedfetcher-Google", "TechnoratiSnoop", "Rankivabot",
			"Mediapartners-Google", "Sogou web spider", "WebAlta Crawler","TweetmemeBot",
			"Butterfly","Twitturls","Me.dium","Twiceler");
		foreach($botlist as $bot)
		{
			if(strpos($_SERVER['HTTP_USER_AGENT'], $bot) !== false)
				$robot = 'yes';
		}
		$now = new DateTime();
		$userid = isset($_SESSION['user']['id'])? $_SESSION['user']['id']: null;

		$qry		= $this->sql()->tableVisitors()
						->setVisitor_ip($ip)
						->setVisitor_url(urlencode($url))
						->setVisitor_agent(urlencode($agent))
						->setVisitor_referer(urlencode($referer))
						->setVisitor_robot($robot)
						->setVisitor_datetime($now->format('Y-m-d H:i:s'))
						->setUser_id($userid);
		$sql		= $qry->insert();

		$sQl = new dbconnection_lib;
		$sQl->query("COMMIT");
		$sQl->query("START TRANSACTION");
	}
}
?>
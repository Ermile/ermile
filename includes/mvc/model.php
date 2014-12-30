<?php
namespace mvc;

class model extends \lib\model
{
	function _construct()
	{
		// var_dump("model");
	}

// $referer = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER']: null;
	public function get_checkmodel()
	{
		$this->addVisitor();

		$referer = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER']: null;
		if($referer =='http://account.ermile.dev/login' && \lib\router::get_real_url()=='')
		{
			$this->setlogin();
			\lib\debug::true("Login successfully");
		}
	}

	public function setlogin()
	{
		$tmp_result	= $this->sql()->tableUsermetas()
						->whereUsermeta_cat('cookie_token')
						->andUsermeta_name($_SERVER['REMOTE_ADDR'])
						->andUsermeta_status('enable')
						->select();
		
		var_dump($tmp_result->num());
		var_dump('setlogin');
		// exit();
	}

	public function addVisitor()
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

		$userid = isset($_SESSION['user']['id'])? $_SESSION['user']['id']: null;

		$qry		= $this->sql()->tableVisitors()
						->setVisitor_ip($ip)
						->setVisitor_url(urlencode($url))
						->setVisitor_agent(urlencode($agent))
						->setVisitor_referer(urlencode($referer))
						->setVisitor_robot($robot)
						->setVisitor_createdate(date('Y-m-d H:i:s'))
						->setUser_id($userid);
		$sql		= $qry->insert();

		$this->commit(function()
		{
			// debug::true("Register sms successfully");
		});

		// if a query has error or any error occour in any part of codes, run roolback
		$this->rollback(function()
		{
			// debug::fatal("Register sms failed!");
		});

		// $sQl = new dbconnection_lib;
		// $sQl->query("COMMIT");
		// $sQl->query("START TRANSACTION");
	}
}
?>
<?php
namespace content\home;

class controller extends \mvc\controller
{



	/**
	 * the static page to not run any query
	 * and brand black list
	 * @var        array
	 */
	public static  $static_pages =
	[
		'benefits',
		'pricing',
		'help',
		'admin',
		'enter',
		'about',
		'social-responsibility',
		'terms',
		'privacy',
		'changelog',
		'logo',
		'contact',
		'api',
		// brand black list
		'branch',
		'team',
		'member',
		'add',
		'edit',
		'delete',
		'user',
		'hours',
		'report',
		'last',
		'daily',
		'account',
		'for',

	];

	// for routing check
	function _route()
	{
		// if have display return false
		if($this->display_name !== null)
		{
			return false;
		}
		// if on homepage return false
		$url = \lib\url::directory();
		if(!$url)
		{
			return false;
		}
		// if the url in static page [and black list] return
		if(in_array($url, self::$static_pages))
		{
			return;
		}

		// check url like this /ermile/tejarak
		if(preg_match("/^([a-zA-Z0-9]+)(|\/([a-zA-Z0-9]+))$/", $url, $split))
		{
			// @check
			\lib\engine\main::controller_set('content\\hours\\controller');
			return;
		}
	}
}
?>
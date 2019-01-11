<?php
require_once('social.php');
require_once('sms.php');

/**
@ In the name Of Allah
* The base configurations of the ermile.
*/

if(!defined('db_log_name'))
{
	define('db_log_name', 'ermile_log');
}


self::$language =
[
	'default' => 'fa',
	'list'    => ['fa','en',],
];
/**
 * system default lanuage
 */

// self::$url['protocol']       = 'https';
self::$url['root']           = 'ermile';
// self::$url['tld']            = 'com';


self::$config['site']['title']  = "Ermile";
self::$config['site']['desc']   = "Ermile contain a new tools for each one";
self::$config['site']['slogan'] = "As easy as ABC is our slogan!";

/**
 * call kavenegar template
 */
self::$config['enter']['call']                = true;
self::$config['enter']['call_template_fa'] = 'ermile-fa';
self::$config['enter']['call_template_en'] = 'ermile-en';
self::$config['enter']['verify_telegram'] = true;
self::$config['enter']['verify_sms']      = true;
self::$config['enter']['verify_call']     = true;
self::$config['enter']['verify_sendsms']  = false;




?>
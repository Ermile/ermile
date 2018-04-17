<?php


/**
@ In the name Of Allah
* The base configurations of the ermile.
*/
self::$language =
[
	'default' => 'fa',
	'list'    => ['fa','en',],
];
/**
 * system default lanuage
 */

self::$config['redirect_url']                 = 'https://ermile.com';
self::$config['multi_domain']                 = true;
self::$config['redirect_to_main']             = true;
self::$config['https']                        = true;
self::$config['default_tld']                  = 'com';
self::$config['default_permission']           = null;
self::$config['debug']                        = true;
self::$config['coming']                       = false;
self::$config['short_url']                    = null;
self::$config['save_as_cookie']               = false;
self::$config['log_visitors']                 = true;
self::$config['passphrase']                   = null;
self::$config['passkey']                      = null;
self::$config['passvalue']                    = null;
self::$config['default']                      = null;
self::$config['redirect']                     = 'a';
self::$config['register']                     = true;
self::$config['recovery']                     = true;
self::$config['fake_sub']                     = null;
self::$config['real_sub']                     = true;
self::$config['force_short_url']              = null;
self::$config['sms']                          = true;

self::$config['account']                      = true;
self::$config['main_account']                 = null;
self::$config['account_status']               = true;
self::$config['use_main_account']             = false;

self::$config['domain_same']                  = true;
self::$config['domain_name']                  = 'ermile';
self::$config['main_site']                    = 'https://ermile.com';


self::$config['enter']['verify_telegram'] = false;
self::$config['enter']['verify_sms']      = true;
self::$config['enter']['verify_call']     = true;
self::$config['enter']['verify_sendsms']  = false;




?>
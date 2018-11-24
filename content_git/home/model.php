<?php
namespace content_git\home;


class model
{
	public static function post()
	{

		if(\dash\request::post('checktoken'))
		{
			$token   = \dash\request::post('token');
			$project = \dash\request::post('project');
			$file    = self::file_addr();
			$get     = @file_get_contents($file);
			if(isset($get[$project]))
			{
				if(isset($get[$project]['token']))
				{
					if($get[$project]['token'] === $token)
					{
						\dash\code::jsonBoom(['ok' => true]);
					}
				}
			}
			\dash\code::jsonBoom(['ok' => false]);
		}
		else
		{

			$domain = \dash\request::post('domain');
			if($domain)
			{
				self::send_request($domain);
			}
		}

	}

	private static function generate_verification_code($_domain)
	{
		$code  = \dash\utility::hasher('Ermile');
		$code .= time();
		$code .= rand(1, 9999);
		$code .= rand(1, 9999);
		$code .= rand(1, 9999);
		$code .= rand(1, 9999);
		$code  = md5($code);

		self::save_file($_domain, $code);

		return $code;
	}

	public static function file_addr()
	{
		return __DIR__. '/token.me.json';
	}

	private static function save_file($_domain, $_code)
	{
		$new =
		[
			$_domain =>
			[
				'domain' => $_domain,
				'token'  => $_code,
				'time'   => time(),
			],
		];

		$file  = self::file_addr();

		if(!is_file($file))
		{
			$get = $new;
		}
		else
		{
			$get = @file_get_contents($file);
			$get = json_decode($get, true);
			if(!is_array($get))
			{
				$get = [];
			}

			$get = array_merge($get, $new);


		}
		\dash\file::write($file, json_encode($get, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

	}


	private static function send_request($_domain)
	{
		$url            = $_domain. '/hook/gitdetail';
		$token          = self::generate_verification_code($_domain);
		$field          = [];
		$field['token'] = $token;
		$handle         = curl_init();

		curl_setopt($handle, CURLOPT_URL, $url);
		// curl_setopt($handle, CURLOPT_HTTPHEADER, json_encode($_requests['header'], JSON_UNESCAPED_UNICODE));
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($handle, CURLOPT_POST, true);

		curl_setopt($handle, CURLOPT_POSTFIELDS, http_build_query($field));
		curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($handle, CURLOPT_TIMEOUT, 2);

		if(defined('CURLOPT_IPRESOLVE') && defined('CURL_IPRESOLVE_V4'))
		{
 			curl_setopt($handle, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		}

		$response = curl_exec($handle);
		curl_close ($handle);
	}
}
?>
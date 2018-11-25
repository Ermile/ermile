<?php
namespace content_git\home;


class controller
{
	public static function routing()
	{
		if(\dash\request::post('checktoken'))
		{
			$token   = \dash\request::post('token');
			$project = \dash\request::post('project');
			$file    = \content_git\home\model::file_addr();
			$get     = @file_get_contents($file);
			$get     = json_decode($get, true);

			if(isset($get[$project]))
			{
				if(isset($get[$project]['token']))
				{
					if($get[$project]['token'] === $token)
					{
						if(isset($get[$project]['time']))
						{
							$time = $get[$project]['time'];
							if(time() - intval($time) < 30)
							{
								\dash\code::jsonBoom(['ok' => true]);
							}
						}
					}
				}
			}
			\dash\code::jsonBoom(['ok' => false]);
		}

		if(!\dash\user::id() || !\dash\permission::supervisor())
		{
			\dash\header::status(403);
		}
	}
}
?>
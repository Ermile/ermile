<?php
namespace content\git;


class controller
{
	public static function routing()
	{
		if(!\dash\user::id() || !\dash\permission::supervisor())
		{
			\dash\header::status(403);
		}
	}
}
?>
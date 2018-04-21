<?php
namespace content\careers;

class controller
{
	public static function routing()
	{
		if(\dash\url::child() === 'get' && \dash\url::subchild() === null)
		{
			\dash\open::get();
		}
	}
}
?>
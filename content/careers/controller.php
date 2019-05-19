<?php
namespace content\careers;

class controller
{
	public static function routing()
	{
		\dash\redirect::to('https://sarshomar.com/fa/s/3L2fP', false);
		if(\dash\url::child() === 'get' && \dash\url::subchild() === null)
		{
			\dash\open::get();
		}
	}
}
?>
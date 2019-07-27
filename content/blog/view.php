<?php
namespace content\blog;


class view
{
	public static function config()
	{
		\dash\data::allPostList(\dash\app\posts::get_post_list(['pagenation' => true]));
	}
}
?>

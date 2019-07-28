<?php
namespace content\blog;


class view
{
	public static function config()
	{
		\dash\data::allPostList(\dash\app\posts::get_post_list(['pagenation' => true]));

		\dash\data::page_desc(T_('Know about our stories and events'));
		\dash\data::page_cover(\dash\url::static(). '/images/homepage/bg-ermile-blog.jpg');
	}
}
?>

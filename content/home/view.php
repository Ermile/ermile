<?php
namespace content\home;


class view
{
	public static function config()
	{
		\dash\data::page_seotitle(\dash\data::site_title() . ' | '. \dash\data::site_slogan());
		\dash\data::page_title(T_('As easy as ABC'));
		\dash\data::page_desc(T_('We provide a wide range of enterprise services to you.'));
		\dash\data::page_special(true);
	}
}
?>
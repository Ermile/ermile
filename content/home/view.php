<?php
namespace content\home;

class view
{
	public static function config()
	{
		\dash\data::bodyclass('unselectable vflex');
		\dash\data::page_title(\dash\data::site_title() . ' | '. \dash\data::site_slogan());
		\dash\data::page_special(true);
	}

}
?>
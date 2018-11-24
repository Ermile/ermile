<?php
namespace content_git;


class view
{
	public static function config()
	{
		\dash\data::include_adminPanel(true);
		\dash\data::include_css(false);
		\dash\data::include_js(false);

		\dash\data::badge_shortkey(120);
		\dash\data::badge2_shortkey(121);

	}
}
?>
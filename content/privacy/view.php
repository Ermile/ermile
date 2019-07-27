<?php
namespace content\privacy;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Privacy Policy'));
		\dash\data::page_desc(T_('We wish to assure you that our main concern is to secure your privacy and protect your information against impermissible access.'));
	}
}
?>
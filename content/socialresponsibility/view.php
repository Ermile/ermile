<?php
namespace content\socialresponsibility;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Ermile Social Responsibility'));
		\dash\data::page_desc(T_('Social responsibility refers to our role in maintaining, caring about and helping our society, while having set as its goal a responsibility-centered enterprise along with wealth production.'));
		\dash\data::page_special(true);
	}
}
?>
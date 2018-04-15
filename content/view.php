<?php
namespace content;

class view
{
	public static function config()
	{
		// set default value for site properties
		\dash\data::site_title(T_("Ermile"));
		\dash\data::site_desc(T_("Ermile contain a new tools for each one"));
		\dash\data::site_slogan(T_("As easy as ABC is our slogan!"));
		\dash\data::page_desc(T_("Ermile is inteligent"));
		\dash\data::template_social('content/template/social.html');
		\dash\data::template_share('content/template/share.html');
	}
}
?>
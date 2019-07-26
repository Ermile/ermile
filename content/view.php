<?php
namespace content;

class view
{
	public static function config()
	{
		// set default value for site properties
		\dash\data::site_title(T_("Ermile"));
		// improve site desc

		\dash\data::site_desc(T_("We belive that we can do anywork, without complexity, as soon as possible."). ' '. T_('This is our slogan at Ermile.'));
		\dash\data::site_slogan(T_("Software Solution Designer"));
		\dash\data::site_company(T_("Rooz Andish Kavir Peyma"));

		\dash\data::page_desc(T_("Ermile is inteligent"));
	}
}
?>
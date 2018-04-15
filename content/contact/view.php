<?php
namespace content\contact;

class view
{
	public static function config()
	{
		\dash\data::page_title(\dash\url::module());
		\dash\data::bodyclass('unselectable vflex');
	}
}
?>
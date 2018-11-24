<?php
namespace content\git;


class view
{
	public static function config()
	{
		$projectsList = [];

		$projectsList[] =
		[
			'logo' => rand(1,999),
			'sitetitle' => rand(1,999),
			'sitetitle' => rand(1,999),
			'projectVersion' => rand(1,999),
			'dbVersion' => rand(1,999),
			'dbVersionAddon' => rand(1,999),
		];

		\dash\data::projectsList($projectsList);
	}
}
?>
<?php
namespace content_git\home;


class view
{
	public static function config()
	{
		$projectsList = self::project_detail();
		\dash\data::projectsList($projectsList);
	}


	private static function project_detail()
	{
		$list = self::project_list();
		$project_detail = [];
		foreach ($list as $key => $value)
		{
			$project_detail[] = self::get_detail($value);
		}

		return $project_detail;
	}


	private static function project_list()
	{
		$list = [];
		if(\dash\url::isLocal())
		{
			$list[] = 'http://jibres.local';
			$list[] = 'http://azvir.local';
			$list[] = 'http://tejarak.local';
			$list[] = 'http://qhkarimeh.local';
			$list[] = 'http://iranquran.local';
			$list[] = 'http://khadije.local';
			$list[] = 'http://ermile.local';
			$list[] = 'http://taraztax.local';
			// $list[] = 'http://iranpresidents.com';
			// $list[] = 'http://deadbrowser.com';

		}
		else
		{
			$list[] = 'https://jibres.com';
			$list[] = 'https://azvir.com';
			$list[] = 'https://tejarak.com';
			$list[] = 'https://ermile.com';
			$list[] = 'https://qhkarimeh.ir';
			$list[] = 'https://iranquran.ir';
			$list[] = 'https://khadije.com';
			$list[] = 'https://taraztax.ir';
			$list[] = 'https://iranpresidents.com';
			$list[] = 'https://deadbrowser.com';
		}
		return $list;
	}


	private static function get_detail($_domain)
	{
		$url = $_domain. '/hook/gitdetail';
		$response = file_get_contents($url);
		$response = json_decode($response, true);

		return $response;

	}
}
?>
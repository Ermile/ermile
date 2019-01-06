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
			$temp = self::get_detail($value);
			if(isset($temp['lastUpdateTime']))
			{
				$time = intval($temp['lastUpdateTime']);
			}
			else
			{
				$time = time() - (365*24*60*60);
			}

			$date1 = date_create(date("Y-m-d", $time));
			$date2 = date_create(date("Y-m-d"));
			$diff  = date_diff($date1,$date2);
			if($diff->m || $diff->y)
			{
				$diff = 10;
			}
			else
			{

				$diff  = $diff->d;

				if($diff > 10)
				{
					$diff = 10;
				}
			}

			$diff = 10 - $diff;

			$left = ($diff * 100)/ 10;


			$temp['left'] = $left;

			$project_detail[$value] = $temp;

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
			$list[] = 'https://sarshomar.com';
			$list[] = 'https://tejarak.com';
			$list[] = 'https://ermile.com';
			$list[] = 'https://qhkarimeh.ir';
			$list[] = 'https://iranquran.ir';
			$list[] = 'https://nazr.ermile.com';
			$list[] = 'https://khadije.com';
			$list[] = 'https://taraztax.ir';
			// $list[] = 'https://iranpresidents.com';
			// $list[] = 'https://deadbrowser.com';
		}
		return $list;
	}


	private static function get_detail($_domain)
	{
		$url = $_domain. '/api/v5/git';
		$response = @file_get_contents($url);
		$response = json_decode($response, true);
		return $response;
	}
}
?>
<?php
namespace content\saloos_tg;
class controller extends \lib\mvc\controller
{
	/**
	 * [_route description]
	 * @return [type] [description]
	 */
	function _route()
	{
		$myhook = 'saloos_tg/'.\lib\utility\option::get('telegram', 'meta', 'hook');
		if($this->url('path') == $myhook)
		{
			$result = self::tg_handle();
			if(\lib\utility\option::get('telegram', 'meta', 'debug'))
			{
				var_dump($result);
			}
			exit();
		}
	}


	/**
	 * handle tg requests
	 * @return [type] [description]
	 */
	static function tg_handle()
	{
		// run hook and get it
		$hook        = \lib\utility\social\tg::hook();
		// extract chat_id if not exist return false
		$chat_id     = self::tg_chat($hook);
		// define variables
		$command     = self::tg_text($hook);
		$reply       = self::tg_reply($hook);
		$text        = null;
		$replyMarkup = null;
		if(!$chat_id)
		{
			if(DEBUG)
			{
				$chat_id = \lib\utility::get('id');
				if(!$command)
				{
					$command = \lib\utility::get('cmd');
				}
			}
			else
			{
				return 'chat id is not exist!';
			}
		}
		switch ($command)
		{
			case '/start':
				$text = 'Welcome to ' . Domain;
				break;

			case 'about':
				$text = '['.T_('Saloos').'](http://saloos.ir)'."\r\n";
				$text .= 'Created and developed by [Ermile](http://ermile.ir)';
				break;

			case 'photo':
				break;

			case 'test':
				$text = 'testing ' . Domain;
				break;

			case 'khar':
				$text = 'خر خودتی'."\r\n";
				$text .= 'باباته'."\r\n";
				$text .= 'بی تربیت'."\r\n";
				break;


			case 'cb_go_right':
				$text = 'رفتم راست'."\r\n";
				break;

			case 'cb_go_left':
				$text = 'رفتم چپ'."\r\n";
				break;


			case 'loc':
				$text = 'موثعیت تست'."\r\n";
				$replyMarkup =
				[
					'keyboard' =>
					[
						[
							[
								'text' => 'تقاضای شماره تلفن',
								'request_contact' => true
							],
							[
								'text' => 'تقاضای آدرس',
								'request_location' => true
							]
						]
					]
				];
				break;


			case 'menu':
				$text = 'منو'."\r\n";
				$replyMarkup =
				[
					'keyboard' =>
					[
							["/start"],
							["menu"],
							["inline"],
							["loc"],
							["test", "about"],
					],
				];
				break;

			case 'inline':
				$text = 'کیبورد آزمایشی'."\r\n";
				// create keyboard
				$replyMarkup =
				[
					'inline_keyboard' =>
					[
						[
							[
								'text' => '<',
								'callback_data' => 'go_left'
							],
							[
								'text' => '^',
								'callback_data' => 'go_up'
							],
							[
								'text' => '>',
								'callback_data' => 'go_right'
							],
						],
						[
							[
								'text' => 'Ermile',
								'url' => 'ermile.ir'
							],
							[
								'text' => 'inline search',
								'switch_inline_query' => 'test'
							],
						]


							// ["مقالات"],
							// ["پروفایل"],
					],
				];
				break;

			default:
				$text = 'تعریف نشده';
				break;
		}


		if($chat_id && $text)
		{
			// generate data
			$data =
			[
				'chat_id'      => $chat_id,
				'text'         => $text,
				'parse_mode'   => 'markdown',
			];
			if($replyMarkup)
			{
				$data['reply_markup'] = json_encode($replyMarkup);
				$data['force_reply'] = true;
			}
			if($reply)
			{
				$data['reply_to_message_id'] = $reply;
			}

			if($command === 'cb_go_right' || $command === 'cb_go_left')
			{
				unset($data['chat_id']);
				$data['inline_message_id'] = $hook['callback_query']['id'];
				$result = \lib\utility\social\tg::editMessageText($data);
			}
			else
			{
				$result = \lib\utility\social\tg::sendMessage($data);
			}
			return $result;
		}

		// $result = \lib\utility\social\tg::getMe();
		return null;
	}


	static function tg_from($_hook, $_needle = 'id')
	{
		if(isset($_hook['message']['from'][$_needle]))
		{
			return $_hook['message']['from'][$_needle];
		}
		return null;
	}


	static function tg_text($_hook)
	{
		$cmd = null;
		if(isset($_hook['message']['from']))
		{
			if(isset($_hook['message']['text']))
			{
				$cmd = $_hook['message']['text'];
				if(strpos($commad, 'خر') !== false)
				{
					$cmd = 'khar';
				}
			}
		}
		elseif(isset($_hook['callback_query']['data']))
		{
			$cmd = 'cb_'.$_hook['callback_query']['data'];
		}
		return $cmd;
	}


	static function tg_chat($_hook, $_needle = 'id')
	{
		if(isset($_hook['message']['chat'][$_needle]))
		{
			return $_hook['message']['chat'][$_needle];
		}
		elseif(isset($_hook['callback_query']['message']['chat'][$_needle]))
		{
			return $_hook['callback_query']['message']['chat'][$_needle];
		}
		return null;
	}


	static function tg_reply($_hook)
	{
		if(isset($_hook['message']['message_id']))
		{
			return $_hook['message']['message_id'];
		}
		return null;
	}
}
?>
<?php
namespace content\contact;


class model
{

	// log callers
	// user:send:contact
	// user:send:contact:fail
	// user:send:contact:empty:message
	// user:send:contact:empty:mobile
	// user:send:contact:wrong:captha
	// user:send:contact:register:by:mobile

	/**
	 * save contact form
	 */
	public static function post()
	{
		// check login
		if(\dash\user::login())
		{
			$user_id = \dash\user::login("id");

			// get mobile from user login session
			$mobile = \dash\user::login('mobile');

			if(!$mobile)
			{
				$mobile = \dash\request::post('mobile');
			}

			// get display name from user login session
			$displayname = \dash\user::login("displayname");
			// user not set users display name, we get display name from contact form
			if(!$displayname)
			{
				$displayname = \dash\request::post("name");
			}
			// get email from user login session
			$email = \dash\db\users::get_email($user_id);
			// user not set users email, we get email from contact form
			if(!$email)
			{
				$email = \dash\request::post("email");
			}
		}
		else
		{
			// users not registered
			$user_id     = null;
			$displayname = \dash\request::post("name");
			$email       = \dash\request::post("email");
			$mobile      = \dash\request::post("mobile");
		}
		// get the content
		$content = \dash\request::post("content");

		// save log meta
		$log_meta =
		[
			'meta' =>
			[
				'login'    => \dash\user::login('all'),
				'language' => \dash\language::get_language(),
				'post'     => \dash\request::post(),
			]
		];


		// check content
		if($content == '')
		{
			\dash\db\logs::set('user:send:contact:empty:message', $user_id, $log_meta);
			\dash\notif::error(T_("Please try type something!"), "content");
			return false;
		}
		// ready to insert comments
		$args =
		[
			'author'  => $displayname,
			'email'   => $email,
			'type'    => 'comment',
			'content' => $content,
			'user_id' => $user_id
		];

		$url    = root. 'content/contact/allCommentJson';

		if(!\dash\file::exists($url))
		{
			\dash\file::write($url, json_encode($args, JSON_UNESCAPED_UNICODE). "\n");
		}

		else
		{
			\dash\file::append($url, json_encode($args, JSON_UNESCAPED_UNICODE). "\n");

		}

		// \dash\db\logs::set('user:send:contact', $user_id, $log_meta);
		\dash\notif::ok(T_("Thank You For contacting us"));

	}
}
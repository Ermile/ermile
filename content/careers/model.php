<?php
namespace content\careers;
use \lib\debug;
use \lib\utility;
use \lib\utility\upload\check as upload;

class model extends \mvc\model
{
	public static $url = root.'public_html/files/careers';

	public function post_careers()
	{
		$name   = utility::post("name");
		$number = utility::post("number");
		$type   = utility::post("type");

		if($type != 'php' && $type != 'js' && $type != 'graphic')
		{
			return debug::error(T_("Type not found"));
		}
		if(!$number)
		{
			return debug::error(T_("Contact number not set"));
		}
		if(!is_numeric($number))
		{
			return debug::error(T_("Contact number must be number"));
		}
		if(strlen($number) != 11)
		{
			return debug::error(T_("Contact number must 11 character"));
		}

		if(strlen($name) > 30)
		{
			$name = substr($name, 0, 30);
		}

		if(!utility::files("file"))
		{
			return debug::error(T_("You must upload a CV file"));
		}

		$url = self::$url;
		if(!utility\file::exists($url))
		{
			utility\file::makeDir($url);
		}
		$url = $url. '/';
		$url .= $type. '_'. $number. '_';
		$url .= utility\filter::slug($name). '_';
		$url .= '['.utility\filter::slug(utility::files("file")['name']).']';

		$path = utility\file::getName(utility::files("file")['name']);
		$path = explode('.', $path);
		$path = end($path);

		$extentionsDisallow = ['php', 'php5', 'htaccess', 'exe', 'bat', 'bin'];
		// if(in_array($path, $extentionsDisallow))
		if($path !== 'pdf')
		{
			return debug::error(T_("Can not upload this file! only PDF:/"));
		}

		$url = str_replace('-'. $path, '', $url);
		$url .= '.'. $path;

		if(isset(utility::files("file")['tmp_name']))
		{
			if(move_uploaded_file(utility::files("file")['tmp_name'], $url))
			{
				return debug::true(T_("Thank you. Wait for our call"));
			}
			else
			{
				return debug::true(T_("We could not upload CV file"));
			}
		}
	}

	public function get_list($_args)
	{
		$file_list = [];
		if (is_dir(self::$url))
		{
		    if ($dh = opendir(self::$url))
		    {
		        while (($file = readdir($dh)) !== false)
		        {
		        	if($file == '.' || $file == '..')
		        	{
		        		continue;
		        	}
		        	$split = explode("_", $file);
		        	$type = null;
		        	if(isset($split[0]))
		        	{
		        		$type = $split[0];
		        	}
		        	$number = null;
		        	if(isset($split[1]))
		        	{
		        		$number = $split[1];
		        	}
		        	$name = null;
		        	if(isset($split[2]))
		        	{
		        		$name = $split[2];
		        	}
		        	$fileRawName = null;
		        	if(isset($split[3]))
		        	{
		        		$fileRawName = $split[3];
		        	}


		            $file_list[] =
		            [
						'file'   => $file,
						'type'   => $type,
						'number' => $number,
						'name'   => $name,
						'fileRawName'   => $fileRawName,
						'date'   => date("Y-m-d H:i:s", filemtime(self::$url. '/'. $file)),
						'url'    => \lib\router::$base. '/files/careers/'. $file
		            ];
		        }
		        closedir($dh);
		    }
		}
		return $file_list;

	}
}
?>
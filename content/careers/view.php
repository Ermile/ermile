<?php
namespace content\careers;

class view
{
	public static function config()
	{
		\dash\data::include_fontawesome(true);

		\dash\data::bodyclass('unselectable');

	    if(\dash\url::module() == 'careers')
	    {
			\dash\data::include_css(false);
			\dash\data::include_js(false);
	    }

		if(\dash\url::child() === 'get' && \dash\url::subchild() === null)
		{
			\dash\data::fileList(self::get_list());
		}
	}


	public static function get_list()
	{
		$file_list = [];
		if (is_dir(\content\careers\model::$url))
		{
		    if ($dh = opendir(\content\careers\model::$url))
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
						'date'   => date("Y-m-d H:i:s", filemtime(\content\careers\model::$url. '/'. $file)),
						'url'    => \dash\url::site(). '/files/careers/'. $file
		            ];
		        }
		        closedir($dh);
		    }
		}
		return $file_list;

	}

}
?>
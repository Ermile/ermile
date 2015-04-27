<?php
// require_once('../../public_html/config.php');
if ( file_exists( __DIR__.'/../../public_html/config.php') )
	require_once( __DIR__.'/../../public_html/config.php');
else
{
	// A config file doesn't exist
	echo( "<p>There doesn't seem to be a <code>config.php</code> file. I need this before we can get started.</p>" );
	exit();
}
echo "<!DOCTYPE html><meta charset='UTF-8'/><title>Extract text form twig files</title><body>";

$myPath = realpath(__DIR__."/../../").'/';
foreach (glob($myPath.'/*.php') as $filename)
{
    echo($filename);
}

$directory   = new RecursiveDirectoryIterator($myPath);
$flattened   = new RecursiveIteratorIterator($directory);

// Make sure the path does not contain "/.Trash*" folders and ends eith a .php or .html file
$files       = new RegexIterator($flattened, "/\\.html\$/i");
$translation = array();

foreach($files as $file)
{
	// create an record for array name
	$trans_key = substr($file, strpos($file, db_name)+strlen(db_name)+1 );
	$file_name = basename($file,'.html');
	$lines     = file($file);
	$find      = "trans";
	$count     = 0;

	foreach($lines as $num => $line)
	{
		if(strpos($line, $find) !== false && strpos($line, "transparent") === false)
		// if(!preg_match("/\btrans\b/i", $line))
		{
			$count +=1;
			// find all matches with my creteria
			// preg_match_all('/{%trans(.*?)%}/s', $line, $matches);										// #1
			// preg_match_all("/\{\s*%trans\s*(\"|')?([^\"'%]*)(\"|')?\s*%/", $line, $matches); // #2
			// preg_match_all("/\{\s*%\s*trans\s*\"?([^\"]*)\"?\s*%\s*\}/", $line, $matches);	// #3
			// preg_match_all("/\{\s*%trans\s*\"?([^\"]*)\"?%\s*\}/", $line, $matches);			// #3.1
			// preg_match_all("/\{\s*%\s*trans\s*\"([^\"]+?)\"\s*%\s*\}/", $line, $matches);		// #4
			preg_match_all('/{% ?trans\s\"(.*?)\" ?%}/s', $line, $matches);							// #5
			// var_dump($matches);
			$translation[$trans_key] = 'New File';
			foreach ($matches[1] as $key => $value)
			{
				$value = trim($value);
				if($value)
				{
					$translation[$value] = 'Line '.($num+1);
				}
			}
			preg_match_all("/\{\s*%\s*trans\s*%\s*}(.+?)\{\s*%\s*endtrans\s*%\s*}/", $line, $matches2);
			// var_dump($matches2);
			foreach ($matches2[1] as $key => $value)
			{
				$value = trim($value);
				if($value)
				{
					$translation[$value] = 'Line '.($num+1).' Seperate';
					
				}
			}
		}
	}
	if($count === 0 )
	{
		// echo($trans_key.'<br/>');
		// unset($translation[$trans_key]);
	}
}


echo('<h2>Translation Export '.count($translation).' String</h2>');
echo "<hr /><ol>";


// create translation file
$translation_output  = '<?php'."\n".'function transtext()'."\n{\n";
foreach ($translation as $key => $value)
{
	if($value=='New File')
	{
		$translation_output .= "\n\t//".str_repeat('-', 80-strlen($key))."$key\n";
		echo("</ul><br />");
		echo("<li>".$key.'</li>');
		echo("<ul>");
		
	}
	else
	{
		@$translation_output .= "\t".'echo T_("'.$key.'");'.str_repeat(' ',70-strlen($key)).'// '.$value."\n";
		echo('<li>'.$key.'</li>');
	}
}
$translation_output .= "\n}\n?>";
file_put_contents(__DIR__."/twig_translation.php", $translation_output);

echo "</ol><br/><br/><hr/><h1>Finish..!</h1>";
echo "<p>Extract string from twig file completed!</p></body></html>";

?>
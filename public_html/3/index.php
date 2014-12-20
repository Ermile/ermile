<?php
// I18N support information here

var_dump(setlocale(LC_ALL, null) );
//Persian_Iran.1256
//LC_COLLATE=C;LC_CTYPE=Persian_Iran.1256;LC_MONETARY=C;LC_NUMERIC=C;LC_TIME=C

$language = 'fa_IR';
putenv("LANG=$language"); 
setlocale(LC_ALL, $language);

// Set the text domain as 'messages'
$domain = 'messages';
bindtextdomain($domain, "/locale"); 
textdomain($domain);


var_dump(setlocale(LC_ALL, 0) );
//
echo gettext("A string to be translated would go here");
?>
<?php
// require_once('../../public_html/config.php');
if ( file_exists( __DIR__.'/../../../public_html/config.php') )
	require_once( __DIR__.'/../../../public_html/config.php');
else
{
	// A config file doesn't exist
	echo( "<p>There doesn't seem to be a <code>config.php</code> file. I need this before we can get started.</p>" );
	exit();
}

/**
***********************************************************************************
CAUTIONS : IF YOU DON'T KNOW WHAT'S THIS, PLEASE DON'T RUN IT!
* 
*THIS FILE READ DATABASE AND CREATE A PHP FILE FOR CREATING FORM
***********************************************************************************
**/
echo "<!DOCTYPE html><meta charset='UTF-8'/><title>Create file from db</title><body>";
$connect     = mysqli_connect("localhost", db_user, db_pass, db_name);
$qTables     = $connect->query("SHOW TABLES FROM ".db_name);
$translation = array();

function _type($type, $def,$_table  = null)
{
	global $translation;
	$def     = $def ? "!$def" : null;
	preg_match("/^([^(]*)(\((.*)\))?/", $type, $tp);
	$_type   = $tp[1];
	$_length = isset($tp[3]) ? $tp[3] : null;
	switch ($_type) 
	{
		case 'enum':
			$_length     = preg_replace("[']", "", $_length);
			if($_table)
			{
				$enum_values = explode(",",$_length);
				foreach ($enum_values as $key => $value)
				{
					$translation['Enum '.$value] = $value;
				}
			}
			return ("'type' => '$_type@$_length{$def}'");
			break;

		default:
			return ("'type' => '$_type@$_length{$def}'");
			break;
	}
}

function setproperty($myparam)
{
	$type       = $myparam->Type;
	$field      = $myparam->Field;
	// for add new HTML5 feature to forms
	preg_match("/^([^(]*)(\((.*)\))?/", $type, $tp);
	$_type		= $tp[1];
	$_length	   = isset($tp[3]) ? $tp[3] : null;
	$mydotpos	= strpos($_length,',');
	$mydotpos	= $mydotpos?$mydotpos:strlen($_length);
	$mylen 		= substr($_length, 0, $mydotpos);
	$mylength	= $_length;
	$mymax		= "->maxlength('".$_length."')";
	$tmp		   = array();
	// tmp[0]	type
	// tmp[1]	min
	// tmp[2]	max

	switch ($_type) 
	{
		case 'enum':
			$tmp[0] 	= "->type('select')";
			return $tmp;
			break;

		case 'timestamp':
		case 'text':
			return $tmp;
			break;

		case 'smallint':
		case 'tinyint':
		case 'int':
		case 'bigint':
		case 'decimal':
		case 'float':
			$tmp[0] 	= "->type('number')";
			if( substr($type, strlen($type)-8) == "unsigned" )
				array_push($tmp, "->min(0)");
			array_push($tmp, "->max(".str_repeat("9",$mylen-1).")");
			return $tmp;
			break;

		case 'varchar':
		case 'char':
			if($mylen>100)
				$tmp[0] 	= "->type('textarea')";
			else
				if($field == 'tel')
					$tmp[0] 	= "->type('tel')";
				elseif($field == 'pass')
					$tmp[0] 	= "->type('password')";
				elseif($field == 'website')
					$tmp[0] 	= "->type('url')";
				elseif($field == 'email')
					$tmp[0] 	= "->type('email')";
				else
					$tmp[0] 	= "->type('text')";

			array_push($tmp, "->maxlength(".$mylen.")");
			return $tmp;
			break;

		case 'datetime':
		case 'date':
		case 'time':
			return $tmp;
			break;

		default:
			return ("N-A: Create Error, Please check for new datatype");
			break;
	}
}

// loop until end of tables
while ($row = $qTables->fetch_object())
{
	$content                 = "<?php\n". "namespace database\\".db_name.";\n";
	$tmp_t                   = 'Tables_in_'.db_name;
	$TABLENAME               = $row->$tmp_t;
	$content                .= "class $TABLENAME \n{\n";
	$qCOL                    = $connect->query("DESCRIBE $TABLENAME");
	$qCOL1                   = $connect->query("DESCRIBE $TABLENAME");
	$fn                      ="\n";
	echo '<h2>'.$TABLENAME.'</h2><ul>';

	// Count number of char of each string ----------------------------------------------------------
	$counter         = array();
	$counter['name'] = 0;
	$counter['type'] = 0;
	while ($mycrow1 = $qCOL1->fetch_object())
	{
		$mytype = _type($mycrow1->Type, $mycrow1->Default, $TABLENAME);
		if(strlen($mytype) > $counter['type'])
			$counter['type'] = strlen($mytype);

		if(strlen($mycrow1->Field) > $counter['name'])
			$counter['name'] = strlen($mycrow1->Field);
	}

	$translation['Table '.$TABLENAME] = $TABLENAME;
	$translation[ucfirst($TABLENAME)] = ucfirst($TABLENAME);
	$translation[$TABLENAME]          = substr($TABLENAME, 0, -1);
	// create file of each table -------------------------------------------------------------------
	while ($crow = $qCOL->fetch_object())
	{
		// ========================================================================================== Edit by Javad
		// for fields from currect table except foreign key
		// we remove the table prefix, then show ramained text for name and for label we replace _ with space
		// for foreign key we remove second part of text after _ and show only the name of table without last char
		$myfield		   = $crow->Field;
		$myfield_null	= $crow->Null;
		$myfield_show	= 'YES';
		$property		= "";
		$property_type	= "";
		$tmp_result		= setproperty($crow);
		foreach ($tmp_result as $key => $value) 
		{
			if( substr($value, 0, 6)=='->type' )
			{
				$property_type = $value;
			}
			else
			{
				$property .= $value;
			}
		}
		$required   = $myfield_null=='NO'?'->required()':null;
		$property  .= $required;
		$tmp_pos    = strpos($myfield, '_');
		$prefix     = substr($myfield, 0, $tmp_pos );
		$isforeign  = false;
		$myname     = substr($myfield, ($tmp_pos ? $tmp_pos+1 : 0) );
		
		$myname     = strtolower($myname);
		$mylabel    = str_replace("_", " ", $myname);
		$mylabel    = ucwords($mylabel);
		
		$txtcomment = "\n\t//------------------------------------------------------------------ ";
		$txtstart   = "\tpublic function $myfield() \n\t{\n\t\t";
		$txtend     ="\n\t}\n";

		// --------------------------------------------------------------------------------- ID
		if($myfield=="id")
		{
			$fn           .= $txtcomment. "id - primary key\n";
			$fn           .= "\tpublic function $myfield() {" . '$this->validate()->id();' ."}\n";
			$myfield_show  = 'NO';

		}

		// --------------------------------------------------------------------------------- Foreign Key - User_id
		elseif ($myfield=='user_id' && $TABLENAME!='')
		{
			// for foreign key we use prefix that means we use (table name-last char)
			$fn			 .= "\tpublic function $myfield() {" . '$this->validate()->id();' ."}\n";

			$isforeign    = true;
			$mylabel      = ucwords(strtolower($prefix));
			$myfield_show = 'NO';
		}

		// --------------------------------------------------------------------------------- Foreign Key
		elseif ($myname=="id" || $myfield=="user_id_customer")
		{
			// for foreign key we use prefix that means we use (table name-last char)
			$fn .= $txtcomment. "id - foreign key\n";
			$fn .= $txtstart. '$this->form("select")->name("'. $prefix.'_")'.$property.'->type("select")->validate()->id();';
			$fn .= "\n\t\t".'$this->setChild();'.$txtend;

			$isforeign = true;
			$mylabel   = ucwords(strtolower($prefix));
		}


		// --------------------------------------------------------------------------------- General & more usable fields
		elseif ($myname=='title'	|| $myname=="slug" 	|| $myname=="desc" || $myname=="email"
			 ||  $myname=="website"	|| $myname=="mobile" || $myname=="tel"  || $myname=="pass"
			 || $myfield=="attachment_type")
		{
			// var_dump($property_type);
			$property  = $property. $property_type;
			$fn       .= $txtcomment. $myname."\n";
			$fn       .= $txtstart. '$this->form("#'.$myname.'")'.$property.';';
			$fn       .= $txtend;

			if ($myname=="desc" || $myname=="website" || $myname=="tel" || $myname=="pass" 
				|| $myfield=="attachment_type")
			{
				$myfield_show = 'NO';
			}
		}

		// --------------------------------------------------------------------------------- unuse
		elseif($myfield=="date_modified" || $myfield=='user_incomes' || $myfield=='user_outcomes'
			|| $myfield=='user_logincount')
		{
			$fn           .= "\tpublic function $myfield() {}\n";
			// $mylabel      = str_replace("_", " ", $myfield);
			$mylabel      = ucwords(strtolower($mylabel));
			$myfield_show = 'NO';
		}

		// --------------------------------------------------------------------------------- radio
		elseif ($myname=="active" 		|| $myname=="view"		|| $myname=="verified"
			|| $myname=="add" 			|| $myname=="edit" 		|| $myname=="delete"
			|| $myname=="service"		|| $myname=="gender"		|| $myname=="married"
			|| $myname=="newsletter"	|| $myname=="credit"		|| $myfield=="permission_status"
			)	
		{
			$fn    .= $txtcomment. "radio button\n";
			$fn    .= $txtstart. '$this->form("radio")->name("'. $myname.'")->type("radio")'.$property.';';
			// $fn .= "\n\t\t".'$this->setChild($this->form);'.$txtend;
			$fn    .= "\n\t\t".'$this->setChild();'.$txtend;
		}

		// --------------------------------------------------------------------------------- select
		elseif ($myname=="status" 	|| $myname=="model" 		|| $myname=="priority"
			|| $myname=="sellin"		|| $myname=="priority" 	|| $myname=='method'
			|| $myname=="type"		|| $myname=="paperstatus"
			)
		{
			$fn    .= $txtcomment. "select button\n";
			$fn    .= $txtstart. '$this->form("select")->name("'. $myname.'")->type("select")'.$property.'->validate();';
			// $fn .= "\n\t\t".'$this->setChild($this->form);'.$txtend;
			$fn    .= "\n\t\t".'$this->setChild();'.$txtend;
		}

		else
		{
			$property = $property.$property_type;
			$fn      .= $txtstart. '$this->form("text")->name("'. $myname.'")'.$property.';'.$txtend;
		}
		

		// ****************************************************************************for show in form or not
		if( $myfield=="user_id" || $myfield=="user_id_customer")
		{
			$myfield_show	= 'NO';
		}
		
		$mytype     = _type($crow->Type, $crow->Default);
		$fields		= "public \$$crow->Field"    .str_repeat(' ',$counter['name']+1-strlen($crow->Field))
		             ."= array("
		             ."'null' =>'$myfield_null',"  .str_repeat(' ',4-strlen($myfield_null))
		             ."'show' =>'$myfield_show',"  .str_repeat(' ',4-strlen($myfield_show))
		             ."'label'=>'$mylabel',"       .str_repeat(' ',14-strlen($mylabel))
		             .$mytype.","                  .str_repeat(' ',$counter['type']+1-strlen($mytype));
		             // .");\n";
		echo('<li><pre style="margin: 0;">'.$fields.'</pre></li>');
		if($isforeign)
		{
			$table            = $prefix.'s';
			$fields          .= "'foreign'=>'$table@id!";

			$tmp_fields_name = $prefix . "_title";
			if($table=="users")
				$tmp_fields_name = $prefix."_nickname";
			if($table=="receipts" || $table=="transactions" || $table=="papers")
				$tmp_fields_name = "id";

			$fields          .= $tmp_fields_name."'";
		}

		$content                           .= "\t".$fields.");\n";
		$translation[$myfield]  = $mylabel;
	}
	echo '</ul>';

	$content	.= $fn;
	$content	.= "}\n";
	$content	.= "?>";
	file_put_contents(__DIR__.'/'.db_name."/$TABLENAME.php", $content);
}
$connect->close();

// create translation file
$translation_output  = '<?php'."\n".'function transtext()'."\n{\n";
foreach ($translation as $key => $value)
{
	if(substr($key, 0, 6)=='Table ')
		$translation_output .= "\n\t// ------------------------------------------------------------------- $key\n";

	$translation_output .= "\t".'echo T_'.'("'.$value.'");'.str_repeat(' ',20-strlen($value)).'// '.$key."\n";
	// if(substr($key, 0, 5)=='Enum ')
	// 	$translation_output .= "\t".str_repeat(' ',20-strlen($key))."Enum value";

	// $translation_output .= "\n";
}
$translation_output .= "\n}\n?>";
file_put_contents(__DIR__.'/'.db_name."/translation.php", $translation_output);

echo "<br/><br/><hr/><h1>Finish..!</h1>";
echo "<p>Convert db to file and create translation file completed!</p></body></html>";
?>
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

// create db folder name if not exist
if (!file_exists(__DIR__.'/'.db_name))
	mkdir(__DIR__.'/'.db_name, 0777, true);


// this function return the type of field
function _type($_type, $_def, $_table = null)
{
	global $translation;
	$_def     = $_def ? "!$_def" : null;
	preg_match("/^([^(]*)(\((.*)\))?/", $_type, $tp);
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
					if($value)
						$translation['Enum '.$value] = $value;
				}
			}
			return ("'type' => '$_type@$_length{$_def}'");
			break;

		default:
			return ("'type' => '$_type@$_length{$_def}'");
			break;
	}
}


// this function set needed property of fields for HTML5
function setproperty($_arg)
{
	$type       = $_arg->Type;
	$field      = $_arg->Field;
	$tmp_pos    = strpos($field, '_');
	$fieldname  = substr($field, ($tmp_pos ? $tmp_pos+1 : 0) );

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
			$tmp[0] 	= "->type('radio')";
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
			if($fieldname === 'barcode' || substr($type, strlen($type)-8) == "zerofill")
			{
				array_push($tmp, "->min(1".str_repeat("0",$mylen-1).")");
				// array_push($tmp, "->pattern('.{".$mylen.",}')");
			}
			elseif( substr($type, strlen($type)-8) == "unsigned")
				array_push($tmp, "->min(0)");

			array_push($tmp, "->max(".str_repeat("9",$mylen).")");
			return $tmp;
			break;

		case 'varchar':
		case 'char':
			if($mylen>100)
				$tmp[0] 	= "->type('textarea')";
			else
				if($fieldname     == 'tel')       $tmp[0] = "->type('tel')";
				elseif($fieldname == 'pass')      $tmp[0] = "->type('password')";
				elseif($fieldname == 'password')  $tmp[0] = "->type('password')";
				elseif($fieldname == 'website')   $tmp[0] = "->type('url')";
				elseif($fieldname == 'email')     $tmp[0] = "->type('email')";
				elseif($fieldname == 'province')  $tmp[0] = "->type('select')";
				else                              $tmp[0] = "->type('text')";

			array_push($tmp, "->maxlength(".$mylen.")");
			return $tmp;
			break;

		case 'datetime':
		case 'date':
		case 'time':
			return $tmp;
			break;

		case 'year':
			$tmp[0] 	= "->type('number')";
			array_push($tmp, "->min(0)");
			array_push($tmp, "->max(9999)");
			return $tmp;
			break;		

		default:
			return ("N-A: Create Error, Please check for new datatype");
			break;
	}
}


// change field name with condition and return new user friendly name
function field_userFriendly($_fieldname, $_export = 'name')
{
	$_fieldname = strtolower($_fieldname);

	// check for _ exist in name or not
	$tmp_pos = strpos($_fieldname, '_');
	if($tmp_pos)
	{
		// var_dump($tmp_pos);
		$suffix = substr($_fieldname, $tmp_pos + 1);
		$prefix = substr($_fieldname, 0, $tmp_pos);

		// if is foreign key like user_id or permission_id
		// change it to user_ or permission_
		if($suffix === 'id')
		{
			$myname  = $prefix.'_';
			$mylabel = $prefix;
			$mytype  = 'foreign';
		}

		// if especial foreign key like user_idcustomer
		// change it to user_customer
		elseif(substr($suffix, 0, 2) === 'id')
		{
			$myname  = $prefix.'_'.substr($suffix, 2);
			$mylabel = $prefix.' '.substr($suffix, 2);
			$mytype  = 'foreign';
		}

		// for normal field like user_firstname or user_gender
		// change it to firstname or gender
		else
		{
			$myname  = $suffix;
			$mylabel = $suffix;
			$mytype  = 'normal';
		}
	}
	// in field like id return id
	else
	{
		$myname   = $_fieldname;
		$mylabel  = $_fieldname;
		$mytype  = 'id';
	}

	$result = array('name' => $myname, 'label' => $mylabel, 'type' => $mytype );
	
	return $result[$_export];
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
		$tmp_type = _type($mycrow1->Type, $mycrow1->Default, $TABLENAME);
		if(strlen($tmp_type) > $counter['type'])
			$counter['type'] = strlen($tmp_type);

		if(strlen($mycrow1->Field) > $counter['name'])
			$counter['name'] = strlen($mycrow1->Field);
	}

	$translation['Table '.$TABLENAME]       = $TABLENAME;
	// $translation[$TABLENAME]                = $TABLENAME;
	$translation[substr($TABLENAME, 0, -1)] = substr($TABLENAME, 0, -1);
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
				$property_type = $value;
			else
				$property .= $value;
		}
		$required   = $myfield_null=='NO'?'->required()':null;
		$property  .= $required;
		$tmp_pos    = strpos($myfield, '_');


		// filter then name of field for show in form
		$myname     = field_userFriendly($myfield, 'name');
		$mylabel    = field_userFriendly($myfield, 'label');
		$mytype     = field_userFriendly($myfield, 'type');


		$prefix     = substr($myfield, 0, $tmp_pos );
		$txtcomment = "\n\t//------------------------------------------------------------------ ";
		$txtstart   = "\tpublic function $myfield() \n\t{\n\t\t";
		$txtend     = true;

		/**
		 -------------------------------------------------------- only in this project - Start
		*/
		// if($myname  === 'passport')       $property .= "->parent('hide')";
		// elseif($myname  === 'color')      $property .= "->parent('span4')";
		// elseif($myname  === 'number')     $property .= "->parent('span4 endline')";
		/**
		 -------------------------------------------------------- only in this project - End
		*/


		// ------------------------------------------------------------- ID
		if($mytype === "id" || ($myfield=='user_id' && $TABLENAME!=''))
		{
			$fn          .= $txtcomment. $myfield."\n";
			$fn          .= "\tpublic function $myfield() {" . '$this->validate()->id();' ."}\n";
			$myfield_show = 'NO';
			$txtend       = false;
		}

		// ------------------------------------------------------------- Foreign Key
		elseif ($mytype === "foreign")
		{
			// for foreign key we use prefix that means we use (table name-last char)
			$fn .= $txtcomment. "id - foreign key\n";
			$fn .= $txtstart. '$this->form("select")->name("'.$myname.'")'.$property.'->type("select")->validate()->id();';
			$fn .= "\n\t\t".'$this->setChild();';
		}

		// ------------------------------------------------------------- General & more usable fields
		elseif ($myname=='title'	|| $myname=="slug" 	|| $myname=="desc" || $myname=="email"
			 ||  $myname=="website"	|| $myname=="mobile" || $myname=="tel"  || $myname=="pass"
			 || $myfield=="attachment_type")
		{
			$property  = $property. $property_type;
			$fn       .= $txtcomment. $myname."\n";
			$fn       .= $txtstart. '$this->form("#'.$myname.'")'.$property.';';

			if ($myname=="desc" || $myname=="website" || $myname=="tel" || $myname=="pass" 
				|| $myfield=="attachment_type")
			{
				$myfield_show = 'NO';
			}
		}

		// ------------------------------------------------------------- unuse
		elseif($myfield=="date_modified" || $myfield=='user_incomes' || $myfield=='user_outcomes'
			|| $myfield=='user_logincount')
		{
			$fn          .= "\tpublic function $myfield() {}\n";
			$myfield_show = 'NO';
			$txtend       = false;
		}

		// ------------------------------------------------------------- radio
		elseif ($myname=="active" 		|| $myname=="view"		|| $myname=="verified"
			|| $myname=="add" 			|| $myname=="edit" 		|| $myname=="delete"
			|| $myname=="service"		|| $myname=="gender"		|| $myname=="married"
			|| $myname=="newsletter"	|| $myname=="credit"		|| $myfield=="permission_status"
			)	
		{
			$fn    .= $txtcomment. "radio button\n";
			$fn    .= $txtstart. '$this->form("radio")->name("'. $myname.'")->type("radio")'.$property.';';
			// $fn .= "\n\t\t".'$this->setChild($this->form);';
			$fn    .= "\n\t\t".'$this->setChild();';
		}

		// ------------------------------------------------------------- select
		elseif ($myname=="status" 	|| $myname=="model" 		|| $myname=="priority"
			|| $myname=="sellin"		|| $myname=="priority" 	|| $myname=='method'
			|| $myname=="type"		|| $myname=="paperstatus" || $property_type =="->type('select')"
			)
		{
			$fn    .= $txtcomment. "select button\n";
			$fn    .= $txtstart. '$this->form("select")->name("'. $myname.'")->type("select")'.$property.'->validate();';

			if($myname === 'province' )
				$fn .= "\n\t\t".'$this->setChild'."('provinces@id!province_name', '18');";
			else
				$fn .= "\n\t\t".'$this->setChild();';
				
		}

		else
		{
			$property = $property.$property_type;
			$fn      .= $txtstart. '$this->form("text")->name("'. $myname.'")'.$property.';';

			if($myname === 'province' )
				$fn .= "\n\t\t".'$this->setChild'."('provinces@id!province_name', '18');";

			if($myname === 'nationalcode' || $myname === 'birthyear')
				$fn .= "\n\t\t".'$this->validate()->'.$myname.'();';
		}

		// if want to add txt end then end it
		if($txtend)
			$fn      .= "\n\t}\n";
		

		// ****************************************************************************for show in form or not
		if( $myfield=="user_id" || $myfield=="user_idcustomer")
		{
			$myfield_show	= 'NO';
		}
		
		$tmp_type = _type($crow->Type, $crow->Default);
		$fields		= "public \$$crow->Field"    .str_repeat(' ',$counter['name']+1-strlen($crow->Field))
		             ."= array("
		             ."'null' =>'$myfield_null',"  .str_repeat(' ',4-strlen($myfield_null))
		             ."'show' =>'$myfield_show',"  .str_repeat(' ',4-strlen($myfield_show))
		             ."'label'=>'$mylabel',"       .str_repeat(' ',14-strlen($mylabel))
		             .$tmp_type.","                  .str_repeat(' ',$counter['type']+1-strlen($tmp_type));
		             // .");\n";
		echo('<li><pre style="margin: 0;">'.$fields.'</pre></li>');

		if($mytype === 'foreign')
		{
			$table            = $prefix.'s';
			$fields          .= "'foreign'=>'$table@id!";

			$tmp_fields_name = $prefix . "_title";
			if($table=="users")
				$tmp_fields_name = $prefix."_nickname";
			elseif($table=="countrys" || $table=="provinces" || $table=="citys")
				$tmp_fields_name = $prefix."_name";
			elseif($table=="receipts" || $table=="transactions" || $table=="papers" || $table=="files")
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


// create translation file for gettext
$translation_output  = '<?php'."\n".'function transtext()'."\n{\n";
foreach ($translation as $key => $value)
{
	if(substr($key, 0, 6)=='Table ')
		$translation_output .= "\n\t// ------------------------------------------------------------------- $key\n";

	$translation_output .= "\t".'echo T_'.'("'.$value.'");'.str_repeat(' ',20-strlen($value)).'// '.$key."\n";
}
$translation_output .= "\n}\n?>";
file_put_contents(__DIR__.'/'.db_name."/translation.php", $translation_output);

// show final result!
echo "<br/><br/><hr/><h1>Finish..!</h1>";
echo "<p>Convert db to file and create translation file completed!</p></body></html>";
?>
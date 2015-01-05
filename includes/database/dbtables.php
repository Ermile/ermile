<?php
require_once('../../public_html/config.php');
/**
***********************************************************************************
CAUTIONS : IF YOU DON'T KNOW WHAT'S THIS, PLEASE DON'T RUN IT!
* 
*THIS FILE READ DATABASE AND CREATE A PHP FILE FOR CREATING FORM
***********************************************************************************
**/
$connect = mysqli_connect("localhost", db_user, db_pass, db_name);
$qTables = $connect->query("SHOW TABLES FROM ".db_name);
function _type($type, $def)
{
	$def = $def ? "!$def" : null;
	preg_match("/^([^(]*)(\((.*)\))?/", $type, $tp);
	$_type		= $tp[1];
	$_length	= isset($tp[3]) ? $tp[3] : null;
	switch ($_type) 
	{
		case 'enum':
			$_length = preg_replace("[']", "", $_length);
			return ("'type' => '$_type@$_length{$def}'");
			break;

		default:
			return ("'type' => '$_type@$_length{$def}'");
			break;
	}
}

function setproperty($myparam)
{
	$type = $myparam->Type;
	// var_dump($type);
	// for add new HTML5 feature to forms
	preg_match("/^([^(]*)(\((.*)\))?/", $type, $tp);
	$_type		= $tp[1];
	$_length	= isset($tp[3]) ? $tp[3] : null;
	$mydotpos	= strpos($_length,',');
	$mydotpos	= $mydotpos?$mydotpos:strlen($_length);
	$mylen 		= substr($_length, 0, $mydotpos);

	$mylength	= $_length;
	$mymax		= "->maxlength('".$_length."')";
	$tmp		= array();
	// tmp[0]	type
	// tmp[1]	min
	// tmp[2]	max

	// '->type("select")'
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
				
			// check for max input
			// $tmp 	.= "->onKeyDown('if(this.value.length==".$mylen.") return false;')";
			// $tmp 	.= "->max(".str_repeat("9",$mylen-1).")";
			array_push($tmp, "->max(".str_repeat("9",$mylen-1).")");


			return $tmp;
			break;


		case 'varchar':
		case 'char':
			if($mylen>100)
				$tmp[0] 	= "->type('textarea')";
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
			return ("N-A: Create Error");
			break;
	}
}
	while ($row = $qTables->fetch_object()) 
	{
		$content	= "<?php\n";
		$content	.= "namespace database\\".db_name.";\n";
		$tmp_t 		= 'Tables_in_'.db_name;
		$TABLENAME	= $row->$tmp_t;
		$content	.= "class $TABLENAME \n{\n";
		$qCOL		= $connect->query("DESCRIBE $TABLENAME");
		$fn			="\n";

		while ($crow = $qCOL->fetch_object()) 
		{
			// var_dump($crow);

			// ========================================================================================== Edit by Javad
			// for fields from currect table except foreign key
			// we remove the table prefix, then show ramained text for name and for label we replace _ with space
			// for foreign key we remove second part of text after _ and show only the name of table without last char
			
			$myfield		= $crow->Field;
			$mynull			= $crow->Null;
			$myfield_show	= 'YES';
			// $property		= setproperty($crow);
			$property		= "";
			$property_type	= "";
			$tmp_result		= setproperty($crow);
			// var_dump($TABLENAME);
			// var_dump($tmp_result);
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
			$required		= $mynull=='NO'?'->required()':null;
			$property		.= $required;
			$tmp_pos 		= strpos($myfield, '_');
			$prefix			= substr($myfield, 0, $tmp_pos );
			$isforeign		= false;
			$myname			= substr($myfield, ($tmp_pos ? $tmp_pos+1 : 0) );

			$myname 		= strtolower($myname);
			$mylabel 		= str_replace("_", " ", $myname);
			$mylabel		= ucwords($mylabel);

			$txtcomment		= "\n\t//------------------------------------------------------------------ ";
			$txtstart		= "\tpublic function $myfield() \n\t{\n\t\t";
			$txtend			="\n\t}\n";
			// $content		.= "\tpublic \$$crow->Field = array(". _type($crow->Type, $crow->Default).", 'label' => '$myname');\n";

			// --------------------------------------------------------------------------------- ID
			if($myfield=="id")
			{
				$fn				.= $txtcomment. "id - primary key\n";
				$fn				.= "\tpublic function $myfield() {" . '$this->validate()->id();' ."}\n";
				$mylabel		= "ID";
				$myfield_show	= 'NO';
			}

			// --------------------------------------------------------------------------------- Foreign Key - User_id
			elseif ($myfield=='user_id' && $TABLENAME!='')
			{
				// for foreign key we use prefix that means we use (table name-last char)
				$fn				.= "\tpublic function $myfield() {" . '$this->validate()->id();' ."}\n";
				// $fn .= $txtcomment. "id - foreign key - Users\n";
				// $fn .= $txtstart. '$this->form("select")->name("'. $prefix.'")'.$property.'->type("select")->validate()->id();';
				// $fn .= "\n\t\t".'$this->setChild($this->form);'.$txtend;

				// $mylabel = str_replace("_", " ", $myfield);
				$isforeign		= true;
				$mylabel		= ucwords(strtolower($prefix));
				$mylabel		= $mylabel;
				$myfield_show	= 'NO';
			}

			// --------------------------------------------------------------------------------- Foreign Key
			elseif ($myname=="id" || $myfield=="user_id_customer")
			{
				// for foreign key we use prefix that means we use (table name-last char)
				$fn .= $txtcomment. "id - foreign key\n";
				// $fn .= $txtstart. '$this->form("#foreignkey")->name("'. $prefix.'")->validate("id");' .$txtend;
				$fn .= $txtstart. '$this->form("select")->name("'. $prefix.'")'.$property.'->type("select")->validate()->id();';
				$fn .= "\n\t\t".'$this->setChild($this->form);'.$txtend;

				// $mylabel = str_replace("_", " ", $myfield);
				$isforeign		= true;
				$mylabel		= ucwords(strtolower($prefix));
				$mylabel		= $mylabel;
			}

			// --------------------------------------------------------------------------------- General
			elseif ($myname=='title')
			{
				$property = $property.$property_type;
				$fn .= $txtcomment. 'title'."\n";
				$fn .= $txtstart. '$this->form("text")->name("title")'.$property.';'.$txtend;
			}
			elseif ($myname=="slug")
			{
				$property = $property.$property_type;
				$fn .= $txtcomment. "slug\n";
				// $fn .= $txtstart. '$this->form("#slug");';
				$fn .= $txtstart. '$this->form("text")->name("'. $myname.'")->maxlength(40)->validate()->slugify("'.$prefix.'_title");';
				
				// $fn .= $txtstart. '$this->form("text")->name("'. $myname.'")->validate()';
				// $fn .= "\n\t\t->createslug(function()\t{" .'$this->value =\validator_lib::$save'."['form']['".$prefix."_title']->value;});";
				$fn .= $txtend;

				// $this->validate()->xsslug(function()
				// {
				// 	$this->value = \validator_lib::$save['form']['user_email']->value;
				// });
				
				// $myfield_show	= 'NO';
				// comment above line after check validation
			}
			elseif ($myname=="desc")
			{
				$property = $property.$property_type;
				$fn .= $txtcomment. "description\n";
				$fn .= $txtstart. '$this->form("#desc")'.$property.';'.$txtend;

				$mylabel = "Description";
				$myfield_show	= 'NO';
			}

			// --------------------------------------------------------------------------------- Email
			elseif ($myname=="email")
			{
				$fn .= $txtcomment. "email\n";
				$fn .= $txtstart. '$this->form("#email")->type("email")->required()'.$property.';'.$txtend;
			}

			// --------------------------------------------------------------------------------- Website
			elseif ($myname=="website")
			{
				$fn .= $txtcomment. "website\n";
				$fn .= $txtstart. '$this->form("#website")->type("url")'.$property.';'.$txtend;
				// $mylabel = "Description";
				$myfield_show	= 'NO';
			}

			// --------------------------------------------------------------------------------- Website
			elseif ($myname=="mobile")
			{
				$fn .= $txtcomment. "website\n";
				$fn .= $txtstart. '$this->form()->type("tel")->name("mobile")->pl("Mobile")->pattern(".{10,}")->maxlength(17)->required();'.$txtend;
			}
			elseif ( $myname=="tel")
			{
				$fn .= $txtcomment. "website\n";
				$fn .= $txtstart. '$this->form()->type("tel")->name("tel")->pattern(".{9,}")->maxlength(17);'.$txtend;
				$myfield_show	= 'NO';

			}
			// --------------------------------------------------------------------------------- Password
			elseif ($myname=="pass")
			{
				$fn				.= $txtcomment. "password\n";
				// Pattern:: (?	=^.{6,20}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$
				$fn				.= $txtstart. '$this->form()->name("pass")->pl("Password")->type("password")->required()->maxlength(20)';
				$fn				.= "\n\t\t\t". '->pattern("^.{5,20}$")->title("between 5-20 character")->validate()->password();'.$txtend;
				$mylabel		= "Password";
				$myfield_show	= 'NO';
			}

			// --------------------------------------------------------------------------------- unuse
			elseif($myfield=="date_modified" || $myfield=='user_incomes' || $myfield=='user_outcomes'
				|| $myfield=='user_logincount')
			{
				$fn .= "\tpublic function $myfield() {}\n";
				$mylabel = str_replace("_", " ", $myfield);
				$mylabel = ucwords(strtolower($mylabel));
				$mylabel = $mylabel;
				$myfield_show	= 'NO';
			}
			elseif($myfield=="attachment_type")
			{
				$fn .= $txtstart. '$this->form("text")->name("'. $myname.'")'.$property.';'.$txtend;
				$myfield_show	= 'NO';
			}

			// --------------------------------------------------------------------------------- radio
			elseif ($myname=="active" 		|| $myname=="view"		|| $myname=="verified"
				|| $myname=="add" 			|| $myname=="edit" 		|| $myname=="delete"
				|| $myname=="service"		|| $myname=="gender"	|| $myname=="married"
				|| $myname=="newsletter"	|| $myname=="credit"	|| $myfield=="permission_status"
				)	
			{
				$fn .= $txtcomment. "radio button\n";
				$fn .= $txtstart. '$this->form("radio")->name("'. $myname.'")->type("radio")'.$property.';';
				$fn .= "\n\t\t".'$this->setChild($this->form);'.$txtend;
			}

			// --------------------------------------------------------------------------------- select
			elseif ($myname=="status" 	|| $myname=="model" 	|| $myname=="priority"
				|| $myname=="sellin"	|| $myname=="priority" 	|| $myname=='method'
				|| $myname=="type"		|| $myname=="paperstatus"
				)
			{
				$fn .= $txtcomment. "select button\n";
				$fn .= $txtstart. '$this->form("select")->name("'. $myname.'")->type("select")'.$property.'->validate();';
				$fn .= "\n\t\t".'$this->setChild($this->form);'.$txtend;
			}

			// --------------------------------------------------------------------------------- Other
			elseif ($myfield=="user_extra")
			{
				$fn .= $txtcomment. "Extra\n";
				$fn .= $txtstart. '$this->form()->type("text")->label("Extra")->pl("Extra value")->name("extra")->required()';
				// $fn .= "\n\t\t\t".'->maxlength(20)->title("3 to 20 characters or number");'.$txtend;
				$fn .= "\n\t\t\t".'->maxlength(20)->pattern("^[a-zA-Z][a-zA-Z0-9-_\.]{2,20}$")->title("start with letter. 3 to 20 characters or number");'.$txtend;
				// ^[a-zA-Z][a-zA-Z0-9-_\.]{3,20}$
				$myfield_show	= 'NO';
			}
			else
			{
				$property = $property.$property_type;
				// $fn .= $txtcomment. "email\n";
				// $fn .= $txtstart. '$this->form()->name("'. $myname.'")'."\n\t\t".'->validate();'.$txtend;
				$fn .= $txtstart. '$this->form("text")->name("'. $myname.'")'.$property.';'.$txtend;
				// $fn .= $txtstart. $txtend;
			}
			


			// ****************************************************************************for show in form or not
			if ( $myfield=="user_id" )
			{
				$myfield_show	= 'NO';
			}

			elseif($myfield=="user_id_customer")
			{
				$myfield_show	= 'NO';
			}



			// ========================================================================================== Edit by Javad

			// $content .= "\tpublic \$$crow->Field = array(". _type($crow->Type, $crow->Default).", 'label' => '$mylabel');\n";
			// 'foreign' => 'table@id!value'
			$fields	= "\tpublic \$$crow->Field = array(". _type($crow->Type, $crow->Default).", 'null'=>'$mynull', 'show'=>'$myfield_show', 'label'=>'$mylabel');\n";
			if($isforeign)
			{
				$table				= $prefix.'s';
				$tmp_fields_start	= "\tpublic \$$crow->Field = array(". _type($crow->Type, $crow->Default).", 'null'=>'$mynull', 'show'=>'$myfield_show', 'label'=>'$mylabel', 'foreign'=>'$table@id!";
				$tmp_fields_end		= "');\n";
				$tmp_fields_name	= $prefix . "_title";
				// $fields				= "\tpublic \$$crow->Field = array(". _type($crow->Type, $crow->Default).", 'null' =>'$mynull' ,'label' => '$mylabel', 'foreign' => '$table@id!".$prefix."_title');\n";
				// if table has a especial record
				if($table=="users")
					$tmp_fields_name = $prefix."_nickname";
				if($table=="receipts" || $table=="transactions" || $table=="papers")
					$tmp_fields_name = "id";
				$fields				= $tmp_fields_start. $tmp_fields_name. $tmp_fields_end;
			}

			$content .= $fields;
		}

		$content	.= $fn;
		$content	.= "}\n";
		$content	.= "?>";
		// file_put_contents("./created/$TABLENAME.php", $content);
		file_put_contents(db_name."/$TABLENAME.php", $content);
	}
	$connect->close();

	echo "Finish..!";
	?>
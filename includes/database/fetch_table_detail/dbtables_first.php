<?php
$connect = mysqli_connect("localhost", "samac", "sql@92", "store");
$qTables = $connect->query("SHOW TABLES FROM store");
function _type($type, $def){
	$def = $def ? "!$def" : null;
	preg_match("/^([^(]*)(\((.*)\))?/", $type, $tp);
		$_type = $tp[1];
		$_length = isset($tp[3]) ? $tp[3] : null;
		switch ($_type) {
			case 'enum':
			$_length = preg_replace("[']", "", $_length);
			return ("'type' => '$_type@$_length{$def}'");
			break;
			default:

			return ("'type' => '$_type@$_length{$def}'");
			break;
		}
	}
	while ($row = $qTables->fetch_object()) {
		$content	= "<?php\n";
		$content	.= "namespace sql;\n";
		$TABLENAME	= $row->Tables_in_store;
		$content	.= "class $TABLENAME \n{\n";
		$qCOL		= $connect->query("DESCRIBE $TABLENAME");
		$fn			="\n";

		while ($crow = $qCOL->fetch_object()) {
			//$LABEL = $TABLENAME.'_'.$crow->Field;
			$LABEL = $crow->Field;
			$content .= "\tpublic \$$crow->Field = array(". _type($crow->Type, $crow->Default).", 'label' => '$LABEL');\n";
			


			$myfield	= $crow->Field;
			$txtcomment	= "\n\t//------------------------------------------------------------------ ";
			$txtstart	= "\tpublic function $crow->Field() \n\t{\n\t\t";
			$txtend		="\n\t}\n";

			if($crow->Field=="id")
			{
				$fn .= $txtcomment. "id - primary key\n";
				$fn .= "\tpublic function $crow->Field() {" . '$this->validate("id");' ."}\n";
			}
			elseif (substr($crow->Field, -2)=="id")
			{
				$fn .= $txtcomment. "id - foreign key\n";
				$fn .= $txtstart. '$this->validate("id");' .$txtend;
			}
			elseif (substr($crow->Field, -5)=="title")
			{
				$fn .= $txtcomment. "title\n";
				$fn .= $txtstart. '$this->form("title")->name("'. $myfield.'");'.$txtend;
			}
			elseif (substr($crow->Field, -4)=="slug")
			{
				$fn .= $txtcomment. "slug\n";
				$fn .= $txtstart. '$this->form("slug")->name("'. $myfield.'");'.$txtend;
			}
			elseif (substr($crow->Field, -4)=="desc")
			{
				$fn .= $txtcomment. "description\n";
				$fn .= $txtstart. '$this->form("desc")->name("'. $myfield.'");'.$txtend;
			}
			elseif($crow->Field=="date_created" or $crow->Field=="date_modified")
			{
				$fn .= "\tpublic function $crow->Field() {};\n";
			}
			else
			{
				$fn .= $txtstart. $txtend;
			}


		}
		$content .= $fn;
		$content .= "}\n";
		$content .= "?>";
		file_put_contents("./sql/$TABLENAME.sql.php", $content);
	}
	$connect->close();

	echo "Finish!";
	?>
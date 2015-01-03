<?php
namespace database\ermile;
class attachmentmetas 
{
	public $id = array('type' => 'int@10', 'null'=>'NO', 'show'=>'NO', 'label'=>'ID');
	public $attachment_id = array('type' => 'int@10', 'null'=>'NO', 'show'=>'YES', 'label'=>'Attachment', 'foreign'=>'attachments@id!attachment_title');
	public $attachmentmeta_cat = array('type' => 'varchar@50', 'null'=>'NO', 'show'=>'YES', 'label'=>'Cat');
	public $attachmentmeta_name = array('type' => 'varchar@100', 'null'=>'NO', 'show'=>'YES', 'label'=>'Name');
	public $attachmentmeta_value = array('type' => 'varchar@200', 'null'=>'YES', 'show'=>'YES', 'label'=>'Value');
	public $attachmentmeta_status = array('type' => 'enum@enable,disable,expire!enable', 'null'=>'NO', 'show'=>'YES', 'label'=>'Status');
	public $date_modified = array('type' => 'timestamp@', 'null'=>'YES', 'show'=>'NO', 'label'=>'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ id - foreign key
	public function attachment_id() 
	{
		$this->form("select")->name("attachment")->min(0)->max(999999999)->required()->type("select")->validate()->id();
		$this->setChild($this->form);
	}
	public function attachmentmeta_cat() 
	{
		$this->form("text")->name("cat")->maxlength(50)->required()->type('text');
	}
	public function attachmentmeta_name() 
	{
		$this->form("text")->name("name")->maxlength(100)->required()->type('text');
	}
	public function attachmentmeta_value() 
	{
		$this->form("text")->name("value")->maxlength(200)->type('textarea');
	}

	//------------------------------------------------------------------ select button
	public function attachmentmeta_status() 
	{
		$this->form("select")->name("status")->type("select")->required()->validate();
		$this->setChild($this->form);
	}
	public function date_modified() {}
}
?>
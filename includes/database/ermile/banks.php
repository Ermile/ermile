<?php
namespace database\ermile;
class banks 
{
	public $id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'NO', 'label'=>'ID');
	public $bank_title = array('type' => 'varchar@50', 'null'=>'NO', 'show'=>'YES', 'label'=>'Title');
	public $bank_slug = array('type' => 'varchar@50', 'null'=>'NO', 'show'=>'YES', 'label'=>'Slug');
	public $bank_website = array('type' => 'varchar@50', 'null'=>'YES', 'show'=>'NO', 'label'=>'Website');
	public $bank_status = array('type' => 'enum@enable,disable,expire!enable', 'null'=>'NO', 'show'=>'YES', 'label'=>'Status');
	public $date_modified = array('type' => 'timestamp@', 'null'=>'YES', 'show'=>'NO', 'label'=>'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ title
	public function bank_title() 
	{
		$this->form("text")->name("title")->maxlength(50)->required()->type('text');
	}

	//------------------------------------------------------------------ slug
	public function bank_slug() 
	{
		$this->form("text")->name("slug")->maxlength(40)->validate()->slugify("bank_title");
	}

	//------------------------------------------------------------------ website
	public function bank_website() 
	{
		$this->form("#website")->type("url")->maxlength(50);
	}

	//------------------------------------------------------------------ select button
	public function bank_status() 
	{
		$this->form("select")->name("status")->type("select")->required()->validate();
		$this->setChild($this->form);
	}
	public function date_modified() {}
}
?>
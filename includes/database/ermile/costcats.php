<?php
namespace database\ermile;
class costcats 
{
	public $id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'NO', 'label'=>'ID');
	public $costcat_title = array('type' => 'varchar@50', 'null'=>'NO', 'show'=>'YES', 'label'=>'Title');
	public $costcat_slug = array('type' => 'varchar@50', 'null'=>'NO', 'show'=>'YES', 'label'=>'Slug');
	public $costcat_desc = array('type' => 'varchar@200', 'null'=>'YES', 'show'=>'NO', 'label'=>'Description');
	public $costcat_father = array('type' => 'smallint@5', 'null'=>'YES', 'show'=>'YES', 'label'=>'Father');
	public $costcat_row = array('type' => 'smallint@5', 'null'=>'YES', 'show'=>'YES', 'label'=>'Row');
	public $costcat_type = array('type' => 'enum@income,outcome', 'null'=>'YES', 'show'=>'YES', 'label'=>'Type');
	public $costcat_status = array('type' => 'enum@enable,disable,expire!enable', 'null'=>'NO', 'show'=>'YES', 'label'=>'Status');
	public $date_modified = array('type' => 'timestamp@', 'null'=>'YES', 'show'=>'NO', 'label'=>'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ title
	public function costcat_title() 
	{
		$this->form("text")->name("title")->maxlength(50)->required()->type('text');
	}

	//------------------------------------------------------------------ slug
	public function costcat_slug() 
	{
		$this->form("text")->name("slug")->maxlength(40)->validate()->slugify("costcat_title");
	}

	//------------------------------------------------------------------ description
	public function costcat_desc() 
	{
		$this->form("#desc")->maxlength(200)->type('textarea');
	}
	public function costcat_father() 
	{
		$this->form("text")->name("father")->max(9999)->type('number');
	}
	public function costcat_row() 
	{
		$this->form("text")->name("row")->max(9999)->type('number');
	}

	//------------------------------------------------------------------ select button
	public function costcat_type() 
	{
		$this->form("select")->name("type")->type("select")->validate();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ select button
	public function costcat_status() 
	{
		$this->form("select")->name("status")->type("select")->required()->validate();
		$this->setChild($this->form);
	}
	public function date_modified() {}
}
?>
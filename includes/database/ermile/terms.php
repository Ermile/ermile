<?php
namespace database\ermile;
class terms 
{
	public $id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'NO', 'label'=>'ID');
	public $term_name = array('type' => 'varchar@50', 'null'=>'NO', 'show'=>'YES', 'label'=>'Name');
	public $term_slug = array('type' => 'varchar@50', 'null'=>'NO', 'show'=>'YES', 'label'=>'Slug');
	public $term_desc = array('type' => 'varchar@200', 'null'=>'NO', 'show'=>'NO', 'label'=>'Description');
	public $term_father = array('type' => 'smallint@5', 'null'=>'YES', 'show'=>'YES', 'label'=>'Father');
	public $term_type = array('type' => 'enum@cat,tag!cat', 'null'=>'NO', 'show'=>'YES', 'label'=>'Type');
	public $term_status = array('type' => 'enum@enable,disable,expire!enable', 'null'=>'NO', 'show'=>'YES', 'label'=>'Status');
	public $date_modified = array('type' => 'timestamp@', 'null'=>'YES', 'show'=>'NO', 'label'=>'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}
	public function term_name() 
	{
		$this->form("text")->name("name")->maxlength(50)->required()->type('text');
	}

	//------------------------------------------------------------------ slug
	public function term_slug() 
	{
		$this->form("text")->name("slug")->maxlength(40)->validate()->slugify("term_title");
	}

	//------------------------------------------------------------------ description
	public function term_desc() 
	{
		$this->form("#desc")->maxlength(200)->required()->type('textarea');
	}
	public function term_father() 
	{
		$this->form("text")->name("father")->min(0)->max(9999)->type('number');
	}

	//------------------------------------------------------------------ select button
	public function term_type() 
	{
		$this->form("select")->name("type")->type("select")->required()->validate();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ select button
	public function term_status() 
	{
		$this->form("select")->name("status")->type("select")->required()->validate();
		$this->setChild($this->form);
	}
	public function date_modified() {}
}
?>
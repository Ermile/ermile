<?php
namespace database\ermile;
class addons 
{
	public $id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'NO', 'label'=>'ID');
	public $addon_name = array('type' => 'varchar@50', 'null'=>'NO', 'show'=>'YES', 'label'=>'Name');
	public $addon_slug = array('type' => 'varchar@50', 'null'=>'NO', 'show'=>'YES', 'label'=>'Slug');
	public $addon_desc = array('type' => 'varchar@999', 'null'=>'YES', 'show'=>'NO', 'label'=>'Description');
	public $addon_status = array('type' => 'enum@enable,disable,expire,goingtoexpire!enable', 'null'=>'NO', 'show'=>'YES', 'label'=>'Status');
	public $addon_expire = array('type' => 'datetime@', 'null'=>'YES', 'show'=>'YES', 'label'=>'Expire');
	public $addon_installdate = array('type' => 'datetime@', 'null'=>'YES', 'show'=>'YES', 'label'=>'Installdate');
	public $date_modified = array('type' => 'timestamp@', 'null'=>'YES', 'show'=>'NO', 'label'=>'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}
	public function addon_name() 
	{
		$this->form("text")->name("name")->maxlength(50)->required()->type('text');
	}

	//------------------------------------------------------------------ slug
	public function addon_slug() 
	{
		$this->form("text")->name("slug")->maxlength(40)->validate()->slugify("addon_title");
	}

	//------------------------------------------------------------------ description
	public function addon_desc() 
	{
		$this->form("#desc")->maxlength(999)->type('textarea');
	}

	//------------------------------------------------------------------ select button
	public function addon_status() 
	{
		$this->form("select")->name("status")->type("select")->required()->validate();
		$this->setChild($this->form);
	}
	public function addon_expire() 
	{
		$this->form("text")->name("expire");
	}
	public function addon_installdate() 
	{
		$this->form("text")->name("installdate");
	}
	public function date_modified() {}
}
?>
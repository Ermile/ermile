<?php
namespace database\ermile;
class permissions 
{
	public $id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'NO', 'label'=>'ID');
	public $permission_title = array('type' => 'varchar@50', 'null'=>'NO', 'show'=>'YES', 'label'=>'Title');
	public $Permission_module = array('type' => 'varchar@50', 'null'=>'NO', 'show'=>'YES', 'label'=>'Module');
	public $permission_view = array('type' => 'enum@yes,no!yes', 'null'=>'NO', 'show'=>'YES', 'label'=>'View');
	public $permission_add = array('type' => 'enum@yes,no!no', 'null'=>'NO', 'show'=>'YES', 'label'=>'Add');
	public $permission_edit = array('type' => 'enum@yes,no!no', 'null'=>'NO', 'show'=>'YES', 'label'=>'Edit');
	public $permission_delete = array('type' => 'enum@yes,no!no', 'null'=>'NO', 'show'=>'YES', 'label'=>'Delete');
	public $permission_status = array('type' => 'enum@enable,disable,expire!enable', 'null'=>'NO', 'show'=>'YES', 'label'=>'Status');
	public $date_modified = array('type' => 'timestamp@', 'null'=>'YES', 'show'=>'NO', 'label'=>'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ title
	public function permission_title() 
	{
		$this->form("text")->name("title")->maxlength(50)->required()->type('text');
	}
	public function Permission_module() 
	{
		$this->form("text")->name("module")->maxlength(50)->required()->type('text');
	}

	//------------------------------------------------------------------ radio button
	public function permission_view() 
	{
		$this->form("radio")->name("view")->type("radio")->required();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ radio button
	public function permission_add() 
	{
		$this->form("radio")->name("add")->type("radio")->required();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ radio button
	public function permission_edit() 
	{
		$this->form("radio")->name("edit")->type("radio")->required();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ radio button
	public function permission_delete() 
	{
		$this->form("radio")->name("delete")->type("radio")->required();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ radio button
	public function permission_status() 
	{
		$this->form("radio")->name("status")->type("radio")->required();
		$this->setChild($this->form);
	}
	public function date_modified() {}
}
?>
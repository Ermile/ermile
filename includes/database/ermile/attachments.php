<?php
namespace database\ermile;
class attachments 
{
	public $id = array('type' => 'int@10', 'null'=>'NO', 'show'=>'NO', 'label'=>'ID');
	public $attachment_title = array('type' => 'varchar@100', 'null'=>'YES', 'show'=>'YES', 'label'=>'Title');
	public $attachment_model = array('type' => 'enum@productcategory,product,admin,banklogo,post,system,other', 'null'=>'NO', 'show'=>'YES', 'label'=>'Model');
	public $attachment_addr = array('type' => 'varchar@100', 'null'=>'NO', 'show'=>'YES', 'label'=>'Addr');
	public $attachment_name = array('type' => 'varchar@50', 'null'=>'NO', 'show'=>'YES', 'label'=>'Name');
	public $attachment_type = array('type' => 'varchar@10', 'null'=>'NO', 'show'=>'NO', 'label'=>'Type');
	public $attachment_size = array('type' => 'float@12,0', 'null'=>'NO', 'show'=>'YES', 'label'=>'Size');
	public $attachment_desc = array('type' => 'varchar@200', 'null'=>'YES', 'show'=>'NO', 'label'=>'Description');
	public $attachment_server = array('type' => 'int@10', 'null'=>'YES', 'show'=>'YES', 'label'=>'Server');
	public $attachment_folder = array('type' => 'int@10', 'null'=>'YES', 'show'=>'YES', 'label'=>'Folder');
	public $user_id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'NO', 'label'=>'User', 'foreign'=>'users@id!user_nickname');
	public $date_modified = array('type' => 'timestamp@', 'null'=>'YES', 'show'=>'NO', 'label'=>'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ title
	public function attachment_title() 
	{
		$this->form("text")->name("title")->maxlength(100)->type('text');
	}

	//------------------------------------------------------------------ select button
	public function attachment_model() 
	{
		$this->form("select")->name("model")->type("select")->required()->validate();
		$this->setChild($this->form);
	}
	public function attachment_addr() 
	{
		$this->form("text")->name("addr")->maxlength(100)->required()->type('text');
	}
	public function attachment_name() 
	{
		$this->form("text")->name("name")->maxlength(50)->required()->type('text');
	}
	public function attachment_type() 
	{
		$this->form("text")->name("type")->maxlength(10)->required();
	}
	public function attachment_size() 
	{
		$this->form("text")->name("size")->max(99999999999)->required()->type('number');
	}

	//------------------------------------------------------------------ description
	public function attachment_desc() 
	{
		$this->form("#desc")->maxlength(200)->type('textarea');
	}
	public function attachment_server() 
	{
		$this->form("text")->name("server")->min(0)->max(999999999)->type('number');
	}
	public function attachment_folder() 
	{
		$this->form("text")->name("folder")->min(0)->max(999999999)->type('number');
	}
	public function user_id() {$this->validate()->id();}
	public function date_modified() {}
}
?>
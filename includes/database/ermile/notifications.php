<?php
namespace database\ermile;
class notifications 
{
	public $id = array('type' => 'int@10', 'null'=>'NO', 'show'=>'NO', 'label'=>'ID');
	public $user_id_sender = array('type' => 'smallint@5', 'null'=>'YES', 'show'=>'YES', 'label'=>'Id Sender');
	public $user_id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'NO', 'label'=>'User', 'foreign'=>'users@id!user_nickname');
	public $notification_title = array('type' => 'varchar@50', 'null'=>'NO', 'show'=>'YES', 'label'=>'Title');
	public $notification_content = array('type' => 'varchar@200', 'null'=>'YES', 'show'=>'YES', 'label'=>'Content');
	public $notification_url = array('type' => 'varchar@100', 'null'=>'YES', 'show'=>'YES', 'label'=>'Url');
	public $notification_status = array('type' => 'enum@read,unread,expire!unread', 'null'=>'NO', 'show'=>'YES', 'label'=>'Status');
	public $date_modified = array('type' => 'timestamp@', 'null'=>'YES', 'show'=>'NO', 'label'=>'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}
	public function user_id_sender() 
	{
		$this->form("text")->name("id_sender")->min(0)->max(9999)->type('number');
	}
	public function user_id() {$this->validate()->id();}

	//------------------------------------------------------------------ title
	public function notification_title() 
	{
		$this->form("text")->name("title")->maxlength(50)->required()->type('text');
	}
	public function notification_content() 
	{
		$this->form("text")->name("content")->maxlength(200)->type('textarea');
	}
	public function notification_url() 
	{
		$this->form("text")->name("url")->maxlength(100)->type('text');
	}

	//------------------------------------------------------------------ select button
	public function notification_status() 
	{
		$this->form("select")->name("status")->type("select")->required()->validate();
		$this->setChild($this->form);
	}
	public function date_modified() {}
}
?>
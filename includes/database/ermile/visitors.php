<?php
namespace database\ermile;
class visitors 
{
	public $id = array('type' => 'int@10', 'null'=>'NO', 'show'=>'NO', 'label'=>'ID');
	public $visitor_ip = array('type' => 'int@10', 'null'=>'NO', 'show'=>'YES', 'label'=>'Ip');
	public $visitor_url = array('type' => 'varchar@255', 'null'=>'NO', 'show'=>'YES', 'label'=>'Url');
	public $visitor_agent = array('type' => 'varchar@255', 'null'=>'NO', 'show'=>'YES', 'label'=>'Agent');
	public $visitor_referer = array('type' => 'varchar@255', 'null'=>'YES', 'show'=>'YES', 'label'=>'Referer');
	public $visitor_robot = array('type' => 'enum@yes,no!no', 'null'=>'NO', 'show'=>'YES', 'label'=>'Robot');
	public $user_id = array('type' => 'smallint@5', 'null'=>'YES', 'show'=>'NO', 'label'=>'User', 'foreign'=>'users@id!user_nickname');
	public $visitor_createdate = array('type' => 'datetime@', 'null'=>'YES', 'show'=>'YES', 'label'=>'Createdate');
	public $date_modified = array('type' => 'timestamp@', 'null'=>'YES', 'show'=>'NO', 'label'=>'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}
	public function visitor_ip() 
	{
		$this->form("text")->name("ip")->min(0)->max(999999999)->required()->type('number');
	}
	public function visitor_url() 
	{
		$this->form("text")->name("url")->maxlength(255)->required()->type('textarea');
	}
	public function visitor_agent() 
	{
		$this->form("text")->name("agent")->maxlength(255)->required()->type('textarea');
	}
	public function visitor_referer() 
	{
		$this->form("text")->name("referer")->maxlength(255)->type('textarea');
	}
	public function visitor_robot() 
	{
		$this->form("text")->name("robot")->required()->type('select');
	}
	public function user_id() {$this->validate()->id();}
	public function visitor_createdate() 
	{
		$this->form("text")->name("createdate");
	}
	public function date_modified() {}
}
?>
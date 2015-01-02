<?php
namespace sql;
class smss 
{
	public $id = array('type' => 'int@10', 'null'=>'NO', 'show'=>'NO', 'label'=>'ID');
	public $sms_from = array('type' => 'varchar@15', 'null'=>'YES', 'show'=>'YES', 'label'=>'From');
	public $sms_to = array('type' => 'varchar@15', 'null'=>'YES', 'show'=>'YES', 'label'=>'To');
	public $sms_message = array('type' => 'varchar@255', 'null'=>'YES', 'show'=>'YES', 'label'=>'Message');
	public $sms_messageid = array('type' => 'int@10', 'null'=>'YES', 'show'=>'YES', 'label'=>'Messageid');
	public $sms_status = array('type' => 'tinyint@4', 'null'=>'YES', 'show'=>'YES', 'label'=>'Status');
	public $sms_method = array('type' => 'enum@post,get!post', 'null'=>'NO', 'show'=>'YES', 'label'=>'Method');
	public $sms_type = array('type' => 'enum@receive,delivery!delivery', 'null'=>'YES', 'show'=>'YES', 'label'=>'Type');
	public $sms_date = array('type' => 'datetime@', 'null'=>'YES', 'show'=>'YES', 'label'=>'Date');
	public $date_modified = array('type' => 'timestamp@', 'null'=>'YES', 'show'=>'NO', 'label'=>'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}
	public function sms_from() 
	{
		$this->form("text")->name("from")->maxlength(15)->type('text');
	}
	public function sms_to() 
	{
		$this->form("text")->name("to")->maxlength(15)->type('text');
	}
	public function sms_message() 
	{
		$this->form("text")->name("message")->maxlength(255)->type('textarea');
	}
	public function sms_messageid() 
	{
		$this->form("text")->name("messageid")->min(0)->max(999999999)->type('number');
	}

	//------------------------------------------------------------------ select button
	public function sms_status() 
	{
		$this->form("select")->name("status")->type("select")->min(0)->max(999)->validate();
		$this->setChild($this->form);
	}
	public function sms_method() 
	{
		$this->form("text")->name("method")->required()->type('select');
	}

	//------------------------------------------------------------------ select button
	public function sms_type() 
	{
		$this->form("select")->name("type")->type("select")->validate();
		$this->setChild($this->form);
	}
	public function sms_date() 
	{
		$this->form("text")->name("date");
	}
	public function date_modified() {}
}
?>
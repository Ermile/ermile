<?php
namespace database\ermile;
class notifications 
{
	public $id                   = array('null' =>'NO',  'show' =>'NO',  'label'=>'Id',            'type' => 'int@10',                         );
	public $user_id_sender       = array('null' =>'YES', 'show' =>'YES', 'label'=>'Id Sender',     'type' => 'smallint@5',                     );
	public $user_id              = array('null' =>'NO',  'show' =>'NO',  'label'=>'User',          'type' => 'smallint@5',                     'foreign'=>'users@id!user_nickname');
	public $notification_title   = array('null' =>'NO',  'show' =>'YES', 'label'=>'Title',         'type' => 'varchar@50',                     );
	public $notification_content = array('null' =>'YES', 'show' =>'YES', 'label'=>'Content',       'type' => 'varchar@200',                    );
	public $notification_url     = array('null' =>'YES', 'show' =>'YES', 'label'=>'Url',           'type' => 'varchar@100',                    );
	public $notification_status  = array('null' =>'NO',  'show' =>'YES', 'label'=>'Status',        'type' => 'enum@read,unread,expire!unread', );
	public $date_modified        = array('null' =>'YES', 'show' =>'NO',  'label'=>'Date Modified', 'type' => 'timestamp@',                     );


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
		$this->form("#title")->maxlength(50)->required()->type('text');
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
		$this->setChild();
	}
	public function date_modified() {}
}
?>
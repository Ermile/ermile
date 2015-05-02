<?php
namespace database\ermile;
class notifications 
{
	public $id                   = array('null' =>'NO',  'show' =>'NO',  'label'=>'id',            'type' => 'bigint@20',                      );
	public $user_idsender        = array('null' =>'YES', 'show' =>'YES', 'label'=>'user sender',   'type' => 'int@10',                         'foreign'=>'users@id!user_nickname');
	public $user_id              = array('null' =>'NO',  'show' =>'NO',  'label'=>'user',          'type' => 'int@10',                         'foreign'=>'users@id!user_nickname');
	public $notification_title   = array('null' =>'NO',  'show' =>'YES', 'label'=>'title',         'type' => 'varchar@50',                     );
	public $notification_content = array('null' =>'YES', 'show' =>'YES', 'label'=>'content',       'type' => 'varchar@200',                    );
	public $notification_url     = array('null' =>'YES', 'show' =>'YES', 'label'=>'url',           'type' => 'varchar@100',                    );
	public $notification_status  = array('null' =>'NO',  'show' =>'YES', 'label'=>'status',        'type' => 'enum@read,unread,expire!unread', );
	public $date_modified        = array('null' =>'YES', 'show' =>'NO',  'label'=>'modified',      'type' => 'timestamp@',                     );


	//------------------------------------------------------------------ id
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ id - foreign key
	public function user_idsender() 
	{
		$this->form("select")->name("user_sender")->min(0)->max(9999999999)->type("select")->validate()->id();
		$this->setChild();
	}

	//------------------------------------------------------------------ user_id
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
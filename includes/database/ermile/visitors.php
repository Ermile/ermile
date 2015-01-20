<?php
namespace database\ermile;
class visitors 
{
	public $id                 = array('null' =>'NO',  'show' =>'NO',  'label'=>'ID',            'type' => 'int@10',         );
	public $visitor_ip         = array('null' =>'NO',  'show' =>'YES', 'label'=>'Ip',            'type' => 'int@10',         );
	public $visitor_url        = array('null' =>'NO',  'show' =>'YES', 'label'=>'Url',           'type' => 'varchar@255',    );
	public $visitor_agent      = array('null' =>'NO',  'show' =>'YES', 'label'=>'Agent',         'type' => 'varchar@255',    );
	public $visitor_referer    = array('null' =>'YES', 'show' =>'YES', 'label'=>'Referer',       'type' => 'varchar@255',    );
	public $visitor_robot      = array('null' =>'NO',  'show' =>'YES', 'label'=>'Robot',         'type' => 'enum@yes,no!no', );
	public $user_id            = array('null' =>'YES', 'show' =>'NO',  'label'=>'User',          'type' => 'smallint@5',     'foreign'=>'users@id!user_nickname');
	public $visitor_createdate = array('null' =>'YES', 'show' =>'YES', 'label'=>'Createdate',    'type' => 'datetime@',      );
	public $date_modified      = array('null' =>'YES', 'show' =>'NO',  'label'=>'Date Modified', 'type' => 'timestamp@',     );


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
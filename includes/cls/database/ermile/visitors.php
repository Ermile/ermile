<?php
namespace database\ermile;
class visitors 
{
	public $id                 = array('null' =>'NO',  'show' =>'NO',  'label'=>'id',            'type' => 'bigint@20',      );
	public $visitor_ip         = array('null' =>'NO',  'show' =>'YES', 'label'=>'ip',            'type' => 'int@10',         );
	public $visitor_url        = array('null' =>'NO',  'show' =>'YES', 'label'=>'url',           'type' => 'varchar@255',    );
	public $visitor_agent      = array('null' =>'NO',  'show' =>'YES', 'label'=>'agent',         'type' => 'varchar@255',    );
	public $visitor_referer    = array('null' =>'YES', 'show' =>'YES', 'label'=>'referer',       'type' => 'varchar@255',    );
	public $visitor_robot      = array('null' =>'NO',  'show' =>'YES', 'label'=>'robot',         'type' => 'enum@yes,no!no', );
	public $user_id            = array('null' =>'YES', 'show' =>'NO',  'label'=>'user',          'type' => 'int@10',         'foreign'=>'users@id!user_nickname');
	public $visitor_createdate = array('null' =>'YES', 'show' =>'YES', 'label'=>'createdate',    'type' => 'datetime@',      );
	public $date_modified      = array('null' =>'YES', 'show' =>'NO',  'label'=>'modified',      'type' => 'timestamp@',     );


	//------------------------------------------------------------------ id
	public function id() {$this->validate()->id();}
	public function visitor_ip() 
	{
		$this->form("text")->name("ip")->min(0)->max(9999999999)->required()->type('number');
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
		$this->form("text")->name("robot")->required()->type('radio');
	}

	//------------------------------------------------------------------ user_id
	public function user_id() {$this->validate()->id();}
	public function visitor_createdate() 
	{
		$this->form("text")->name("createdate");
	}
	public function date_modified() {}
}
?>
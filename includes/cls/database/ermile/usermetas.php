<?php
namespace database\ermile;
class usermetas 
{
	public $id              = array('null' =>'NO',  'show' =>'NO',  'label'=>'id',            'type' => 'smallint@6',                        );
	public $user_id         = array('null' =>'NO',  'show' =>'NO',  'label'=>'user',          'type' => 'smallint@6',                        'foreign'=>'users@id!user_nickname');
	public $usermeta_cat    = array('null' =>'NO',  'show' =>'YES', 'label'=>'cat',           'type' => 'varchar@50',                        );
	public $usermeta_name   = array('null' =>'NO',  'show' =>'YES', 'label'=>'name',          'type' => 'varchar@100',                       );
	public $usermeta_value  = array('null' =>'YES', 'show' =>'YES', 'label'=>'value',         'type' => 'varchar@500',                       );
	public $usermeta_extra  = array('null' =>'YES', 'show' =>'YES', 'label'=>'extra',         'type' => 'varchar@500',                       );
	public $usermeta_status = array('null' =>'NO',  'show' =>'YES', 'label'=>'status',        'type' => 'enum@enable,disable,expire!enable', );
	public $date_modified   = array('null' =>'YES', 'show' =>'NO',  'label'=>'modified',      'type' => 'timestamp@',                        );


	//------------------------------------------------------------------ id
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ user_id
	public function user_id() {$this->validate()->id();}
	public function usermeta_cat() 
	{
		$this->form("text")->name("cat")->maxlength(50)->required()->type('text');
	}
	public function usermeta_name() 
	{
		$this->form("text")->name("name")->maxlength(100)->required()->type('text');
	}
	public function usermeta_value() 
	{
		$this->form("text")->name("value")->maxlength(500)->type('textarea');
	}
	public function usermeta_extra() 
	{
		$this->form("text")->name("extra")->maxlength(500)->type('textarea');
	}

	//------------------------------------------------------------------ select button
	public function usermeta_status() 
	{
		$this->form("select")->name("status")->type("select")->required()->validate();
		$this->setChild();
	}
	public function date_modified() {}
}
?>
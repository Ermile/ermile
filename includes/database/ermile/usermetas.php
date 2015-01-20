<?php
namespace database\ermile;
class usermetas 
{
	public $id              = array('null' =>'NO',  'show' =>'NO',  'label'=>'ID',            'type' => 'smallint@6',                        );
	public $user_id         = array('null' =>'NO',  'show' =>'NO',  'label'=>'User',          'type' => 'smallint@6',                        'foreign'=>'users@id!user_nickname');
	public $usermeta_cat    = array('null' =>'NO',  'show' =>'YES', 'label'=>'Cat',           'type' => 'varchar@50',                        );
	public $usermeta_name   = array('null' =>'NO',  'show' =>'YES', 'label'=>'Name',          'type' => 'varchar@100',                       );
	public $usermeta_value  = array('null' =>'YES', 'show' =>'YES', 'label'=>'Value',         'type' => 'varchar@500',                       );
	public $usermeta_status = array('null' =>'NO',  'show' =>'YES', 'label'=>'Status',        'type' => 'enum@enable,disable,expire!enable', );
	public $date_modified   = array('null' =>'YES', 'show' =>'NO',  'label'=>'Date Modified', 'type' => 'timestamp@',                        );


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}
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

	//------------------------------------------------------------------ select button
	public function usermeta_status() 
	{
		$this->form("select")->name("status")->type("select")->required()->validate();
		$this->setChild();
	}
	public function date_modified() {}
}
?>
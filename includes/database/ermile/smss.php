<?php
namespace database\ermile;
class smss 
{
	public $id                 = array('null' =>'NO',  'show' =>'NO',  'label'=>'Id',            'type' => 'int@10',                            );
	public $sms_from           = array('null' =>'YES', 'show' =>'YES', 'label'=>'From',          'type' => 'varchar@15',                        );
	public $sms_to             = array('null' =>'YES', 'show' =>'YES', 'label'=>'To',            'type' => 'varchar@15',                        );
	public $sms_message        = array('null' =>'YES', 'show' =>'YES', 'label'=>'Message',       'type' => 'varchar@255',                       );
	public $sms_messageid      = array('null' =>'YES', 'show' =>'YES', 'label'=>'Messageid',     'type' => 'int@10',                            );
	public $sms_deliverystatus = array('null' =>'YES', 'show' =>'YES', 'label'=>'Deliverystatus','type' => 'tinyint@4',                         );
	public $sms_method         = array('null' =>'NO',  'show' =>'YES', 'label'=>'Method',        'type' => 'enum@post,get!post',                );
	public $sms_type           = array('null' =>'NO',  'show' =>'YES', 'label'=>'Type',          'type' => 'enum@receive,delivery!delivery',    );
	public $sms_createdate     = array('null' =>'NO',  'show' =>'YES', 'label'=>'Createdate',    'type' => 'datetime@',                         );
	public $sms_status         = array('null' =>'NO',  'show' =>'YES', 'label'=>'Status',        'type' => 'enum@enable,disable,expire!enable', );
	public $date_modified      = array('null' =>'YES', 'show' =>'NO',  'label'=>'Date Modified', 'type' => 'timestamp@',                        );


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
	public function sms_deliverystatus() 
	{
		$this->form("text")->name("deliverystatus")->min(0)->max(999)->type('number');
	}

	//------------------------------------------------------------------ select button
	public function sms_method() 
	{
		$this->form("select")->name("method")->type("select")->required()->validate();
		$this->setChild();
	}

	//------------------------------------------------------------------ select button
	public function sms_type() 
	{
		$this->form("select")->name("type")->type("select")->required()->validate();
		$this->setChild();
	}
	public function sms_createdate() 
	{
		$this->form("text")->name("createdate")->required();
	}

	//------------------------------------------------------------------ select button
	public function sms_status() 
	{
		$this->form("select")->name("status")->type("select")->required()->validate();
		$this->setChild();
	}
	public function date_modified() {}
}
?>
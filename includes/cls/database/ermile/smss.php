<?php
namespace database\ermile;
class smss 
{
	public $id                 = array('null' =>'NO',  'show' =>'NO',  'label'=>'id',            'type' => 'int@10',                            );
	public $sms_from           = array('null' =>'YES', 'show' =>'YES', 'label'=>'from',          'type' => 'varchar@15',                        );
	public $sms_to             = array('null' =>'YES', 'show' =>'YES', 'label'=>'to',            'type' => 'varchar@15',                        );
	public $sms_message        = array('null' =>'YES', 'show' =>'YES', 'label'=>'message',       'type' => 'varchar@255',                       );
	public $sms_messageid      = array('null' =>'YES', 'show' =>'YES', 'label'=>'messageid',     'type' => 'int@10',                            );
	public $sms_deliverystatus = array('null' =>'YES', 'show' =>'YES', 'label'=>'deliverystatus','type' => 'tinyint@4',                         );
	public $sms_method         = array('null' =>'NO',  'show' =>'YES', 'label'=>'method',        'type' => 'enum@post,get!post',                );
	public $sms_type           = array('null' =>'NO',  'show' =>'YES', 'label'=>'type',          'type' => 'enum@receive,delivery!delivery',    );
	public $sms_createdate     = array('null' =>'NO',  'show' =>'YES', 'label'=>'createdate',    'type' => 'datetime@',                         );
	public $sms_status         = array('null' =>'NO',  'show' =>'YES', 'label'=>'status',        'type' => 'enum@enable,disable,expire!enable', );
	public $date_modified      = array('null' =>'YES', 'show' =>'NO',  'label'=>'modified',      'type' => 'timestamp@',                        );


	//------------------------------------------------------------------ id
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
		$this->form("text")->name("messageid")->min(0)->max(9999999999)->type('number');
	}
	public function sms_deliverystatus() 
	{
		$this->form("text")->name("deliverystatus")->min(0)->max(9999)->type('number');
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
		$this->form("text")->name("createdate")->required()->type('text');
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
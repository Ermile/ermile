<?php
namespace database\ermile;
class smss 
{
	public $id                 = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'id'              ,'type'=>'int@10'];
	public $sms_from           = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'from'            ,'type'=>'varchar@15'];
	public $sms_to             = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'to'              ,'type'=>'varchar@15'];
	public $sms_message        = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'message'         ,'type'=>'varchar@255'];
	public $sms_messageid      = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'messageid'       ,'type'=>'int@10'];
	public $sms_deliverystatus = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'deliverystatus'  ,'type'=>'tinyint@4'];
	public $sms_method         = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'method'          ,'type'=>'enum@post,get!post'];
	public $sms_type           = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'type'            ,'type'=>'enum@receive,delivery!delivery'];
	public $sms_createdate     = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'createdate'      ,'type'=>'datetime@'];
	public $sms_status         = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'status'          ,'type'=>'enum@enable,disable,expire!enable'];
	public $date_modified      = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'modified'        ,'type'=>'timestamp@'];

	//--------------------------------------------------------------------------------id
	public function id(){}

	public function sms_from()
	{
		$this->form()->type('text')->name('from')->maxlength('15');
	}

	public function sms_to()
	{
		$this->form()->type('text')->name('to')->maxlength('15');
	}

	public function sms_message()
	{
		$this->form()->type('textarea')->name('message')->maxlength('255');
	}

	public function sms_messageid()
	{
		$this->form()->type('number')->name('messageid')->min()->max('9999999999');
	}

	public function sms_deliverystatus()
	{
		$this->form()->type('number')->name('deliverystatus')->min()->max('9999');
	}

	public function sms_method()
	{
		$this->form()->type('radio')->name('method')->required();
		$this->setChild();
	}

	public function sms_type()
	{
		$this->form()->type('radio')->name('type')->required();
		$this->setChild();
	}

	public function sms_createdate()
	{
		$this->form()->type('text')->name('createdate')->required();
	}

	public function sms_status()
	{
		$this->form()->type('radio')->name('status')->required();
		$this->setChild();
	}

	public function date_modified(){}
}
?>
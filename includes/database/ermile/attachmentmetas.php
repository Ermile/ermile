<?php
namespace database\ermile;
class attachmentmetas 
{
	public $id                    = array('null' =>'NO',  'show' =>'NO',  'label'=>'ID',            'type' => 'int@10',                            );
	public $attachment_id         = array('null' =>'NO',  'show' =>'YES', 'label'=>'Attachment',    'type' => 'int@10',                            'foreign'=>'attachments@id!attachment_title');
	public $attachmentmeta_cat    = array('null' =>'NO',  'show' =>'YES', 'label'=>'Cat',           'type' => 'varchar@50',                        );
	public $attachmentmeta_name   = array('null' =>'NO',  'show' =>'YES', 'label'=>'Name',          'type' => 'varchar@100',                       );
	public $attachmentmeta_value  = array('null' =>'YES', 'show' =>'YES', 'label'=>'Value',         'type' => 'varchar@200',                       );
	public $attachmentmeta_status = array('null' =>'NO',  'show' =>'YES', 'label'=>'Status',        'type' => 'enum@enable,disable,expire!enable', );
	public $date_modified         = array('null' =>'YES', 'show' =>'NO',  'label'=>'Date Modified', 'type' => 'timestamp@',                        );


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ id - foreign key
	public function attachment_id() 
	{
		$this->form("select")->name("attachment")->min(0)->max(999999999)->required()->type("select")->validate()->id();
		$this->setChild();
	}
	public function attachmentmeta_cat() 
	{
		$this->form("text")->name("cat")->maxlength(50)->required()->type('text');
	}
	public function attachmentmeta_name() 
	{
		$this->form("text")->name("name")->maxlength(100)->required()->type('text');
	}
	public function attachmentmeta_value() 
	{
		$this->form("text")->name("value")->maxlength(200)->type('textarea');
	}

	//------------------------------------------------------------------ select button
	public function attachmentmeta_status() 
	{
		$this->form("select")->name("status")->type("select")->required()->validate();
		$this->setChild();
	}
	public function date_modified() {}
}
?>
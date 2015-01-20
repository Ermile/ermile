<?php
namespace database\ermile;
class addons 
{
	public $id                = array('null' =>'NO',  'show' =>'NO',  'label'=>'Id',            'type' => 'smallint@5',                                      );
	public $addon_name        = array('null' =>'NO',  'show' =>'YES', 'label'=>'Name',          'type' => 'varchar@50',                                      );
	public $addon_slug        = array('null' =>'NO',  'show' =>'YES', 'label'=>'Slug',          'type' => 'varchar@50',                                      );
	public $addon_desc        = array('null' =>'YES', 'show' =>'NO',  'label'=>'Desc',          'type' => 'varchar@999',                                     );
	public $addon_status      = array('null' =>'NO',  'show' =>'YES', 'label'=>'Status',        'type' => 'enum@enable,disable,expire,goingtoexpire!enable', );
	public $addon_expire      = array('null' =>'YES', 'show' =>'YES', 'label'=>'Expire',        'type' => 'datetime@',                                       );
	public $addon_installdate = array('null' =>'YES', 'show' =>'YES', 'label'=>'Installdate',   'type' => 'datetime@',                                       );
	public $date_modified     = array('null' =>'YES', 'show' =>'NO',  'label'=>'Date Modified', 'type' => 'timestamp@',                                      );


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}
	public function addon_name() 
	{
		$this->form("text")->name("name")->maxlength(50)->required()->type('text');
	}

	//------------------------------------------------------------------ slug
	public function addon_slug() 
	{
		$this->form("#slug")->maxlength(50)->required()->type('text');
	}

	//------------------------------------------------------------------ desc
	public function addon_desc() 
	{
		$this->form("#desc")->maxlength(999)->type('textarea');
	}

	//------------------------------------------------------------------ select button
	public function addon_status() 
	{
		$this->form("select")->name("status")->type("select")->required()->validate();
		$this->setChild();
	}
	public function addon_expire() 
	{
		$this->form("text")->name("expire");
	}
	public function addon_installdate() 
	{
		$this->form("text")->name("installdate");
	}
	public function date_modified() {}
}
?>
<?php
namespace database\ermile;
class locations 
{
	public $id              = array('null' =>'NO',  'show' =>'NO',  'label'=>'ID',            'type' => 'smallint@5',                        );
	public $location_title  = array('null' =>'NO',  'show' =>'YES', 'label'=>'Title',         'type' => 'varchar@100',                       );
	public $location_slug   = array('null' =>'NO',  'show' =>'YES', 'label'=>'Slug',          'type' => 'varchar@100',                       );
	public $location_desc   = array('null' =>'YES', 'show' =>'NO',  'label'=>'Description',   'type' => 'varchar@200',                       );
	public $location_status = array('null' =>'NO',  'show' =>'YES', 'label'=>'Status',        'type' => 'enum@enable,disable,expire!enable', );
	public $date_modified   = array('null' =>'YES', 'show' =>'NO',  'label'=>'Date Modified', 'type' => 'timestamp@',                        );


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ title
	public function location_title() 
	{
		$this->form("text")->name("title")->maxlength(100)->required()->type('text');
	}

	//------------------------------------------------------------------ slug
	public function location_slug() 
	{
		$this->form("text")->name("slug")->maxlength(40)->validate()->slugify("location_title");
	}

	//------------------------------------------------------------------ description
	public function location_desc() 
	{
		$this->form("#desc")->maxlength(200)->type('textarea');
	}

	//------------------------------------------------------------------ select button
	public function location_status() 
	{
		$this->form("select")->name("status")->type("select")->required()->validate();
		$this->setChild();
	}
	public function date_modified() {}
}
?>
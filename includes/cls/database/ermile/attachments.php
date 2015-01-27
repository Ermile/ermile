<?php
namespace database\ermile;
class attachments 
{
	public $id                = array('null' =>'NO',  'show' =>'NO',  'label'=>'Id',            'type' => 'int@10',                                                                    );
	public $file_id           = array('null' =>'NO',  'show' =>'YES', 'label'=>'File',          'type' => 'int@10',                                                                    'foreign'=>'files@id!file_title');
	public $attachment_title  = array('null' =>'YES', 'show' =>'YES', 'label'=>'Title',         'type' => 'varchar@100',                                                               );
	public $attachment_model  = array('null' =>'NO',  'show' =>'YES', 'label'=>'Model',         'type' => 'enum@productcategory,product,admin,banklogo,post,system,other,file,folder', );
	public $attachment_addr   = array('null' =>'NO',  'show' =>'YES', 'label'=>'Addr',          'type' => 'varchar@100',                                                               );
	public $attachment_name   = array('null' =>'NO',  'show' =>'YES', 'label'=>'Name',          'type' => 'varchar@50',                                                                );
	public $attachment_type   = array('null' =>'NO',  'show' =>'NO',  'label'=>'Type',          'type' => 'varchar@10',                                                                );
	public $attachment_size   = array('null' =>'NO',  'show' =>'YES', 'label'=>'Size',          'type' => 'float@12,0',                                                                );
	public $attachment_desc   = array('null' =>'YES', 'show' =>'NO',  'label'=>'Desc',          'type' => 'varchar@200',                                                               );
	public $attachment_parent = array('null' =>'YES', 'show' =>'YES', 'label'=>'Parent',        'type' => 'int@10',                                                                    );
	public $attachment_depth  = array('null' =>'YES', 'show' =>'YES', 'label'=>'Depth',         'type' => 'smallint@5',                                                                );
	public $attachment_count  = array('null' =>'YES', 'show' =>'YES', 'label'=>'Count',         'type' => 'smallint@5',                                                                );
	public $attachment_order  = array('null' =>'YES', 'show' =>'YES', 'label'=>'Order',         'type' => 'smallint@5',                                                                );
	public $user_id           = array('null' =>'NO',  'show' =>'NO',  'label'=>'User',          'type' => 'smallint@5',                                                                'foreign'=>'users@id!user_nickname');
	public $date_modified     = array('null' =>'YES', 'show' =>'NO',  'label'=>'Modified',      'type' => 'timestamp@',                                                                );


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ id - foreign key
	public function file_id() 
	{
		$this->form("select")->name("file_")->min(0)->max(999999999)->required()->type("select")->validate()->id();
		$this->setChild();
	}

	//------------------------------------------------------------------ title
	public function attachment_title() 
	{
		$this->form("#title")->maxlength(100)->type('text');
	}

	//------------------------------------------------------------------ select button
	public function attachment_model() 
	{
		$this->form("select")->name("model")->type("select")->required()->validate();
		$this->setChild();
	}
	public function attachment_addr() 
	{
		$this->form("text")->name("addr")->maxlength(100)->required()->type('text');
	}
	public function attachment_name() 
	{
		$this->form("text")->name("name")->maxlength(50)->required()->type('text');
	}

	//------------------------------------------------------------------ type
	public function attachment_type() 
	{
		$this->form("#type")->maxlength(10)->required()->type('text');
	}
	public function attachment_size() 
	{
		$this->form("text")->name("size")->max(99999999999)->required()->type('number');
	}

	//------------------------------------------------------------------ desc
	public function attachment_desc() 
	{
		$this->form("#desc")->maxlength(200)->type('textarea');
	}
	public function attachment_parent() 
	{
		$this->form("text")->name("parent")->min(0)->max(999999999)->type('number');
	}
	public function attachment_depth() 
	{
		$this->form("text")->name("depth")->min(0)->max(9999)->type('number');
	}
	public function attachment_count() 
	{
		$this->form("text")->name("count")->min(0)->max(9999)->type('number');
	}
	public function attachment_order() 
	{
		$this->form("text")->name("order")->max(9999)->type('number');
	}
	public function user_id() {$this->validate()->id();}
	public function date_modified() {}
}
?>
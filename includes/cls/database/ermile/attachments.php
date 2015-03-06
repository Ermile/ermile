<?php
namespace database\ermile;
class attachments 
{
	public $id                = array('null' =>'NO',  'show' =>'NO',  'label'=>'id',            'type' => 'int@10',                                                                    );
	public $file_id           = array('null' =>'YES', 'show' =>'YES', 'label'=>'file',          'type' => 'int@10',                                                                    'foreign'=>'files@id!id');
	public $attachment_title  = array('null' =>'YES', 'show' =>'YES', 'label'=>'title',         'type' => 'varchar@100',                                                               );
	public $attachment_type   = array('null' =>'NO',  'show' =>'NO',  'label'=>'type',          'type' => 'enum@productcategory,product,admin,banklogo,post,system,other,file,folder', );
	public $attachment_addr   = array('null' =>'YES', 'show' =>'YES', 'label'=>'addr',          'type' => 'varchar@1000',                                                              );
	public $attachment_name   = array('null' =>'YES', 'show' =>'YES', 'label'=>'name',          'type' => 'varchar@50',                                                                );
	public $attachment_ext    = array('null' =>'YES', 'show' =>'YES', 'label'=>'ext',           'type' => 'varchar@255',                                                               );
	public $attachment_size   = array('null' =>'YES', 'show' =>'YES', 'label'=>'size',          'type' => 'float@12,0',                                                                );
	public $attachment_desc   = array('null' =>'YES', 'show' =>'NO',  'label'=>'desc',          'type' => 'varchar@200',                                                               );
	public $attachment_parent = array('null' =>'YES', 'show' =>'YES', 'label'=>'parent',        'type' => 'int@10',                                                                    );
	public $attachment_depth  = array('null' =>'YES', 'show' =>'YES', 'label'=>'depth',         'type' => 'smallint@5',                                                                );
	public $attachment_count  = array('null' =>'YES', 'show' =>'YES', 'label'=>'count',         'type' => 'smallint@5',                                                                );
	public $attachment_order  = array('null' =>'YES', 'show' =>'YES', 'label'=>'order',         'type' => 'smallint@5',                                                                );
	public $attachment_status = array('null' =>'NO',  'show' =>'YES', 'label'=>'status',        'type' => 'enum@normal,trash,deleted,inprogress!normal',                               );
	public $user_id           = array('null' =>'NO',  'show' =>'NO',  'label'=>'user',          'type' => 'smallint@5',                                                                'foreign'=>'users@id!user_nickname');
	public $date_modified     = array('null' =>'YES', 'show' =>'NO',  'label'=>'modified',      'type' => 'timestamp@',                                                                );


	//------------------------------------------------------------------ id
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ id - foreign key
	public function file_id() 
	{
		$this->form("select")->name("file_")->min(0)->max(9999999999)->type("select")->validate()->id();
		$this->setChild();
	}

	//------------------------------------------------------------------ title
	public function attachment_title() 
	{
		$this->form("#title")->maxlength(100)->type('text');
	}

	//------------------------------------------------------------------ type
	public function attachment_type() 
	{
		$this->form("#type")->required()->type('radio');
	}
	public function attachment_addr() 
	{
		$this->form("text")->name("addr")->maxlength(1000)->type('textarea');
	}
	public function attachment_name() 
	{
		$this->form("text")->name("name")->maxlength(50)->type('text');
	}
	public function attachment_ext() 
	{
		$this->form("text")->name("ext")->maxlength(255)->type('textarea');
	}
	public function attachment_size() 
	{
		$this->form("text")->name("size")->max(999999999999)->type('number');
	}

	//------------------------------------------------------------------ desc
	public function attachment_desc() 
	{
		$this->form("#desc")->maxlength(200)->type('textarea');
	}
	public function attachment_parent() 
	{
		$this->form("text")->name("parent")->min(0)->max(9999999999)->type('number');
	}
	public function attachment_depth() 
	{
		$this->form("text")->name("depth")->min(0)->max(99999)->type('number');
	}
	public function attachment_count() 
	{
		$this->form("text")->name("count")->min(0)->max(99999)->type('number');
	}
	public function attachment_order() 
	{
		$this->form("text")->name("order")->max(99999)->type('number');
	}

	//------------------------------------------------------------------ select button
	public function attachment_status() 
	{
		$this->form("select")->name("status")->type("select")->required()->validate();
		$this->setChild();
	}

	//------------------------------------------------------------------ user_id
	public function user_id() {$this->validate()->id();}
	public function date_modified() {}
}
?>
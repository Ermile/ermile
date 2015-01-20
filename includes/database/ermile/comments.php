<?php
namespace database\ermile;
class comments 
{
	public $id              = array('null' =>'NO',  'show' =>'NO',  'label'=>'ID',            'type' => 'smallint@5',                                       );
	public $post_id         = array('null' =>'YES', 'show' =>'YES', 'label'=>'Post',          'type' => 'smallint@5',                                       'foreign'=>'posts@id!post_title');
	public $product_id      = array('null' =>'YES', 'show' =>'YES', 'label'=>'Product',       'type' => 'smallint@5',                                       'foreign'=>'products@id!product_title');
	public $comment_author  = array('null' =>'YES', 'show' =>'YES', 'label'=>'Author',        'type' => 'varchar@50',                                       );
	public $comment_email   = array('null' =>'YES', 'show' =>'YES', 'label'=>'Email',         'type' => 'varchar@100',                                      );
	public $comment_url     = array('null' =>'YES', 'show' =>'YES', 'label'=>'Url',           'type' => 'varchar@100',                                      );
	public $comment_content = array('null' =>'NO',  'show' =>'YES', 'label'=>'Content',       'type' => 'varchar@999',                                      );
	public $comment_status  = array('null' =>'NO',  'show' =>'YES', 'label'=>'Status',        'type' => 'enum@approved,unapproved,spam,deleted!unapproved', );
	public $comment_parent  = array('null' =>'YES', 'show' =>'YES', 'label'=>'Parent',        'type' => 'int@10',                                           );
	public $user_id         = array('null' =>'YES', 'show' =>'NO',  'label'=>'User',          'type' => 'smallint@5',                                       'foreign'=>'users@id!user_nickname');
	public $Visitor_id      = array('null' =>'NO',  'show' =>'YES', 'label'=>'Visitor',       'type' => 'int@10',                                           'foreign'=>'Visitors@id!Visitor_title');
	public $date_modified   = array('null' =>'YES', 'show' =>'NO',  'label'=>'Date Modified', 'type' => 'timestamp@',                                       );


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ id - foreign key
	public function post_id() 
	{
		$this->form("select")->name("post")->min(0)->max(9999)->type("select")->validate()->id();
		$this->setChild();
	}

	//------------------------------------------------------------------ id - foreign key
	public function product_id() 
	{
		$this->form("select")->name("product")->min(0)->max(9999)->type("select")->validate()->id();
		$this->setChild();
	}
	public function comment_author() 
	{
		$this->form("text")->name("author")->maxlength(50)->type('text');
	}

	//------------------------------------------------------------------ email
	public function comment_email() 
	{
		$this->form("#email")->type("email")->required()->maxlength(100);
	}
	public function comment_url() 
	{
		$this->form("text")->name("url")->maxlength(100)->type('text');
	}
	public function comment_content() 
	{
		$this->form("text")->name("content")->maxlength(999)->required()->type('textarea');
	}

	//------------------------------------------------------------------ select button
	public function comment_status() 
	{
		$this->form("select")->name("status")->type("select")->required()->validate();
		$this->setChild();
	}
	public function comment_parent() 
	{
		$this->form("text")->name("parent")->min(0)->max(999999999)->type('number');
	}
	public function user_id() {$this->validate()->id();}

	//------------------------------------------------------------------ id - foreign key
	public function Visitor_id() 
	{
		$this->form("select")->name("Visitor")->min(0)->max(999999999)->required()->type("select")->validate()->id();
		$this->setChild();
	}
	public function date_modified() {}
}
?>